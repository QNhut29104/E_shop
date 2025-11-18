<?php
	$id = $_GET['ID'];
	$sql = "SELECT * FROM `tbl_thanhtoan` WHERE `ID`= $id";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
		exit();
	}
	$thanhtoan = $danhsach->fetch_array(MYSQLI_ASSOC);
	
	$sql = "UPDATE `tbl_thanhtoan` SET `XacThuc` = 'Không hợp lệ' WHERE `ID` = $id";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
		exit();
	}
	if(strcmp($thanhtoan['XacThuc'],"Đã xác thực") == 0){
		$sotientt = $thanhtoan['SoTienTT'];
		$sql = "UPDATE `tbl_donhang` SET `SoTienDaTT` = `SoTienDaTT` - $sotientt WHERE `MaDH` = '".$thanhtoan['MaDH']."'";
		$danhsach = $connect->query($sql);
		if(!$danhsach){
			die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
			exit();
		}
	}
	header("Location: index.php?do=tacvuthanhtoan");
?>