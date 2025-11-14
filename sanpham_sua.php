<?php
	$masp = $_GET['MaSP'];
	$sql = "SELECT `tbl_sanpham`.*, `tbl_loaisanpham`.`TenLoai`, `tbl_thuonghieu`.`TenThuongHieu`
			FROM `tbl_sanpham` 
				LEFT JOIN `tbl_loaisanpham` ON `tbl_sanpham`.`MaLoai` = `tbl_loaisanpham`.`MaLoai` 
				LEFT JOIN `tbl_thuonghieu` ON `tbl_sanpham`.`MaTH` = `tbl_thuonghieu`.`MaTH`
			WHERE `MaSP` = '$masp'";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	$row = $danhsach->fetch_array(MYSQLI_ASSOC);
?>
<form class="formSua" action="index.php?do=sanpham_sua_xuly" method="post" enctype="multipart/form-data">
	<input type="hidden" name="MaSPold" value="<?php echo $masp;?>" />
	<h3 style="text-align: center;">Sửa thông tin</h3>
	<table>
		<tr>
			<td class="label">
				<label for="MaSP">Mã sản phẩm: </label>
			</td>
			<td>
				<input type="text" name="MaSP" value="<?php echo $row['MaSP'];?>" required>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="TenSanPham">Tên sản phẩm: </label>
			</td>
			<td>
				<input type="text" name="TenSanPham" value="<?php echo $row['TenSanPham'];?>" required>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="MaTH">Thương hiệu: </label>
			</td>
			<td>
				<select name="MaTH">
					<?php
						$sql = "SELECT * FROM `tbl_thuonghieu`";
						$danhsach = $connect->query($sql);
						if(!$danhsach){
							die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
							exit();
						}
						while($r = $danhsach->fetch_array(MYSQLI_ASSOC)){
							if($r['MaTH'] == $row['MaTH'])
								echo "<option value=".$r['MaTH']." selected>".$r['TenThuongHieu']."</option>";
							else
								echo "<option value=".$r['MaTH'].">".$r['TenThuongHieu']."</option>";
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="MaLoai">Loại sản phẩm: </label>
			</td>
			<td>
				<select name="MaLoai">
					<?php
						$sql = "SELECT * FROM `tbl_loaisanpham`";
						$danhsach = $connect->query($sql);
						if(!$danhsach){
							die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
							exit();
						}
						while($r = $danhsach->fetch_array(MYSQLI_ASSOC)){
							if($r['MaLoai'] == $row['MaLoai'])
								echo "<option value=".$r['MaLoai']." selected>".$r['TenHienThi']."</option>";
							else
								echo "<option value=".$r['MaLoai'].">".$r['TenHienThi']."</option>";
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="GiaGoc">Giá gốc: </label>
			</td>
			<td>
				<input type="number" name="GiaGoc" value="<?php echo $row['GiaGoc'];?>" required>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="TiLeGiam">Tỉ lệ giảm: </label>
			</td>
			<td>
				<input type="number" name="TiLeGiam" value="<?php echo $row['TiLeGiam'];?>" required>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="TonKho">Tồn kho: </label>
			</td>
			<td>
				<input type="number" name="TonKho" value="<?php echo $row['TonKho'];?>" required>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="XuatXu">Xuất xứ: </label>
			</td>
			<td>
				<input type="text" name="XuatXu" value="<?php echo $row['XuatXu'];?>" required>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="MoTa">Mô tả: </label>
			</td>
			<td>
				<textarea name="MoTa" rows="3" required><?php echo $row['MoTa'];?></textarea>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="HinhAnh">Hình ảnh: </label>
			</td>
			<td>
				<input type="file" name="HinhAnh" onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])" />
			</td>
		</tr>
		<tr>
			<td colspan = "2" style="text-align: center;">
				<img id="img" src="<?php echo "images/".$row['TenLoai']."/".$row['TenThuongHieu']."/".$row['HinhAnh'];?>" style="width: 300px; height: 250px;"/>
			</td>
		</tr>
		<tr>
			<td colspan="3" style="text-align: center;">
				<input class="submit" type="submit" value="Lưu thông tin" onclick="return confirm('Lưu thông tin?');" />
			</td>
		</tr>
	</table>
</form>
