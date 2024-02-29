<?php $con = mysqli_connect("localhost", "root", "Anushka@25", "pr_project"); ?>

<?php

ob_start();

    // Variables to store form data
    $csi_client = $csi_event = $csi_image_name = $csi_status = '';


    if(isset($_POST['submit'])){

        $csi_client                 = $_POST['pr_csi_client'];
        $csi_event                  = $_POST['pr_csi_event'];
        $csi_image_name             = $_POST['pr_csi_image_name'];
        $csi_status                 = $_POST['pr_csi_status'];


        // Insert data into the database
        $insert_client_story_images = "INSERT INTO pr_client_story_images (
                                pr_csi_client, 
                                pr_csi_event, 
                                pr_csi_image_name, 
                                pr_csi_status
                            ) VALUES (
                                '$csi_client', 
                                '$csi_event', 
                                '$csi_image_name', 
                                '$csi_status'
                            )";

        // Execute the SQL query

        if (mysqli_query($con, $insert_client_story_images)) {
          // Redirect to another page after successful insertion
          header('Location: insert_client_story_image.php');
          exit; // Make sure to exit after redirection
      } else {
          echo "Error: " . $insert_client_story_images . "<br>" . mysqli_error($con);
      }
        } 
        

   ob_end_flush(); 
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css"/>
    <title>Client Story Images</title>
    <link rel="stylesheet" href="../Styles/insert_client_story_images.css">
  </head>
  <body>
  <form id="registration_form" method="post" enctype="multipart/form-data">
    <div class="wrapper">
      <div class="form-row">
        <label for="pr_csi_client">Client</label>
        <input type="number" name="pr_csi_client" id="pr_csi_client" placeholder="Enter Client" required>
      </div>

      <div class="form-row">
        <label for="pr_csi_event">Event</label>
        <input type="number" name="pr_csi_event" id="pr_csi_event" placeholder="Enter Event" required>
      </div>

      <div class="form-row">
        <label for="pr_csi_image_name">Image Name</label>
        <input type="text" name="pr_csi_image_name" id="pr_csi_image_name" placeholder="Enter Image Name" required />

      </div>

      <div class="form-row">
        <label for="pr_csi_status">Status</label>
        <input type="number" name="pr_csi_status" id="pr_csi_status" placeholder="Enter Status">
      </div>

      <div class="buttonSubmit">
        <input type="submit" name="submit" value="Submit">
      </div>
    </div>
    <h3>Client Story Details</h3>
  <table>
    <tr>
      <th>#</th>
      <th>Client</th>
      <th>Event</th>
      <th>Image Name</th>
      <th>Status</th>
      <th>Operations</th>
    </tr>

    <?php
      $i = 1;
      $select_all_client_story_images_query = "SELECT * FROM pr_client_story_images";
      $select_all_client_story_images_query_sql = mysqli_query($con, $select_all_client_story_images_query);
      $count_select_all_client_story_images_query = mysqli_num_rows($select_all_client_story_images_query_sql);

      if($count_select_all_client_story_images_query  > 0){
        while ($row = $select_all_client_story_images_query_sql -> fetch_assoc()) {
          $id = $row['pr_csi_id'];
    ?>

        <tr>
        <td><?php echo $i++ ?></td>
        <td><?php echo $row['pr_csi_client']?></td>
        <td><?php echo $row['pr_csi_event']?></td>
        <td><?php echo $row['pr_csi_image_name']?></td>
        <td><?php echo $row['pr_csi_status']?></td>

        <td class="operations">
            <a href="update_client_story_image.php?id=<?php echo $id; ?>" class="edit-button">Edit</a>
            <a href="delete_client_story_image.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure?')" class="delete-button">Delete</a>
        </td>
        </tr>

    <?php 
        }
      }
    ?>
  </table>
  </body>
</html>

  