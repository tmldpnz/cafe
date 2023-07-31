<!DOCTYPE html>
<html>
  <head>
    <title>View Menu Items</title>
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
    <br><br>
    <h1>Menu Item Details</h1>
    <?php
      readfile("linksandbackground.html");
      include "dbconnect.php";
      include "getmenuid.php"; 
//prepare a query and send it to the server
      $query = 'SELECT * FROM menu WHERE menuid='.$id;
      $result = mysqli_query($db_connection, $query);
      $rowcount = mysqli_num_rows($result); 
//makes sure we have the menu item
      if($rowcount > 0)
      {  
        echo "<h4><fieldset><legend>Menu item $id</legend><dl>"; 
        $row = mysqli_fetch_assoc($result);
        echo "<dt>Name:</dt><dd>".$row['name']."</dd>";
        echo "<dt>Description:</dt><dd>".$row['description']."</dd>";
        echo "<dt>Category:</dt><dd>".$row['category']."</dd>";
        echo "<dt>Price:</dt><dd>$".$row['price']."</dd>"; 
        echo "</dl></fieldset>";
        echo "</h4>";  
      }
      else
      {
	      echo "<p>No Item found!</p>"; //suitable feedback
      }
      mysqli_free_result($result); //free any memory used by the query
      mysqli_close($db_connection); //close the connection once done
      readfile("footer.html");
    ?>
  </body>
</html>
