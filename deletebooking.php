<!DOCTYPE html>
<html>
  <head>
    <title>Delete Booking</title>
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
  if ($_SERVER["REQUEST_METHOD"] == "GET")
  {
    $id = $_GET['id'];
    if (empty($id) or !is_numeric($id))
    {
        echo "<h2>Invalid booking ID</h2>"; //simple error feedback
        exit;
    } 
  }

//  check that post data has been sent
  if(isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Delete'))
  {     
    $error = 0; //clear our error flag
    $msg = 'Error: ';  
//bookingID (sent via a form it is a string not a number so we try a type conversion)    
    if (isset($_POST['id']) and !empty($_POST['id']) and is_integer(intval($_POST['id'])))
    {
       $bookingid = clean_input($_POST['id']); 
    }
    else
    {
       $error++; //bump the error flag
       $msg .= 'Invalid booking ID '; //append error message
       $bookingid = 0;  
    }        
    
//save the Room data if the error flag is still clear and Room id is > 0
    if ($error == 0 and $bookingid > 0)
    {
        $query = "DELETE FROM booking WHERE bookingid=?";
        $stmt = mysqli_prepare($db_connection, $query); //prepare the query
        mysqli_stmt_bind_param($stmt,'i', $bookingid); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);    
// set the value for the user message
        $message = "Booking deleted.";
// Use the header function to redirect to the destination page with the parameter
        header("Location: confirmationmessage.php?message=".urlencode($message));
        exit; // exit statement after the header to stop further execution.        
      }
    else
    { 
      echo "<p>$msg</p>";
    }      
  }


//prepare a query and send it to the server
//NOTE for simplicity purposes ONLY we are not using prepared queries
//make sure you ALWAYS use prepared queries when creating custom SQL like below
$query = 'SELECT * FROM booking WHERE bookingid='.$id;
$result = mysqli_query($db_connection,$query);
$rowcount = mysqli_num_rows($result); 
?>

<?php
//makes sure we have the Item
if($rowcount > 0)
{      
    echo "<br><br><br><fieldset><legend>Booking detail #$id before deletion</legend><dl>"; 
    $row = mysqli_fetch_assoc($result);
    echo "<dt>Name:</dt><dd>".$row['name']."</dd>";
    echo "<dt>Number of people:</dt><dd>".$row['people']."</dd>";
    echo "<dt>Date and time:</dt><dd>".$row['dateandtime']."</dd>";
    echo "<dt>Comment</dt><dd>".$row['comment']."</dd>"; 
    echo "</dl></fieldset>";
   ?>

   <form method="POST" action="deletebooking.php">
     <h2>Are you sure you want to delete this booking?</h2>
     <input type="hidden" name="id" value="<?php echo $id; ?>">
     <input type="submit" name="submit" value="Delete">
     <a href="admin.php">[Cancel]</a>
   </form>

   
<?php    
}
readfile("footer.html");
mysqli_free_result($result); //free any memory used by the query
mysqli_close($db_connection); //close the connection once done
?>



<!-- End page content -->
</div>




</body>
</html>
