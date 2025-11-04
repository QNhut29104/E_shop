<?php
	include_once "cauhinh.php";

	$TenDangNhap = $_POST['TenDangNhap'];
	$MatKhau = $_POST['MatKhau'];
	
	if(trim($TenDangNhap) == "")
		ThongBaoLoi("Tên đăng nhập không được bỏ trống!");
	elseif(trim($MatKhau) == "")
		ThongBaoLoi("Mật khẩu không được bỏ trống!");
	else
	{
		// Mã hóa mật khẩu
		$MatKhau = md5($MatKhau);
		
		// Kiểm tra người dùng có tồn tại không
		$sql_kiemtra = "SELECT * FROM `tbl_nguoidung` WHERE `TenDangNhap` = '$TenDangNhap' AND `MatKhau` = '$MatKhau'";				
		
		$danhsach = $connect->query($sql_kiemtra);
		//Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
		if (!$danhsach) {
			die("Không thể thực hiện câu lệnh SQL: " . $connect->connect_error);
			exit();
		}
		
		$dong = $danhsach->fetch_array(MYSQLI_ASSOC);
		if($dong)
		{
			if($dong['Blocked'] == 0)
			{
				// Đăng ký SESSION
				$_SESSION['ID'] = $dong['ID'];
				$_SESSION['HoTen'] = $dong['HoTen'];
				$_SESSION['QuyenHan'] = $dong['QuyenHan'];
				
				// Chuyển hướng về trang index.php
				Header("Location:index.php");
			}
			else
			{
				ThongBaoLoi("Người dùng đã bị khóa tài khoản!");
			}			
		}
		else
		{
			ThongBaoLoi("Tên đăng nhập hoặc mật khẩu không chính xác!");
		}			
	}			
?>	