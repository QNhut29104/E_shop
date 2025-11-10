<form class="formSua" action="index.php?do=khuyenmai_them_xuly" method="post">
	<h3 style="text-align: center;">Thêm mã khuyến mãi</h3>
	<table>
		<tr>
			<td class="label" style="width: 200px;">
				<label for="Code">Mã khuyến mãi:</label>
			</td>
			<td>
				<input type="text" name="Code" required>
			</td>
		</tr>
		<tr>
			<td class="label" style="width: 200px;">
				<label for="NgayTao">Ngày tạo:</label>
			</td>
			<td>
				<input type="date" name="NgayTao" required>
			</td>
		</tr>
		<tr>
			<td class="label" style="width: 200px;">
				<label for="MucGiam">Mức giảm:</label>
			</td>
			<td>
				<input type="number" name="MucGiam"  required>
			</td>
		</tr>
		<tr>
			<td class="label" style="width: 200px;">
				<label for="ToiDa">Tối đa:</label>
			</td>
			<td>
				<input type="number" name="ToiDa" required>
			</td>
		</tr>
		<tr>
			<td class="label" style="width: 200px;">
				<label for="ApDungToiThieu">Mức giá tối thiểu:</label>
			</td>
			<td>
				<input type="number" name="ApDungToiThieu" required>
			</td>
		</tr>
		<tr>
			<td class="label" style="width: 200px;">
				<label for="GioiHanSuDung">Giới hạn sử dụng:</label>
			</td>
			<td>
				<input type="number" name="GioiHanSuDung" required>
			</td>
		</tr>
		<tr>
			<td class="label" style="width: 200px;">
				<label for="SoLanSuDung">Số lần sử dụng:</label>
			</td>
			<td>
				<input type="number" name="SoLanSuDung" required>
			</td>
		</tr>
	</table>
	<input type="submit" value="Cập nhật" />
</form>