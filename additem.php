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
    <?php
      readfile("linksandbackground.html");
    ?>
  
    <br><br>
    <h2>Add New Menu Item</h2>
      <div class="w3-container" id="where" style="padding-bottom:32px;">
      <div class="w3-content" style="max-width:700px">
      <form method="POST" action="additemhandler.php">
        <p>
          <label for="itemname">Item name: </label>
          <input type="text" id="itemname" name="itemname" minlength="5" maxlength="60" size="60" required> 
        </p> 
        <p>
          <label for="description">Description: </label>
          <input type="text" id="description" name="description" size="100" minlength="5" maxlength="200" required> 
        </p>  
        <p>  
          <label for="category">Category: </label>
          <input type="radio" id="category" name="category" value="eat"> Eat 
          <input type="radio" id="category" name="category" value="drink"> Drink 
        </p>
        <p>
          <label for="price">Price: $</label>
          <input type="number" step="0.01" id="price" name="price" size="10" required> 
        </p> 
        <input type="submit" name="submit" value="Create">
      </form>
    </div>
    </div>

    <?php    
      readfile("footer.html");
    ?>

</body>
</html>
