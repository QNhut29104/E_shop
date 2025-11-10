<?php
	$oldcode = $_POST['oldCode'];
	$code = $_POST['Code'];
	$ngaytao = $_POST['NgayTao'];
	$mucgiam = $_POST['MucGiam'];
	$toida = $_POST['ToiDa'];
	$toithieu = $_POST['ApDungToiThieu'];
	$gioihan = $_POST['GioiHanSuDung'];
	$solan = $_POST['SoLanSuDung'];
	
	$sql = "UPDATE `tbl_phieukhuyenmai` SET `Code`='$code',`NgayTao`='$ngaytao',`MucGiam`=$mucgiam,`ToiDa`=$toida,
											`ApDungToiThieu`=$toithieu,`GioiHanSuDung`=$gioihan,`SoLanSuDung`=$solan
			WHERE `Code` = '$oldcode'";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	header("Location: index.php?do=khuyenmai");
	
?>