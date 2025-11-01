<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    include_once "cauhinh.php";
    include_once "thuvien.php";
    date_default_timezone_set("Asia/Ho_Chi_Minh");
?>

<!DOCTYPE html>
<html>
<head>
    <title>ESHOP</title>
    <meta charset="utf-8" />
    <script type="application/javascript" src="scripts/basic.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="icon" href="images/logo.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body onLoad="htGio()">
    <div id="header">
        <div id="login">
            <?php
                if(isset($_SESSION['ID']) && isset($_SESSION['HoTen'])){
                    echo "Xin chào: ".$_SESSION['HoTen'];
                } else {
                    echo "Xin chào: Khách";
                }
            ?>
        </div>
        <div id="time"></div>
    </div>

    <div id="phantren">
        <div class="trai">
            <a href="index.php" class="logo">
                <img src="images/logo.png" alt="Logo" width="40px" height="40px"/>
            </a>
        </div>
        <div class="giua">
            <?php
                if(!isset($_SESSION['ID']) || $_SESSION['QuyenHan'] == 2){
            ?>
                <div class="thanhtimkiem">
                    <form action="index.php" method="get">
                        <input type="hidden" name="do" value="search_xuly" />
                        <button class="btn" type="button">
                            <i class="fa fa-search" style="font-size: 20px"></i>
                        </button>
                        <input type="search" class="searchbar" name="search" id="s" placeholder="Tìm kiếm..." required>
                    </form>
                </div>
            <?php
                }
            ?>
        </div>

        <div class="phai">
            <form action="index.php" method="get">
                <?php
                    if(isset($_SESSION['QuyenHan'])){
                        switch($_SESSION['QuyenHan']){
                            case 2: // Khách hàng
                                echo "<div class='dropdown'>";
                                echo "<button class='dropbtn' type='submit' name='do' value='hosonguoidung'>";
                                echo "<i class='fa fa-user' style='font-size:25px'></i>";
                                echo "</button>";
                                echo "<div class='dropdown-content'>";
                                echo "<a href='index.php?do=hosonguoidung'>Thông tin cá nhân</a>";
                                echo "<a href='index.php?do=lichsudathang'>Lịch sử đặt hàng</a>";
                                echo "<a href='index.php?do=lichsuthanhtoan'>Lịch sử thanh toán</a>";
                                echo "<a href='index.php?do=doimatkhau'>Đổi mật khẩu</a>";
                                echo "<a href='index.php?do=dangxuat'>Đăng xuất</a>";
                                echo "</div></div>";

                                echo "<div class='dropdown'>";
                                echo "<button class='dropbtn' type='submit' name='do' value='giohang'>";
                                echo "<i class='fa fa-shopping-cart' style='font-size:25px'></i>";
                                echo "</button></div>";
                                break;

                            case 1: // Nhân viên
                                echo "<div class='dropdown'>";
                                echo "<button class='dropbtn' type='submit' name='do' value='hosonguoidung'>";
                                echo "<i class='fa fa-user' style='font-size:25px'></i>";
                                echo "</button>";
                                echo "<div class='dropdown-content'>";
                                echo "<a href='index.php?do=hosonguoidung'>Thông tin cá nhân</a>";
                                echo "<a href='index.php?do=doimatkhau'>Đổi mật khẩu</a>";
                                echo "<a href='index.php?do=dangxuat'>Đăng xuất</a>";
                                echo "</div></div>";
                                break;

                            case 0: // Quản lý
                                echo "<div class='dropdown'>";
                                echo "<button class='dropbtn' type='submit' name='do' value='hosonguoidung'>";
                                echo "<i class='fa fa-user' style='font-size:25px'></i>";
                                echo "</button>";
                                echo "<div class='dropdown-content'>";
                                echo "<a href='index.php?do=hosonguoidung'>Thông tin cá nhân</a>";
                                echo "<a href='index.php?do=doimatkhau'>Đổi mật khẩu</a>";
                                echo "<a href='index.php?do=dangxuat'>Đăng xuất</a>";
                                echo "</div></div>";
                                break;
                        }
                    } else {
                        echo "<div class='dropdown'>";
                        echo "<button class='dropbtn' type='submit' name='do' value='login'>";
                        echo "<i class='fa fa-user' style='font-size:25px'></i>";
                        echo "</button></div>";
                    }
                ?>
            </form>
        </div>
    </div>

    <?php
    if(isset($_SESSION['QuyenHan'])){
        switch($_SESSION['QuyenHan']){
            // ================= KHÁCH HÀNG =================
            case 2:
    ?>
                <div id="menutren">
                    <a href="index.php?do=home">Trang chủ</a>
                    <div class="dropdown">
                        <?php
                            $sql = "select * from tbl_loaisanpham";
                            $danhsach = $connect->query($sql);
                        ?>
                        <button class="dropbtn">Danh mục <i class="fa fa-caret-down"></i></button>
                        <div class="dropdown-content">
                            <?php while($row = $danhsach->fetch_array(MYSQLI_ASSOC)) {
                                echo "<a href='index.php?do=sanpham_loai&MaLoai=".$row['MaLoai']."'>".$row['TenHienThi']."</a>";
                            } ?>
                        </div>
                    </div>

                    <div class="dropdown">
                        <?php
                            $sql = "select * from tbl_thuonghieu";
                            $danhsach = $connect->query($sql);
                        ?>
                        <button class="dropbtn">Thương hiệu <i class="fa fa-caret-down"></i></button>
                        <div class="dropdown-content">
                            <?php while($row = $danhsach->fetch_array(MYSQLI_ASSOC)) {
                                echo "<a href='index.php?do=sanpham_thuonghieu&MaTH=".$row['MaTH']."'>".$row['TenThuongHieu']."</a>";
                            } ?>
                        </div>
                    </div>
                    <a href="index.php?do=aboutus">Về chúng tôi</a>
                </div>

                <div id="phangiua">
                    <div id="noidung">
                        <?php 
                            $do = isset($_GET['do']) ? $_GET['do'] : "home";
                            include $do.".php";
                        ?>
                    </div>
                </div>
    <?php
                break;

            // ================= QUẢN LÝ =================
            case 0:
    ?>
                <div id="menutren">
                    <a href="index.php?do=home">Trang chủ</a>
                    <div class="dropdown">
                        <button class="dropbtn">Quản lý <i class="fa fa-caret-down"></i></button>
                        <div class="dropdown-content-quanly">
                            <a href="index.php?do=nhanvien">Nhân viên</a>
                            <a href="index.php?do=khachhang">Khách hàng</a>
                            <a href="index.php?do=sanpham">Sản phẩm</a>
                            <a href="index.php?do=thuonghieu">Thương hiệu</a>
                            <a href="index.php?do=khuyenmai">Khuyến mãi</a>
                        </div>
                    </div>

                    <div class="dropdown">
                        <button class="dropbtn">Tác vụ <i class="fa fa-caret-down"></i></button>
                        <div class="dropdown-content-quanly">
                            <a href="index.php?do=tacvuthanhtoan">Xử lý thanh toán</a>
                            <a href="index.php?do=tacvudonhang">Xử lý đơn hàng</a>
                        </div>
                    </div>

                    <a href="index.php?do=aboutus">Về chúng tôi</a>
                </div>

                <div id="phangiua">
                    <div id="noidung">
                        <?php 
                            $do = isset($_GET['do']) ? $_GET['do'] : "home";
                            include $do.".php";
                        ?>
                    </div>
                </div>
    <?php
                break;

            // ================= NHÂN VIÊN =================
            case 1:
    ?>
                <div id="menutren">
                    <a href="index.php?do=home">Trang chủ</a>
                    <div class="dropdown">
                        <button class="dropbtn">Tác vụ <i class="fa fa-caret-down"></i></button>
                        <div class="dropdown-content-quanly">
                            <a href="index.php?do=tacvuthanhtoan">Xử lý thanh toán</a>
                            <a href="index.php?do=tacvudonhang">Xử lý đơn hàng</a>
                        </div>
                    </div>
                    <a href="index.php?do=aboutus">Về chúng tôi</a>
                </div>

                <div id="phangiua">
                    <div id="noidung">
                        <?php 
                            $do = isset($_GET['do']) ? $_GET['do'] : "home";
                            include $do.".php";
                        ?>
                    </div>
                </div>
    <?php
                break;
        }
    } else {
    ?>
        <div id="menutren">
            <a href="index.php?do=home">Trang chủ</a>
            <div class="dropdown">
                <?php
                    $sql = "select * from tbl_loaisanpham";
                    $danhsach = $connect->query($sql);
                ?>
                <button class="dropbtn">Danh mục <i class="fa fa-caret-down"></i></button>
                <div class="dropdown-content">
                    <?php while($row = $danhsach->fetch_array(MYSQLI_ASSOC)){
                        echo "<a href='index.php?do=sanpham_loai&MaLoai=".$row['MaLoai']."'>".$row['TenHienThi']."</a>";
                    } ?>
                </div>
            </div>

            <div class="dropdown">
                <?php
                    $sql = "select * from tbl_thuonghieu";
                    $danhsach = $connect->query($sql);
                ?>
                <button class="dropbtn">Thương hiệu <i class="fa fa-caret-down"></i></button>
                <div class="dropdown-content">
                    <?php while($row = $danhsach->fetch_array(MYSQLI_ASSOC)){
                        echo "<a href='index.php?do=sanpham_thuonghieu&MaTH=".$row['MaTH']."'>".$row['TenThuongHieu']."</a>";
                    } ?>
                </div>
            </div>

            <a href="index.php?do=aboutus">Về chúng tôi</a>
        </div>

        <div id="phangiua">
            <div id="noidung">
                <?php 
                    $do = isset($_GET['do']) ? $_GET['do'] : "home";
                    include $do.".php";
                ?>
            </div>
        </div>
    <?php
    }
    ?>

    <div id="phanduoi">
        <div class="footer-content">
            <div class="footer-section about">
                <h3>Về EShop</h3>
                <p>EShop là cửa hàng điện tử uy tín, cung cấp các sản phẩm công nghệ hiện đại với chất lượng đảm bảo và dịch vụ tận tâm.</p>
            </div>
            <div class="footer-section contact">
                <h3>Liên hệ</h3>
                <p>Email: eshopQandN@gmail.com</p>
                <p>Hotline: xxxx-xxx-xxx</p>
                <p>Địa chỉ: 18 Ung Văn Khiêm, Phường Mỹ Xuyên, Thành phố Long Xuyên, An Giang</p>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2025 EShop. Bản quyền thuộc về EShop Việt Nam.</p>
        </div>
    </div>
</body>
</html>
