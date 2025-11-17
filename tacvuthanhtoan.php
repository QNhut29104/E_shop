<?php
	$sql = "SELECT `tbl_thanhtoan`.*, `tbl_nguoidung`.`HoTen`
			FROM `tbl_thanhtoan` 
				LEFT JOIN `tbl_nguoidung` ON `tbl_thanhtoan`.`User_id` = `tbl_nguoidung`.`ID`
			WHERE `XacThuc` = 'Chưa xác thực'
			ORDER BY `NgayTT`";
	$chuaxacthuc = $connect->query($sql);
	if(!$chuaxacthuc){
		die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
		exit();
	}
	
	$sql = "SELECT `tbl_thanhtoan`.*, `tbl_nguoidung`.`HoTen`
			FROM `tbl_thanhtoan` 
				LEFT JOIN `tbl_nguoidung` ON `tbl_thanhtoan`.`User_id` = `tbl_nguoidung`.`ID`
			WHERE `XacThuc` = 'Không hợp lệ'
			ORDER BY `NgayTT`";
	$khonghople = $connect->query($sql);
	if(!$khonghople){
		die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
		exit();
	}
	
	$sql = "SELECT `tbl_thanhtoan`.*, `tbl_nguoidung`.`HoTen`
			FROM `tbl_thanhtoan` 
				LEFT JOIN `tbl_nguoidung` ON `tbl_thanhtoan`.`User_id` = `tbl_nguoidung`.`ID`
			WHERE `XacThuc` = 'Đã xác thực'
			ORDER BY `NgayTT`";
	$daxacthuc = $connect->query($sql);
	if(!$daxacthuc){
		die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
		exit();
	}
?>
<h3 class="tensp" style="float: left; margin: 8px 20px;">CHƯA XÁC THỰC</h3>
<table class="danhsach">
	<tr>
		<th>ID</th>
		<th>Tên người dùng</th>
		<th>Mã đơn hàng</th>
		<th>Ngày thanh toán</th>
		<th>Số tiền thanh toán</th>
		<th>Hình ảnh</th>
		
		<th colspan="2">Hành động</th>
	</tr>
	<?php
		while ($row = $chuaxacthuc->fetch_array(MYSQLI_ASSOC)) {	
			echo "<tr  bgcolor='#ffffff' onmouseover='this.style.background=\"#dee3e7\"' onmouseout='this.style.background=\"#ffffff\"'>";
				echo "<td>" . $row['ID'] . "</td>";
				echo "<td class='tensp'>" . $row['HoTen'] . "</td>";
				echo "<td>" . $row['MaDH'] . "</td>";
				echo "<td>" . date("H:i:s d/m/Y",strtotime($row['NgayTT'])) . "</td>";
				echo "<td>" . $row['SoTienTT'] . "</td>";
				echo "<td align='center'><a href='images/uploads/".$row['HinhAnh']."'><img src='images/uploads/".$row['HinhAnh']."' height='50px'/></a></td>";

				echo "<td align='center'><a href='index.php?do=tacvuthanhtoan_xacthuc&ID=" . $row['ID'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xác thực thanh toán này?\")'><img src='images/active.png' /></a></td>";
				echo "<td align='center'><a href='index.php?do=tacvuthanhtoan_khonghople&ID=" . $row['ID'] . "'><img src='images/ban.png' /></a></td>";
			echo "</tr>";
		}
	?>
</table>

<h3 class="tensp" style="float: left; margin: 8px 20px;">KHÔNG HỢP LỆ</h3>
<table class="danhsach">
	<tr>
		<th>ID</th>
		<th>Tên người dùng</th>
		<th>Mã đơn hàng</th>
		<th>Ngày thanh toán</th>
		<th>Số tiền thanh toán</th>
		<th>Hình ảnh</th>
		
		<th colspan="2">Hành động</th>
	</tr>
	<?php
		while ($row = $khonghople->fetch_array(MYSQLI_ASSOC)) {	
			echo "<tr>";
				echo "<td>" . $row['ID'] . "</td>";
				echo "<td class='tensp'>" . $row['HoTen'] . "</td>";
				echo "<td>" . $row['MaDH'] . "</td>";
				echo "<td>" . date("H:i:s d/m/Y",strtotime($row['NgayTT'])) . "</td>";
				echo "<td>" . $row['SoTienTT'] . "</td>";
				echo "<td align='center'><a href='images/uploads/".$row['HinhAnh']."'><img src='images/uploads/".$row['HinhAnh']."' height='50px'/></a></td>";

				echo "<td align='center'><a href='index.php?do=tacvuthanhtoan_xacthuc&ID=" . $row['ID'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn xác thực thanh toán này?\")'><img src='images/active.png' /></a></td>";
				echo "<td align='center'><a href='index.php?do=tacvuthanhtoan_chuaxacthuc&ID=" . $row['ID'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn huỷ xác thực thanh toán này?\")'><img src='images/delete.png' /></a></td>";
			echo "</tr>";
		}
	?>
</table>

<h3 class="tensp" style="float: left; margin: 8px 20px;">ĐÃ XÁC THỰC</h3>
<table class="danhsach">
	<tr>
		<th>ID</th>
		<th>Tên người dùng</th>
		<th>Mã đơn hàng</th>
		<th>Ngày thanh toán</th>
		<th>Số tiền thanh toán</th>
		<th>Hình ảnh</th>
		
		<th colspan="2">Hành động</th>
	</tr>
	<?php
		while ($row = $daxacthuc->fetch_array(MYSQLI_ASSOC)) {	
			echo "<tr>";
				echo "<td>" . $row['ID'] . "</td>";
				echo "<td class='tensp'>" . $row['HoTen'] . "</td>";
				echo "<td>" . $row['MaDH'] . "</td>";
				echo "<td>" . date("H:i:s d/m/Y",strtotime($row['NgayTT'])) . "</td>";
				echo "<td>" . $row['SoTienTT'] . "</td>";
				echo "<td align='center'><a href='images/uploads/".$row['HinhAnh']."'><img src='images/uploads/".$row['HinhAnh']."' height='50px'/></a></td>";

				echo "<td align='center'><a href='index.php?do=tacvuthanhtoan_khonghople&ID=" . $row['ID'] . "' onclick='return confirm(\"Bạn có chắc chắn thanh toán này không hợp lệ?\")'><img src='images/ban.png' /></a></td>";
				echo "<td align='center'><a href='index.php?do=tacvuthanhtoan_chuaxacthuc&ID=" . $row['ID'] . "' onclick='return confirm(\"Bạn có chắc chắn muốn huỷ xác thực thanh toán này?\")' ><img src='images/delete.png' /></a></td>";
			echo "</tr>";
		}
	?>
</table>