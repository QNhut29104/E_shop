<?php
	$id = $_POST['ID'];
	$type = $_POST['type'];
	$HoTen = $_POST['HoTen'];
	$NamSinh = $_POST['NamSinh'];
	$GioiTinh = $_POST['GioiTinh'];
	$SDT = $_POST['SDT'];
	$Email = $_POST['Email'];
	$DiaChi = $_POST['DiaChi'];
	
	$sql = "UPDATE `tbl_nguoidung` SET `HoTen` = '$HoTen', `NamSinh`=$NamSinh,`GioiTinh`=$GioiTinh,`SDT`='$SDT',`Email`='$Email',`DiaChi`='$DiaChi'
			WHERE `ID` = $id;";
	
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	header("Location: index.php?do=$type");
?>