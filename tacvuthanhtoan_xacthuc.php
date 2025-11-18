<?php
	$id = $_GET['ID'];
	$sql = "SELECT * FROM `tbl_thanhtoan` WHERE `ID`= $id";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
		exit();
	}
	$thanhtoan = $danhsach->fetch_array(MYSQLI_ASSOC);
	
	$sql = "UPDATE `tbl_thanhtoan` SET `XacThuc` = 'Đã xác thực' WHERE `ID` = $id";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
		exit();
	}
	
	$sotientt = $thanhtoan['SoTienTT'];
	$sql = "UPDATE `tbl_donhang` SET `SoTienDaTT` = `SoTienDaTT` + $sotientt WHERE `MaDH` = '".$thanhtoan['MaDH']."'";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
		exit();
	}
	header("Location: index.php?do=tacvuthanhtoan");
?>