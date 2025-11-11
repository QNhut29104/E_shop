<?php
	$id = $_GET['id'];
	$type = $_GET['type'];
	
	$sql = "DELETE FROM `tbl_nguoidung` WHERE `ID` = $id";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	else{
		header("Location: index.php?do=$type");
	}
?>