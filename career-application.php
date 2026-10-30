<?php
declare(strict_types=1);

ini_set('display_errors', '0');
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, max-age=0');
header('X-Content-Type-Options: nosniff');

function career_response(int $status, array $payload): void
{
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function career_error(int $status, string $message): void
{
    career_response($status, ['success' => false, 'message' => $message]);
}

function career_ini_bytes(string $value): int
{
    $value = trim($value);
    if ($value === '' || $value === '0' || $value === '-1') {
        return PHP_INT_MAX;
    }
    $number = (float) $value;
    $unit = strtolower(substr($value, -1));
    $multipliers = ['k' => 1024, 'm' => 1048576, 'g' => 1073741824];
    return (int) ($number * ($multipliers[$unit] ?? 1));
}

function career_text(string $key): string
{
    return isset($_POST[$key]) && is_string($_POST[$key]) ? trim($_POST[$key]) : '';
}

function career_rate_limit(array $config): void
{
    // Only timestamps and a hash of the connection address are stored, outside the web root.
    $directory = rtrim(sys_get_temp_dir(), '/\\') . DIRECTORY_SEPARATOR . 'confiance-careers-limits';
    if (!is_dir($directory) && !@mkdir($directory, 0700, true) && !is_dir($directory)) {
        career_error(503, 'Online applications are temporarily unavailable. Please email your CV to lkconfiance@gmail.com.');
    }
    $address = (string) ($_SERVER['REMOTE_ADDR'] ?? 'unknown');
    $file = $directory . DIRECTORY_SEPARATOR . hash('sha256', __DIR__ . '|' . $address) . '.json';
    $handle = @fopen($file, 'c+');
    if ($handle === false) {
        career_error(503, 'Online applications are temporarily unavailable. Please email your CV to lkconfiance@gmail.com.');
    }
    if (!flock($handle, LOCK_EX)) {
        fclose($handle);
        career_error(503, 'Please try again in a moment.');
    }
    $now = time();
    $existing = json_decode((string) stream_get_contents($handle), true);
    $attempts = is_array($existing) ? array_values(array_filter($existing, static function ($timestamp) use ($now) {
        return is_int($timestamp) && $timestamp > $now - 3600;
    })) : [];
    $last = count($attempts) > 0 ? (int) end($attempts) : 0;
    $retryAfter = 0;
    if ($last > 0 && $now - $last < (int) $config['minimum_interval']) {
        $retryAfter = (int) $config['minimum_interval'] - ($now - $last);
    } elseif (count($attempts) >= (int) $config['hourly_limit']) {
        $retryAfter = max(1, 3600 - ($now - $attempts[0]));
    }
    if ($retryAfter > 0) {
        flock($handle, LOCK_UN);
        fclose($handle);
        header('Retry-After: ' . $retryAfter);
        career_error(429, 'Please wait before sending another application, or email your CV to lkconfiance@gmail.com.');
    }
    $attempts[] = $now;
    rewind($handle);
    $written = ftruncate($handle, 0) && fwrite($handle, (string) json_encode($attempts)) !== false;
    fflush($handle);
    flock($handle, LOCK_UN);
    fclose($handle);
    if (!$written) {
        career_error(503, 'Online applications are temporarily unavailable. Please email your CV to lkconfiance@gmail.com.');
    }
}

try {
    $config = require __DIR__ . '/careers-config.php';
    // Test mode is enabled only by the local preview process, never by submitted input.
    $preview = getenv('CAREERS_PREVIEW') === '1'
        && in_array((string) ($_SERVER['REMOTE_ADDR'] ?? ''), ['127.0.0.1', '::1'], true);
    if ($preview) {
        $config['minimum_form_age'] = 0;
        $config['minimum_interval'] = 0;
        $config['hourly_limit'] = 100;
    }
    $method = $_SERVER['REQUEST_METHOD'] ?? '';
    if (!in_array($method, ['GET', 'POST'], true)) {
        header('Allow: GET, POST');
        career_error(405, 'This request method is not supported.');
    }
    $maxBytes = min(
        (int) $config['max_cv_bytes'],
        career_ini_bytes((string) ini_get('upload_max_filesize')),
        max(1, career_ini_bytes((string) ini_get('post_max_size')) - 65536)
    );
    if ($method === 'POST' && (int) ($_SERVER['CONTENT_LENGTH'] ?? 0) > $maxBytes + 65536) {
        career_error(413, 'Your application is too large. Please choose a smaller PDF.');
    }
    if ($method === 'POST' && isset($_SERVER['HTTP_ORIGIN'])) {
        $origin = parse_url((string) $_SERVER['HTTP_ORIGIN']);
        $host = parse_url('http://' . (string) ($_SERVER['HTTP_HOST'] ?? ''));
        if (!is_array($origin) || !is_array($host)
            || !in_array(strtolower((string) ($origin['scheme'] ?? '')), ['http', 'https'], true)
            || strtolower((string) ($origin['host'] ?? '')) !== strtolower((string) ($host['host'] ?? ''))
            || (int) ($origin['port'] ?? 0) !== (int) ($host['port'] ?? 0)) {
            career_error(403, 'Please submit your application from the CONFIANCE careers page.');
        }
    }

    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    session_name('confiance_careers');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    if (!session_start()) {
        career_error(503, 'Online applications are temporarily unavailable. Please email your CV to lkconfiance@gmail.com.');
    }
    $now = time();
    if ($method === 'GET') {
        if (!isset($_SESSION['csrf_token'], $_SESSION['issued_at'])
            || $now - (int) $_SESSION['issued_at'] > 7200) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            $_SESSION['issued_at'] = $now;
        }
        career_response(200, [
            'success' => true,
            'csrfToken' => $_SESSION['csrf_token'],
            'mode' => $preview ? 'preview' : 'live',
            'maxBytes' => $maxBytes,
        ]);
    }

    $token = career_text('csrf_token');
    if (!isset($_SESSION['csrf_token'], $_SESSION['issued_at'])
        || $token === '' || !hash_equals((string) $_SESSION['csrf_token'], $token)
        || $now - (int) $_SESSION['issued_at'] > 7200) {
        career_error(403, 'Your application form has expired. Please refresh this page and try again.');
    }
    if (career_text('company_website') !== '') {
        career_error(422, 'This application could not be accepted.');
    }
    if ($now - (int) $_SESSION['issued_at'] < (int) $config['minimum_form_age']) {
        header('Retry-After: 3');
        career_error(429, 'Please take a moment to review your application, then try again.');
    }
    $name = career_text('full_name');
    $email = career_text('email');
    $phone = career_text('phone');
    $role = career_text('role');
    $message = career_text('message');
    if (!preg_match('/^[^\p{C}]{2,120}$/u', $name)) {
        career_error(422, 'Please enter your full name.');
    }
    if (strlen($email) > 254 || !filter_var($email, FILTER_VALIDATE_EMAIL) || preg_match('/[\r\n]/', $email)) {
        career_error(422, 'Please enter a valid email address.');
    }
    $phoneDigits = preg_replace('/\D/', '', $phone);
    if (!preg_match('/^[+0-9 ()-]{7,30}$/', $phone) || strlen($phoneDigits) < 7 || strlen($phoneDigits) > 15) {
        career_error(422, 'Please enter a valid phone number.');
    }
    if (!array_key_exists($role, $config['roles'])) {
        career_error(422, 'Please select an available position.');
    }
    if (strlen($message) > 8000 || preg_match('//u', $message) !== 1
        || preg_match_all('/./us', $message) > 2000) {
        career_error(422, 'Please keep your introduction within 2,000 characters.');
    }
    if (career_text('consent') !== '1') {
        career_error(422, 'Please agree to the use of your details for this application.');
    }
    $upload = $_FILES['cv'] ?? null;
    if (!is_array($upload) || !isset($upload['error']) || !is_int($upload['error'])) {
        career_error(422, 'Please attach your CV as a PDF.');
    }
    if (in_array($upload['error'], [UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE], true)) {
        career_error(413, 'Your CV is too large. Please choose a smaller PDF.');
    }
    if ($upload['error'] !== UPLOAD_ERR_OK || !isset($upload['tmp_name'], $upload['name'], $upload['size'])
        || !is_string($upload['tmp_name']) || !is_string($upload['name'])
        || !is_uploaded_file($upload['tmp_name'])) {
        career_error(422, 'Your CV could not be uploaded. Please select it again.');
    }
    if ((int) $upload['size'] < 5 || (int) $upload['size'] > $maxBytes) {
        career_error(413, 'Please attach a PDF within the displayed file-size limit.');
    }
    if (!class_exists('finfo')) {
        career_error(503, 'Online applications are temporarily unavailable. Please email your CV to lkconfiance@gmail.com.');
    }
    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($upload['tmp_name']);
    $pdf = file_get_contents($upload['tmp_name']);
    if (strtolower(pathinfo($upload['name'], PATHINFO_EXTENSION)) !== 'pdf'
        || $mime !== 'application/pdf' || !is_string($pdf) || substr($pdf, 0, 5) !== '%PDF-') {
        career_error(422, 'Please upload a valid PDF document.');
    }
    if (!filter_var($config['recipient'], FILTER_VALIDATE_EMAIL) || !filter_var($config['sender'], FILTER_VALIDATE_EMAIL)
        || (!$preview && !function_exists('mail'))) {
        career_error(503, 'Online applications are temporarily unavailable. Please email your CV to lkconfiance@gmail.com.');
    }

    career_rate_limit($config);
    $roleTitle = (string) $config['roles'][$role];
    $subject = '=?UTF-8?B?' . base64_encode('Career application - ' . $roleTitle) . '?=';
    $boundary = 'confiance_' . bin2hex(random_bytes(18));
    $bodyText = "New CONFIANCE career application\n\nPosition: " . $roleTitle
        . "\nName: " . $name . "\nEmail: " . $email . "\nPhone: " . $phone
        . "\n\nIntroduction:\n" . ($message !== '' ? $message : '(Not provided)')
        . "\n\nThe applicant agreed to the use of their details and CV for recruitment."
        . "\nTheir PDF CV is attached. Reply to this email to contact the applicant.\n";
    $body = '--' . $boundary . "\r\n"
        . "Content-Type: text/plain; charset=UTF-8\r\nContent-Transfer-Encoding: base64\r\n\r\n"
        . chunk_split(base64_encode($bodyText)) . "\r\n"
        . '--' . $boundary . "\r\n"
        . "Content-Type: application/pdf; name=\"CV.pdf\"\r\n"
        . "Content-Disposition: attachment; filename=\"CV.pdf\"\r\n"
        . "Content-Transfer-Encoding: base64\r\n\r\n"
        . chunk_split(base64_encode($pdf)) . "\r\n--" . $boundary . "--\r\n";
    $headers = [
        'From' => 'CONFIANCE Careers <' . $config['sender'] . '>',
        'Reply-To' => $email,
        'MIME-Version' => '1.0',
        'Content-Type' => 'multipart/mixed; boundary="' . $boundary . '"',
    ];
    if ($preview) {
        $captureDirectory = rtrim(sys_get_temp_dir(), '/\\') . DIRECTORY_SEPARATOR . 'confiance-careers-preview';
        if (!is_dir($captureDirectory) && !@mkdir($captureDirectory, 0700, true) && !is_dir($captureDirectory)) {
            career_error(503, 'The local test could not save your application. Please try again.');
        }
        $captureId = bin2hex(random_bytes(10));
        $captureFile = $captureDirectory . DIRECTORY_SEPARATOR . 'application-' . $captureId . '.eml';
        $captureHeaders = 'To: ' . $config['recipient'] . "\r\nSubject: " . $subject . "\r\n";
        foreach ($headers as $name => $value) {
            $captureHeaders .= $name . ': ' . $value . "\r\n";
        }
        if (@file_put_contents($captureFile, $captureHeaders . "\r\n" . $body, LOCK_EX) === false) {
            career_error(503, 'The local test could not save your application. Please try again.');
        }
        @chmod($captureFile, 0600);
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        $_SESSION['issued_at'] = time();
        career_response(200, [
            'success' => true,
            'preview' => true,
            'csrfToken' => $_SESSION['csrf_token'],
            'message' => 'Local test complete: your application and PDF were saved on this computer. No email was sent.',
        ]);
    }
    if (!@mail($config['recipient'], $subject, $body, $headers)) {
        error_log('CONFIANCE careers: recruitment email could not be handed to the mail transport.');
        career_error(503, 'We could not send your application. Please email your CV directly to lkconfiance@gmail.com.');
    }
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    $_SESSION['issued_at'] = time();
    career_response(200, [
        'success' => true,
        'message' => 'Your application has been submitted. Thank you! Our team will contact shortlisted applicants.',
    ]);
} catch (Throwable $error) {
    error_log('CONFIANCE careers: application service error (' . get_class($error) . ').');
    career_error(503, 'Online applications are temporarily unavailable. Please email your CV to lkconfiance@gmail.com.');
}
