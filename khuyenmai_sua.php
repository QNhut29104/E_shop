<?php
	$sql = "SELECT * FROM `tbl_phieukhuyenmai` WHERE `Code` = '".$_GET['Code']."'";
	$danhsach = $connect->query($sql);
	//Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
	if (!$danhsach) {
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	$row = $danhsach->fetch_array(MYSQLI_ASSOC);
?>
<form class="formSua" action="index.php?do=khuyenmai_sua_xuly" method="post">
	<h3 style="text-align: center;">Sửa mã khuyến mãi</h3>
	<input type="hidden" name="oldCode" value="<?php echo $row['Code'];?>" />
	<table>
		<tr>
			<td class="label" style="width: 200px;">
				<label for="Code">Mã khuyến mãi:</label>
			</td>
			<td>
				<input type="text" name="Code" value="<?php echo $row['Code'];?>" required>
			</td>
		</tr>
		<tr>
			<td class="label" style="width: 200px;">
				<label for="NgayTao">Ngày tạo:</label>
			</td>
			<td>
				<input type="date" name="NgayTao" value="<?php echo $row['NgayTao'];?>" required>
			</td>
		</tr>
		<tr>
			<td class="label" style="width: 200px;">
				<label for="MucGiam">Mức giảm:</label>
			</td>
			<td>
				<input type="number" name="MucGiam" value="<?php echo $row['MucGiam'];?>" />
			</td>
		</tr>
		<tr>
			<td class="label" style="width: 200px;">
				<label for="ToiDa">Tối đa:</label>
			</td>
			<td>
				<input type="number" name="ToiDa" value="<?php echo $row['ToiDa'];?>" />
			</td>
		</tr>
		<tr>
			<td class="label" style="width: 200px;">
				<label for="ApDungToiThieu">Mức giá tối thiểu:</label>
			</td>
			<td>
				<input type="number" name="ApDungToiThieu" value="<?php echo $row['ApDungToiThieu'];?>" />
			</td>
		</tr>
		<tr>
			<td class="label" style="width: 200px;">
				<label for="GioiHanSuDung">Giới hạn sử dụng:</label>
			</td>
			<td>
				<input type="number" name="GioiHanSuDung" value="<?php echo $row['GioiHanSuDung'];?>" />
			</td>
		</tr>
		<tr>
			<td class="label" style="width: 200px;">
				<label for="SoLanSuDung">Số lần sử dụng:</label>
			</td>
			<td>
				<input type="number" name="SoLanSuDung" value="<?php echo $row['SoLanSuDung'];?>" />
			</td>
		</tr>
	</table>
	
	<input type="submit" value="Cập nhật" />
</form>
