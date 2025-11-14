<?php
    $masp_old = $_POST['MaSPold'];
    $masp = $_POST['MaSP'];
    $tensp = $_POST['TenSanPham'];
    $math = $_POST['MaTH'];
    $maloai = $_POST['MaLoai'];
    $giagoc = $_POST['GiaGoc'];
    $tlgiam = $_POST['TiLeGiam'];
    $tonkho = $_POST['TonKho'];
    $xuatxu = $_POST['XuatXu'];
    $mota = $_POST['MoTa'];

    // Tình trạng sản phẩm
    $tinhtrang = $tonkho > 0 ? "Còn hàng" : "Hết hàng";

    // Nếu có upload hình ảnh
    if (!empty($_FILES["HinhAnh"]["name"])) {

        // Lấy tên loại sản phẩm
        $sql = "SELECT TenLoai FROM tbl_loaisanpham WHERE MaLoai = $maloai";
        $danhsach = $connect->query($sql);
        if (!$danhsach) {
            die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
        }
        $loai = $danhsach->fetch_array(MYSQLI_ASSOC);

        // Lấy tên thương hiệu
        $sql = "SELECT TenThuongHieu FROM tbl_thuonghieu WHERE MaTH = $math";
        $danhsach = $connect->query($sql);
        if (!$danhsach) {
            die("Không thể thực hiện câu lệnh SQL: " . $connect->error);
        }
        $th = $danhsach->fetch_array(MYSQLI_ASSOC);

        // Tạo đường dẫn thư mục ảnh
        $target_dir = "images/" . $loai['TenLoai'] . "/" . $th['TenThuongHieu'] . "/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Tên file ảnh
        $target_img = $target_dir . basename($_FILES["HinhAnh"]["name"]);
        $imageFileType = strtolower(pathinfo($target_img, PATHINFO_EXTENSION));

        $checkOK = 1;

        // Kiểm tra đúng là ảnh
        $check = getimagesize($_FILES["HinhAnh"]["tmp_name"]);
        if ($check === false) {
            $checkOK = 0;
        }

        // Kiểm tra kích thước ảnh (<= 5MB)
        if ($_FILES["HinhAnh"]["size"] > 5000000) {
            $checkOK = 0;
        }

        // Chỉ cho phép JPG, PNG, JPEG
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $checkOK = 0;
        }

        // Nếu kiểm tra ok → upload file
        if ($checkOK) {
            if (move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], $target_img)) {
                $HinhAnh = basename($_FILES["HinhAnh"]["name"]);

                // Cập nhật sản phẩm có hình ảnh mới
                $sql = "UPDATE tbl_sanpham 
                        SET MaSP='$masp', MaLoai=$maloai, MaTH=$math, TenSanPham='$tensp',
                            GiaGoc=$giagoc, TiLeGiam=$tlgiam, TonKho=$tonkho, 
                            XuatXu='$xuatxu', MoTa='$mota', TinhTrang='$tinhtrang', HinhAnh='$HinhAnh'
                        WHERE MaSP='$masp_old'";
                $danhsach = $connect->query($sql);
                if (!$danhsach) {
                    die('Không thể thực hiện câu lệnh SQL: ' . $connect->error);
                }

                header("Location: index.php?do=sanpham");
                exit();
            } else {
                // Upload thất bại
                echo "<script>alert('Lỗi khi upload file!'); window.location='index.php?do=sanpham';</script>";
                exit();
            }
        } else {
            // Ảnh không hợp lệ → chỉ update dữ liệu khác
            $sql = "UPDATE tbl_sanpham 
                    SET MaSP='$masp', MaLoai=$maloai, MaTH=$math, TenSanPham='$tensp',
                        GiaGoc=$giagoc, TiLeGiam=$tlgiam, TonKho=$tonkho, 
                        XuatXu='$xuatxu', MoTa='$mota', TinhTrang='$tinhtrang'
                    WHERE MaSP='$masp_old'";
            $danhsach = $connect->query($sql);
            if (!$danhsach) {
                die('Không thể thực hiện câu lệnh SQL: ' . $connect->error);
            }
            header("Location: index.php?do=sanpham");
            exit();
        }
    } 
    else {
        // Không upload hình → chỉ update thông tin khác
        $sql = "UPDATE tbl_sanpham 
                SET MaSP='$masp', MaLoai=$maloai, MaTH=$math, TenSanPham='$tensp',
                    GiaGoc=$giagoc, TiLeGiam=$tlgiam, TonKho=$tonkho, 
                    XuatXu='$xuatxu', MoTa='$mota', TinhTrang='$tinhtrang'
                WHERE MaSP='$masp_old'";
        $danhsach = $connect->query($sql);
        if (!$danhsach) {
            die('Không thể thực hiện câu lệnh SQL: ' . $connect->error);
        }
        header("Location: index.php?do=sanpham");
        exit();
    }
?>
