<?php
	
	$sql = "SELECT * FROM `tbl_nguoidung` WHERE `QuyenHan` = 2";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
?>
<h3 class="tensp" style="float: left; margin: 8px 20px;">DANH SÁCH KHÁCH HÀNG</h3>
<table class="danhsach">
	<tr>
		<th>ID</th>
		<th>Họ và tên</th>
		<th>Tên đăng nhập</th>
		<th>Năm sinh</th>
		<th>Giới tính</th>
		<th>Số điện thoại</th>
		<th>Email</th>
		<th>Địa chỉ</th>
		<th>Khoá</th>
		<th colspan="2">Hành động</th>
	</tr>
	<?php
		while ($dong = $danhsach->fetch_array(MYSQLI_ASSOC)) 
		{			
			echo "<tr  bgcolor='#ffffff' onmouseover='this.style.background=\"#dee3e7\"' onmouseout='this.style.background=\"#ffffff\"'>";
				echo "<td>" . $dong["ID"] . "</td>";
				echo "<td>" . $dong["HoTen"] . "</td>";
				echo "<td>" . $dong["TenDangNhap"] . "</td>";
				echo "<td>" . $dong["NamSinh"] . "</td>";
				echo "<td>" . ($dong["GioiTinh"] == 0 ? "Nam" : "Nữ") . "</td>";
				echo "<td>" . $dong["SDT"] . "</td>";
				echo "<td>" . $dong["Email"] . "</td>";
				echo "<td>" . $dong["DiaChi"] . "</td>";
				
				echo "<td align='center'>";
					if($dong["Blocked"] == 0)
						echo "<a href='index.php?do=nguoidung_kichhoat&id=" . $dong["ID"] . "&khoa=1&type=khachhang'><img src='images/active.png' /></a>";
					else
						echo "<a href='index.php?do=nguoidung_kichhoat&id=" . $dong["ID"] . "&khoa=0&type=khachhang'><img src='images/ban.png' /></a>";
				echo "</td>";
				
				echo "<td align='center'><a href='index.php?do=nguoidung_sua&id=" . $dong["ID"] . "&type=khachhang'><img src='images/edit.png' /></a></td>";
				echo "<td align='center'><a href='index.php?do=nguoidung_xoa&id=" . $dong["ID"] . "&type=khachhang' onclick='return confirm(\"Bạn có muốn xóa người dùng " . $dong['HoTen'] . " không?\")'><img src='images/delete.png' /></a></td>";
			echo "</tr>";
		}
	?>
</table>