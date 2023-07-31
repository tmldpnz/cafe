<?php
include "cleaninput.php";
include "dbconnect.php";
//the data was sent using a form therefore use $_POST instead of $_GET
//check if we are saving data first by checking if the submit button exists in the array
if(isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Create'))
{     
//validate incoming data - only the first field is done in this example
// item name
       $itemname = clean_input($_POST['itemname']); 
// description
       $description = clean_input($_POST['description']);        
// category
       $category = clean_input($_POST['category']);         
// price
       $price = clean_input($_POST['price']);         
//save the item data 
        $query = "INSERT INTO menu SET name=?, description=?, category=?, price=?";
        $stmt = mysqli_prepare($db_connection, $query); //prepare the query
        mysqli_stmt_bind_param($stmt,'sssd', $itemname, $description, $category, $price); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
// set the value for the user message
        $message = "Menu item added.";
// Use the header function to redirect to the destination page with the parameter
        header("Location: confirmationmessage.php?message=".urlencode($message));
        exit; // exit statement after the header to stop further execution.    
        ?>     
       <?php
}         
else
{ 
       echo "error in setting up post data";
}
mysqli_close($db_connection); //close the connection once done
?>

