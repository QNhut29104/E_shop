<?php
	$type = $_GET['type'];
	
	if((strcmp($type,"nhanvien") == 0 && isset($_SESSION['QuyenHan']) && $_SESSION['QuyenHan'] == 0) || strcmp($type,"khachhang") == 0)
	{
	?>
	<form class="formSua" action="index.php?do=dangky_xuly" method="post">
		<input type="hidden" name="type" value="<?php echo $type;?>" />
		<?php
			if(strcmp($type,"nhanvien") == 0)
				echo "<h3 style='text-align: center;'>Đăng ký nhân viên</h3>";
			else
				echo "<h3 style='text-align: center;'>Đăng ký khách hàng</h3>";
		?>
		<table>
			<tr>
				<td class="label" style="width: 200px;">
					<label for="TenDangNhap">Tên đăng nhập: </label>
				</td>
				<td>
					<input type="text" name="TenDangNhap" required>
				</td>
			</tr>
			<tr>
				<td class="label" style="width: 200px;">
					<label for="MatKhau">Mật khẩu: </label>
				</td>
				<td>
					<input type="password" name="MatKhau" required>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="HoTen">Họ tên: </label>
				</td>
				<td>
					<input type="text" name="HoTen" required>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="NamSinh">Năm sinh: </label>
				</td>
				<td>
					<input type="number" name="NamSinh" required>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="GioiTinh">Giới tính: </label>
				</td>
				<td>
					<input type='radio' name='GioiTinh' checked='checked' value='0' >Nam</input>
					<input type='radio' name='GioiTinh' value='1' >Nữ</input>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="SDT">SDT: </label>
				</td>
				<td>
					<input type="text" name="SDT" required>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="Email">Email: </label>
				</td>
				<td>
					<input type="email" name="Email" required>
				</td>
			</tr>
			<tr>
				<td class="label">
					<label for="DiaChi">Địa chỉ: </label>
				</td>
				<td>
					<textarea type="text" name="DiaChi" rows="1" required></textarea>
				</td>
			</tr>
		</table>
		<input type="submit" onclick="return confirm('Lưu thông tin?')" value="Xác nhận"/>
	</form>
	<?php
	}
	else
		echo "Bạn không có quyền sử dụng tính năng này!!!"
?>