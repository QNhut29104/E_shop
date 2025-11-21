<?php
	$id = $_SESSION['ID'];
	$masp = $_GET['MaSP'];
	
	$sql = "DELETE FROM `tbl_giohang` WHERE `User_id` = $id AND `MaSP` = '$masp'";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
		exit();
	}
	Header("Location: index.php?do=giohang");
?>