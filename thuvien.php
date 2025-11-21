<?php
	function ThongBaoLoi($thongbao = "")
	{
		echo "<h3>Lỗi</h3><p class='ThongBaoLoi'>$thongbao</p>";
	}
	
	function ThongBao($thongbao = "")
	{
		echo "<h3>Hoàn thành</h3><p class='ThongBao'>$thongbao</p>";
	}
	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';

		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[random_int(0, $charactersLength - 1)];
		}
		return $randomString;
	}
?>