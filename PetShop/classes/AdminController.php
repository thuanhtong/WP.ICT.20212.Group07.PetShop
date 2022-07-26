<?php
require_once('../config.php');
Class AdminController extends DBConnection {
	private $settings;

	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}

	public function __destruct(){
		parent::__destruct();
	}

	public function index(){
		echo "<h1>Access Denied</h1> <a href='".base_url."'>Go Back.</a>";
	}

	public function login(){
		extract($_POST);

		$qry = $this->conn->query("SELECT * from users where username = '$username' and password = md5('$password') ");
		if($qry->num_rows > 0){
			foreach($qry->fetch_array() as $k => $v){
				if(!is_numeric($k) && $k != 'password'){
					$this->settings->set_userdata($k,$v);
				}
			}
			$this->settings->set_userdata('login_type',1);
			return json_encode(array('status'=>'success'));
		} else {
			return json_encode(array('status'=>'incorrect','last_qry'=>"SELECT * from users where username = '$username' and password = md5('$password') "));
		}
	}

	public function logout(){
		if($this->settings->sess_des()){
			redirect('admin/login.php');
		}
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

	function delete_img(){
		extract($_POST);
		if(is_file($path)){
			if(unlink($path)){
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
				$resp['error'] = 'failed to delete '.$path;
			}
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = 'Unkown '.$path.' path';
		}
		return json_encode($resp);
	}

	function delete_product(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `products` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Product successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}

	function save_product(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id','description'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(isset($_POST['description'])){
			if(!empty($data)) $data .=",";
				$data .= " `description`='".addslashes(htmlentities($description))."' ";
		}
		$check = $this->conn->query("SELECT * FROM `products` where `product_name` = '{$product_name}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Product already exist.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `products` set {$data} ";
			$save = $this->conn->query($sql);
			$id= $this->conn->insert_id;
		}else{
			$sql = "UPDATE `products` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$upload_path = "uploads/product_".$id;
			if(!is_dir(base_app.$upload_path))
				mkdir(base_app.$upload_path);
			if(isset($_FILES['img']) && count($_FILES['img']['tmp_name']) > 0){
				foreach($_FILES['img']['tmp_name'] as $k => $v){
					if(!empty($_FILES['img']['tmp_name'][$k])){
						move_uploaded_file($_FILES['img']['tmp_name'][$k],base_app.$upload_path.'/'.$_FILES['img']['name'][$k]);
					}
				}
			}
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"New Product successfully saved.");
			else
				$this->settings->set_flashdata('success',"Product successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}

	function delete_inventory(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `inventory` where id = '{$id}'");
		if($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Invenory successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function save_inventory(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id','description'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `inventory` where `product_id` = '{$product_id}' and `size` = '{$size}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Inventory already exist.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `inventory` set {$data} ";
			$save = $this->conn->query($sql);
		}else {
			$sql = "UPDATE `inventory` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"New Invenory successfully saved.");
			else
				$this->settings->set_flashdata('success',"Invenory successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}

	
	function pay_order(){
		extract($_POST);
		$update = $this->conn->query("UPDATE orders set paid = '1' where id = '{$id}' ");

		if($update){
			$resp['status'] ='success';
			$this->settings->set_flashdata("success"," Order payment status successfully updated.");
		} else {
			$resp['status'] ='failed';
			$resp['err'] =$this->conn->error;
		}

		return json_encode($resp);
	}

	function delete_order(){
		extract($_POST);
		$delete = $this->conn->query("DELETE FROM orders where id = '{$id}'");
		$delete2 = $this->conn->query("DELETE FROM order_list where order_id = '{$id}'");
		$delete3 = $this->conn->query("DELETE FROM sales where order_id = '{$id}'");
		if($this->capture_err())
			return $this->capture_err();

		if($delete) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Order successfully deleted");
		} else {
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}

	function update_order_status(){
		extract($_POST);
		$update = $this->conn->query("UPDATE orders set status = '$status' where id = '{$id}' ");
		if($update) {
			$resp['status'] ='success';
			$this->settings->set_flashdata("success"," Order status successfully updated.");
		}else {
			$resp['status'] ='failed';
			$resp['err'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function delete_category(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM categories where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Category successfully deleted.");
		}else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function save_category(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id','description'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		} 

		if(isset($_POST['description'])){
			if(!empty($data)) $data .=",";
				$data .= " `description`='".addslashes(htmlentities($description))."' ";
		}
		$check = $this->conn->query("SELECT * FROM `categories` where `category` = '{$category}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();

		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Category already exist.";
			return json_encode($resp);
			exit;
		}

		if(empty($id)){
			$sql = "INSERT INTO `categories` set {$data} ";
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `categories` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"New Category successfully saved.");
			else
				$this->settings->set_flashdata('success',"Category successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}

	function delete_sub_category(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM sub_categories where id = '{$id}'");
		if($del) {
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success', "Sub Category successfully deleted.");
		} else {
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function save_sub_category(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id','description'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}

		if(isset($_POST['description'])){
			if(!empty($data)) $data .=",";
				$data .= " `description`='".addslashes(htmlentities($description))."' ";
		}

		$check = $this->conn->query("SELECT * FROM `sub_categories` where `sub_category` = '{$sub_category}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		
			if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Sub Category already exist.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `sub_categories` set {$data} ";
			$save = $this->conn->query($sql);
		} else{
			$sql = "UPDATE `sub_categories` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}

		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"New Sub Category successfully saved.");
			else
				$this->settings->set_flashdata('success',"Sub Category successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}

	public function save_user(){
		extract($_POST);
		$data = '';
		foreach($_POST as $k => $v){
			if(!in_array($k,array('id','password'))){
				if(!empty($data)) $data .=" , ";
				$data .= " {$k} = '{$v}' ";
			}
		}

		if(!empty($password) && !empty($id)){
			$password = md5($password);
			if(!empty($data)) $data .=" , ";
			$data .= " `password` = '{$password}' ";
		}

		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
				$fname = 'uploads/'.$_FILES['img']['name'];
				$move = move_uploaded_file($_FILES['img']['tmp_name'],'../'. $fname);
				if($move){
					$data .=" , avatar = '{$fname}' ";
					if(isset($_SESSION['userdata']['avatar']) && is_file('../'.$_SESSION['userdata']['avatar']))
						unlink('../'.$_SESSION['userdata']['avatar']);
				}
		}

		if(empty($id)){
			$qry = $this->conn->query("INSERT INTO users set {$data}");
			if($qry){
				$this->settings->set_flashdata('success','User Details successfully saved.');
				foreach($_POST as $k => $v){
					if($k != 'id'){
						if(!empty($data)) $data .=" , ";
						$this->settings->set_userdata($k,$v);
					}
				}
				return 1;
			} else {
				return 2;
			}

		} else {
			$qry = $this->conn->query("UPDATE users set $data where id = {$id}");
			if($qry){
				$this->settings->set_flashdata('success','User Details successfully updated.');
				foreach($_POST as $k => $v){
					if($k != 'id'){
						if(!empty($data)) $data .=" , ";
						$this->settings->set_userdata($k,$v);
					}
				}
				if(isset($fname) && isset($move))
				$this->settings->set_userdata('avatar',$fname);

				return 1;
			} else {
				return "UPDATE users set $data where id = {$id}";
			}
		}
	}

	

}

$AdminController = new AdminController();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'login':
		echo $AdminController->login();
		break;
	case 'logout':
		echo $AdminController->logout();
		break;

	case 'delete_img':
		echo $AdminController->delete_img();
		break;

	case 'save_product':
		echo $AdminController->save_product();
		break;
	case 'delete_product':
		echo $AdminController->delete_product();
		break;

	case 'save_inventory':
		echo $AdminController->save_inventory();
		break;
	case 'delete_inventory':
		echo $AdminController->delete_inventory();
		break;
	
	case 'pay_order':
		echo $AdminController->pay_order();
		break;	
	case 'delete_order':
		echo $AdminController->delete_order();
		break;
	case 'update_order_status':
		echo $AdminController->update_order_status();
		break;

	case 'delete_category':
		echo $AdminController->delete_category();
		break;
	case 'save_category':
		echo $AdminController->save_category();
		break;

	case 'delete_sub_category':
		echo $AdminController->delete_sub_category();
		break;
	case 'save_sub_category':
		echo $AdminController->save_sub_category();
		break;

	case 'save_user':
		echo $AdminController->save_user();
		break;

	default:
		break;
}