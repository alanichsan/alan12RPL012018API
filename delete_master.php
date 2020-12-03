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
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $json["STATUS"] = array();
            $json["MESSAGE"] = array();

            // Enkripsi Password
            // $u_password = password_hash($u_password, PASSWORD_DEFAULT);
            $sql = "DELETE FROM tbsepeda WHERE id='$id'";
            $result = mysqli_query($con, $sql);
            if ($result) {
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
//     } else {
//         $json["STATUS"] = "FAILED";
//         $json["MESSAGE"] = "NOT AUTHORIZED";
//     }
// } else {
//     $json["STATUS"] = "FAILED";
//     $json["MESSAGE"] = "INPUT NOT FOUND";
// }

echo json_encode($json);
mysqli_close($con);