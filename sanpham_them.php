<form class="formSua" action="index.php?do=sanpham_them_xuly" method="post" enctype="multipart/form-data">
	<h3 style="text-align: center;">Thêm sản phẩm</h3>
	<table>
		<tr>
			<td class="label">
				<label for="MaSP">Mã sản phẩm: </label>
			</td>
			<td>
				<input type="text" name="MaSP" required>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="TenSanPham">Tên sản phẩm: </label>
			</td>
			<td>
				<input type="text" name="TenSanPham" required>
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
				<input type="number" name="GiaGoc" required>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="TiLeGiam">Tỉ lệ giảm: </label>
			</td>
			<td>
				<input type="number" name="TiLeGiam" required>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="TonKho">Tồn kho: </label>
			</td>
			<td>
				<input type="number" name="TonKho" required>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="XuatXu">Xuất xứ: </label>
			</td>
			<td>
				<input type="text" name="XuatXu" required>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="MoTa">Mô tả: </label>
			</td>
			<td>
				<textarea name="MoTa" rows="3" required></textarea>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="HinhAnh">Hình ảnh: </label>
			</td>
			<td>
				<input type="file" name="HinhAnh" onchange="document.getElementById('img').src = window.URL.createObjectURL(this.files[0])" required>
			</td>
		</tr>
		<tr>
			<td colspan = "2" style="text-align: center;">
				<img id="img" src="" alt="Hãy chọn file để hiển thị!" style="width: 300px; height: 250px;"/>
			</td>
		</tr>
		<tr>
			<td colspan="3" style="text-align: center;">
				<input class="submit" type="submit" value="Lưu thông tin" onclick="return confirm('Lưu thông tin?');" />
			</td>
		</tr>
	</table>
</form>