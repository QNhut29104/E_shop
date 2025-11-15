<?php
	$masp = $_GET['MaSP'];
	$math = $_GET['MaTH'];
	if(!isset($_SESSION['ID'])){
		echo "<script type='text/javascript'>
			alert('Vui lòng đăng nhập để mua hàng!!!');
			window.location.replace('index.php?do=sanpham_chitiet&MaSP=$masp&MaTH=$math');
		</script>";
	}
	
	$sql = "SELECT `tbl_sanpham`.*, `tbl_loaisanpham`.`TenLoai`, `tbl_thuonghieu`.`TenThuongHieu`
			FROM `tbl_sanpham` 
				LEFT JOIN `tbl_loaisanpham` ON `tbl_sanpham`.`MaLoai` = `tbl_loaisanpham`.`MaLoai` 
				LEFT JOIN `tbl_thuonghieu` ON `tbl_sanpham`.`MaTH` = `tbl_thuonghieu`.`MaTH`
			WHERE `tbl_sanpham`.`MaSP` = '$masp';";
			
	$danhsach = $connect->query($sql);
	//Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
	if (!$danhsach) {
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	$row = $danhsach->fetch_array(MYSQLI_ASSOC);
	$path = "images/".$row['TenLoai']."/".$row['TenThuongHieu']."/".$row['HinhAnh'];
	
	if($row['TiLeGiam'] > 0)
		$giaban = $row['GiaGoc'] - (($row['TiLeGiam'] /100) * $row['GiaGoc']);
	else
		$giaban = $row['GiaGoc'];
	
	$sql = "SELECT * FROM `tbl_shipping`";
	$dsship = $connect->query($sql);
	if (!$dsship) {
		die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
		exit();
	}
	
	if(isset($_SESSION['ID'])){
		$id = $_SESSION['ID'];
		$sql = "SELECT * FROM `tbl_nguoidung` WHERE `ID` = $id;";
		$danhsach = $connect->query($sql);
		//Nếu kết quả kết nối không được thì xuất báo lỗi và thoát
		if (!$danhsach) {
			die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
			exit();
		}
		$user = $danhsach->fetch_array(MYSQLI_ASSOC);
	}
	
	
?>
<table class="muasanpham">
	<tr>
		<td class="hinhanh">
			<?php echo "<img class=\"hinhanhsp\" src=".$path." />";?>
		</td>
	</tr>
	<tr>
		<td class="chitiet"><h3 class="tensp"><a class="tensp" href="index.php?do=sanpham_chitiet&MaSP=<?php echo $row['MaSP'];?>&MaTH=<?php echo $row['MaTH'];?>" style="padding: 0px;"><?php echo $row['TenSanPham'] ?></a></h3>
			<p><b>Thương hiệu:</b> <?php echo $row['TenThuongHieu'];?></p>
			<?php
				if($row['TiLeGiam'] > 0){
					echo "<p><b>Giá gốc:</b> <span class=\"giagoc\" style='float: none;'>".number_format($row['GiaGoc'])." đ</span> <span class=\"giamgia\">-".$row['TiLeGiam']."%</span> </p>";
				}
			?>
			<p><b>Giá bán:</b> <?php echo "<span class=\"giaban\" style='float: none;' >".number_format($giaban)." đ</span>";?></p>
			<p><b>Số lượng hiện có:</b> <?php echo $row['TonKho'];?></p>
			<p><b>Tình trạng:</b> <?php echo $row['TinhTrang'];?></p>
		</td>
	</tr>
</table>
<form class="formmuahang" action="index.php?do=muahang_xuly" method="post">
	<table class="formmua">
		<tr><td colspan="3"><h3 style="text-align: center; font-size: 30px;">MUA HÀNG</h3></td></tr>
		<tr>
			<td class="cottrai">
				<label class='formlbl' for="HoTen">Họ và tên:</label>
			</td>
			<td>
			<?php
				if(isset($_SESSION['ID'])){
					echo "<input type='hidden' name='User_id' value='".$id."' />";
					echo "<input type='hidden' name='MaSP' value='".$masp."' />";
					echo "<input class='text' type='text' name='HoTen' value='".$user['HoTen']."' required>";
				}
				else	
					echo "<input class='text' type='text' name='HoTen' required>";
			?>
			</td>
			<td class="cotphai">*</td>
		</tr>
		<tr>
			<td class="cottrai">
				<label class='formlbl' for="GioiTinh">Giới tính:</label>
			</td>
			<td>
			<?php
				if(isset($_SESSION['ID']))
					if($user['GioiTinh'] == 0){
						echo "<input type='radio' name='GioiTinh' checked='checked' value='0' >Nam</input>";
						echo "<input type='radio' name='GioiTinh' value='1' >Nữ</input>";
					}
					else{
						echo "<input type='radio' name='GioiTinh' value='0' >Nam</input>";
						echo "<input type='radio' name='GioiTinh' checked='checked' value='1' >Nữ</input>";
					}
				else{
					echo "<input type='radio' name='GioiTinh' checked='checked' value='0' >Nam</input>";
					echo "<input type='radio' name='GioiTinh' value='1' >Nữ</input>";
				}
			?>
			</td>
			<td class="cotphai">*</td>
		</tr>
		<tr>
			<td class="cottrai">
				<label class='formlbl' for="SDT">Số điện thoại:</label>
			</td>
			<td>
			<?php
				if(isset($_SESSION['ID']))
					echo "<input class='text' type='text' name='SDT' value='".$user['SDT']."' required>";
				else	
					echo "<input class='text' type='text' name='HoTen' required>";
			?>
			</td>
		</tr>
		<tr>
			<td class="cottrai">
				<label class='formlbl' for="DiaChi">Địa chỉ nhận hàng:</label>
			</td>
			<td>
			<?php
				if(isset($_SESSION['ID']))
					echo "<textarea class='text' name='DiaChi' rows='3' required>".$user['DiaChi']."</textarea>";
				else	
					echo "<textarea class='text' name='DiaChi' rows='3' required></textarea>";
			?>
			</td>
			<td class="cotphai">*</td>
		</tr>
		<tr>
			<td class="cottrai">
				<label class='formlbl' for="SoLuong">Số lượng mua:</label>
			</td>
			<td>
				<input type='hidden' name="DonGia" value=<?php echo $giaban;?> />
				<input class="number" type="number" name="SoLuong" value="1" min="1" max = <?php echo $row['TonKho']?> />
			</td>
			<td class="cotphai">*</td>
		</tr>
		<tr>
			<td class="cottrai">
				<label class='formlbl' for="BaoHiem">Bảo hiểm hàng:</label>
			</td>
			<td>
				<input type="radio" name="BaoHiem" checked="checked" value="1" >Có</input>
				<input type="radio" name="BaoHiem" value="0" >Không</input>
			</td>
		</tr>
		<tr>
			<td class="cottrai">
				<label class='formlbl' for="TraGop">Trả góp:</label>
			</td>
			<td>
				<input type="checkbox" name="TraGop">Trả góp</input>
			</td>
		</tr>
		<tr>
			<td class="cottrai">
				<label class='formlbl' for="CodeKM">Mã giảm giá:</label>
			</td>
			<td>
				<input class="text" type="text" name="CodeKM" />
			</td>
		</tr>
		<tr>
			<td class="cottrai">
				<label class='formlbl' for="MaShip">Phương thức vận chuyển:</label>
			</td>
			<td>
				<select name="MaShip">
				<?php
					while($r = $dsship->fetch_array(MYSQLI_ASSOC)){
						echo "<option value=".$r['MaShip'].">".$r['TenShip']."</option>";
					}
				?>
				</select>
			</td>
			<td class="cotphai">*</td>
		</tr>
		<tr>
			<td colspan="3" style="text-align: center;">
				<input class="submit" type="submit" value="Xác nhận mua hàng" />
			</td>
		</tr>
	</table>
</form>