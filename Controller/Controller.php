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
					include 'Views/login.php';
					break;


				case '/login':

					if($_SERVER['REQUEST_METHOD'] == "POST"){
						$email = mysqli_real_escape_string($this->connection ,$_POST['email']);
						$pass = mysqli_real_escape_string($this->connection ,$_POST['password']);
	
						$loginEx = $this->LoginData($email, $pass);
						if($loginEx['Code']){
							?>
							<script type="text/javascript">
								console.log("<?php echo $loginEx['Message'] ?>");
							</script>	
							<?php
						} else {
							?>
							<script type="text/javascript">
								console.log("<?php echo $loginEx['Message'] ?>");
							</script>	
							<?php
						}
					}

					include 'Views/login.php'; 
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
