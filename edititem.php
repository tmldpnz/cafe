<!DOCTYPE html>
<html>
  <head>
    <title>Edit Menu Item</title>
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
    <h1>Menu Item Details</h1>

    <?php
      readfile("linksandbackground.html");
      include "cleaninput.php";
      include "dbconnect.php";
      include "getmenuid.php";
      $error=0;
//check if there is data in the request
      if(isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Update'))
      {     
//validate incoming data
// menu item id (sent via a form it is a string not a number so we try a type conversion)    
        if (isset($_POST['id']) and !empty($_POST['id']) and is_integer(intval($_POST['id'])))
        {
          $id = clean_input($_POST['id']); 
        }
        else
        {
          $error++; //increment the error flag
          $msg .= 'Invalid item ID '; //append error message
          $id = 0;  
        }   
// menu item name
        $itemname = clean_input($_POST['itemname']); 
// description
        $description = clean_input($_POST['description']);        
// category
        $category = clean_input($_POST['category']);         
// price
        $price = clean_input($_POST['price']);
//save the item data if the error flag is still clear and item id is > 0
      if ($error == 0 and $id > 0)
	    {
        $query = "UPDATE menu SET name=?,description=?,category=?,price=? WHERE menuid=?";
        $stmt = mysqli_prepare($db_connection, $query); //prepare the query
        mysqli_stmt_bind_param($stmt,'sssdi', $itemname, $description, $category, $price, $id); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
// set the value for the user message
        $message = "Menu item ".$itemname." updated.";
// Use the header function to redirect to the destination page with the parameter
        header("Location: confirmationmessage.php?message=".urlencode($message));
        exit; // exit statement after the header to stop further execution.        
      } 
	    else
	    { 
        echo "<h2>$msg</h2>";
      }      
    }
// locate the menu item to edit by using the menu ID
// also include the menu ID in the form for sending it back for saving the data
// prepare a query and send it to the server
    $query = 'SELECT * FROM menu WHERE menuid='.$id;
    $result = mysqli_query($db_connection, $query);
    $rowcount = mysqli_num_rows($result); 
    if($rowcount > 0)
    {
      $row = mysqli_fetch_assoc($result);
    ?>
    
    <h2>Menu Item Update</h2>
    <div class="w3-container" id="where" style="padding-bottom:32px;">
      <div class="w3-content" style="max-width:700px">
        <form method="POST" action="edititem.php">
          <input type="hidden" name="id" value="<?php echo $id;?>">
          <p>
            <label for="itemname">Item name: </label>
            <input type="text" id="itemname" name="itemname" minlength="5" maxlength="60" size="60" value="<?php echo $row['name']; ?>" required> 
          </p> 
          <p>
            <label for="description">Description: </label>
            <input type="text" id="description" name="description" size="100" minlength="5" maxlength="200" value="<?php echo $row['description']; ?>" required> 
          </p>  
          <p>  
            <label for="category">Category: </label>
            <input type="radio" id="category" name="category" value="eat" <?php echo $row['category']=='eat'?'Checked':''; ?>> Eat 
            <input type="radio" id="category" name="category" value="drink" <?php echo $row['category']=='drink'?'Checked':''; ?>> Drink 
          </p>
          <p>
            <label for="price">Price: $</label>
            <input type="number" step="0.01" id="price" name="price" size="10" value="<?php echo $row['price']; ?>" required> 
          </p> 
          <input type="submit" name="submit" value="Update">
        </form>
      </div>
    </div>
    <?php 
      } 
      else
      { 
        echo "<p>item not found with that ID</p>"; //simple error feedback
      }
      mysqli_close($db_connection); //close the connection once done
      readfile("footer.html");
    ?>
  </body>
</html>
