<?php

date_default_timezone_set('Asia/Kolkata');
require_once('Model/Model.php');
session_start();

class Controller extends Model
{
	function redirect($path, $seconds)
	{
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
			$protocol = 'https';
		} else {
			$protocol = 'http';
		}
		$protocol = $_SERVER['REQUEST_SCHEME'];
		$host = $_SERVER['HTTP_HOST'];
		$path = '/nisargi' . $path;

		header("Refresh: $seconds; url=$protocol://$host$path");
		// header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "/nisargi" . $path);
		exit;
	}

	function validateForm($data)
	{
		$errors = [];

		foreach ($data as $field => $value) {

			if (empty($value)) {
				$errors[] = ucfirst($field) . ' should not be empty.';
			}

			if ($field === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
				$errors[] = 'Invalid email format.';
			}

			if ($field === 'number' || $field === 'stock' || $field === 'price') {
				if (!is_numeric($value))
					$errors[] = ucfirst($field) . ' must be number';
			}
		}

		return $errors;
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
						$this->redirect('/', 0);
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
						$this->redirect("/", 0);
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

						$error = [];
						$error = $this->validateForm($insert_data);
						if ($error) {
						?>
							<script>
								openModal("Failed Insertion", "<?= $error[0] ?>", 1, 1.5);
							</script>
						<?php
							exit;
						}
						$insertEx = $this->InsertData('user', $insert_data);
						if ($insertEx['Code']) {
							if (!is_null($photo)) {
								move_uploaded_file($_FILES['photo']['tmp_name'], $path . $file_name);
							}
						?>
							<script>
								console.log("hey success");
								openModal("Register Success", "Please login Now!", 0, 1.5);
							</script>
						<?php
							$this->redirect('/login', 1.5);
						} else {
						?>
							<script>
								openModal("Failed", "<?= $insertEx['Message'] ?>", 0, 1.5);
							</script>
						<?php
						}
					}

					break;

				case '/farmerZone':
					include 'Views/producer/header.php';
					include 'Views/producer/dashboard.php';
					include 'Views/producer/footer.php';
					break;

				case '/farmerProduct':
					$where = ['shop_id' => 1, 'deleteFlag' => 'o'];
					$products = $this->SelectData('product', $where);

					include 'Views/producer/header.php';
					include 'Views/producer/product.php';
					include 'Views/producer/footer.php';
					break;

				case '/productCreate':

					include 'Views/producer/header.php';
					include 'Views/producer/productForm.php';
					include "Views/modal.php";


					if ($_SERVER['REQUEST_METHOD'] == "POST") {
						$path = 'uploads/products/';
						$extention = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
						$file_name = $_POST['name'] . '_' . date('YmdHis') . '.' . $extention;
						$photo = (file_exists($_FILES['image']['tmp_name'])) ? $file_name : null;

						$insert_data = [
							'name' => $_POST['name'],
							'image' => $photo,
							'description' => $_POST['description'],
							'category' => $_POST['category'],
							'price' => $_POST['price'],
							'stock' => $_POST['stock'],
							'unit' => $_POST['unit'],
							'shop_id' => 1,
						];
						$error = [];
						$error = $this->validateForm($insert_data);
						if ($error) {
						?>
							<script>
								openModal("Failed Insertion", "<?= $error[0] ?>", 1, 1.5);
							</script>
						<?php
							exit;
						}
						$insertEx = $this->InsertData('product', $insert_data);
						if ($insertEx['Code']) {
							if (!is_null($photo)) {
								move_uploaded_file($_FILES['image']['tmp_name'], $path . $file_name);
							}
						?>
							<script>
								openModal("Sucess", "data has been sucessfully inserted", 0, 1.5, './farmerProduct');
							</script>
						<?php

						} else {
						?>
							<script>
								openModal("Failed", "data has been sucessfully failed", 1, 1.5);
							</script>
						<?php
						}
					}

					include 'Views/producer/footer.php';
					break;

				case '/productEdit':
					include 'Views/producer/header.php';

					$product = [
						'name' => '',
						'image' => '',
						'description' => '',
						'category' => '',
						'price' => '',
						'stock' => '',
						'unit' => '',
						'shop_id' => 1,
					];

					if ($_SERVER['REQUEST_METHOD'] == "GET") {
						$where = ['id' => $_GET['id']];
						$products = $this->SelectData('product', $where);
						if (!$products['Code']) {
							echo "no product found";
							exit;
						}
						$product = $products['Data'][0];
						include 'Views/producer/productFormEdit.php';
					}

					include 'Views/modal.php';

					if ($_SERVER['REQUEST_METHOD'] == "POST") {

						$where = ['id' => $_GET['id']];
						$products = $this->SelectData('product', $where);
						$product = $products['Data'][0];

						$path = 'uploads/products/';
						$extention = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
						$file_name = $_POST['name'] . '_' . date('YmdHis') . '.' . $extention;
						$photo = (file_exists($_FILES['image']['tmp_name'])) ? $file_name : $product->image;


						$update_data = [
							'name' => $_POST['name'],
							'image' => $photo,
							'description' => $_POST['description'],
							'category' => $_POST['category'],
							'price' => $_POST['price'],
							'stock' => $_POST['stock'],
							'unit' => $_POST['unit'],
							'shop_id' => 1,
						];

						$where = ['id' => $_GET['id']];

						$upd_data = $this->UpdateData('product', $update_data, $where);

						if ($upd_data) {

							if (!is_null($photo)) {
								move_uploaded_file($_FILES['image']['tmp_name'], $path . $file_name);
								echo "hello";
							}

						?>
							<script type="text/javascript">
								openModal("Sucess", "data has been sucessfully updated", 0, 1.5, './farmerProduct');
							</script>
						<?php
						} else {
						?>
							<script type="text/javascript">
								openModal("Failed", "data update failed", 1, 1.5, '');
							</script>
<?php
						}
					}

					include 'Views/producer/footer.php';

					break;
				
				case '/productDelete':
					if($_SERVER['REQUEST_METHOD'] == "GET"){
						include 'Views/producer/header.php';
						include 'Views/producer/productDelete.php';
						include 'Views/producer/footer.php';
					}
					if ($_SERVER['REQUEST_METHOD'] == "POST") {
						if ($_POST['delete'] == 'yes') {
							$where = ['id' => $_GET['id']];
							$del_data = $this->FlagDelete('product', $where);
							if($del_data){
								$this->redirect('./farmerProduct', 0);
							}
						}
					}
					break;

				case '/logout':
					if (!isset($_SESSION['user_data'])) {
						$this->redirect("/", 0);
					}

					if ($_SERVER['REQUEST_METHOD'] == "POST") {
						if ($_POST['logout'] == 'yes') {
							unset($_SESSION['user_data']);
							session_destroy();
							$this->redirect('/', 0);
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
