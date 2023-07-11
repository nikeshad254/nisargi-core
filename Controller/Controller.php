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

	function filterOrderProductView($orders)
	{
		$newArray = array();

		foreach ($orders as $order) {
			$orderID = $order->order_id;

			if (!isset($newArray[$orderID])) {
				$newArray[$orderID] = clone $order; // Clone the object to preserve other properties
				$newArray[$orderID]->products = array(); // Initialize the products array
			}

			$product = array(
				'price' => $order->price,
				'stock' => $order->stock,
				'quantity' => $order->quantity,
				'id' => $order->product_id,
				'deleteFlag' => $order->deleteFlag,
				'product_name' => $order->product_name,
				'unit' => $order->unit,
				'product_image' => $order->product_image,
			);

			$newArray[$orderID]->products[] = $product;

			// Unset the duplicated properties
			unset($newArray[$orderID]->price);
			unset($newArray[$orderID]->stock);
			unset($newArray[$orderID]->quantity);
			unset($newArray[$orderID]->product_id);
			unset($newArray[$orderID]->deleteFlag);
			unset($newArray[$orderID]->product_name);
			unset($newArray[$orderID]->unit);
			unset($newArray[$orderID]->product_image);
		}

		$newArray = array_values($newArray); // Reset the array keys to be sequential
		return $newArray;
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
							$where = ['user_id' => $_SESSION['user_data']->id];
							$selectEx = $this->SelectData('shop', $where);
							if ($selectEx['Code']) {
								$_SESSION['shop_data'] = $selectEx['Data'][0];
							}

?>
							<script type="text/javascript">
								openModal("Login Successful", "<?= $loginEx['Message'] ?>", 0, 1.5, '/nisargi');
							</script>
						<?php
						} else {
						?>
							<script type="text/javascript">
								openModal("Login Failed", "<?= $loginEx['Message'] ?>", 1, 1.5, '');
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
								openModal("Register Success", "Please login Now!", 0, 1.5, '');
							</script>
						<?php
							$this->redirect('/login', 1.5);
						} else {
						?>
							<script>
								openModal("Failed", "<?= $insertEx['Message'] ?>", 0, 1.5, '');
							</script>
						<?php
						}
					}

					break;

				case '/products':
					$category = '';
					$where = ['deleteFlag' => 'o'];
					if ($_SERVER['REQUEST_METHOD'] == "GET") {
						if (isset($_GET['category'])) {
							$category = $_GET['category'];
							$where = ['deleteFlag' => 'o', 'category' => $category];
							if ($category == '' || $category == 'all') {
								$where = ['deleteFlag' => 'o'];
							}
						}
					}
					$selectEx = $this->SelectData('product_view', $where);
					if ($selectEx['Code'] == false) {
						echo "Error Occured Catgegory and Produccts not found";
						// exit;
					}
					$products = $selectEx['Data'];

					// echo "<pre>";
					// print_r($products);
					// exit;

					include 'Views/consumer/header.php';
					include 'Views/consumer/category.php';
					include 'Views/consumer/footer.php';

					break;

				case '/yourcart':
					include 'Views/consumer/header.php';
					include 'Views/modal.php';
					$cartDatas = [];
					$order_data = array(
						"user_id" => -1,

						"ordered_product" => [],

						"delivery" => array(
							"name" => "",
							"city" => "",
							"street" => "",
							"mobile" => "",
							"message" => "",
						),
					);
					if (isset($_SESSION['user_data'])) {
						$order_data['user_id'] = $_SESSION['user_data']->id;
					}

					if (isset($_COOKIE['nisargiCart101'])) {
						$cartDataUnparsed = $_COOKIE['nisargiCart101'];
						$cartDataUp = json_decode($cartDataUnparsed, true);
						$cartDatas = json_decode($cartDataUp, true);
					}
					$where = ["id = -1"];

					foreach ($cartDatas as $cartItem) {
						$productId = $cartItem['productId'];
						$where[] = "id = " . $productId;
					}

					$selectEx = $this->SelectOrData('product_view', $where);

					$cartItems = $selectEx['Data'];

					include 'Views/consumer/cart.php';
					include 'Views/consumer/footer.php';
					include 'Views/modal.php';

					if ($_SERVER['REQUEST_METHOD'] == "POST") {
						if (!isset($_SESSION['user_data'])) {
						?>
							<script>
								openModal("Failed", "Please Login First", 1, 1.5, '');
							</script>
							<?php
						} else {

							$order_data['delivery']['name'] = $_POST['full-name'];
							$order_data['delivery']['city'] = $_POST['city'];
							$order_data['delivery']['street'] = $_POST['street'];
							$order_data['delivery']['mobile'] = $_POST['mobile'];
							$order_data['delivery']['message'] = $_POST['message'];

							$insertEx = $this->InsertOrderData($order_data);
							print_r($insertEx);

							if ($insertEx['Code']) {
							?>
								<script>
									deleteCookie("nisargiCart101");
									openModal("Success", "Successfully Created Order", 0, 1.5, '/nisargi');
								</script>
							<?php
							} else {
							?>
								<script>
									openModal("Failed", <?php $insertEx['Message'] ?>, 1, 1.5, '');
								</script>
						<?php
							}
						}
					}
					break;

				case '/product':
					include 'Views/consumer/header.php';
					$product = [];
					$where = ['id' => -1];
					if (isset($_GET['id'])) {
						$where = ['id' => $_GET['id']];
					}
					$selectEx = $this->SelectData('product_view', $where);
					if ($selectEx['Code'] == true) {
						$product = $selectEx['Data'][0];
					}
					$cartDatas = [];
					if (isset($_COOKIE['nisargiCart101'])) {
						$cartDataUnparsed = $_COOKIE['nisargiCart101'];
						$cartDataUp = json_decode($cartDataUnparsed, true);
						$cartDatas = json_decode($cartDataUp, true);
					}
					include 'Views/modal.php';
					include 'Views/consumer/oneProduct.php';
					include 'Views/consumer/footer.php';
					break;

				case '/myorders':
					include 'Views/consumer/header.php';
					include 'Views/modal.php';

					if (!isset($_SESSION['user_data'])) {
						?>
						<script>
							openModal("Failed", "Please Login First", 1, 1.5, './login');
						</script>
					<?php
					}
					$inDelivery = [];
					$allOrders = [];

					$where = ['user_id' => $_SESSION['user_data']->id, 'status' => 'in delivery'];
					$selectEx = $this->SelectData('orderproduct_view', $where);
					if ($selectEx['Code']) {
						$inDelivery = $this->filterOrderProductView($selectEx['Data']);
					}

					$where = ['user_id' => $_SESSION['user_data']->id];
					$selectEx = $this->SelectData('orderproduct_view', $where);
					if ($selectEx['Code']) {
						$allOrders = $this->filterOrderProductView($selectEx['Data']);
					}

					include 'Views/consumer/myorders.php';
					include 'Views/consumer/footer.php';
					break;

				case '/billview':

					if (!isset($_SESSION['user_data'])) {
						$this->redirect("/", 0);
					}
					$order = [];

					if (isset($_GET['id'])) {
						$where = ['order_id' => $_GET['id']];
						$selectEx = $this->SelectData('orderproduct_view', $where);
						if ($selectEx['Code']) {
							$orders = $this->filterOrderProductView($selectEx['Data']);
							$order = $orders[0];
						}
					}
					include 'Views/consumer/header.php';
					include 'Views/consumer/billView.php';
					include 'Views/consumer/footer.php';

					break;

				case '/approveorder':

					if (!isset($_SESSION['user_data'])) {
						$this->redirect("/", 0);
					}

					if (!isset($_GET['id'])) {
						$this->redirect("/myorders", 0);
					}

					$where = ['id' => $_GET['id']];
					$currentDate = date('Y-m-d');
					$data = ['delivery_date' => $currentDate, 'status' => 'complete'];
					$updateEx = $this->UpdateData('orders', $data, $where);
					include 'Views/consumer/header.php';
					include 'Views/modal.php';
					if ($updateEx) {
					?>
						<script>
							openModal("Success", "Delivery is Complete", 0, 1.5, './myorders');
						</script>
					<?php
					} else {
					?>
						<script>
							openModal("Failed", "Delivery is not Complete", 1, 1.5, './myorders');
						</script>
					<?php
					}
					break;
				case '/givereview':
					include 'Views/consumer/header.php';
					include 'Views/modal.php';
					$item = [];
					$review = [];

					if (!isset($_SESSION['user_data'])) {
						$this->redirect("/", 0);
					}

					if (!isset($_GET['id'])) {
						?>
						<script>
							openModal("Invalid Url", "item or shop not found", 1, 1.5, './myorders');
						</script>
						<?php
						exit;
					}

					if (!isset($_GET['item'])) {
						?>
						<script>
							openModal("Invalid Url", "item or shop not found", 1, 1.5, './myorders');
						</script>
						<?php
						exit;
					}


					if ($_GET['item'] == 'shop') {

						$where = ['id' => $_GET['id']];
						$selectEx = $this->SelectData('shop', $where);
						if($selectEx['Code']){
							$data = $selectEx['Data'][0];
							$item = [
								'type' => 'shop',
								'id' => $data->id,
								'name' => $data->name,
								'desc' => $data->bio,
								'address' => $data->address,
								'badge' => $data->badge,
								'img_path' => '/'.$data->image,
							];
						}

					} elseif ($_GET['item'] == 'product') {

						$where = ['id' => $_GET['id']];
						$selectEx = $this->SelectData('product', $where);
						if ($selectEx['Code']) {
							$data = $selectEx['Data'][0];
							if($data->deleteFlag != 'd'){
								$item = [
									'type' => 'product',
									'id' => $data->id,
									'name' => $data->name,
									'desc' => $data->description,
									'category' => $data->category,
									'price' => $data->price,
									'unit' => $data->unit,
									'shop_id' => $data->shop_id,
									'img_path'=> '/products/'.$data->image,
								];
							}
						}

					} else {
					?>
						<script>
							openModal("Invalid Item", "item not found", 1, 1.5, './myorders');
						</script>
						<?php
					}

					$where = ['item_id' => $_GET['id']];
					$selectEx = $this->SelectData('review', $where);
					if($selectEx['Code']){
						$data = $selectEx['Data'][0];
						if($data->type == $_GET['item']){
							$review = $data;
						}
					}

					if($_SERVER['REQUEST_METHOD'] == 'POST'){
						$data = [
							'star_count' => $_POST['star'],
							'message' => $_POST['reviewTxt'],
							'customer_id' => $_SESSION['user_data']->id,
							'item_id' => $_GET['id'],
							'type' => $_GET['item']
						];

						if(empty($review)){
							$insertEx = $this->InsertData('review', $data);
							if($insertEx['Code']){
								?>
								<script>
									openModal("Success", "Thank your for reviewing", 0, 1.5, './myorders');
								</script>
								<?php
								exit;
							}else{
								?>
								<script>
									openModal("Failed", "Failed to review", 1, 1.5, '');
								</script>
								<?php
								exit;
							}
						}else{
							$where = [
								'customer_id' => $_SESSION['user_data']->id,
								'item_id' => $_GET['id'],
								'type' => $_GET['item']
							];
							$updateEx = $this->UpdateData('review', $data, $where);
							if($updateEx){
								?>
								<script>
									openModal("Success", "Thank your for reviewing", 0, 1.5, './myorders');
								</script>
								<?php
								exit;
							}else{
								?>
								<script>
									openModal("Failed", "Failed to update review", 1, 1.5, '');
								</script>
								<?php
							}
						}
					}

					include 'Views/consumer/givereview.php';
					include 'Views/consumer/footer.php';

					break;



					//		Farmers Codes Start from Here: 

				case '/registerShop':
					if (!isset($_SESSION['user_data'])) {
						$this->redirect("/login", 0);
					} else {
						if (isset($_SESSION['shop_data'])) {
							$this->redirect('/farmerZone', 0);
						}
					}

					include 'Views/consumer/header.php';
					include 'Views/producer/registerShop.php';
					include 'Views/modal.php';
					include 'Views/producer/footer.php';

					if ($_SERVER['REQUEST_METHOD'] == "POST") {

						$insert_data = [
							'name' => $_POST['name'],
							'phone' => $_POST['phone'],
							'bio' => $_POST['bio'],
							'address' => $_POST['address'],
							'user_id' => $_SESSION['user_data']->id,
						];

						$error = [];
						$error = $this->validateForm($insert_data);
						if ($error) {
						?>
							<script>
								openModal("Failed Insertion", "<?= $error[0] ?>", 1, 1.5, '');
							</script>
						<?php
							exit;
						}
						$insertEx = $this->InsertData('shop', $insert_data);
						if ($insertEx['Code']) {
							$where = ['user_id' => $_SESSION['user_data']->id];
							$dataEx = $this->SelectData('shop', $where);
							if ($dataEx['Code']) {
								$_SESSION['shop_data'] = $dataEx['Data'][0];
							}
						?>
							<script>
								openModal("Register Success", "You have a shop now!", 0, 1.5, '/nisargi/farmerZone');
							</script>
						<?php
						} else {
						?>
							<script>
								openModal("Failed", "<?= $insertEx['Message'] ?>", 0, 1.5, '');
							</script>
						<?php
						}
					}
					break;

				case '/farmerZone':
					if (!isset($_SESSION['user_data'])) {
						$this->redirect("/login", 0);
					} else {
						if (!isset($_SESSION['shop_data'])) {
							$this->redirect('/registerShop', 0);
						}
					}

					include 'Views/producer/header.php';
					include 'Views/producer/dashboard.php';
					include 'Views/producer/footer.php';
					break;

				case '/farmerProduct':
					if (!isset($_SESSION['user_data'])) {
						$this->redirect("/login", 0);
					} else {
						if (!isset($_SESSION['shop_data'])) {
							$this->redirect('/registerShop', 0);
						}
					}
					$where = ['shop_id' => $_SESSION['shop_data']->id, 'deleteFlag' => 'o'];
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
							'shop_id' => $_SESSION['shop_data']->id,
						];
						$error = [];
						$error = $this->validateForm($insert_data);
						if ($error) {
						?>
							<script>
								openModal("Failed Insertion", "<?= $error[0] ?>", 1, 1.5, '');
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
								openModal("Failed", "data has been sucessfully failed", 1, 1.5, '');
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
						'shop_id' => $_SESSION['shop_data']->id,
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
							'shop_id' => $_SESSION['shop_data']->id,
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
					if ($_SERVER['REQUEST_METHOD'] == "GET") {
						include 'Views/producer/header.php';
						include 'Views/producer/productDelete.php';
						include 'Views/producer/footer.php';
					}
					if ($_SERVER['REQUEST_METHOD'] == "POST") {
						if ($_POST['delete'] == 'yes') {
							$where = ['id' => $_GET['id']];
							$del_data = $this->FlagDelete('product', $where);
							if ($del_data) {
								$this->redirect('./farmerProduct', 0);
							}
						}
					}
					break;

				case '/requests':
					if (!isset($_SESSION['shop_data'])) {
						$this->redirect('/', 0);
					}
					$orders = [];
					$where = ['shop_id' => $_SESSION['shop_data']->id, 'status' => 'in review'];
					$selectEx = $this->SelectData('orderproduct_view', $where);

					if ($selectEx['Code']) {
						$orderUnfilter = $selectEx['Data'];
						if (count($orderUnfilter) > 0) {
							$orders = $this->filterOrderProductView($orderUnfilter);
						}
					}
					include 'Views/producer/header.php';
					include 'Views/producer/request.php';
					include 'Views/producer/footer.php';

					break;

				case '/viewrequest':
					if (!isset($_GET['id'])) {
						echo "Such Record doesn't exist.";
						$this->redirect('/requests', 1);
						exit;
					}

					$orders = [];
					$where = ['shop_id' => $_SESSION['shop_data']->id, 'order_id' =>  $_GET['id'], 'status' => 'in review'];
					$selectEx = $this->SelectData('orderproduct_view', $where);

					if ($selectEx['Code']) {
						$orderUnfilter = $selectEx['Data'];
						if (count($orderUnfilter) > 0) {
							$orders = $this->filterOrderProductView($orderUnfilter);
						}
					}

					include 'Views/producer/header.php';
					include 'Views/producer/viewRequest.php';
					include 'Views/producer/footer.php';

					break;

				case '/handleRequest':
					$id = -1;
					$status = '';
					if (isset($_GET['id']) && isset($_GET['approve'])) {
						$id = $_GET['id'];
						$status = ($_GET['approve'] == 'true') ? 'approved' : 'canceled';
					} else {
						echo "invalid request";
						$this->redirect('/requests', 0.5);
						exit;
					}

					var_dump($id, $status);
					if ($status == 'canceled') {
						$where = ['id' => $_GET['id']];
						$data = ['status' => $status];
						$this->UpdateData('orders', $data, $where);
						$this->redirect('/requests', 0);
					} else if ($status == 'approved') {

						$columns = ['product_id', 'quantity'];
						$where = ['order_id' => $_GET['id'], 'status' => 'in review'];
						$selectEx = $this->SelectColumnData('orderproduct_view', $columns, $where);
						if ($selectEx['Code'] == true) {
							$products = $selectEx['Data'];
							foreach ($products as $product) {
								$this->UpdateStock($product->product_id, $product->quantity);
							}

							$where = ['id' => $_GET['id']];
							$data = ['status' => $status];
							$this->UpdateData('orders', $data, $where);
						}

						$this->redirect('/requests', 0);
					} else {
						$this->redirect('/requests', 0);
					}

					break;

				case '/shoporders':
					if (!isset($_SESSION['shop_data'])) {
						$this->redirect('/', 0);
					}
					$orders = [];
					$where = ['shop_id' => $_SESSION['shop_data']->id, 'status' => 'approved'];
					if (isset($_GET['type'])) {
						$type = $_GET['type'];
						if ($type == 'active' || $type == '') {
							$where = ['shop_id' => $_SESSION['shop_data']->id, 'status' => 'approved'];
						} else if ($type == 'delivery') {
							$where = ['shop_id' => $_SESSION['shop_data']->id, 'status' => 'in delivery'];
						} else if ($type == 'completed') {
							$where = ['shop_id' => $_SESSION['shop_data']->id, 'status' => 'complete'];
						} else if ($type == 'canceled') {
							$where = ['shop_id' => $_SESSION['shop_data']->id, 'status' => 'canceled'];
						}
					}
					$selectEx = $this->SelectData('orderproduct_view', $where);

					if ($selectEx['Code']) {
						$orderUnfilter = $selectEx['Data'];
						if (count($orderUnfilter) > 0) {
							$orders = $this->filterOrderProductView($orderUnfilter);
						}
					}

					include 'Views/producer/header.php';
					include 'Views/producer/orders.php';
					include 'Views/producer/footer.php';
					break;

				case '/shoporder':
					if (!isset($_SESSION['shop_data'])) {
						$this->redirect('/', 0);
					}

					$order = [];
					if (isset($_GET['id'])) {
						$where = ['shop_id' => $_SESSION['shop_data']->id, 'order_id' => $_GET['id']];
						$selectEx = $this->SelectData('orderproduct_view', $where);

						if ($selectEx['Code']) {
							$orderUnfilter = $selectEx['Data'];
							if (count($orderUnfilter) > 0) {
								$order = $this->filterOrderProductView($orderUnfilter);
							}
						}
					}
					include 'Views/producer/header.php';
					include 'Views/producer/shopOrder.php';
					include 'Views/producer/footer.php';
					break;

				case '/setdelivery':
					if (!isset($_SESSION['shop_data'])) {
						$this->redirect('/', 0);
					}

					if (!isset($_GET['id'])) {
						$this->redirect('/shoporders', 0);
					}
					include 'Views/producer/header.php';
					include 'Views/modal.php';
					$where = ['id' => $_GET['id']];
					$data = ['status' => 'in delivery'];
					$updateEx = $this->UpdateData('orders', $data, $where);
					if ($updateEx['Code']) {
						?>
						<script type="text/javascript">
							openModal("Sucess", "Item set for delivery", 0, 2, './shoporders');
						</script>
					<?php
					} else {
					?>
						<script type="text/javascript">
							openModal("Failed", "Item can't be set for delivery", 1, 2, './shoporders');
						</script>
<?php
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
