<?php
	$madh = $_GET['MaDH'];
	$id = $_SESSION['ID'];
	$sql = "SELECT * FROM `tbl_donhang` WHERE `MaDH`='$madh'";
	$danhsach = $connect->query($sql);
	if(!$danhsach){
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	$row = $danhsach->fetch_array(MYSQLI_ASSOC);
	$ThanhTien = $row['ThanhTien'];
	$TienDaTT = $row['SoTienDaTT'];
	$SoTienConLai = $ThanhTien - $TienDaTT;
?>
<div class="xacminh">
	<h2 style="text-align: center;">XÁC MINH THANH TOÁN</h2>
	<table class="tblinfo">
	<tr>
		<td style="float: left;">
			<b>Mã đơn hàng: <?php echo $madh;?></b>
		</td>
		<td style="float: right;">
			Ngày đặt hàng: <?php echo date("d/m/Y",strtotime($row['NgayDat']));?>
		</td>
	</tr>
		<td style="float: left;">
			<b>Tổng số tiền: </b><?php echo number_format($ThanhTien);?> đ
		</td>
	</tr>
	</tr>
		<td style="float: left;">
			<b>Số tiền đã thanh toán: </b><?php echo number_format($TienDaTT);?> đ
		</td>
	</tr>
	</tr>
		<td style="float: left;">
			<b>Số tiền cần thanh toán: </b><?php echo number_format($SoTienConLai);?> đ
		</td>
	</tr>
	</table>
	<form action="index.php?do=xacminh_xuly" class="formxacminh" method="post" enctype="multipart/form-data">
		<input type="hidden" name="do" value="xacminh_xuly" />
		<input type="hidden" name="MaDH" value="<?php echo $madh;?>" />
		<table class="tblxacminh">
		<tr>
			<td class='label' style="width: 250px;">
				<label for="SoTienTT">Số tiền thanh toán: </label>
			</td>
			<td style="width: 250px;">
				<input type="number" name="SoTienTT" class="thanhtoan" max="<?php echo $SoTienConLai;?>" required>
			</td>
		</tr>
		<tr>
			<td class='label' style="width: 250px;">
				<label for="HinhAnh">Hình ảnh xác minh: </label>
			</td>
			<td style="width: 250px;">
				<input type="file" id="HinhAnh" name="HinhAnh" class="thanhtoan" accept=".png, .jpg, .jpeg" required>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<button type="submit" class="btnsubmit" name="submit">Gửi xác minh</button>
			</td>
		</tr>
		</table>
	</form>
</div>