<?php
include("connect.php");

$name = $_POST["t3"];
$phone = $_POST["t4"];
$p = $_POST["t5"];
$cp = $_POST["t6"];
$addr = $_POST["t7"];
$image = $_FILES['photo']['name'];
$tmp_name = $_FILES['photo']['tmp_name'];
$upload_directory = "../uploads/"; 

$role = $_POST['role'];

mysql_query("use omdada");

if ($p == $cp) {
    move_uploaded_file($tmp_name, $upload_directory . $image);

$query = "INSERT INTO user (Name, mobaile_no, password, Address, photo, Role,status, Vote) VALUES ('$name', $phone, '$p', '$addr', '$image','$role', 0, 0)";$result = mysql_query($query, $con);
    
    if ($result) {
        echo '
        <script>
            alert("Registered Successfully...");
            window.location = "../";
        </script>';
    } else {
        echo '
        <script>
            alert("Error in Registration.....");
            window.location = "../";
        </script>';
    }
} else {
    echo '
    <script>
        alert("Password and Confirm Password do not match");
        window.location = "../";
    </script>';
}
?>
