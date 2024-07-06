<?php
$con = mysql_connect("localhost", "root", "");

if (!$con) {
    die("<h3>Database Connection Failed......");
}

$name = mysql_real_escape_string($_POST["t3"]);
$phone = mysql_real_escape_string($_POST["t4"]);
$p = mysql_real_escape_string($_POST["t5"]);
$cp = mysql_real_escape_string($_POST["t6"]);
$addr = mysql_real_escape_string($_POST["t7"]);
$img = mysql_real_escape_string($_FILES['Photo']['name']);
$temp = mysql_real_escape_string($_FILES['Photo']['temp']);

if($t8=="male")
{
  $gender=$_POST["t8"];
}
elseif($t9=="female")
{
  $gender=$_POST["t9"];
}


if ($p == $cp) {
    move_uploaded_file($temp, "../upload/$img");

    mysql_select_db("om");

    $query = "INSERT INTO user (Name, phone_no, password, Address, image, Gender, Vote) VALUES ('$name', '$phone', '$p', '$addr', '$img', '$gender', 0)";

    $result = mysql_query($query, $con);

    if ($result) {
        echo '
        <script>
            alert("Registered Successfully...");
            window.location = "../";
        </script>';
    } else {
        echo '
        <script>
            alert("Error in Registration: ' . mysql_error() . '");
            window.location = "Registration.html";
        </script>';
    }
} else {
    echo '
        <script>
            alert("Password and Confirm Password do not match");
            window.location = "Registration.html";
        </script>';
}

mysql_close($con);
?>
