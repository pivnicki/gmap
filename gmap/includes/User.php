<?php
include_once 'connection.php';


class User{
	
	private $connection;
	
	public function __construct(){
		$this->connection=new Connection();
		$this->connection=$this->connection->getDb();
	}
	
	public function insertToMap($name,$address,$lat,$lng,$type){
		
		try{			
			$sql="INSERT INTO markers (name,address,lat,lng,type) VALUES (:name,:address,:lat,:lng,:type)";
			
			$stmt=$this->connection->prepare($sql);
			$stmt->bindParam(":name",$name,PDO::PARAM_STR);
			$stmt->bindParam(":address",$address,PDO::PARAM_STR);
			$stmt->bindParam(":lat",$lat);
			$stmt->bindParam(":lng",$lng);
			$stmt->bindParam(":type",$type);
			$stmt->execute();
			 
		}			 
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
	public function getFromMap(){
		try{
			$sql="SELECT * FROM markers";
			$stmt=$this->connection->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
			
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	
}