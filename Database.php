<?php
session_start();
/**
* DB Connection
*/
class Database
{
	public $con;
	private $host="mysql:host=localhost;dbname=sterilization;";
	private $user="root";
	private $pass="yeshi;";


	public function __construct()
	{
		try {
			$this->con=new PDO($this->host,$this->user,$this->pass);
			// echo "Connecion Established";
		} catch (PDOException $e) {
			echo "Cannot Connect: ".$e->getMessage();
		}
	}

	public function login($userName,$pass)
	{
		try {

			$sql="SELECT * FROM User WHERE UserName=:user AND Password=:pass";
			$stmt=$this->con->prepare($sql);
			$stmt->bindParam(":user",$userName,PDO::PARAM_STR);
			$stmt->bindParam(":pass",$pass,PDO::PARAM_STR);
			$stmt->execute();
			
			$rows=$stmt->fetch(PDO::FETCH_ASSOC);
			$count=$stmt->rowCount();

			if ($count>0) {

				$_SESSION['username']=$rows['UserName'];
				$_SESSION['fullname']=$rows['FullName'];
				$_SESSION['roles']=$rows['Role'];

				if ($rows['Role']=="department") {
					header("Location:admin/index.php?msg=Successfully Logged in to Department");
				}else if ($rows['Role']=="mentor") {
					header("Location:hcw/mentor.php?msg=Successfully Logged in to Mentor");
				}else if ($rows['Role']=="hcw1") {
					header("Location:hcw/hcw1.php?msg=Successfully Logged in to HCW1");
				}else if ($rows['Role']=="hcw2") {
					header("Location:hcw/hcw2.php?msg=Successfully Logged in to HCW2");
				}else if ($rows['Role']=="hcw3") {
					header("Location:hcw/hcw3.php?msg=Successfully Logged in to HCW3");
				}else{
					header("Location:login.php?msg=Incorrect Cridentials, Try again");
				}
			}else{
				header("Location:login.php?msg=Incorrect UserName and Password");
			}
		} catch (PDOException $e) {
			echo "Cannot Login: ".$e->getMessage();
		}
	}

	public function Logout()
	{
		session_destroy();
		unset($_SESSION['username']);
		header("Location:../login.php?Message=Logged out successfully");
	}

	public function Register($fullname,$username,$password,$role)
	{
		try {
			$stmt=$this->con->prepare("INSERT INTO User(FullName,UserName,Password,Role) VALUES(?,?,?,?)");
			$stmt->bindParam(1,$fullname,PDO::PARAM_STR);
			$stmt->bindParam(2,$username,PDO::PARAM_STR);
			$stmt->bindParam(3,$password,PDO::PARAM_STR);
			$stmt->bindParam(4,$role,PDO::PARAM_STR);
			$stmt->execute();
			echo "<script>window.alert('Account Created')</script>";
		} catch (PDOException $e) {
			echo "Cannot Register: ".$e->getMessage();
		}
	}

	public function DeleteAccount($id)
	{
		try {

			$sql="DELETE FROM User WHERE IDNo=?";
			$stmt=$this->con->prepare($sql);
			$stmt->bindParam(1,$id,PDO::PARAM_STR);
			$stmt->execute();
			echo "<script>window.alert('Account Deleted')</script>";
		} catch (PDOException $e) {
			echo "Cannot Delete: ".$e->getMessage();
		}
	}

	public function ConfirmPackages($packCode,$status)
	{
		try {

			$sql="INSERT INTO Packages(PackageBarcode,status) VALUES(?,?)";
			$stmt=$this->con->prepare($sql);
			$stmt->bindParam(1,$packCode,PDO::PARAM_STR);
			$stmt->bindParam(2,$status,PDO::PARAM_STR);
			$stmt->execute();

		} catch (PDOException $e) {
			echo "Cannot Insert: ".$e->getMessage();
		}
	}

	public function ConfirmBoxes($boxCode,$status)
	{
		try {

			$sql="INSERT INTO Boxes(BoxeCode,status) VALUES(?,?)";
			$stmt=$this->con->prepare($sql);
			$stmt->bindParam(1,$boxCode,PDO::PARAM_STR);
			$stmt->bindParam(2,$status,PDO::PARAM_STR);
			$stmt->execute();

		} catch (PDOException $e) {
			echo "Cannot Insert: ".$e->getMessage();
		}
	}

	public function Request($equipmnt,$category,$quantity,$barcode,$dept,$status)
	{
		try {
			$stmt=$this->con->prepare("INSERT INTO Request(ItemName,Category,Quantity,ItemBarcode,Department,Status) VALUES(?,?,?,?,?,?)");
			$stmt->bindParam(1,$equipmnt,PDO::PARAM_STR);
			$stmt->bindParam(2,$category,PDO::PARAM_STR);
			$stmt->bindParam(3,$quantity,PDO::PARAM_STR);
			$stmt->bindParam(4,$barcode,PDO::PARAM_STR);
			$stmt->bindParam(5,$dept,PDO::PARAM_STR);
			$stmt->bindParam(6,$status,PDO::PARAM_STR);
			$stmt->execute();
		} catch (PDOException $e) {
			echo "Cannot Request: ".$e->getMessage();
		}
	}

	public function CancelRequest($id)
	{
		try {

			$sql="DELETE FROM Request WHERE ItemID=?";
			$stmt=$this->con->prepare($sql);
			$stmt->bindParam(1,$id,PDO::PARAM_STR);
			$stmt->execute();

		} catch (PDOException $e) {
			echo "Cannot Delete: ".$e->getMessage();
		}
	}

	public function RegisterBoxes($boxeCode,$status)
	{
		try {

			$sql="INSERT INTO Boxes(BoxeCode,status) VALUES(?,?)";
			$stmt=$this->con->prepare($sql);
			$stmt->bindParam(1,$boxeCode,PDO::PARAM_STR);
			$stmt->bindParam(2,$status,PDO::PARAM_STR);
			$stmt->execute();

		} catch (PDOException $e) {
			echo "Cannot Insert: ".$e->getMessage();
		}
	}

	public function DeleteBoxe($id)
	{
		try {

			$sql="DELETE FROM Boxes WHERE IDNo=?";
			$stmt=$this->con->prepare($sql);
			$stmt->bindParam(1,$id,PDO::PARAM_STR);
			$stmt->execute();

		} catch (PDOException $e) {
			echo "Cannot Delete: ".$e->getMessage();
		}
	}

	public function WashBoxes($status,$boxeCode)
	{
		try {

			$sql="UPDATE Boxes SET status=? WHERE BoxeCode=?";
			$stmt=$this->con->prepare($sql);
			$stmt->bindParam(1,$status,PDO::PARAM_STR);
			$stmt->bindParam(2,$boxeCode,PDO::PARAM_STR);
			$stmt->execute();

		} catch (PDOException $e) {
			echo "Cannot Update: ".$e->getMessage();
		}
	}

	public function free($status,$id)
	{
		try {
			$sql="UPDATE Boxes SET status=? WHERE IDNo=?";
			$stmt=$this->con->prepare($sql);

			$stmt->bindParam(1,$status,PDO::PARAM_STR);
			$stmt->bindParam(2,$id,PDO::PARAM_STR);
			$stmt->execute();
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public function WashedEquip($status,$stat1)
	{
		try {

			$sql="UPDATE Request SET status=? WHERE status=?";
			$stmt=$this->con->prepare($sql);
			$stmt->bindParam(1,$status,PDO::PARAM_STR);
			$stmt->bindParam(2,$stat1,PDO::PARAM_STR);
			$stmt->execute();

		} catch (PDOException $e) {
			echo "Cannot Update: ".$e->getMessage();
		}
	}
}


// $db=new Database();
?>