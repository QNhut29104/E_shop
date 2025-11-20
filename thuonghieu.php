<?php
	
	$sql = "SELECT * FROM `tbl_thuonghieu`";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
?>
<h3 class="tensp" style="float: left; margin: 8px 20px;">DANH SÁCH THƯƠNG HIỆU	</h3>
<a class="add" href="index.php?do=thuonghieu_them">Thêm thương hiệu</a>
<table class="danhsach">
	<tr>
		<th>ID</th>
		<th>Tên thương hiệu</th>
		<th style="min-width: 200px;">Ghi chú</th>
		<th colspan="2">Hành động</th>
	</tr>
	<?php
		while($row = $danhsach->fetch_array(MYSQLI_ASSOC)){
			echo "<tr  bgcolor='#ffffff' onmouseover='this.style.background=\"#dee3e7\"' onmouseout='this.style.background=\"#ffffff\"'>";
				echo "<td>" . $row["MaTH"] . "</td>";
				echo "<td>" . $row["TenThuongHieu"] . "</td>";
				echo "<td>" . $row["GhiChu"] . "</td>";
				
				echo "<td align='center'><a href='index.php?do=thuonghieu_sua&MaTH=" . $row["MaTH"] . "'><img src='images/edit.png' /></a></td>";
				echo "<td align='center'><a href='index.php?do=thuonghieu_xoa&MaTH=" . $row["MaTH"] . "' onclick='return confirm(\"Bạn có muốn xóa thương hiệu " . $row['TenThuongHieu'] . " không?\")'><img src='images/delete.png' /></a></td>";
			echo "</tr>";
		}
	?>
</table>