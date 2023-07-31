<!DOCTYPE html>
<html>
  <head>
    <title>Edit Booking</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
    <style>
      body
      {
        height: 100%;
        font-family: "Inconsolata", sans-serif;
      }
    </style>
  </head>
  <body>    
    <?php
      readfile("linksandbackground.html");
      include "cleaninput.php";
      include "dbconnect.php";
//retrieve the booking id from the URL
      if($_SERVER["REQUEST_METHOD"] == "GET")
      {
        $id = $_GET['id'];
        if (empty($id) or !is_numeric($id))
        {
          echo "<h2>Invalid booking ID</h2>"; //simple error feedback
          exit;
        } 
      }
      $error=0;
// check there is data in the request
      if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Update'))
      {     
//validate incoming data
// menuid (sent via a form it is a string not a number so we try a type conversion!)    
        if (isset($_POST['id']) and !empty($_POST['id']) and is_integer(intval($_POST['id'])))
        {
          $id = clean_input($_POST['id']); 
        }
        else
        {
          $error++; // increment the error flag
          $msg .= 'Invalid booking ID '; //append error message
          $id = 0;  
        }   
// name
        $name = clean_input($_POST['name']); 
// number of people
        $people = clean_input($_POST['people']);        
//  date and time
        $dateandtime = clean_input($_POST['dateandtime']);         
// comment
        $comment = clean_input($_POST['comment']);         
//save the item data if the error flag is still clear and item id is > 0
        if ($error == 0 and $id > 0)
	      {
          $query = "UPDATE booking SET name=?, people=?, dateandtime=?, comment=? WHERE bookingid=?";
          $stmt = mysqli_prepare($db_connection, $query); //prepare the query
          mysqli_stmt_bind_param($stmt,'ssssi', $name, $people, $dateandtime, $comment, $id); 
          mysqli_stmt_execute($stmt);
          mysqli_stmt_close($stmt);    
// set the value for the user message
          $message = "Booking updated for ".$name;
// Use the header function to redirect to the destination page with the parameter
          header("Location: confirmationmessage.php?message=".urlencode($message));
          exit; // exit statement after the header to stop further execution.        
        } 
	      else
	      { 
          echo "<h2>$msg</h2>";
        }      
      }
//locate the booking item to edit by using the menuID
//we also include the ID in our form for sending it back for saving the data
//prepare a query and send it to the server
      $query = 'SELECT * FROM booking WHERE bookingid='.$id;
      $result = mysqli_query($db_connection, $query);
      $rowcount = mysqli_num_rows($result); 
      if ($rowcount > 0)
      {
        $row = mysqli_fetch_assoc($result);
    ?>
    <br><br>
    <h2>Booking Update</h2>
<!-- Contact/Area Container -->
    <div class="w3-container" id="where" style="padding-bottom:32px;">
      <div class="w3-content" style="max-width:700px">
        <form method="POST" action="editbooking.php">
          <input type="hidden" name="id" value="<?php echo $id;?>">
          <p>
            <label for="name">Name: </label>
            <input type="text" id="name" name="name" minlength="1" maxlength="60" size="60" value="<?php echo $row['name']; ?>" required> 
          </p> 
          <p>
            <label for="people">How many people?: </label>
            <input type="text" id="people" name="people" size="20" minlength="1" maxlength="20" value="<?php echo $row['people']; ?>" required> 
          </p>  
          <p>
            <label for="datetime-local">Date and time?: </label>
            <input type="datetime-local" id="dateandtime" name="dateandtime" size="20" minlength="1" maxlength="20" value="<?php echo $row['dateandtime']; ?>" required> 
          </p>  
          <p>
            <label for="comment">Comments or additional information</label>
            <input type="text" id="comment" name="comment" size="50" value="<?php echo $row['comment']; ?>" required> 
          </p> 
          <input type="submit" name="submit" value="Update">
        </form>
      </div>
    </div>
  <?php 
    } 
    else
    { 
      echo "<p>booking not found with that ID</p>"; //simple error feedback
    }
    mysqli_close($db_connection); //close the connection once done
    readfile("footer.html");
  ?>
  </body>
</html>
