<!DOCTYPE html>
<html>
<head>
<title>Old Factory Cafe - Add Booking</title>
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
    <h3>Add New Booking</h3>

    <?php
         readfile("linksandbackground.html");
         include "cleaninput.php";
         include "dbconnect.php";

// check that post data has been sent from the correct form
if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'SEND REQUEST'))
{     
//validate incoming data
// name
  $name = clean_input($_POST['name']); 
// nuber of people
  $people = clean_input($_POST['people']);        
// date and time
  $dateandtime = clean_input($_POST['dateandtime']);         
// message
  $message = clean_input($_POST['message']);      
    
//save the booking data
  $query = "INSERT INTO booking SET name=?, people=?, dateandtime=?, comment=?";
  $stmt = mysqli_prepare($db_connection, $query); //prepare the query
  mysqli_stmt_bind_param($stmt,'ssss', $name, $people, $dateandtime, $message); 
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);    
  // set the value for the user message
  $message = "Booking for ".$name." added.";
  // Use the header function to redirect to the destination page with the parameter
          header("Location: confirmationmessage.php?message=".urlencode($message));
          exit; // exit statement after the header to stop further execution.              
}
mysqli_close($db_connection); //close the connection once done
readfile("footer.html");
?>

</body>
</html>
