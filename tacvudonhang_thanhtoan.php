<?php
	$madh = $_GET['MaDH'];
	$sql= "UPDATE `tbl_donhang` SET `SoTienDaTT` = `ThanhTien` WHERE `MaDH` = '$madh'";
	$dh = $connect->query($sql);
	if(!$dh){
		die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
		exit();
	}
	header("Location: index.php?do=tacvudonhang");
?>