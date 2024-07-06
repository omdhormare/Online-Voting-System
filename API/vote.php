<?php
session_start();
include("connect.php");

$votes = isset($_POST['gvotes']) ? (int)$_POST['gvotes'] : 0;
$gid = isset($_POST['gid']) ? (int)$_POST['gid'] : 0;

if ($votes <= 0 || $gid <= 0) {
    die("Invalid input");
}

$uid = $_SESSION['userdata']['id'];

// Update user vote count
$updatedVote = $votes + 1;
$updateVotesQuery = "UPDATE user SET vote = $updatedVote WHERE id = $gid";

if (mysqli_query($connection, $updateVotesQuery)) {
    // Update the user status
    $updateUserStatusQuery = "UPDATE user SET status = 1 WHERE id = $uid";
    if (mysqli_query($connection, $updateUserStatusQuery)) {
        $groupsQuery = "SELECT * FROM user WHERE role = 2";
        $groupsResult = mysqli_query($connection, $groupsQuery);
        
        if ($groupsResult) {
            $groupsData = mysqli_fetch_array($groupsResult, MYSQLI_ASSOC);
            
            $_SESSION['userdata']['status'] = 1;
            $_SESSION['groupsdata'] = $groupsData;
            
            echo '<script>
                alert("Voting Successfully...");
                window.location = "../API/dash.php";
                </script>';
        } else {
            echo '<script>
                alert("Failed to update user status...");
                window.location = "../API/dash.php";
                </script>';
        }
    } else {
        echo '<script>
            alert("Failed to update user status...");
            window.location = "../API/dash.php";
            </script>';
    }
} else {
    echo '<script>
        alert("Failed to update votes...");
        window.location = "../API/dash.php";
        </script>';
}

mysqli_close($connection);  // Close the database connection when done
?>
