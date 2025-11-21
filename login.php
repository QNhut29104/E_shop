<form class="loginform" action="index.php?do=dangnhap_xuly"  method="post">
	<div class="sub-form">
		<div class="phantren">
			<h2 class="login">Login</h2>
			<label>Tên đăng nhập</label><br>
			<input class="login" type="text" name="TenDangNhap" placeholder="Tên đăng nhập" required><br>
			<label>Mật khẩu</label><br>
			<input class="login" type="password" name="MatKhau" placeholder="Mật khẩu" required><br>
			<div>
				<button class="loginbtn" type="submit" name="login">Đăng nhập</button><br>         
			</div>
		</div>
		<div class="dangky-forgot">
			<a href="index.php?do=dangky&type=khachhang">Đăng ký</a> | <a href="index.php?do=quenmatkhau">Quên mật khẩu</a>
		</div>
	</div>
</form>