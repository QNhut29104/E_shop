<?php
	$sql = "SELECT `tbl_sanpham`.*, `tbl_thuonghieu`.`TenThuongHieu`
			FROM `tbl_sanpham` 
				LEFT JOIN `tbl_thuonghieu` ON `tbl_sanpham`.`MaTH` = `tbl_thuonghieu`.`MaTH`  
			ORDER by `MaSP` DESC";
	$danhsach = $connect->query($sql);
	//Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
	if (!$danhsach) {
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
?>
<h3 class="tensp" style="float: left; margin: 8px 20px;">DANH SÁCH SẢN PHẨM</h3>
<a class="add" href="index.php?do=sanpham_them">Thêm sản phẩm</a>
<table class="danhsach">
	<tr>
		<th>STT</th>
		<th>Mã sản phẩm</th>
		<th>Tên sản phẩm</th>
		<th>Thương hiệu</th>
		<th>Giá gốc</th>
		<th>Tỉ lệ giảm</th>
		<th>Tồn kho</th>
		
		<th colspan="2">Hành động</th>
	</tr>
	<?php
		$stt = 1;
		while ($dong = $danhsach->fetch_array(MYSQLI_ASSOC)) {	
			echo "<tr>";
				echo "<td>" . $stt . "</td>";
				echo "<td>" . $dong['MaSP'] . "</td>";
				echo "<td class='tensp'>" . $dong['TenSanPham'] . "</td>";
				echo "<td>" . $dong['TenThuongHieu'] . "</td>";
				echo "<td>" . number_format($dong['GiaGoc']) . "</td>";
				echo "<td>" . $dong['TiLeGiam'] . "</td>";
				echo "<td>" . $dong['TonKho'] . "</td>";

				echo "<td align='center'><a href='index.php?do=sanpham_sua&MaSP=" . $dong['MaSP'] . "'><img src='images/edit.png' /></a></td>";
				echo "<td align='center'><a href='index.php?do=sanpham_xoa&MaSP=" . $dong['MaSP'] . "' onclick='return confirm(\"Bạn có muốn xóa sản phẩm " . $dong['TenSanPham'] . " không?\")'><img src='images/delete.png' /></a></td>";
			echo "</tr>";
			$stt++;
		}
	?>
</table>