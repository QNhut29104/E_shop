
<form class="formSua" action="index.php?do=doimatkhau_xuly" method="post">
<h3 style="text-align: center;">Đổi mật khẩu</h3>
	<table>
		<input type="hidden" value="<?php echo $_SESSION['ID']; ?>" name="ID" />
		<tr>
			<td>Mật khẩu cũ:</td>
			<td><input type="password" name="MatKhauCu" required></td>
		</tr>
		<tr>
			<td>Mật khẩu mới:</td>
			<td><input type="password" name="MatKhauMoi" required></td>
		</tr>
		<tr>
			<td>Xác nhận mật khẩu mới:</td>
			<td><input type="password" name="XacNhanMatKhauMoi" required></td>
		</tr>
	</table>
	
	<input type="submit" value="Cập nhật" />
</form>