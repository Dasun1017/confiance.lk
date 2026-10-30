Careers page
============

Public page: careers.html
Footer Explore link: Careers (after Gallery)
Confirmed opening: Japanese Language Teacher
Applications inbox: lkconfiance@gmail.com

Application delivery
--------------------
The form posts to career-application.php and emails the PDF CV as an attachment.
It uses the hosting server's PHP mail transport. Configure that transport to
deliver mail for no-reply@confiance.lk, including the host's normal sender-domain
authentication. A successful PHP mail() call means the message was accepted by
the configured transport; it does not confirm Gmail inbox delivery.

Local testing
-------------
Opening careers.html with file:// lets you fill in every field and run client
validation with Test Application. No application or email is sent.

For full PHP upload/validation testing, run:
  node scripts/preview-careers.cjs
Then open http://127.0.0.1:8080/careers.html and click Apply for this role.
This preview saves accepted test messages and PDF attachments in a private
system-temporary folder printed by the command. No email is sent.
Use --port=8081 if port 8080 is occupied, and CAREERS_PHP for another PHP binary.

Production hosting uses its configured PHP mail transport as described above.

Settings live in careers-config.php. Do not put SMTP passwords or other secrets
in a public JavaScript file. The recipient is fixed on the server, not taken
from submitted form fields.

CVs must be real PDFs. The configured limit is 5 MB; the GET endpoint reports
a lower effective limit if PHP upload/post settings require it. CVs remain in
PHP's temporary upload area only for the request and are not saved under the
website. The rate limiter stores only timestamps and a hash of the connection
address in the system temporary directory. No changes are made to edu.

Changing roles
--------------
Update the vacancy markup/options in careers.html and the approved role IDs
in careers-config.php together. Do not advertise an unconfirmed vacancy.
A general application is also available.

Validation
----------
node tests/frontend-check.cjs
node tests/careers-endpoint-check.cjs

The endpoint test uses PHP and a local SMTP capture server. It never sends an
application to Gmail. Live inbox delivery still needs verification on the host.

Vacancy poster and application popup
------------------------------------
The hiring post fills the content width and includes the poster at
newTemplate/images/japanese-teacher-hiring-poster.png.
The poster was generated with the built-in imagegen tool; the exact prompt is
saved alongside it in japanese-teacher-hiring-poster.prompt.txt.
Apply for this role and Introduce yourself open the same accessible native
application dialog. Closing the popup preserves in-progress fields and the CV.
The underlying email endpoint and recruitment inbox remain unchanged.
