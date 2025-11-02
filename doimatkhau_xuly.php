<?php
	$id = $_POST['ID'];
	$old = $_POST['MatKhauCu'];
	$new = $_POST['MatKhauMoi'];
	$confirm = $_POST['XacNhanMatKhauMoi'];
	
	$sql = "SELECT * FROM `tbl_nguoidung` WHERE `ID` = $id";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
		exit();
	}
	$row = $danhsach->fetch_array(MYSQLI_ASSOC);
	if(strcmp(md5($old), $row['MatKhau']) == 0){
		if(strcmp($new, $confirm) == 0){
			$new = md5($new);
			$sql = "UPDATE `tbl_nguoidung` SET `MatKhau` = '$new' WHERE `ID` = $id";
			$danhsach = $connect->query($sql);
			if(!$danhsach){
				die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
				exit();
			}
			header("Location: index.php");
		}
		else
			ThongBaoLoi("Xác nhận mật khẩu không chính xác!!!");
	}
	else
		ThongBaoLoi("Mật khẩu không chính xác!!!");
?>