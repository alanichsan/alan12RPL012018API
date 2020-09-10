<?php
include("conn.php");
if (isset($_POST['nama']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['noktp']) && isset($_POST['nohp']) && isset($_POST['alamat'])&& isset($_POST['roleuser'])) {
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $nohp = $_POST['nohp'];
  $noktp = $_POST['noktp'];
  $alamat = $_POST['alamat'];
  $role = $_POST['roleuser'];
  $json["STATUS"] = array();
  $json["MESSAGE"] = array();

  // Enkripsi Password
  // $u_password = password_hash($u_password, PASSWORD_DEFAULT);
  $query = "SELECT * FROM tbuser WHERE email = '$email'";
  $check = mysqli_num_rows(mysqli_query($con, $query));
  if ($check == 0) {
    $sql = "INSERT INTO tbuser(nama, email, password, noktp, nohp, alamat, roleuser) VALUES ('$nama', '$email', '$password', '$noktp', '$nohp', '$alamat', $role)";
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
    $json["MESSAGE"] = "Duplicated Username";
  }
} else {
  $json["STATUS"] = "FAILED";
  $json["MESSAGE"] = "INPUT NOT FOUND";
}

echo json_encode($json);
mysqli_close($con);