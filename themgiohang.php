<?php
	$masp = $_GET['MaSP'];
	$math = $_GET['MaTH'];
	if(isset($_SESSION['ID']))
	{
		$id = $_SESSION['ID'];
		$sql = "SELECT * FROM `tbl_giohang` WHERE `User_id`=$id AND `MaSP`='$masp';";
		$danhsach = $connect->query($sql);
		if(!$danhsach){
			die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
			exit();
		}
		if(mysqli_num_rows($danhsach)>0){
			echo "<script type='text/javascript'>
				alert('Sản phẩm đã có trong giỏ hàng!!!');
				window.location.replace('index.php?do=sanpham_chitiet&MaSP=$masp&MaTH=$math');
			</script>";
		}
		else{
			$sql = "INSERT INTO `tbl_giohang`(`User_id`, `MaSP`) VALUES ($id, '$masp');";
			$danhsach = $connect->query($sql);
			if(!$danhsach){
				die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
				exit();
			}
		echo "<script type='text/javascript'>
			alert('Đã thêm sản phẩm vào giỏ hàng!!!');
			window.location.replace('index.php?do=sanpham_chitiet&MaSP=$masp&MaTH=$math');
		</script>";
		}
	}
	else{
		echo "<script type='text/javascript'>
			alert('Vui lòng đăng nhập để sử dụng tính năng này!!!');
			window.location.replace('index.php?do=sanpham_chitiet&MaSP=$masp&MaTH=$math');
		</script>";
	}
?>