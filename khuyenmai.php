<?php
	
	$sql = "SELECT * FROM `tbl_phieukhuyenmai`";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
?>
<h3 class="tensp" style="float: left; margin: 8px 20px;">DANH SÁCH MÃ KHUYẾN MÃI</h3>
<a class="add" href="index.php?do=khuyenmai_them">Thêm mã khuyến mãi</a>
<table class="danhsach">
	<tr>
		<th>Mã code</th>
		<th>Ngày tạo</th>
		<th>Mức giảm</th>
		<th>Tối đa</th>
		<th>Mức giá tối thiểu</th>
		<th>Giới hạn SD</th>
		<th>Số lần SD</th>
		<th colspan="2">Hành động</th>
	</tr>
	<?php
		while($row = $danhsach->fetch_array(MYSQLI_ASSOC)){
			echo "<tr  bgcolor='#ffffff' onmouseover='this.style.background=\"#dee3e7\"' onmouseout='this.style.background=\"#ffffff\"'>";
				echo "<td>" . $row["Code"] . "</td>";
				echo "<td>" . $row["NgayTao"] . "</td>";
				echo "<td>" . $row["MucGiam"] . "</td>";
				echo "<td>" . $row["ToiDa"] . "</td>";
				echo "<td>" . $row["ApDungToiThieu"] . "</td>";
				echo "<td>" . $row["GioiHanSuDung"] . "</td>";
				echo "<td>" . $row["SoLanSuDung"] . "</td>";
				
				echo "<td align='center'><a href='index.php?do=khuyenmai_sua&Code=" . $row["Code"] . "'><img src='images/edit.png' /></a></td>";
				echo "<td align='center'><a href='index.php?do=khuyenmai_xoa&Code=" . $row["Code"] . "' onclick='return confirm(\"Bạn có muốn xóa mã khuyến mãi " . $row['Code'] . " không?\")'><img src='images/delete.png' /></a></td>";
			echo "</tr>";
		}
	?>
</table>