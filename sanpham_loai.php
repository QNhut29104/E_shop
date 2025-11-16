<!DOCTYPE html>
<html>
<head>
	<title>ESHOP</title>
	<meta charset="utf-8" />
</head>

<body>
	<?php
		if(isset($_GET['display_limit']))
			$_SESSION['display_limit'] += 8;
		else
			$_SESSION['display_limit'] = 12;
		$display_limit = $_SESSION['display_limit'];
		
		$maloai = $_GET['MaLoai'];
		
		$sql = "SELECT `tbl_sanpham`.*, `tbl_loaisanpham`.`TenLoai`, `tbl_thuonghieu`.`TenThuongHieu`
				FROM `tbl_sanpham` 
					LEFT JOIN `tbl_loaisanpham` ON `tbl_sanpham`.`MaLoai` = `tbl_loaisanpham`.`MaLoai` 
					LEFT JOIN `tbl_thuonghieu` ON `tbl_sanpham`.`MaTH` = `tbl_thuonghieu`.`MaTH` 
				WHERE `tbl_sanpham`.`MaLoai` ='".$maloai."' ORDER BY `LuotMua` DESC LIMIT ".$display_limit;
		
		$danhsach = $connect->query($sql);
		//Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
		if (!$danhsach) {
			die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
			exit();
		}
		
		$sql = "SELECT `tbl_sanpham`.*, `tbl_loaisanpham`.`TenLoai`, `tbl_thuonghieu`.`TenThuongHieu`
				FROM `tbl_sanpham` 
					LEFT JOIN `tbl_loaisanpham` ON `tbl_sanpham`.`MaLoai` = `tbl_loaisanpham`.`MaLoai` 
					LEFT JOIN `tbl_thuonghieu` ON `tbl_sanpham`.`MaTH` = `tbl_thuonghieu`.`MaTH` 
				WHERE `tbl_sanpham`.`MaLoai` ='".$maloai."' ";
		$danhsachall = $connect->query($sql);
		$count_query = mysqli_num_rows($danhsachall);
		
		while($row = $danhsach->fetch_array(MYSQLI_ASSOC)){
			$path = "images/".$row['TenLoai']."/".$row['TenThuongHieu']."/".$row['HinhAnh'];
			if($row['TiLeGiam'] > 0)
				$giaban = $row['GiaGoc'] - (($row['TiLeGiam'] /100) * $row['GiaGoc']);
			else
				$giaban = $row['GiaGoc'];
			?>
			<div class="khungsanpham">
				<div class="card">					
					<a href='index.php?do=sanpham_chitiet&MaSP=<?php echo $row['MaSP'];?>&MaTH=<?php echo $row['MaTH'];?>'>
						<img class="hinhanhsp" src="<?php echo $path;?>" style='width: 200px; height: 150px;'>
						<br />
					</a>
					<span class="luotxem"><?php echo $row['LuotXem'];?> lượt xem </span>
					<span class="luotmua"><?php echo $row['LuotMua'];?> lượt mua </span><br/>
					<?php
					if($row['TiLeGiam'] > 0)
						echo "<span class=\"giagoc\">". number_format($row['GiaGoc'])." đ</span>";
					?>
					</span><span class="giaban"><?php echo number_format($giaban);?> đ</span>
				</div>
				<p><a  class="tensp" href='index.php?do=sanpham_chitiet&MaSP=<?php echo $row['MaSP'];?>&MaTH=<?php echo $row['MaTH'];?>'><?php echo $row['TenSanPham'];?></a></p>
			</div>
		<?php
		}
		if($count_query > $_SESSION['display_limit'])
		{
			echo "<h3 class=\"xemthem\"><a href='index.php?do=sanpham_loai&MaLoai=".$maloai."&display_limit=ok'>Xem thêm các sản phẩm khác</a></h3></td>";
		}
	?>
</body>

</html>