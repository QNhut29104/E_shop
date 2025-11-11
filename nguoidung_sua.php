<?php
	$id = $_GET['id'];
	$type = $_GET['type'];
	$sql = "SELECT * FROM `tbl_nguoidung` WHERE `ID` = $id";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	$row = $danhsach->fetch_array(MYSQLI_ASSOC);
?>
<form class="formSua" action="index.php?do=nguoidung_sua_xuly" method="post">
	<input type="hidden" name="ID" value="<?php echo $id;?>" />
	<input type="hidden" name="type" value="<?php echo $type;?>" />
	<h3 style="text-align: center;">Sửa thông tin</h3>
	<table>
		<tr>
			<td class="label">
				<label for="HoTen">Họ tên: </label>
			</td>
			<td>
				<input type="text" name="HoTen" value="<?php echo $row['HoTen'];?>" required>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="NamSinh">Năm sinh: </label>
			</td>
			<td>
				<input type="text" name="NamSinh" value="<?php echo $row['NamSinh'];?>" required>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="GioiTinh">Giới tính: </label>
			</td>
			<td>
				<?php
					if($row['GioiTinh'] == 0){
						echo "<input type='radio' name='GioiTinh' checked='checked' value='0' >Nam</input>";
						echo "<input type='radio' name='GioiTinh' value='1' >Nữ</input>";
					}
					else{
						echo "<input type='radio' name='GioiTinh' value='0' >Nam</input>";
						echo "<input type='radio' name='GioiTinh' checked='checked' value='1' >Nữ</input>";
					}
				?>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="SDT">SDT: </label>
			</td>
			<td>
				<input type="text" name="SDT" value="<?php echo $row['SDT'];?>" required>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="Email">Email: </label>
			</td>
			<td>
				<input type="email" name="Email" value="<?php echo $row['Email'];?>" required>
			</td>
		</tr>
		<tr>
			<td class="label">
				<label for="DiaChi">Địa chỉ: </label>
			</td>
			<td>
				<textarea type="text" name="DiaChi" rows="1" required><?php echo $row['DiaChi'];?></textarea>
			</td>
		</tr>
	</table>
	<input type="submit" onclick="return confirm('Lưu thông tin?')" value="Lưu thông tin"/>
</form>
