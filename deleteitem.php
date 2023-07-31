<!DOCTYPE html>
<html>
<head>
<title>Old Factory Cafe</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
<style>
body, html {
  height: 100%;
  font-family: "Inconsolata", sans-serif;
}

.bgimg {
  background-position: center;
  background-size: cover;
  background-image: url("https://www.w3schools.com/w3images/coffeehouse.jpg");
  min-height: 75%;
}

.menu {
  display: none;
}
</style>
</head>
<body>

<head><title>View Menu Item</title> </head>
 <body>


<?php
include "cleaninput.php";
include "dbconnect.php";
include "getmenuid.php";

// the data was sent using a form therefore use $_POST instead of $_GET
// check if the correct submit button exists in the array
var_dump($_POST);
if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Delete')) {     
    $error = 0; //clear an error flag
    $msg = 'Error: ';  
// menu item id is sent via a form so it is a string not a number so try a type conversion    
    if (isset($_POST['id']) and !empty($_POST['id']) and is_integer(intval($_POST['id']))) {
       $id = clean_input($_POST['id']); 
    } else {
       $error++; // increment the error flag
       $msg .= 'Invalid item ID '; //append error message
       $id = 0;  
    }        
    
//save the menu item data if the error flag is still clear and the id is > 0
    if ($error == 0 and $id > 0) {
        $query = "DELETE FROM menu WHERE menuid=?";
        $stmt = mysqli_prepare($db_connection, $query); //prepare the query
        mysqli_stmt_bind_param($stmt,'i', $id); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
// set the value for the user message
        $message = "Menu item deleted.";
// Use the header function to redirect to the destination page with the parameter
        header("Location: confirmationmessage.php?message=".urlencode($message));
        exit; // exit statement after the header to stop further execution.
    } else { 
      echo "<p>$msg</p>";
    }      
}

//prepare a query and send it to the server
//NOTE for simplicity purposes ONLY we are not using prepared queries
//make sure you ALWAYS use prepared queries when creating custom SQL like below
$query = 'SELECT * FROM menu WHERE menuid='.$id;
$result = mysqli_query($db_connection,$query);
$rowcount = mysqli_num_rows($result); 
?>

<h4>
<?php
//makes sure we have the Item
if($rowcount > 0)
{      
    echo "<br><br><br><fieldset><legend>Menu item detail #$id before deletion</legend><dl>"; 
    $row = mysqli_fetch_assoc($result);
    echo "<dt>Name:</dt><dd>".$row['name']."</dd>";
    echo "<dt>Description:</dt><dd>".$row['description']."</dd>";
    echo "<dt>Category:</dt><dd>".$row['category']."</dd>";
    echo "<dt>Price</dt><dd>".$row['price']."</dd>"; 
    echo "</dl></fieldset>";
   ?>
   <form method="POST" action="deleteitem.php">
     <h2>Are you sure you want to delete this menu item?</h2>
     <input type="hidden" name="id" value="<?php echo $id; ?>">
     <input type="submit" name="submit" value="Delete">
     <a href="admin.php">[Cancel]</a>
   </form>
   
<?php    
}
mysqli_free_result($result); //free any memory used by the query
mysqli_close($db_connection); //close the connection once done
readfile("footer.html");
?>

<!-- Links (sit on top) -->
<div class="w3-top">
  <div class="w3-row w3-padding w3-black">
    <div class="w3-col s3">
      <a href="admin.php" class="w3-button w3-block w3-black">ADMIN HOME</a>
    </div>
  </div>
</div>

<!-- Add a background color and large text to the whole page -->
<div class="w3-sand w3-grayscale w3-large">
</body>
</html>
