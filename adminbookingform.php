<!DOCTYPE html>
<html>
<head>
<title>Old Factory Cafe - Add Booking (Admin)</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
<style>
body{
  height: 100%;
  font-family: "Inconsolata", sans-serif;
}
</style>
</head>
<body>

<?php
   readfile("linksandbackground.html");
?>
<br><br>
<h2>Add New Booking</h2>
<div class="w3-container" id="where" style="padding-bottom:32px;">
      <div class="w3-content" style="max-width:700px">
<form action="addbooking.php" method="POST">
      <p>Name booking is under <input type="text" placeholder="Name" required name="name"></p>
      <p>Number of people <input type="number" placeholder="How many people" required name="people"></p>
      <p>Date and time of booking <input type="datetime-local" placeholder="Date and time" required name="dateandtime"></p>
      <p>Messages or special requirements <input type="text" placeholder="Message / Special requirements" name="message"></p>
      <p><input class="w3-button w3-black" type="submit" name="submit" value="SEND REQUEST"></p>
</form>
</div>
</div>


<?php 
readfile("footer.html");
?>

</body>
</html>
