<?php 
require_once '../include/dbconnect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
class User
{
 	public $_conn;
    private $_db;
    private $_stmt;
    private $_table = "user";
	
	public $_id;
	public $_lastname;
	public $_firstname;
	public $_mi;
	public $_username;
	public $_password;
	public $_role;
	public $_code;

	public function __construct() {
        $this->_db = Database::getInstance();
        $this->_conn = $this->_db->getConnection();
    }

    public function createUser() 
    {
        $this->_stmt = $this->_conn->prepare("INSERT INTO " . $this->_table . "(lastname, firstname,mi,username,password,role,code) VALUES (?, ?, ?, ?,?,?,?)");
        $this->_stmt->bind_param("sssssss",$this->_lastname,$this->_firstname, $this->_mi, $this->_username, $this->_password, $this->_role, $this->_code);
        return $this->_stmt->execute();
    }

    public function isExistUsername()
    {
		$this->_stmt = $this->_conn->prepare("SELECT * FROM " . $this->_table . " WHERE username = ?");
		$this->_stmt->bind_param("s",$this->_username);
		$this->_stmt->execute();
		$this->_stmt->store_result();
        return $this->_stmt->num_rows;
    }
	
	public function login()
	{
		$this->_stmt = $this->_conn->prepare("SELECT isActive FROM " . $this->_table . " WHERE username = ? AND password = ? LIMIT 1");
		$this->_stmt->bind_param("ss",$this->_username,$this->_password);
		$this->_stmt->execute();
		$this->_stmt->store_result();
        $isExistUser =  $this->_stmt->num_rows;
		
		if ($isExistUser)
		{
			return true;
		}
		else
			return false;
	}
	
	public function isActiveUser()
	{
		$this->_stmt = $this->_conn->prepare("SELECT isActive FROM " . $this->_table . " WHERE username = ? AND password = ? LIMIT 1");
		$this->_stmt->bind_param("ss",$this->_username,$this->_password);
		$this->_stmt->execute();
		$this->_stmt->bind_result($isActive);
		$this->_stmt->fetch();
		$this->_stmt->store_result();
		
		return $isActive;
	}
	
	public function updateIsActive()
	{
		$this->_stmt = $this->_conn->prepare("UPDATE `user` SET `isActive` = '1' WHERE `user`.`username` = ?");
		$this->_stmt->bind_param("s",$this->_username);
		$this->_stmt->execute();
		//echo "OK";
	}
	
	public function verifyCode()
	{
		$this->_stmt = $this->_conn->prepare("SELECT code FROM " . $this->_table . " WHERE username = ? LIMIT 1");
		$this->_stmt->bind_param("s",$this->_username);
		$this->_stmt->execute();
		$this->_stmt->bind_result($Code);
		$this->_stmt->fetch();
		$this->_stmt->store_result();
		$this->_stmt->close();
		if ($Code == $this->_code)
		{
			$this->updateIsActive();
			return true;
		}
		else
			return false;
	}
	
	public function getUser()
	{
		
		$this->_stmt = $this->_conn->prepare("SELECT ID,Lastname,Firstname,MI FROM " . $this->_table . " WHERE user.Username = ?");
		$this->_stmt->bind_param("s",$this->_username);
		$this->_stmt->execute();
		$this->_stmt->bind_result($ID,$Lastname,$Firstname,$MI);
		$this->_stmt->fetch();
		$this->_stmt->store_result();
		$this->_stmt->close();
		
		$user = array();
		$user["ID"] = $ID;
		$user["Lastname"] = $Lastname;
		$user["Firstname"] = $Firstname;
		$user["MI"] = $MI;
		
		return $user;
	}
	

	
	

}

?>