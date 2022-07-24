<?php
require_once('../config.php');
Class CustomerController extends DBConnection {
	private $settings;

	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
        ini_set('display_error', 1);
	}

	public function __destruct(){
		parent::__destruct();
	}

    public function index(){
		echo "<h1>Access Denied</h1> <a href='".base_url."'>Go Back.</a>";
	}

	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}

    function login(){
		extract($_POST);
		$qry = $this->conn->query("SELECT * from clients where email = '$email' and password = md5('$password') ");
		if($qry->num_rows > 0){
			foreach($qry->fetch_array() as $k => $v){
				$this->settings->set_userdata($k,$v);
			}
			$this->settings->set_userdata('login_type',1);
		$resp['status'] = 'success';
		}else{
		$resp['status'] = 'incorrect';
		}
		if($this->conn->error){
			$resp['status'] = 'failed';
			$resp['_error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

    public function logout(){
		if($this->settings->sess_des()){
			redirect(base_url);
		}
	}

	function register(){
		extract($_POST);
		$data = "";
		$_POST['password'] = md5($_POST['password']);
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `clients` where `contact` = '{$contact}' or `email` = '{$email}'".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "The phone number or email is already used for another account.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `clients` set {$data} ";
			$save = $this->conn->query($sql);
			$id = $this->conn->insert_id;
		}else{
			$sql = "UPDATE `clients` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"Account successfully created.");
			else
				$this->settings->set_flashdata('success',"Account successfully updated.");
			foreach($_POST as $k =>$v){
					$this->settings->set_userdata($k,$v);
			}
			$this->settings->set_userdata('id',$id);

		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}

	function add_to_cart(){
		extract($_POST);
		$data = " client_id = '".$this->settings->userdata('id')."' ";
		$_POST['price'] = str_replace(",","",$_POST['price']); 
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `cart` where `inventory_id` = '{$inventory_id}' and client_id = ".$this->settings->userdata('id'))->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$sql = "UPDATE `cart` set quantity = quantity + {$quantity} where `inventory_id` = '{$inventory_id}' and client_id = ".$this->settings->userdata('id');
		}else{
			$sql = "INSERT INTO `cart` set {$data} ";
		}
		
		$save = $this->conn->query($sql);
		if($this->capture_err())
			return $this->capture_err();
			if($save){
				$resp['status'] = 'success';
				$resp['cart_count'] = $this->conn->query("SELECT SUM(quantity) as items from `cart` where client_id =".$this->settings->userdata('id'))->fetch_assoc()['items'];
			}else{
				$resp['status'] = 'failed';
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
			return json_encode($resp);
	}

	function update_cart_qty(){
		extract($_POST);
		$sql = "UPDATE `cart` set quantity = '{$quantity}' where id = '{$id}'";
		$save = $this->conn->query($sql);
		if($this->capture_err())
			return $this->capture_err();
		if($save){
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
		
	}

	function empty_cart(){
		$sql = "DELETE FROM `cart` where client_id = ".$this->settings->userdata('id');
		$delete = $this->conn->query($sql);
		if($this->capture_err())
			return $this->capture_err();
		if($delete){
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}

	function remove_item_in_cart(){
		extract($_POST);
		$delete = $this->conn->query("DELETE FROM `cart` where id = '{$id}'");
		if($this->capture_err())
			return $this->capture_err();
		if($delete){
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
}

$CustomerController = new CustomerController();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
    case 'login':
		echo $CustomerController->login();
		break;
	case 'logout':
		echo $CustomerController->logout();
		break;
    case 'register':
        echo $CustomerController->register();
        break;
    case 'add_to_cart':
        echo $CustomerController->add_to_cart();
        break;
    case 'update_cart_qty':
        echo $CustomerController->update_cart_qty();
        break;
	case 'remove_item_in_cart':
		echo $CustomerController->remove_item_in_cart();
		break;
	case 'empty_cart':
		echo $CustomerController->empty_cart();
		break;
	default:
		break;
}