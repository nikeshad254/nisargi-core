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

	function SelectData(string $tblName, array $where = []){
		$selSql = "SELECT * FROM $tblName";
		if(!empty($where)){
			$selSql .= " WHERE ";
			foreach ($where as $key => $value) {
				$selSql .= " $key = '$value' AND";
			}
			$selSql = rtrim($selSql, 'AND');
		}
		$sqlEx = $this->connection->query($selSql);
		if($sqlEx->num_rows > 0){
			while ($FetchData = $sqlEx->fetch_object()) {
			    $allData[] = $FetchData;
			}
			$response['Data'] = $allData;
			$response['Code'] = true;
			$response['Message'] = 'Data retrieved successfully.';
		} else {
			$response['Data'] = [];
			$response['Code'] = false;
			$response['Message'] = 'Data not retrieved.';
		}
		return $response;

		
	}

	function UpdateData ($tbl, $data, $where) {
		$sql = "UPDATE $tbl SET ";
		foreach ($data as $key => $value) {
			$sql .= "$key = '$value',"; 
		}
		$sql = rtrim($sql, ',');
		$sql .= " WHERE ";
		foreach ($where as $key => $value) {
			$sql .= "$key = '$value' AND";
		}
		$sql = rtrim($sql, 'AND');

		return $updEx = $this->connection->query($sql);
	}

	function DeleteData($tbl, $where){
		$sql = "DELETE FROM $tbl WHERE ";
		foreach ($where as $key => $value) {
			$sql .= " $key = '$value'";
		}
		return $this->connection->query($sql);
	}

	function FlagDelete($tbl, $where){
		$sql = "UPDATE $tbl SET deleteFlag = 'd' WHERE ";
		foreach ($where as $key => $value) {
			$sql .= " $key = '$value'";
		}
		return $this->connection->query($sql);
	}

}

?>