<?php
include("conn.php");
if (isset($_POST['email']) && isset($_POST['password'])) {
  $u_username = $_POST['email'];
  $u_password = $_POST['password'];

  $sql = "SELECT * FROM tbuser WHERE email = '$u_username'";
  $json["STATUS"] = array();
  $json["MESSAGE"] = array();
  $result = mysqli_query($con, $sql);
  if ($result) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
      if ($u_password == $row["password"]  /*password_verify($u_password, $row["password"])*/) {
        $json["MESSAGE"] = "SUCCESS";
        $json["STATUS"] = "SUCCESS";
        $json["PAYLOAD"]["LOGIN_ID"] = $row["id"];
        $json["PAYLOAD"]["LOGIN_NAME"] = $row["nama"];
        $json["PAYLOAD"]["EMAIL"] = $row["email"];
        $json["PAYLOAD"]["NOMOR_HP"] = $row["nohp"];
        $json["PAYLOAD"]["NOMOR_KTP"] = $row["noktp"];
        $json["PAYLOAD"]["ALAMAT"] = $row["alamat"];
        if ($row["roleuser"] == 1) {
          $json["PAYLOAD"]["ROLE"] = "Customer";
        } elseif ($row["roleuser"] == 2) {
          $json["PAYLOAD"]["ROLE"] = "Admin";
        }
      } else {
        $json["MESSAGE"] = "WRONG PASSWORD";
        $json["STATUS"] = "FAILED";
      }
    } else {
      $json["MESSAGE"] = "USERNAME NOT REGISTERED";
      $json["STATUS"] = "FAILED";
    }
  }

} else {
  $json["STATUS"] = "FAILED";
  $json["MESSAGE"] = "INPUT NOT FOUND";
}

echo json_encode($json);
mysqli_close($con);