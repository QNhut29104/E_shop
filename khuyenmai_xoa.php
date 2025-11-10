<?php
	$code = $_GET['Code'];
	$sql = "DELETE FROM `tbl_phieukhuyenmai` WHERE `Code` = '$code'";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	header("Location: index.php?do=khuyenmai");
?>