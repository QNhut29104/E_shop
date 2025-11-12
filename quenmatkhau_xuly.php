<?php
	$tendn = $_POST['TenDangNhap'];
	$email = $_POST['Email'];
	$new = $_POST['MatKhau'];
	$confirm = $_POST['XacNhanMatKhau'];
	
	$sql = "SELECT * FROM `tbl_nguoidung` WHERE `TenDangNhap` = '$tendn'";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
		exit();
	}
	$row = $danhsach->fetch_array(MYSQLI_ASSOC);
	if(strcmp($email, $row['Email']) == 0){
		if(strcmp($new, $confirm) == 0){
			$new = md5($new);
			$sql = "UPDATE `tbl_nguoidung` SET `MatKhau` = '$new' WHERE `TenDangNhap` = '$tendn'";
			$danhsach = $connect->query($sql);
			if(!$danhsach){
				die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
				exit();
			}
			header("Location: index.php?do=login");
		}
		else
			ThongBaoLoi("Xác nhận mật khẩu không chính xác!!!");
	}
	else
		ThongBaoLoi("Mật khẩu không chính xác!!!");
?>