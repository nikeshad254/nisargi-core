<?php

class Model {

	protected $connection = '';
	protected $servername = 'localhost';
	protected $username = 'root';
	protected $password = '';
	protected $db = 'nisargi';

	function __construct(){
		
		mysqli_report(MYSQLI_REPORT_STRICT);
		try{
			$this->connection = new mysqli($this->servername, $this->username, $this->password, $this->db);
		} catch (Exception $ex) {
			echo "Connection Failed: " . $ex->getMessage();
			exit;
		}
	}

	function LoginData($email, $pass) {
		$loginSql = "SELECT * FROM user WHERE email = '$email'";
		$loginEx = $this->connection->query($loginSql);
		$loginData = $loginEx->fetch_object();
		if($loginEx->num_rows > 0 && password_verify($pass, $loginData->password)){
			$response['Data'] = $loginData;
			$response['Code'] = true;
			$response['Message'] = 'Login Successful.';
		} else {
			$response['Data'] = null;
			$response['Code'] = false;
			$response['Message'] = 'Email or password is incorrect.';
		}
		return $response;
	}

	function InsertData ($tbl, $data){
		$clms = implode(',', array_keys($data));
		$vals = implode("','", $data);
		$sql = "insert into $tbl ($clms) values ('$vals')";
		// echo $sql;
		// exit;
		$insertEx = $this->connection->query($sql);
		if($insertEx){
			$response['Data'] = null;
			$response['Code'] = true;
			$response['Message'] = 'Data created successfully.';
		} else {
			$response['Data'] = null;
			$response['Code'] = false;
			$response['Message'] = 'Data creation failed.';
		}
		return $response;
	}

}

?>