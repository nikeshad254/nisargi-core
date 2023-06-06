<?php

date_default_timezone_set('Asia/Kolkata');
require_once('Model/Model.php');
session_start();

class Controller extends Model
{	
	function redirect($path){
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off'){
			$protocol = 'https';
		}else{
			$protocol = 'http';
		}
		header("Location: $protocol://".$_SERVER['HTTP_HOST']."/nisargi".$path);
		exit;
	}

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
					if (isset($_SESSION['user_data'])) {
						// print_r($_SESSION['user_data']);
						// echo $_SESSION['user_data']->photo;
						// exit;
						$this->redirect('/');
					}

					include 'Views/login.php';

					if ($_SERVER['REQUEST_METHOD'] == "POST") {
						$email = mysqli_real_escape_string($this->connection, $_POST['email']);
						$pass = mysqli_real_escape_string($this->connection, $_POST['password']);

						$loginEx = $this->LoginData($email, $pass);
						if ($loginEx['Code']) {
							$_SESSION['user_data'] = $loginEx['Data'];
?>
							<script type="text/javascript">
								openModal("Login Successful", "<?= $loginEx['Message'] ?>", 0, 1.5);
							</script>
						<?php
							header("Refresh:1.5; url=./");
						} else {
						?>
							<script type="text/javascript">
								openModal("Login Failed", "<?= $loginEx['Message'] ?>", 1, 1.5);
							</script>
						<?php
						}
					}

					break;

				case '/register':
					if (isset($_SESSION['user_data'])) {
						$this->redirect("/");
					}

					include 'Views/consumer/register.php';

					if ($_SERVER['REQUEST_METHOD'] == "POST") {
						$path = 'uploads/';
						$extention = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
						$file_name = $_POST['name'] . '_' . date('YmdHis') . '.' . $extention;
						$photo = (file_exists($_FILES['photo']['tmp_name'])) ? $file_name : null;

						$insert_data = [
							'name' => $_POST['name'],
							'address' => $_POST['address'],
							'email' => $_POST['email'],
							'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
							'photo' => $photo,
						];

						$insertEx = $this->InsertData('user', $insert_data);
						if ($insertEx['Code']) {
							if (!is_null($photo)) {
								move_uploaded_file($_FILES['photo']['tmp_name'], $path . $file_name);
							}
						?>
							<script type="text/javascript">
								openModal("Success", "<?= $insertEx['Message'] ?>", 0, 1.5);
								setTimeout(() => {
									<?php $this->redirect('/login'); ?>
								}, 1500);
							</script>
						<?php
						} else {
						?>
							<script type="text/javascript">
								openModal("Failed", "<?= $insertEx['Message'] ?>", 0, 1.5);
							</script>
<?php
						}
					}

					break;

				case '/userHome':
					echo "hey";
					break;

				case '/adminHome':
					echo "hey cons";
					break;
				
				case '/logout':
					if (!isset($_SESSION['user_data'])) {
						$this->redirect("/");
					}

					if ($_SERVER['REQUEST_METHOD'] == "POST") {
						if($_POST['logout']=='yes'){
							unset($_SESSION['user_data']);
							session_destroy();
							$this->redirect('/');
						}
					}
					include 'Views/logout.php';
					break;

					default:
					break;
			}
		}
	}
}

$obj = new Controller;
