<!DOCTYPE html>

<?php
	$masp = $_GET['MaSP'];
	$sql = "SELECT `tbl_sanpham`.*, `tbl_loaisanpham`.`TenLoai`, `tbl_thuonghieu`.`TenThuongHieu`
			FROM `tbl_sanpham` 
				LEFT JOIN `tbl_loaisanpham` ON `tbl_sanpham`.`MaLoai` = `tbl_loaisanpham`.`MaLoai` 
				LEFT JOIN `tbl_thuonghieu` ON `tbl_sanpham`.`MaTH` = `tbl_thuonghieu`.`MaTH`
			WHERE `tbl_sanpham`.`MaSP` = '$masp';";
			
	$danhsach = $connect->query($sql);
	//Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
	if (!$danhsach) {
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	$row = $danhsach->fetch_array(MYSQLI_ASSOC);
	
	$path = "images/".$row['TenLoai']."/".$row['TenThuongHieu']."/".$row['HinhAnh'];
	
	$sql = "UPDATE `tbl_sanpham` SET `LuotXem` = `LuotXem` + 1 WHERE `MaSP` = '$masp';";
	$view_update = $connect->query($sql);
	
	if($row['TiLeGiam'] > 0)
		$giaban = $row['GiaGoc'] - (($row['TiLeGiam'] /100) * $row['GiaGoc']);
	else
		$giaban = $row['GiaGoc'];
?>

<table class="sanpham">
	<tr>
		<td class="chitiet"><h3 class="tensp"><?php echo $row['TenSanPham'] ?></h3>
			<p><b>Thương hiệu:</b> <?php echo $row['TenThuongHieu'];?></p>
			<?php
				if($row['TiLeGiam'] > 0){
					echo "<p><b>Giá gốc:</b> <span class=\"giagoc\" style='float: none;'>".number_format($row['GiaGoc'])." đ</span> <span class=\"giamgia\">-".$row['TiLeGiam']."%</span> </p>";
				}
			?>
			<p><b>Giá bán:</b> <?php echo "<span class=\"giaban\" style='float: none;'>".number_format($giaban)." đ</span>";?></p>
			<p><b>Số lượng hiện có:</b> <?php echo $row['TonKho'];?></p>
			<p><b>Tình trạng:</b> <?php echo $row['TinhTrang'];?></p>
		</td>
		<td class="hinhanh">
			<?php echo "<img class=\"hinhanhsp\" src=".$path." />";?>
		</td>
	</tr>
	<tr>
		<form action="index.php" method='get'>
			<td>
				<button class="btnmua" type="submit" name="do" value="muahang">Mua ngay</button>
				<button class="btnthem" type="submit" name="do" value="themgiohang">Thêm vào giỏ hàng</button>
				<input type="hidden" name="MaSP" value="<?php echo $masp;?>"/>
				<input type="hidden" name="MaTH" value="<?php echo $_GET['MaTH'];?>"/>
			</td>
		</form>			
	</tr>
	<tr>
		<td colspan="2">
			<h2>Mô tả</h2>
			<p class="mota"><?php echo $row['MoTa'];?></p>
		</td>
	</tr>	
</table>
<div style="clear: both;">
	<h2	style="margin: 14px;">Các sản phẩm cùng nhà sản xuất</h2>
	<?php
		include "sanpham_thuonghieu.php";
	?>
</div>