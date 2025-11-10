<?php
	$code = $_POST['Code'];
	$ngaytao = $_POST['NgayTao'];
	$mucgiam = $_POST['MucGiam'];
	$toida = $_POST['ToiDa'];
	$toithieu = $_POST['ApDungToiThieu'];
	$gioihan = $_POST['GioiHanSuDung'];
	$solan = $_POST['SoLanSuDung'];
	
	$sql = "INSERT INTO `tbl_phieukhuyenmai`(`Code`, `NgayTao`, `MucGiam`, `ToiDa`, `ApDungToiThieu`, `GioiHanSuDung`, `SoLanSuDung`) VALUES 
											('$code','$ngaytao',$mucgiam,$toida,$toithieu,$gioihan,$solan);";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	header("Location: index.php?do=khuyenmai");
?>