<?php	
	if(isset($_POST['User_id']))
		$id = $_POST['User_id'];
	else
		$id = null;
	
	$sql = "SELECT * FROM `tbl_shipping` WHERE `MaShip` =".$_POST['MaShip'];
	$dsship = $connect->query($sql);
	if (!$dsship) {
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	$ship = $dsship->fetch_array(MYSQLI_ASSOC);
	
	
	$MaSP = $_POST['MaSP'];
	$NgayDat = date("Y-m-d H:i:s");
	$SoLuong = $_POST['SoLuong'];
	$BaoHiem = $_POST['BaoHiem'];
	$TongCong = $SoLuong * $_POST['DonGia'];
	
	$PhiShip = $ship['ChiPhi'] + $ship['PhuPhiSP'] * $SoLuong;
	
	$songaygiao = $ship['SoNgayDK'];
	
	$giamgia = 0;
	
	if($_POST['CodeKM'] != ""){
		$sql = "SELECT * FROM `tbl_phieukhuyenmai` WHERE `Code` = '".$_POST['CodeKM']."'";
		$dskm = $connect->query($sql);
		if (!$dskm) {
			die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
			exit();
		}
		if(mysqli_num_rows($dskm) == 0){
			ThongBaoLoi("Mã giảm giá không tồn tại hoặc đã hết hạn!");
			echo "<a href='index.php?do=muahang&MaSP=".$MaSP."'>Quay lại</a>";
			exit();
		}
		$km = $dskm->fetch_array(MYSQLI_ASSOC);
		if($km['SoLanSuDung'] >= $km['GioiHanSuDung']){
			ThongBaoLoi("Mã giảm giá đã hết lượt dùng!");
			echo "<a href='index.php?do=muahang&MaSP=".$MaSP."'>Quay lại</a>";
			exit();
		}
		if($TongCong < $km['ApDungToiThieu']){
			ThongBaoLoi("Đơn hàng không đủ điều kiện áp dụng mã giảm giá!");
			echo "<a href='index.php?do=muahang&MaSP=".$MaSP."'>Quay lại</a>";
			exit();
		}
		if($TongCong * $km['MucGiam'] / 100 > $km['ToiDa'])
			$giamgia = $km['ToiDa'];
		else
			$giamgia = $TongCong * $km['MucGiam'] / 100;
	}
	$baohiem = 0;
	if($_POST['BaoHiem'] == 1)
		$baohiem = $TongCong / 10;
	
	$tragop = 0;
	$PhuPhiTraGop = 0;
	if(isset($_POST['TraGop'])){
		$tragop = 1;
		$PhuPhiTraGop = $TongCong * 0.05;
	}
	
	$ThanhTien = $PhiShip + $TongCong - $giamgia + $baohiem + $PhuPhiTraGop;
	
	$GhiChu =  	"<b>Họ tên:</b> ".$_POST['HoTen']."<br/>".
				"<b>Giới tính:</b> ".(($_POST['GioiTinh'] == 0) ? "Nam" : "Nữ")."<br/>".
				"<b>SDT:</b> ".$_POST['SDT']."<br/>".
				"<b>Địa chỉ:</b> ".$_POST['DiaChi']."<br/>".
				"<b>Ngày đặt: </b>".date("H:i:s d/m/Y",strtotime($NgayDat))."</br>".
				"<b>Ngày nhận dự kiến: </>".date("H:i:s d/m/Y",strtotime("$NgayDat +$songaygiao days"))."</br>".
				"<b>Tổng tiền hàng: </b>".$SoLuong." x ".number_format($_POST['DonGia'])." = ".number_format($TongCong)."<br/>".
				"<b>Tổng tiền ship: </b>".number_format($ship['ChiPhi'])." &plus; ".number_format($ship['PhuPhiSP'])." * ".$SoLuong." = ".number_format($PhiShip)."<br/>".
				"<b>Tiền bảo hiểm: </b>".number_format($baohiem)."<br/>".
				"<b>Số tiền được giảm: </b>".number_format($giamgia)."<br/>".
				"<b>Phụ phí trả góp 5%(nếu có): </b>".number_format($PhuPhiTraGop)."<br/>".
				"<b>Thành tiền:</b> ".number_format($ThanhTien);
	
	$MaDH = generateRandomString(10);
	do{
		$sql = "SELECT * FROM `tbl_donhang` WHERE `MaDH`='$MaDH'";
		$danhsach = $connect->query($sql);
		if(!$danhsach){
			die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
		}
	}while(mysqli_num_rows($danhsach)>0);
	
	if($_POST['CodeKM'] != ""){
		$sql = "INSERT INTO `tbl_donhang`(`MaDH`,`User_id`, `MaSP`, `NgayDat`, `SoLuong`, `TienHang`, `BaoHiem`, `MaShip`, `CodeKM`, `ThanhTien`, `GhiChu`, `TraGop`) 
				values ('".$MaDH."',".$id.",'".$MaSP."','".$NgayDat."',".$SoLuong.",".$TongCong.",".$_POST['BaoHiem'].",".$_POST['MaShip'].",'".$_POST['CodeKM']."',".$ThanhTien.",'".$GhiChu."',$tragop)";
	}
	else
		$sql = "INSERT INTO `tbl_donhang`(`MaDH`,`User_id`, `MaSP`, `NgayDat`, `SoLuong`, `TienHang`, `BaoHiem`, `MaShip`, `ThanhTien`, `GhiChu`, `TraGop`) 
				values ('".$MaDH."',".$id.",'".$MaSP."','".$NgayDat."',".$SoLuong.",".$TongCong.",".$_POST['BaoHiem'].",".$_POST['MaShip'].",".$ThanhTien.",'".$GhiChu."',$tragop)";
	$danhsach = $connect->query($sql);
	if (!$danhsach) {
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	$sql = "UPDATE `tbl_phieukhuyenmai` SET `SoLanSuDung` = `SoLanSuDung` + 1 WHERE `Code` = '".$_POST['CodeKM']."'";
	$danhsach = $connect->query($sql);
	if (!$danhsach) {
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	$sql = "UPDATE `tbl_sanpham` SET `LuotMua` = `LuotMua` + $SoLuong, `TonKho` = `TonKho` - $SoLuong WHERE `MaSP` = '".$MaSP."'";
	$danhsach = $connect->query($sql);
	if (!$danhsach) {
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	$sql = "UPDATE `tbl_sanpham` SET `TinhTrang` = 'Hết hàng' WHERE `TonKho` = 0";
	$danhsach = $connect->query($sql);
	if (!$danhsach) {
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	echo "<h3 style='text-align: center;'>Đã đặt hàng thành công</h3>";
	echo $GhiChu;
?>