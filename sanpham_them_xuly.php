<?php
	$masp = $_POST['MaSP'];
	$tensp = $_POST['TenSanPham'];
	$math = $_POST['MaTH'];
	$maloai = $_POST['MaLoai'];
	$giagoc = $_POST['GiaGoc'];
	$tlgiam = $_POST['TiLeGiam'];
	$tonkho = $_POST['TonKho'];
	$xuatxu = $_POST['XuatXu'];
	$mota = $_POST['MoTa'];
	
	$sql = "SELECT `TenLoai` FROM `tbl_loaisanpham` WHERE `MaLoai` = $maloai";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	$loai = $danhsach->fetch_array(MYSQLI_ASSOC);
	
	$sql = "SELECT `TenThuongHieu` FROM `tbl_thuonghieu` WHERE `MaTH` = $math";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	$th = $danhsach->fetch_array(MYSQLI_ASSOC);
	
	$target_dir = "images/".$loai['TenLoai']."/".$th['TenThuongHieu']."/";
	$target_img = $target_dir. basename($_FILES["HinhAnh"]["name"]);
	$checkOK = 1;
	$exist = 0;
	$imageFileType = strtolower(pathinfo($target_img,PATHINFO_EXTENSION));
	
	if(isset($_POST['submit'])){
		$check = getimagesize($_FILES["HinhAnh"]["tmp_name"]);
		if($check !== false) {
			$checkOK = 1;
		} 
		else {
			$checkOK = 0;
		}
	}
	if (file_exists($target_img)) {
		$exist = 1;
	}

	// Check file size
	if ($_FILES["HinhAnh"]["size"] > 500000) {
		$checkOK = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		$checkOK = 0;
	}

	if ($checkOK == 0) {
		echo "File không được đăng tải!! Thêm sản phẩm không thành công!";
	} 
	else {
		if($exist == 0){
			if (move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], $target_img)) {
			echo "Ảnh ". htmlspecialchars( basename( $_FILES["HinhAnh"]["name"])). " đã được upload.";
			}
			else {
				echo "Có lỗi xảy ra.";
				$checkOK = 0;
			}
		}
	
		$HinhAnh = basename($_FILES["HinhAnh"]["name"]);
		
		$tinhtrang = $tonkho > 0 ? "Còn hàng" : "Hết hàng";
		
		if($checkOK){
			$sql = "INSERT INTO `tbl_sanpham`(`MaSP`, `MaLoai`, `MaTH`, `TenSanPham`, `GiaGoc`, `TiLeGiam`, `TonKho`, `HinhAnh`, `TinhTrang`, `XuatXu`, `MoTa`, `LuotXem`, `LuotMua`) VALUES
											 ('$masp', $maloai, $math, '$tensp', $giagoc, $tlgiam, $tonkho, '$HinhAnh', '$tinhtrang', '$xuatxu', '$mota', 0, 0)";
			$danhsach = $connect->query($sql);
			if(!$danhsach){
				die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
				exit();
			}
			header("Location: index.php?do=sanpham");
		}
		else{
			die("Không thể lưu thông tin!!!");
			exit();
		}
	}
?>