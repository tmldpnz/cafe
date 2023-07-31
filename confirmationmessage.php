<!DOCTYPE html>
<html>
  <head>
    <title>Old Factory Cafe - Add Menu item</title>
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
    <h1>Action Completed</h1>

    <?php
        readfile("linksandbackground.html");

if (isset($_GET['message']))
{
    // Retrieve the parameter value
    $message = $_GET['message'];
    echo "<br><br><br><h2>".$message."</h2>
    <button><a href='admin.php'>Click to return to the admin page</button></a>";   
} 
else 
{
    echo "Message parameter not found.";
}
readfile("footer.html");
?>


<!-- End page content -->
  </body>
</html>






