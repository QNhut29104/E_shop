<?php
	$sql = "SELECT `tbl_donhang`.*, `tbl_nguoidung`.`HoTen`
			FROM `tbl_donhang` 
				LEFT JOIN `tbl_nguoidung` ON `tbl_donhang`.`User_id` = `tbl_nguoidung`.`ID`
			WHERE `TraGop` = 0
			ORDER BY `NgayDat` DESC, `TrangThai` ASC";
	$dh = $connect->query($sql);
	if(!$dh){
		die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
		exit();
	}
	
	$sql = "SELECT `tbl_donhang`.*, `tbl_nguoidung`.`HoTen`
			FROM `tbl_donhang` 
				LEFT JOIN `tbl_nguoidung` ON `tbl_donhang`.`User_id` = `tbl_nguoidung`.`ID`
			WHERE `TraGop` = 1
			ORDER BY `NgayDat` DESC, `TrangThai` ASC";
	$tg = $connect->query($sql);
	if(!$tg){
		die("Không thể thực hiện câu lệnh SQL: ".$connect->error);
		exit();
	}
?>
<h3 class="tensp" style="float: left; margin: 8px 20px;">ĐƠN HÀNG PHỔ THÔNG</h3>
<table class="danhsach">
	<tr>
		<th>Mã đơn hàng</th>
		<th>Tên người dùng</th>
		<th>Ngày đặt</th>
		<th>Bảo hiểm</th>
		<th>Thành tiền</th>
		<th>Số tiền đã TT</th>
		<th colspan="2">Trạng thái</th>
		<?php
			if($_SESSION['QuyenHan'] == 0)
				echo "<th colspan='3'>Hành động</th>";
			else
				echo "<th colspan='2'>Hành động</th>";
		?>
		
	</tr>
	<?php
		while ($row = $dh->fetch_array(MYSQLI_ASSOC)) {	
			if($row['ThanhTien'] > $row['SoTienDaTT'])
				echo "<tr  bgcolor='#FFCCCB' onmouseover='this.style.background=\"lightblue\"' onmouseout='this.style.background=\"#FFCCCB\"'>";
			else
				echo "<tr  bgcolor='#ffffff' onmouseover='this.style.background=\"#dee3e7\"' onmouseout='this.style.background=\"#ffffff\"'>";
				echo "<td>" . $row['MaDH'] . "</td>";
				echo "<td class='tensp'>" . $row['HoTen'] . "</td>";
				echo "<td>" . date("H:i:s d/m/Y",strtotime($row['NgayDat'])) . "</td>";
				echo "<td>" . ($row['BaoHiem'] == 1 ? "Có" : "Không") . "</td>";
				echo "<td>" . number_format($row['ThanhTien']) . "</td>";
				echo "<td>" . number_format($row['SoTienDaTT']) . "</td>";
				
				if(strcmp($row['TrangThai'],"Đang xử lý") == 0){
					echo "<td>" . $row['TrangThai'] . "</td>";
					echo "<td align='center'><a href='index.php?do=tacvudonhang_giao&MaDH=" . $row['MaDH'] . "' onclick='return confirm(\"Thay đổi trạng thái thành đang giao?\")'><img src='images/giao.png' /></a></td>";
				}
				else if(strcmp($row['TrangThai'],"Đang giao") == 0){
					echo "<td>" . $row['TrangThai'] . "</td>";
					echo "<td align='center'><a href='index.php?do=tacvudonhang_nhan&MaDH=" . $row['MaDH'] . "' onclick='return confirm(\"Thay đổi trạng thái thành đã nhận?\")'><img src='images/active.png' /></a></td>";
				}
				else{
					echo "<td colspan='2'>" . $row['TrangThai'] . "</td>";
				}
				
				echo "<td align='center'><a href='noidungdonhang.php?MaDH=" . $row['MaDH'] . "'><img src='images/edit.png' /></a></td>";
				if($_SESSION['QuyenHan'] == 0){
					echo "<td align='center'><a href='index.php?do=tacvudonhang_thanhtoan&MaDH=" . $row['MaDH'] . "' onclick='return confirm(\"Bạn có chắc chắn đơn hàng này đã được thanh toán?\")'><img src='images/thanhtoan.png' /></a></td>";
					echo "<td align='center'><a href='index.php?do=tacvudonhang_xoa&MaDH=" . $row['MaDH'] . "' onclick='return confirm(\"Bạn có chắc chắn xoá đơn hàng này?\")'><img src='images/delete.png' /></a></td>";
				}
			echo "</tr>";
		}
	?>
</table>
<h3 class="tensp" style="float: left; margin: 8px 20px;">ĐƠN HÀNG TRẢ GÓP</h3>
<table class="danhsach">
	<tr>
		<th>Mã đơn hàng</th>
		<th>Tên người dùng</th>
		<th>Ngày đặt</th>
		<th>Bảo hiểm</th>
		<th>Thành tiền</th>
		<th>Số tiền đã TT</th>
		<th colspan="2">Trạng thái</th>
		
		<?php
			if($_SESSION['QuyenHan'] == 0)
				echo "<th colspan='3'>Hành động</th>";
			else
				echo "<th>Hành động</th>";
		?>
	</tr>
	<?php
		while ($row = $tg->fetch_array(MYSQLI_ASSOC)) {	
			if($row['ThanhTien'] > $row['SoTienDaTT'])
				echo "<tr  bgcolor='#FFCCCB' onmouseover='this.style.background=\"lightblue\"' onmouseout='this.style.background=\"#FFCCCB\"'>";
			else
				echo "<tr  bgcolor='#ffffff' onmouseover='this.style.background=\"#dee3e7\"' onmouseout='this.style.background=\"#ffffff\"'>";
				echo "<td>" . $row['MaDH'] . "</td>";
				echo "<td class='tensp'>" . $row['HoTen'] . "</td>";
				echo "<td>" . date("H:i:s d/m/Y",strtotime($row['NgayDat'])) . "</td>";
				echo "<td>" . ($row['BaoHiem'] == 1 ? "Có" : "Không") . "</td>";
				echo "<td>" . number_format($row['ThanhTien']) . "</td>";
				echo "<td>" . number_format($row['SoTienDaTT']) . "</td>";
				
				if(strcmp($row['TrangThai'],"Đang xử lý") == 0){
					echo "<td>" . $row['TrangThai'] . "</td>";
					echo "<td align='center'><a href='index.php?do=tacvudonhang_giao&MaDH=" . $row['MaDH'] . "' onclick='return confirm(\"Thay đổi trạng thái thành đang giao?\")'><img src='images/giao.png' /></a></td>";
				}
				else if(strcmp($row['TrangThai'],"Đang giao") == 0){
					echo "<td>" . $row['TrangThai'] . "</td>";
					echo "<td align='center'><a href='index.php?do=tacvudonhang_nhan&MaDH=" . $row['MaDH'] . "' onclick='return confirm(\"Thay đổi trạng thái thành đã nhận?\")'><img src='images/active.png' /></a></td>";
				}
				else{
					echo "<td colspan='2'>" . $row['TrangThai'] . "</td>";
				}
				
				echo "<td align='center'><a href='noidungdonhang.php?MaDH=" . $row['MaDH'] . "'><img src='images/edit.png' /></a></td>";
				if($_SESSION['QuyenHan'] == 0){
					echo "<td align='center'><a href='index.php?do=tacvudonhang_thanhtoan&MaDH=" . $row['MaDH'] . "' onclick='return confirm(\"Bạn có chắc chắn đơn hàng này đã được thanh toán?\")'><img src='images/thanhtoan.png' /></a></td>";
					echo "<td align='center'><a href='index.php?do=tacvudonhang_xoa&MaDH=" . $row['MaDH'] . "' onclick='return confirm(\"Bạn có chắc chắn xoá đơn hàng này?\")'><img src='images/delete.png' /></a></td>";
				}
				
			echo "</tr>";
		}
	?>
</table>