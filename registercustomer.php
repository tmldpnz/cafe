<!DOCTYPE html>
<html>
  <head>
    <title>Register new customer</title>
  </head> 
  <body> 
  <h1>New Customer Registration</h1> 
  <form method="POST" action="registercustomer.php"> 
    <p>
    <label for="firstname">Name: </label> 
    <input type="text" id="firstname" name="firstname" minlength="5" maxlength="50" required>
   </p>
   <p>
    <label for="lastname">Last Name: </label> 
    <input type="text" id="lastname" name="lastname" minlength="5" maxlength="50" required>
   </p>
   <p>
    <label for="email">Email: </label> 
    <input type="email" id="email" name="email" minlength="5" maxlength="50" required>
   </p>
   <p>
    <label for="password">Password: </label>
    <input type="password" id="password" name="password" minlength="8" maxlength="32" required>
    </p>
    <input type="submit" name="submit" value="Register"> 
   </form> 
  <?php
  //check if there is posted data
  if($_SERVER["REQUEST_METHOD"] == "POST") 
  { 
// extract the data from the form into variables
    $firstname = $_POST["firstname"];   
    $lastname = $_POST["lastname"];        
    $email = $_POST['email'];        
    $password = $_POST['password'];        
// write the data back to the page as HTML content
    echo "The data entered into the form was:\n";
    echo "<h2>First name: $firstname</h2>";
    echo "<h2>Last name: $lastname</h2>";
    echo "<h2>Email: $email</h2>";
    echo "<h2>Password: $password</h2>";
   }
?>
   </body> 
</html>