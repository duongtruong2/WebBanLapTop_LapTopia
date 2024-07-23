<?php
session_start();
if (!$_SESSION['user'] || $_SESSION['user']['role'] == 0) { /*Cam vao trang neu ma no ko dang nhap + cai role=0 */
    header("location: ../view/index.php");
}
include "../model/pdo.php";
include "../model/danhmuc.php";
include "../model/sanpham.php";
include "../model/taikhoan.php";
include "../global.php";

include "header.php";

if (isset($_GET['act']) && !empty($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
            //Phần danh mục
            //Danh sách danh mục
        case 'listdm':
            $listdm = loadall_danhmuc();
            include "danhmuc/list.php";
            break;
            //Thêm danh mục
        case 'adddm':
            if (isset($_POST['themdm'])) {
                if (empty($_POST['tendm'])) {
                    $thongbao1 = "Không được để trống!";
                } else {
                    $tendm = $_POST['tendm'];
                    add_danhmuc($tendm);
                    $thongbao1 = "Thêm thành công";
                }
            }
            include "danhmuc/add.php";
            break;
            //Sửa danh mục
        case 'editdm':
            if (isset($_GET['iddm']) && $_GET['iddm'] > 0) {
                $onedm = loadone_danhmuc($_GET['iddm']);
            }
            if (isset($_POST['editdm'])) {
                $iddm = $_POST['iddm'];
                $tendm = $_POST['tendm'];
                update_danhmuc($iddm, $tendm);
                header("location: index.php?act=listdm");
            }
            include "danhmuc/edit.php";
            break;
            //Xóa danh mục
        case 'deletedm':
            if (isset($_GET['iddm']) && $_GET['iddm'] > 0) {
                delete_danhmuc($_GET['iddm']);
                header("location: index.php?act=listdm");
            }
            break;
            //Phần tài khoản
            //Danh sách tài khoản
        case 'listtk':
            $listtk = loadall_taikhoan();
            include "taikhoan/list.php";
            break;
            //Thêm tài khoản
        case 'addtk':
            if (isset($_POST['themtk'])) {
                if (empty($_POST['user']) || empty($_POST['email']) || empty($_POST['pass'])) {
                    $thongbao5 = "Vui lòng nhập đủ 3 trường user, pass, email!";
                } else {
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];
                    $tel = $_POST['tel'];
                    $role = $_POST['role'];
                    $img = $_FILES['img']['name'];
                    $target_file = $image_path . time() . basename($_FILES['img']['name']);
                    move_uploaded_file($_FILES['img']['tmp_name'], $target_file);
                    add_taikhoan_admin($user, $pass, $img, $email, $address, $tel, $role);
                    $thongbao5 = "Thêm thành công";
                }
            }
            include "taikhoan/add.php";
            break;
            //Sửa tài khoản
        case 'edittk':
            if (isset($_GET['idtk']) && $_GET['idtk'] > 0) {
                $onetk = loadone_taikhoan($_GET['idtk']);
            }
            if (isset($_POST['edittk'])) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $tel = $_POST['tel'];
                $role = $_POST['role'];
                $id = $_POST['id'];
                $img = $_FILES['img']['name'];
                $target_file = $image_path . time() . basename($_FILES['img']['name']);
                move_uploaded_file($_FILES['img']['tmp_name'], $target_file);
                update_taikhoan($id, $user, $pass, $img, $email, $address, $tel, $role);
                header("location: index.php?act=listtk");
            }
            include "taikhoan/edit.php";
            break;
            //Xóa tài khoản
        case 'deletetk':
            if (isset($_GET['idtk']) && $_GET['idtk'] > 0) {
                delete_taikhoan($_GET['idtk']);
                header("location: index.php?act=listtk");
            }
            break;
            //Phần sản phẩm
            //Danh sách sản phẩm
        case 'listsp':
            if (isset($_POST['clickOK'])) {
                $keyw = $_POST['keyw'];
                $iddm = $_POST['iddm'];
            } else {
                $keyw = "";
                $iddm = 0;
            }
            $listdm = loadall_danhmuc();
            $listsp = loadall_sanpham($keyw, $iddm);
            include "sanpham/list.php";
            break;
            //Thêm sản phẩm
        case 'addsp':
            $listdm = loadall_danhmuc();
            if (isset($_POST['themsp'])) {
                $iddm = $_POST['iddm'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $mota = $_POST['mota'];
                $cpu = $_POST['cpu'];
                $ram = $_POST['ram'];
                $carddohoa = $_POST['carddohoa'];
                $ocung = $_POST['ocung'];
                $manhinh = $_POST['manhinh'];
                $giamgia = $_POST['giamgia'];
                $img = $_FILES['img']['name'];
                if (empty($name) || empty($price) || empty($img) || empty($mota) || empty($giamgia) || empty($cpu) || empty($ram) || empty($carddohoa) || empty($manhinh) || empty($ocung)) {
                    $thongbao6 = "Vui lòng nhập đủ!";
                } else {
                    $target_file = $image_path . time() . basename($_FILES['img']['name']);
                    move_uploaded_file($_FILES['img']['tmp_name'], $target_file);
                    add_sanpham($name, $mota, $price, $cpu, $ram, $ocung, $carddohoa, $manhinh, $img, $giamgia, $iddm);
                    $thongbao6 = "Thêm thành công";
                }
            }
            include "sanpham/add.php";
            break;
            //Sửa sản phẩm
        case 'editsp':
            $listdm = loadall_danhmuc();
            if (isset($_GET['idsp']) && $_GET['idsp'] > 0) {
                $sanpham = loadone_sanpham($_GET['idsp']);
            }
            if (isset($_POST['editsp'])) {
                $id = $_POST['id'];
                $iddm = $_POST['iddm'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $mota = $_POST['mota'];
                $cpu = $_POST['cpu'];
                $ram = $_POST['ram'];
                $carddohoa = $_POST['carddohoa'];
                $ocung = $_POST['ocung'];
                $manhinh = $_POST['manhinh'];
                $giamgia = $_POST['giamgia'];
                $img = $_FILES['img_new']['name'];
                $target_file = $image_path . time() . basename($_FILES['img_new']['name']);
                move_uploaded_file($_FILES['img_new']['tmp_name'], $target_file);
                update_sanpham($id, $name, $mota, $price, $cpu, $ram, $ocung, $carddohoa, $manhinh, $img, $giamgia, $iddm);
                header("location: index.php?act=listsp");
            }
            include "sanpham/edit.php";
            break;
            //Xóa sản phẩm
        case 'deletesp':
            if (isset($_GET['idsp']) && $_GET['idsp'] > 0) {
                delete_sanpham($_GET['idsp']);
                header("location: index?act=listsp");
            }
            break;
                
        default:
            include "home.php";
            break;
    }
} else {
    include "home.php";
}
