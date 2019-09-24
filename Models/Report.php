<?php 
require_once '../include/dbconnect.php';

class Report
{
 	private $_conn;
    private $_db;
    private $_stmt;

	public function __construct() {
        $this->_db = Database::getInstance();
        $this->_conn = $this->_db->getConnection();
    }


    public function getRemainingMtr()
    {
        $this->_stmt = $this->_conn->prepare("SELECT @n := @n +1 as 'id', IFNULL( ordertb.orderId, '1' ) as 'orderId' , IFNULL( ordertb.orderMasterId, '0' ) as 'orderMasterId', motorcycle.mtrQty, IFNULL( ordertb.orderMotorId, '0' ) as 'orderMotorId', IFNULL( SUM(ordertb.orderQty), '1' ) as 'orderQty', ordertb.orderUsername, motorcycle.mtrBrand,motorcycle.mtrModel,motorcycle.mtrPrice,motorcycle.mtrImg FROM `ordertb` RIGHT JOIN motorcycle ON motorcycle.mtrId = ordertb.orderMotorId , (SELECT @n := 0) m GROUP BY motorcycle.mtrModel");
        $this->_stmt->execute();
        return $this->_stmt->get_result();
    }
	
	 public function getSoldMtr($type,$date)
    {
		if ($type == "DAY")
		{
			$this->_stmt = $this->_conn->prepare("SELECT * FROM `ordertbmaster` JOIN ordertb ON ordertbmaster.ordertbMasterId = ordertb.orderMasterId JOIN motorcycle ON motorcycle.mtrId = ordertb.orderMotorId WHERE DATE_FORMAT(ordertbmaster.orderMstrDateTime,'%d/%m/%Y') = '".$date."'");
			$this->_stmt->execute();
			return $this->_stmt->get_result();
		}
		if ($type == "MONTH")
		{
			$this->_stmt = $this->_conn->prepare("SELECT * FROM `ordertbmaster` JOIN ordertb ON ordertbmaster.ordertbMasterId = ordertb.orderMasterId JOIN motorcycle ON motorcycle.mtrId = ordertb.orderMotorId WHERE DATE_FORMAT(ordertbmaster.orderMstrDateTime,'%M') = '".$date."'");
			$this->_stmt->execute();
			return $this->_stmt->get_result();
		}
		if ($type == "YEAR")
		{
			$this->_stmt = $this->_conn->prepare("SELECT * FROM `ordertbmaster` JOIN ordertb ON ordertbmaster.ordertbMasterId = ordertb.orderMasterId JOIN motorcycle ON motorcycle.mtrId = ordertb.orderMotorId WHERE DATE_FORMAT(ordertbmaster.orderMstrDateTime,'%Y') = '".$date."'");
			$this->_stmt->execute();
			return $this->_stmt->get_result();
		}
    }
}

?>