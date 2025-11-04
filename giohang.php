<?php
	$sql = "SELECT * FROM `tbl_loaisanpham`";
	$dslsp = $connect->query($sql);
	if(!$dslsp){
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	$sql = "SELECT * FROM `tbl_thuonghieu`";
	$dsth = $connect->query($sql);
	if(!$dsth){
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	
	$id = $_SESSION['ID'];
	if(isset($_GET['MaLoai'])){
		$sql = "SELECT `tbl_giohang`.*, `tbl_sanpham`.*, `tbl_loaisanpham`.`TenLoai`, `tbl_thuonghieu`.`TenThuongHieu`
			FROM `tbl_giohang` 
				LEFT JOIN `tbl_sanpham` ON `tbl_giohang`.`MaSP` = `tbl_sanpham`.`MaSP` 
				LEFT JOIN `tbl_loaisanpham` ON `tbl_sanpham`.`MaLoai` = `tbl_loaisanpham`.`MaLoai` 
				LEFT JOIN `tbl_thuonghieu` ON `tbl_sanpham`.`MaTH` = `tbl_thuonghieu`.`MaTH`
			WHERE `User_id` = $id AND `tbl_sanpham`.`MaLoai` = ".$_GET['MaLoai'];
	}
	else if(isset($_GET['MaTH'])){
		$sql = "SELECT `tbl_giohang`.*, `tbl_sanpham`.*, `tbl_loaisanpham`.`TenLoai`, `tbl_thuonghieu`.`TenThuongHieu`
			FROM `tbl_giohang` 
				LEFT JOIN `tbl_sanpham` ON `tbl_giohang`.`MaSP` = `tbl_sanpham`.`MaSP` 
				LEFT JOIN `tbl_loaisanpham` ON `tbl_sanpham`.`MaLoai` = `tbl_loaisanpham`.`MaLoai` 
				LEFT JOIN `tbl_thuonghieu` ON `tbl_sanpham`.`MaTH` = `tbl_thuonghieu`.`MaTH`
			WHERE `User_id` = $id AND `tbl_sanpham`.`MaTH` = ".$_GET['MaTH'];
	}
	else{
		$sql = "SELECT `tbl_giohang`.*, `tbl_sanpham`.*, `tbl_loaisanpham`.`TenLoai`, `tbl_thuonghieu`.`TenThuongHieu`
				FROM `tbl_giohang` 
					LEFT JOIN `tbl_sanpham` ON `tbl_giohang`.`MaSP` = `tbl_sanpham`.`MaSP` 
					LEFT JOIN `tbl_loaisanpham` ON `tbl_sanpham`.`MaLoai` = `tbl_loaisanpham`.`MaLoai` 
					LEFT JOIN `tbl_thuonghieu` ON `tbl_sanpham`.`MaTH` = `tbl_thuonghieu`.`MaTH`
				WHERE `User_id` = $id";
	}
	$dssp = $connect->query($sql);
	if(!$dssp){
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
?>
<h2 style="text-align: center; font-weight: 800;">GIỎ HÀNG</h2>
<div class="giohang">
	<?php
	while ($row = $dssp->fetch_array(MYSQLI_ASSOC)) 
	{
		if($row['TiLeGiam'] > 0)
			$giaban = $row['GiaGoc'] - (($row['TiLeGiam'] /100) * $row['GiaGoc']);
		else
			$giaban = $row['GiaGoc'];
		$path = "images/".$row['TenLoai']."/".$row['TenThuongHieu']."/".$row['HinhAnh'];
		echo "<div class=\"khungitem\">";
			echo "<div class=\"hinhanh\">";
				echo "<img src=$path style='width: 180px; height: 150px;'/>";
			echo "</div>";
			echo "<div class=\"chitiet\">";
				echo "<div class='tensp'><a href='index.php?do=sanpham_chitiet&MaSP=" . $row['MaSP'] . "&MaTH=" . $row['MaTH'] . "'>".$row['TenSanPham']."</a></div>";
				echo "<p><b>Thương hiệu: </b> ".$row['TenThuongHieu']."</p>";
				if($row['TiLeGiam'] > 0){
					echo "<p><b>Giá gốc: </b> <span class=\"giagoc\" style='float: none;'>".number_format($giaban)." đ</span> <span class=\"giamgia\">-".$row['TiLeGiam']."%</span> </p>";
				}
				echo "<p><b>Giá bán: </b><span class=\"giaban\" style='float: none;'>".number_format($row['GiaGoc'])." đ</span></p>";
				echo "<p><b>Số lượng hiện có: </b>".$row['TonKho']."</p>";
				echo "<p><b>Tình trạng: </b> ".$row['TinhTrang']."</p>";
			echo "</div>";
			echo "<div class=\"muahang\">";
			echo "<form action='index.php' method='get'>";
				echo "<button class=\"btnxoa\" type='submit' name='do' value=\"xoagiohang\"><i class='fa fa-trash-o'></i></button>";
				echo "<button class=\"btnmua\" type='submit' name='do' value=\"muahang\">Mua hàng</button>";
				echo "<input type='hidden' name='MaSP' value='".$row['MaSP']."'/>";
				echo "<input type='hidden' name='MaTH' value='".$row['MaTH']."'/>";
			echo "</form>";
			echo "</div>";
		echo "</div>";

	}
	?>
</div>
