<?php
	$target_dir = "images/Uploads/";
	$target_img = $target_dir. basename($_FILES["HinhAnh"]["name"]);
	$checkOK = 1;
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
		$checkOK = 0;
	}

	// Check file size
	if ($_FILES["HinhAnh"]["size"] > 500000) {
		$checkOK = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
		$checkOK = 0;
	}

	if ($checkOK == 0) {
		echo "Không thể upload file!!! ";
	} 
	else {
		if (move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], $target_img)) {
			echo "The file ". htmlspecialchars( basename( $_FILES["HinhAnh"]["name"])). " has been uploaded.";
		}
		else {
			$checkOK = 0;
		}
	}
	
	$id = $_SESSION['ID'];
	$MaDH = $_POST['MaDH'];
	$NgayTT = date("Y-m-d H:i:s");
	$SoTienTT = $_POST['SoTienTT'];
	$HinhAnh = basename($_FILES["HinhAnh"]["name"]);

	if($checkOK){
		$sql = "INSERT INTO `tbl_thanhtoan`(`User_id`, `MaDH`, `NgayTT`, `SoTienTT`, `HinhAnh`) VALUES
				(".$id.", '".$MaDH."', '".$NgayTT."', ".$SoTienTT.", '".$HinhAnh."');";
		$danhsach = $connect->query($sql);
		if(!$danhsach){
			die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
			exit();
		}
		Header("Location: index.php?do=lichsuthanhtoan");
	}
	else{
		echo "Không thể đăng tải xác minh";
	}
?>