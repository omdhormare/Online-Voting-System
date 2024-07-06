<?php
session_start();
include("connect.php");

$mno= $_POST["t1"];
$password = $_POST["t2"];

mysql_select_db("om", $con);
$check = mysql_query("SELECT * FROM user WHERE phone_no='$mno' AND password='$password'");
 $result = mysql_query($check, $con);
if ($result) {
    $rows = mysql_num_rows($result);
    if ($rows > 0) 
{
        $userdata = mysql_fetch_array($result);
        $group=mysql_query($con,"select * from user WHERE role=2");
        $groupdata=mysql_fetch_all($group,MYSQL_ASSOC);
        $_SESSION['userdata']=$userdata;
         $_SESSION['groupdata']=$groupdata;
        echo '<script>
         alert("Login Success..."); 
         window.location = "../";
       </script>';
    }
 else 
  {
        echo '<script>
            alert("User Not Found..."); 
        window.location = "../";
         </script>';

mysql_close($con);
} 
?>
