<?php
// header('Content-Type: application/json');

include("conn.php");
if (isset($_POST['kode']) && isset($_POST['merk']) && isset($_POST['jenis']) && isset($_POST['warna']) && isset($_POST['hargasewa'])) {
    $kode = $_POST['kode'];
    $merk = $_POST['merk'];
    $jenis = $_POST['jenis'];
    $warna = $_POST['warna'];
    $hargasewa = $_POST['hargasewa'];

    // $name = $_FILES['image']['name'];
    // $path = $_FILES['image']['tmp_name'];
    // $size = $_FILES['image']['size'];
    // $format = $_FILES['image']['type'];
    // $error = $_FILES['image']['error'];
    $json["STATUS"] = array();
    $json["MESSAGE"] = array();

    // if ($error == 0) {
    //     if ($size <= 5000000) {
    //         if (($format == 'image/png') || ($format == 'image/jpeg')) {
    //             $fileName = time() . strstr($name, '.');
    //             move_uploaded_file($path, 'upload/' . $fileName);

                $sql = "INSERT INTO tbsepeda(kode, merk, jenis, warna, hargasewa) VALUES ('$kode', '$merk', '$jenis', '$warna', '$hargasewa')";
                if ($con->query($sql)) {
                    $json["STATUS"] = "SUCCESS";
                    $json["MESSAGE"] = "SUCCESS";
                } else {
                    $json["STATUS"] = "FAILED";
                    $json["MESSAGE"] = mysqli_error($con);
                }
    //         } else {
    //             $json["STATUS"] = "FAILED";
    //             $json["MESSAGE"] = "Image Format is not supported";
    //         }
    //     } else {
    //         $json["STATUS"] = "FAILED";
    //         $json["MESSAGE"] = "Image Size should be less than 5MB";
    //     }
    // }
} else {
    $json["STATUS"] = "FAILED";
    $json["MESSAGE"] = "INPUT NOT FOUND";
}


echo json_encode($json);
mysqli_close($con);
