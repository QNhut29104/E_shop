<?php
	if(isset($_GET['display_limit']))
		$_SESSION['display_limit'] += 5;
	else
		$_SESSION['display_limit'] = 5;
	$display_limit = $_SESSION['display_limit'];

	$id = $_SESSION['ID'];
	
	function runquery($dsdh){
		while($row = $dsdh->fetch_array(MYSQLI_ASSOC)){
			$path = "images/".$row['TenLoai']."/".$row['TenThuongHieu']."/".$row['HinhAnh'];
	?>
			<div class="khungdonhang">
				<div class="phantren">
					<a href="noidungdonhang.php?MaDH=<?php echo $row['MaDH'];?>" target="donhang">Mã đơn hàng: <?php echo $row['MaDH'];?></a>
					<span class="date">Ngày đặt hàng: <?php echo date("H:i:s d/m/Y",strtotime($row['NgayDat']))?></span>
				</div>
				<div class="phanduoi">
					<div class="hinhanh"><img src=<?php echo $path;?> style="width: 120px; height: 100px;"/></div>
					<div class="chitiet">
						<div class="tensp" style="font-size: 16px;"><a href="index.php?do=sanpham_chitiet&MaSP=<?php echo $row['MaSP'];?>&MaTH=<?php echo $row['MaTH'];?>"><?php echo $row['TenSanPham'];?></a></div>
						<div class="tensp" style="font-size: 14px;">Số lượng: <?php echo $row['SoLuong'];?></div>
						<div class="tensp" style="font-size: 14px;">Tổng cộng: <?php echo number_format($row['TienHang']);?></div>
						<div class="tensp" style="font-size: 14px;">Thành tiền: <?php echo number_format($row['ThanhTien']);?></div>
						<div class="tensp" style="font-size: 14px;">Đã thanh toán: <?php echo number_format($row['SoTienDaTT']);?></div>
						<div class="tensp" style="font-size: 14px;">Trạng thái giao hàng: <?php echo $row['TrangThai'];?></div>
					</div>
					<div class="trangthaiTT">
						<button id="lichsuTT" onclick="location.href='index.php?do=lichsuthanhtoan&MaDH=<?php echo $row['MaDH']?>'" class="btnlichsu">Lịch sử thanh toán</button>
						<button id="xacminh" onclick="location.href='index.php?do=xacminh&MaDH=<?php echo $row['MaDH']?>'" class="btnxacminh">Xác minh</button>
					</div>
				</div>
			</div>
	<?php
		}
	}
?>

<div class="chitietdonhang">
	<iframe class="framedonhang" name="donhang" id="donhang"></iframe>
</div>
<div class="phandonhang">
	<div class="menutrangthai">
		<button class="tab" onclick="openTabDonHang(event, 'dangxuly')" id="defaultOpen">Đang xử lý</button>
		<button class="tab" onclick="openTabDonHang(event, 'danggiao')">Đang giao</button>
		<button class="tab" onclick="openTabDonHang(event, 'danhan')">Đã nhận</button>
		<button class="tab" onclick="openTabDonHang(event, 'chuathanhtoan')">Chưa thanh toán</button>
		<button class="tab" onclick="openTabDonHang(event, 'tragop')">Trả góp</button>
	</div>
	<div id="dangxuly" class="tabcontent">
	<?php
		$sql = "SELECT `tbl_donhang`.*, `tbl_sanpham`.*, `tbl_loaisanpham`.`TenLoai`, `tbl_thuonghieu`.`TenThuongHieu`
			FROM `tbl_donhang` 
				LEFT JOIN `tbl_sanpham` ON `tbl_donhang`.`MaSP` = `tbl_sanpham`.`MaSP` 
				LEFT JOIN `tbl_loaisanpham` ON `tbl_sanpham`.`MaLoai` = `tbl_loaisanpham`.`MaLoai` 
				LEFT JOIN `tbl_thuonghieu` ON `tbl_sanpham`.`MaTH` = `tbl_thuonghieu`.`MaTH`
			WHERE `tbl_donhang`.`User_id` = $id AND `tbl_donhang`.`TrangThai` = 'Đang xử lý'
			ORDER BY `tbl_donhang`.`NgayDat` DESC
			LIMIT $display_limit";
		$dsdh = $connect->query($sql);
		runquery($dsdh);
	?>
	</div>
	<div id="danggiao" class="tabcontent">
	<?php
		$sql = "SELECT `tbl_donhang`.*, `tbl_sanpham`.*, `tbl_loaisanpham`.`TenLoai`, `tbl_thuonghieu`.`TenThuongHieu`
			FROM `tbl_donhang` 
				LEFT JOIN `tbl_sanpham` ON `tbl_donhang`.`MaSP` = `tbl_sanpham`.`MaSP` 
				LEFT JOIN `tbl_loaisanpham` ON `tbl_sanpham`.`MaLoai` = `tbl_loaisanpham`.`MaLoai` 
				LEFT JOIN `tbl_thuonghieu` ON `tbl_sanpham`.`MaTH` = `tbl_thuonghieu`.`MaTH`
			WHERE `tbl_donhang`.`User_id` = $id AND `tbl_donhang`.`TrangThai` = 'Đang giao'
			ORDER BY `tbl_donhang`.`NgayDat` DESC
			LIMIT $display_limit";
		$dsdh = $connect->query($sql);
		runquery($dsdh);
	?>
	</div>
	<div id="danhan" class="tabcontent">
	<?php
		$sql = "SELECT `tbl_donhang`.*, `tbl_sanpham`.*, `tbl_loaisanpham`.`TenLoai`, `tbl_thuonghieu`.`TenThuongHieu`
			FROM `tbl_donhang` 
				LEFT JOIN `tbl_sanpham` ON `tbl_donhang`.`MaSP` = `tbl_sanpham`.`MaSP` 
				LEFT JOIN `tbl_loaisanpham` ON `tbl_sanpham`.`MaLoai` = `tbl_loaisanpham`.`MaLoai` 
				LEFT JOIN `tbl_thuonghieu` ON `tbl_sanpham`.`MaTH` = `tbl_thuonghieu`.`MaTH`
			WHERE `tbl_donhang`.`User_id` = $id AND `tbl_donhang`.`TrangThai` = 'Đã nhận'
			ORDER BY `tbl_donhang`.`NgayDat` DESC
			LIMIT $display_limit";
		$dsdh = $connect->query($sql);
		runquery($dsdh);
	?>
	</div>
	<div id="chuathanhtoan" class="tabcontent">
	<?php
		$sql = "SELECT `tbl_donhang`.*, `tbl_sanpham`.*, `tbl_loaisanpham`.`TenLoai`, `tbl_thuonghieu`.`TenThuongHieu`
			FROM `tbl_donhang` 
				LEFT JOIN `tbl_sanpham` ON `tbl_donhang`.`MaSP` = `tbl_sanpham`.`MaSP` 
				LEFT JOIN `tbl_loaisanpham` ON `tbl_sanpham`.`MaLoai` = `tbl_loaisanpham`.`MaLoai` 
				LEFT JOIN `tbl_thuonghieu` ON `tbl_sanpham`.`MaTH` = `tbl_thuonghieu`.`MaTH`
			WHERE `tbl_donhang`.`User_id` = $id AND `tbl_donhang`.`ThanhTien` > `tbl_donhang`.`SoTienDaTT`
			ORDER BY `tbl_donhang`.`NgayDat` DESC
			LIMIT $display_limit";
		$dsdh = $connect->query($sql);
		runquery($dsdh);
	?>
	</div>
	<div id="tragop" class="tabcontent">
	<?php
		$sql = "SELECT `tbl_donhang`.*, `tbl_sanpham`.*, `tbl_loaisanpham`.`TenLoai`, `tbl_thuonghieu`.`TenThuongHieu`
			FROM `tbl_donhang` 
				LEFT JOIN `tbl_sanpham` ON `tbl_donhang`.`MaSP` = `tbl_sanpham`.`MaSP` 
				LEFT JOIN `tbl_loaisanpham` ON `tbl_sanpham`.`MaLoai` = `tbl_loaisanpham`.`MaLoai` 
				LEFT JOIN `tbl_thuonghieu` ON `tbl_sanpham`.`MaTH` = `tbl_thuonghieu`.`MaTH`
			WHERE `tbl_donhang`.`User_id` = $id AND `tbl_donhang`.`TraGop` = 1
			ORDER BY `tbl_donhang`.`NgayDat` DESC
			LIMIT $display_limit";
		$dsdh = $connect->query($sql);
		runquery($dsdh);
	?>
	</div>
</div>
<script>
	document.getElementById("defaultOpen").click();
</script>