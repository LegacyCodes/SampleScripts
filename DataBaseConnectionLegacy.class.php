<?php
namespace source\bundle\bin\databank;
include_once 'bundle\bin\reporting\ErrorReporting.class.php';
use source\bundle\bin\reporting\ErrorReporting;
use \PDO;
use \PDOException;

class DataBaseConnection extends ErrorReporting{
  private $_Host,
			$_DataBaseName,
			$_DataBaseUser,
			$_DataBasePassword;
	public function __construct($DBHost,$DBName,$DBUser,$DBPass){
		$this->_Host =$DBHost;
		$this->_DataBaseName = $DBName;
		$this->_DataBaseUser = $DBUser;
		$this->_DataBasePassword =$DBPass;
		
		$this->FilterFields();
	}
	private function FilterFields(){
		if (!empty($this->_Host) && !empty($this->_DataBaseName) && !empty($this->_DataBaseUser)){
			 $this->ConnectDataBase(); }
		 $this->_Errors[] = 'CODE 85302 : One or More fields are empty';
		return $this->ErrorReportingMessage();
	}
	private function ConnectDataBase(){
		try{$Connection = new PDO('mysql:host='.$this->_Host.';dbname='.$this->_DataBaseName,$this->_DataBaseUser,$this->_DataBasePassword);}
		catch(PDOException $e){
			$this->_Errors[] = 'CODE 85303 : '.$e->getMessage();
			$this->ErrorReportingMessage();
			die();
		}	
	}
}