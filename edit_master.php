<?php
include("conn.php");
// include_once("admin_auth.php");

// $json["STATUS"] = array();
// $json["MESSAGE"] = array();

// if (isset($_POST['id_auth'])) {
//     $id_auth = $_POST['id_auth'];

//     $auth = new Authorization($con, $id_auth);
//     $admin = $auth->check_user();
//     if ($admin) {
        if (isset($_POST['id']) && isset($_POST['merk']) && isset($_POST['jenis']) && isset($_POST['hargasewa']) && isset($_POST['warna']) && isset($_POST['kode'])) {
            $id = $_POST['id'];
            $merk = $_POST['merk'];
            $hargasewa = $_POST['hargasewa'];
            $jenis = $_POST['jenis'];
            $warna = $_POST['warna'];
            $warna = $_POST['kode'];
            $json["STATUS"] = array();
            $json["MESSAGE"] = array();

            // Enkripsi Password
            // $u_password = password_hash($u_password, PASSWORD_DEFAULT);
            $sql = "UPDATE tbsepeda SET merk = '$merk', jenis = '$jenis', hargasewa = '$hargasewa', warna = '$warna'  , kode = '$kode' WHERE id = '$id'";
            // $result = mysqli_query($con, $sql);
            if ($con->query($sql)) {
                $json["STATUS"] = "SUCCESS";
                $json["MESSAGE"] = "SUCCESS";
            } else {
                $json["STATUS"] = "FAILED";
                $json["MESSAGE"] = mysqli_error($con);
            }
        } else {
            $json["STATUS"] = "FAILED";
            $json["MESSAGE"] = "INPUT NOT FOUND";
        }
    // } else {
    //     $json["STATUS"] = "FAILED";
    //     $json["MESSAGE"] = "NOT AUTHORIZED";
    // }
// }
//  else {
//     $json["STATUS"] = "FAILED";
//     $json["MESSAGE"] = "INPUT NOT FOUND";
// }

echo json_encode($json);
mysqli_close($con);

