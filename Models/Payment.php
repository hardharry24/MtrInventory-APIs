<?php 
require_once '../include/dbconnect.php';

class Payment
{
 	private $_conn;
    private $_db;
    private $_stmt;
    private $_table = "payment";
	
	public $_pOrderMsterId;
	public $_pAmount;
	public $_pTotal;
	public $_pChange;
	public $_pUsername;
	public $_pDateTime;


	public function __construct() {
        $this->_db = Database::getInstance();
        $this->_conn = $this->_db->getConnection();
    }

    public function createPayment() 
	{
        $this->_stmt = $this->_conn->prepare("INSERT INTO " . $this->_table . "  ( `pOrderMsterId`, `pAmount`, `pTotal`, `pChange`, `pUsername`, `pDateTime`) VALUES (?, ?, ?,?, ?, ?)");
            $this->_stmt->bind_param("ssssss",$this->_pOrderMsterId,$this->_pAmount ,$this->_pTotal, $this->_pChange, $this->_pUsername, $this->_pDateTime);
        return $this->_stmt->execute();
    }

    public function getPayment($username)
    {
    	$this->_stmt = $this->_conn->prepare("SELECT * FROM `payment` WHERE pUsername = '$username'");
        $this->_stmt->execute();
        return $this->_stmt->get_result();
    }
	

	

}

?>