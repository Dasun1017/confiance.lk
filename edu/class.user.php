<?php

//require_once 'dbconfig.php';

class USER
{	

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE userEmail=:email_id	AND type = '1' OR userEmail=:email_id	AND type = '2' OR userEmail=:email_id	AND type = '3' ");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y")
				{
					if($userRow['userPass']==md5($upass))
					{
						$_SESSION['userSession'] = $userRow['userID'];
						$_SESSION['userName'] = $userRow['userName'];
						$_SESSION['type'] = $userRow['type'];
						$_SESSION['grade'] = $userRow['grade'];
						return true;
					}
					else
					{
						if($userRow['type'] == '1') { header("Location: login.php?error&&view=$_GET[view]"); }
						if($userRow['type'] == '2') { header("Location: login.php?error&&view=$_GET[view]"); }
						if($userRow['type'] == '3') { header("Location: login.php?error&&view=$_GET[view]"); }
						exit;
					}
				}
				else
				{
						if($userRow['type'] == '1') { header("Location: login.php?inactive&&view=$_GET[view]"); }
						if($userRow['type'] == '2') { header("Location: login.php?inactive&&e=$_POST[username]&&view=$_GET[view]"); }
						if($userRow['type'] == '3') { header("Location: login.php?inactive&&view=$_GET[view]"); }
					exit;
				}	
			}
			else
			{
						 header("Location: ?error&&view=$_GET[view]"); 
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function logout()
	{
		//session_destroy();
		//$_SESSION['userSession'] = false;
	          unset($_SESSION["userSession"]);
	          unset($_SESSION["userName"]);
        	  unset($_SESSION["cart_item"]);
	}
	
	function send_mail($email,$message,$subject)
	{						
		require_once('mailer/class.phpmailer.php');
        $mail = new PHPMailer();
		//$mail = new PHPMailer(true);
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;
		$mail->SMTPAuth   = true;                  
		$mail->SMTPSecure = "ssl";                 
		$mail->Host       = "mail.aselhardware.com";  
		$mail->Port       = 465;//587;             
		$mail->addAddress($email);
		$mail->Username="info@aselhardware.com";  
		$mail->Password="Admin123";            
		$mail->setFrom('info@aselhardware.com','AselHardware.com');
		$mail->addReplyTo("info@aselhardware.com","AselHardware.com");
		$mail->Subject    = $subject;
		$mail->IsHTML(true);
		$mail->msgHTML($message);
		$mail->send();
	}	
}