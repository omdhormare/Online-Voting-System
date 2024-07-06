<?php
session_start();
//include("connect.php");
$con = mysql_connect("localhost", "root", "");

if ($con==false) 
die("Database Connection Failed: ");
else
echo("<h2>Succes.....");
$mno = $_POST["t1"];
$password = $_POST["t2"];
$role = $_POST['role'];
mysql_select_db("omdada", $con);
$query = "SELECT * FROM user WHERE mobaile_no='$mno' AND password='$password' AND Role='$role'";
$result = mysql_query($query, $con);

if (mysql_num_rows($result)>0) 
{
    $userdata = mysql_fetch_array($result);
    $groups= mysql_query("SELECT * FROM user WHERE role=2");
    $groupsdata=mysql_fetch_array($groups,mysql_ASSOC);

    $_SESSION['userdata'] = $userdata;
    $_SESSION['groupsdata'] = $groupsdata;

    echo '<script>
         window.location = "../api/dash.php";
         </script>';
}
else 
{
    echo '<script>
        alert("User Not Found..."); 
         window.location = "../";
         </script>';
}
mysql_close($con);
?>
