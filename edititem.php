<!DOCTYPE html>
<html>
<head>
<title>Edit Menu Item</title>
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

<?php
include "config.php"; //load in any variables
include "cleaninput.php";

$db_connection = mysqli_connect(HOST, DBUSER, DBPASSWORD, DBDATABASE);

//insert DB code from here onwards
//check if the connection was good
if (mysqli_connect_errno()) {
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}

//retrieve the menu id from the URL
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    if (empty($id) or !is_numeric($id)) {
        echo "<h2>Invalid menu ID</h2>"; //simple error feedback
        exit;
    } 
}

?>
<h1>Menu Item Details</h1>

<?php
$error=0;
//the data was sent using a form therefore we use the $_POST instead of $_GET
//check if we are saving data first by checking if the submit button exists in the array
if (isset($_POST['submit']) and !empty($_POST['submit']) and ($_POST['submit'] == 'Update')) {     
//validate incoming data - only the first field is done for you in this example - rest is up to you do
    echo "in post";
// menuid (sent via a form it is a string not a number so we try a type conversion!)    
    if (isset($_POST['id']) and !empty($_POST['id']) and is_integer(intval($_POST['id']))) {
       $id = clean_input($_POST['id']); 
    } else {
       $error++; //bump the error flag
       $msg .= 'Invalid item ID '; //append error message
       $id = 0;  
    }   
//roomname
       $itemname = clean_input($_POST['itemname']); 
//description
       $description = clean_input($_POST['description']);        
//roomtype
       $category = clean_input($_POST['category']);         
//beds
       $price = clean_input($_POST['price']);         
    
//save the item data if the error flag is still clear and item id is > 0




  if ($error == 0 and $id > 0)
	{
        $query = "UPDATE menu SET name=?,description=?,category=?,price=? WHERE menuid=?";
        $stmt = mysqli_prepare($db_connection, $query); //prepare the query
        mysqli_stmt_bind_param($stmt,'sssdi', $itemname, $description, $category, $price, $id); 
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);    
        echo "<h2>Item details updated.</h2>";          
    } 
	else
	{ 
      echo "<h2>$msg</h2>".PHP_EOL;
    }      
}
//locate the menu item to edit by using the menuID
//we also include the menu ID in our form for sending it back for saving the data
  //prepare a query and send it to the server

$query = 'SELECT * FROM menu WHERE menuid='.$id;
$result = mysqli_query($db_connection, $query);
$rowcount = mysqli_num_rows($result); 

if ($rowcount > 0) {
  $row = mysqli_fetch_assoc($result);

?>
<h2>Menu Item Update</h2>
<h5>
<form method="POST" action="edititem.php">
  <input type="hidden" name="id" value="<?php echo $id;?>">
   <p>
    <label for="itemname">Item name: </label>
    <input type="text" id="itemname" name="itemname" minlength="5" maxlength="60" size="60" value="<?php echo $row['name']; ?>" required> 
  </p> 
  <p>
    <label for="description">Description: </label>
    <input type="text" id="description" name="description" size="150" minlength="5" maxlength="200" value="<?php echo $row['description']; ?>" required> 
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
 </h5>
<?php 
} 
else
{ 
  echo "<p>item not found with that ID</p>"; //simple error feedback
}
mysqli_close($db_connection); //close the connection once done
?>



<!-- Links (sit on top) -->
<div class="w3-top">
  <div class="w3-row w3-padding w3-black">
    <div class="w3-col s3">
      <a href="admin.php" class="w3-button w3-block w3-black">ADMIN HOME</a>
    </div>
  </div>
</div>

</h4>
<!-- Add a background color and large text to the whole page -->
<div class="w3-sand w3-grayscale w3-large">

<!-- About Container -->
<div class="w3-container" id="about">
  <div class="w3-content" style="max-width:700px">
    <img src="https://www.w3schools.com/w3images/coffeeshop.jpg" style="width:100%;max-width:1000px" class="w3-margin-top">
  </div>
</div>

<!-- End page content -->
</div>

<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-48 w3-large">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
</footer>


</body>
</html>
