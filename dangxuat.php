<?php
	// Hủy SESSION
	unset($_SESSION['ID']);
	unset($_SESSION['HoTen']);
	unset($_SESSION['QuyenHan']);
	
	// Chuyển hướng về trang index.php
	header("Location: index.php");
?>