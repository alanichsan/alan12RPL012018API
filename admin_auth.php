<?php
class Authorization
{
    private $id;
    private $conn;

    function __construct($conn, $ids)
    {
        $this->id = $ids;
        $this->conn = $conn;
    }

    function check_user()
    {
        $sql = "SELECT roleuser FROM tbuser WHERE id = '$this->id'";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if($row['roleuser'] > 1) {
                return true;
            } else {
                return false;
            }
        }
        else {
            return false;
        }
    }
}
