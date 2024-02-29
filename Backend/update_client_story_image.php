<?php
$con = mysqli_connect("localhost", "root", "Anushka@25", "pr_project");

if (!$con) {
    die('error in db' . mysqli_error($con));
}

// Variables to store form data
$csi_client = $csi_event = $csi_image_name = $csi_status = '';

// Fetch data for editing when the page loads
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $check_query = "SELECT * FROM pr_client_story_images WHERE pr_csi_id = $id";

    $check_query_sql    = mysqli_query($con, $check_query);
    $count_check_query  = mysqli_num_rows($check_query_sql);

    if ($count_check_query > 0) {
        $row                    = $check_query_sql->fetch_assoc();
        $csi_id                 = $row['pr_csi_id'];
        $csi_client             = $row['pr_csi_client'];
        $csi_event              = $row['pr_csi_event'];
        $csi_image_name         = $row['pr_csi_image_name'];
        $csi_status             = $row['pr_csi_status'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve form fields
    $csi_client             = isset($_POST['csi_client']) ? $_POST['csi_client'] : '';
    $csi_event              = isset($_POST['csi_event']) ? $_POST['csi_event'] : '';
    $csi_image_name         = isset($_POST['csi_image_name']) ? $_POST['csi_image_name'] : '';
    $csi_status             = isset($_POST['csi_status']) ? $_POST['csi_status'] : '';

    // Update data in the database
    $update_client_story_images_query = "UPDATE pr_client_story_images SET 
                                pr_csi_client           = '$csi_client', 
                                pr_csi_event            = '$csi_event', 
                                pr_csi_image_name       = '$csi_image_name', 
                                pr_csi_status           = '$csi_status'
                                
                            WHERE pr_csi_id = '$csi_id'";

    
    if (mysqli_query($con, $update_client_story_images_query)) {
        echo'<script>alert("Client Story Images Updated Successfully");</script>';
        header('location: insert_client_story_image.php');
    } else {
        echo "Error: " . $update_client_story_images_query . "<br>" . mysqli_error($con);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Client Story Images</title>
    <link rel="stylesheet" href="../Styles/insert_client_story_images.css">
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <div class="wrapper">
            <input type="hidden" name="cs_id" value="<?php echo $cd_id; ?>">
            
            <div class="form-row">
                <label for="pr_csi_client">Client</label>
                <input type="number" name="csi_client" id="pr_csi_client" value="<?php echo $csi_client ?>" >
            </div>

            <div class="form-row">
                <label for="pr_csi_event">Event</label>
                <input type="number" name="csi_event" id="pr_csi_event" value="<?php echo $csi_event ?>" >
            </div>

            <div class="form-row">
                <label for="pr_csi_image_name">Image Name</label>
                <input type="text" name="csi_image_name" id="pr_csi_image_name" value= "<?php echo $csi_image_name ?>" />
            </div>

            <div class="form-row">
                <label for="pr_csi_status">Status</label>
                <input type="number" name="csi_status" id="pr_csi_status" value="<?php echo $csi_status ?>" >
            </div>

            <div class="buttonSubmit">
                <input type="submit" name="update" value="Update">
            </div>
        </div>
    </form>
</body>
</html>
