<?php
	$type = $_POST['type'];
	
	$quyen = strcmp($type,"nhanvien") == 0 ? 1 : 2;
	$hoten = $_POST['HoTen'];
	$tendn = $_POST['TenDangNhap'];
	$mk = md5($_POST['MatKhau']);
	$namsinh = $_POST['NamSinh'];
	$gioitinh = $_POST['GioiTinh'];
	$sdt = $_POST['SDT'];
	$email = $_POST['Email'];
	$diachi = $_POST['DiaChi'];
	
	$sql = "SELECT * FROM `tbl_nguoidung` WHERE `TenDangNhap` = '$tendn'";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	else{
		if(mysqli_num_rows($danhsach) == 0){
			$sql = "INSERT INTO `tbl_nguoidung`(`HoTen`, `TenDangNhap`, `MatKhau`, `QuyenHan`, `Blocked`, `NamSinh`, `GioiTinh`, `SDT`, `Email`, `DiaChi`) VALUES
										('$hoten', '$tendn', '$mk', $quyen, 0, $namsinh, $gioitinh, '$sdt', '$email', '$diachi')";
			$danhsach = $connect->query($sql);
			if(!$danhsach){
				die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
				exit();
			}
			if(strcmp($type,"nhanvien") == 0)
				header("Location: index.php?do=nhanvien");
			else
				header("Location: index.php?do=login");
		}
		else{
			echo "Người dùng với tên đăng nhập đã được sử dụng!!!";
		}
	}
	
	
?>