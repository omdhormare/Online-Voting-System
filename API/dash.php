<?php
error_reporting(0);
session_start();

if (!isset($_SESSION['userdata'])) {
    header("Location: ../");
    exit();
}

$userdata = $_SESSION['userdata'];
$groupdata = $_SESSION['groupsdata'];

if($_SESSION['userdata']['status']==0){
$status='<b style="color:red">Not Voted </b>';
}
else{
    $status='<b style="color:orangered">Voted </b>';
}

?>

<html>
<head>
    <title>Online voting system</title>
    <link rel="stylesheet" type="text/css" href="styles1.css">
</head>
<body >
<div id="headersection">
     <a href="../"><button id="Back">Back</button></a>
     <a href="../logout.php"><button id="Logout">Logout</button></a>
    <h1>Online voting system</h1>
</div>
<hr>
    <div id="profile">
    <left><img src="../uploades/<?php echo $userdata['photo'] ?>" height="100" width="100"></left><br><br>
        <b>Name:</b> <?php echo $userdata['Name'] ?><br><br>
        <b>Mobile:</b> <?php echo $userdata['mobaile_no'] ?><br><br>
        <b>Address:</b> <?php echo $userdata['Address'] ?><br><br>
        <b>Status:</b> <?php echo $status ?><br><br>
    </div>

    <div id="Group">
    <?php

    if($_SESSION['groupsdata']){
    for($i=0;$i<count($groupsdata);$i++) {
    ?>
    <div>
    <img src="../uploades/<?php echo $groupsdata[$i]['photo'] ?>" height="100" width="100"><br><br>
    <b>Group Name:</b> <?php echo $groupsdata[$i]['Name'] ?><br><br>
    <b>Votes:</b> <?php echo $groupsdata[$i]['Vote'] ?><br><br></b>
    <form action="../API/vote.php" method="POST"></b><br>
    <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['Vote'] ?>">
    <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id'] ?>">
    <input type="submit" name="votebtn" value="Vote" id="votebtn">
    </form>
    </div>
    <?php
    }
}
?>
</div>
</body>
</html>