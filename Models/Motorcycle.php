<?php 
require_once '../include/dbconnect.php';

class Motorcycle
{
 	private $_conn;
    private $_db;
    private $_stmt;
    private $_table = "motorcycle";
	
	public $_mtrBrand;
	public $_mtrModel;
	public $_mtrQty;
	public $_mtrPrice;
    public $_mtrDateTime;
    public $_mtrImg;


	public function __construct() {
        $this->_db = Database::getInstance();
        $this->_conn = $this->_db->getConnection();
    }

    public function createMotorcycle() 
	{
        $this->_stmt = $this->_conn->prepare("INSERT INTO " . $this->_table . "  ( `mtrBrand`, `mtrModel`, `mtrQty`, `mtrPrice`, `mtrDateTime`, `mtrImg`) VALUES (?, ?, ?, ?, ?,?)");
            $this->_stmt->bind_param("ssssss",$this->_mtrBrand,$this->_mtrModel, $this->_mtrQty,$this->_mtrPrice, $this->_mtrDateTime, $this->_mtrImg);
        return $this->_stmt->execute();
    }
	
	public function isExistMotorcycle()
    {
		$this->_stmt = $this->_conn->prepare("SELECT * FROM " . $this->_table . " WHERE `mtrBrand` = ? AND `mtrModel` = ?");
		$this->_stmt->bind_param("ss",$this->_mtrBrand,$this->_mtrModel);
		$this->_stmt->execute();
		$this->_stmt->store_result();
        return $this->_stmt->num_rows;

    }
	
	public function selectBrand()
	{
		$this->_stmt = $this->_conn->prepare("SELECT brandId, brandName, brandImg FROM brand");
        $this->_stmt->execute();
        return $this->_stmt->get_result();
	}
	
	public function selectModel()
	{
		$this->_stmt = $this->_conn->prepare("SELECT modelName FROM model WHERE brandName = ?");
		$this->_stmt->bind_param("s",$this->_mtrBrand);
        $this->_stmt->execute();
        return $this->_stmt->get_result();
	}
	
	public function selectMotor()
	{
		$this->_stmt = $this->_conn->prepare("SELECT * FROM `motorcycle` WHERE mtrQty >= 0");
        $this->_stmt->execute();
        return $this->_stmt->get_result();
	}
}

?>