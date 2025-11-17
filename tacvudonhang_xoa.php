<?php
	$madh = $_GET['MaDH'];
	$sql= "DELETE FROM `tbl_donhang` WHERE `MaDH` = '$madh'";
	$dh = $connect->query($sql);
	if(!$dh){
		die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
		exit();
	}
	header("Location: index.php?do=tacvudonhang");
?>