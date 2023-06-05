<?php

date_default_timezone_set('Asia/Kolkata');
require_once('Model/Model.php');
session_start();

class Controller extends Model
{

	function __construct()
	{
		parent::__construct();

		if (isset($_SERVER['PATH_INFO'])) {
			switch ($_SERVER['PATH_INFO']) {
				case '/':
					include 'Views/consumer/header.php';
					include 'Views/consumer/home.php';
					include 'Views/consumer/footer.php';
					break;


				case '/login':
					include 'Views/login.php'; 

					if($_SERVER['REQUEST_METHOD'] == "POST"){
						$email = mysqli_real_escape_string($this->connection ,$_POST['email']);
						$pass = mysqli_real_escape_string($this->connection ,$_POST['password']);
	
						$loginEx = $this->LoginData($email, $pass);
						if($loginEx['Code']){
							?>
							<script type="text/javascript">
								console.log("success");
								openModal("Login Successful", "<?= $loginEx['Message']?>", 0, 1.5);
							</script>	
							<?php
							header("Refresh:1.5; url=./");
						} else {
							?>
							<script type="text/javascript">
								console.log("failed");
								openModal("Login Failed", "<?= $loginEx['Message']?>", 1, 1.5);
							</script>	
							<?php
						}
					}

					break;
				
				case '/register':
					echo "register here";
					break;

				case '/userHome':
					echo "hey";
					break;

				case '/adminHome':
					echo "hey cons";
					break;
			}
		}
	}
}

$obj = new Controller;
