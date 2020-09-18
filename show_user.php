
<?php
include("conn.php");
include_once("admin_auth.php");
if (isset($_POST['id'])) {
  $id = $_POST['id'];

  $auth = new Authorization($con, $id);

  $json["STATUS"] = array();
  $json["MESSAGE"] = array();
  $admin = $auth->check_user();
  if ($admin) {
    $sql = "SELECT * FROM tbuser";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
    if ($result) {
      $json["STATUS"] = "SUCCESS";
      $json["MESSAGE"] = "SUCCESS";
      if ($count > 0) {
        $json["PAYLOAD"]["DATA"] = [];
        while ($row = mysqli_fetch_array($result)) {
          $array["ID"] = $row['id'];
          $array["EMAIL"] = $row['email'];
          $array["NAMA"] = $row['nama'];
          $array["NOHP"] = $row['nohp'];
          $array["ALAMAT"] = $row['alamat'];
          $array["NOKTP"] = $row['noktp'];
          if ($row["roleuser"] == 1) {
            $array["ROLE"] = "customer";
          } elseif ($row["roleuser"] == 2) {
            $array["ROLE"] = "admin";
          }
          array_push($json["PAYLOAD"]["DATA"], $array);
        }
      } else {
        $json["PAYLOAD"]["DATA"] = "null";
      }
    } else {
      $json["STATUS"] = "FAILED";
      $json["MESSAGE"] = mysqli_error($con);
    }
  } else {
    $json["STATUS"] = "FAILED";
    $json["MESSAGE"] = "NOT AUTHORIZED";
  }
} else {
  $json["STATUS"] = "FAILED";
  $json["MESSAGE"] = "INPUT NOT FOUND";
}

echo json_encode($json);
mysqli_close($con);