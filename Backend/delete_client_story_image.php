<?php
$con = mysqli_connect("localhost", "root", "Anushka@25", "pr_project");
if (!$con) {
    die('error in con' . mysqli_error($con));
}

$id = $_GET['id'];



$delete_client_story_images = "DELETE FROM pr_client_story_images WHERE pr_csi_id = $id";

if (mysqli_query($con, $delete_client_story_images)) {
    echo '<script>alert("Client Story Images Deleted Successfully");</script>';
    header('location: insert_client_story_image.php');
} else {
    echo mysqli_error($con);
}
?>
