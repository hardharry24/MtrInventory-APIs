<?php 
require_once '../include/dbconnect.php';

class Order
{
 	private $_conn;
    private $_db;
    private $_stmt;
    private $_table = "ordertb";
	
	public $_orderId;
	public $_orderQty;
	public $_orderMotorId;
	public $_orderUsername;


	public function __construct() {
        $this->_db = Database::getInstance();
        $this->_conn = $this->_db->getConnection();
    }

    public function createOrderTb() 
	{
		$ordr = new Order();
		$ordr->_orderUsername = $this->_orderUsername;
		$orderMasterId = $ordr->getMaxOrderMasterId();
        $this->_stmt = $this->_conn->prepare("INSERT INTO " . $this->_table . "  ( `orderMasterId`, `orderMotorId`,`orderQty`, `orderUsername`) VALUES (?, ?, ? , ?)");
            $this->_stmt->bind_param("ssss",$orderMasterId,$this->_orderMotorId ,$this->_orderQty, $this->_orderUsername);
        return $this->_stmt->execute();
    }
	
	public function getMaxOrderMasterId()
    {
		$this->_stmt = $this->_conn->prepare("SELECT MAX(ordertbMasterId) as orderMax FROM `ordertbmaster` WHERE `orderMstrUsername` = ?");
		$this->_stmt->bind_param("s",$this->_orderUsername);
		$this->_stmt->execute();
		$this->_stmt->bind_result($orderMax);
		$this->_stmt->fetch();
		$this->_stmt->store_result();
		$this->_stmt->close();
		if ($orderMax == null)
			return 1;
		else
			return $orderMax + 1;

    }
	
	public function getOrder($username)
	{
		$ordr = new Order();
		$ordr->_orderUsername = $username;
		$orderMasterId = $ordr->getMaxOrderMasterId();

		$this->_stmt = $this->_conn->prepare("SELECT ordertb.orderId, ordertb.orderMasterId, ordertb.orderMotorId, SUM( ordertb.orderQty) as 'orderQty', ordertb.orderUsername, motorcycle.mtrBrand,motorcycle.mtrModel,motorcycle.mtrPrice,motorcycle.mtrImg FROM `ordertb` JOIN motorcycle ON motorcycle.mtrId = ordertb.orderMotorId where ordertb.orderUsername = '$username' AND ordertb.orderMasterId = '$orderMasterId' GROUP BY ordertb.orderMotorId");
        $this->_stmt->execute();
        return $this->_stmt->get_result();
	}
	
	public function removeOrder()
	{
		$this->_stmt = $this->_conn->prepare("DELETE FROM " .$this->_table. " WHERE `orderId` = ?");
		$this->_stmt->bind_param("s",$this->_orderId);
		$this->_stmt->execute();
	}
	
	public function updateMotorQty($mtrId)
	{
		/*** Get Qty of the motor ****/
		$this->_stmt = $this->_conn->prepare("SELECT `mtrQty` FROM `motorcycle` WHERE `mtrId` = ?");
		$this->_stmt->bind_param("s",$mtrId);
		$this->_stmt->execute();
		$this->_stmt->bind_result($Qty);
		$this->_stmt->fetch();
		$this->_stmt->store_result();

		/*** subtract ***/
		$fQty = $Qty - $this->_orderQty;
		$this->_stmt->close();
		echo "QTY ".$fQty;

		$this->_stmt = $this->_conn->prepare("UPDATE `motorcycle` SET `mtrQty` = '$fQty' WHERE `mtrId` = '$mtrId' ");
		$this->_stmt->execute();
	}

	public function updateMotorQtyCancel($mtrId)
	{
		/*** Get Qty of the motor ****/
		$this->_stmt = $this->_conn->prepare("SELECT `mtrQty` FROM `motorcycle` WHERE `mtrId` = ?");
		$this->_stmt->bind_param("s",$mtrId);
		$this->_stmt->execute();
		$this->_stmt->bind_result($Qty);
		$this->_stmt->fetch();
		$this->_stmt->store_result();

		/*** subtract ***/
		$fQty = $Qty + $this->_orderQty;
		$this->_stmt->close();

		$this->_stmt = $this->_conn->prepare("UPDATE `motorcycle` SET `mtrQty` = '$fQty' WHERE `mtrId` = '$mtrId' ");
		$this->_stmt->execute();
	}
	
	public function saveMasterOrder($id,$username,$dateTime)
	{
		$this->_stmt = $this->_conn->prepare("INSERT INTO `ordertbmaster` ( `ordertbMasterId`, `orderMstrUsername`, `orderMstrDateTime`) VALUES (?, ?, ?)");
        $this->_stmt->bind_param("sss",$id,$username ,$dateTime);
        return $this->_stmt->execute();
	}
	
	public function myOrder($username)
	{
		$this->_stmt = $this->_conn->prepare("SELECT * FROM `ordertbmaster` WHERE orderMstrUsername = '$username'");
        $this->_stmt->execute();
        return $this->_stmt->get_result();
	}
	
	public function orderDetails($ordrId)
	{
		$this->_stmt = $this->_conn->prepare("SELECT orderId, orderMasterId,orderMotorId, orderQty, orderUsername FROM `ordertb` where orderMasterId = '$ordrId'");
        $this->_stmt->execute();
        return $this->_stmt->get_result();
	}
	
	
	

}

?>