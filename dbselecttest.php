<!DOCTYPE HTML>
<html><head><title>MySQL select test</title></head>
<body>
<?php
    include  "config.php ";  // access the database constants
    $db_connection = mysqli_connect(HOST, DBUSER, DBPASSWORD, DBDATABASE);

//check if the connection was good
    if (!$db_connection)
    {
        echo "Error: Unable to connect to MySQL ". mysqli_connect_errno()."= ".mysqli_connect_error();
//stop processing the page further
        exit;  
    };

// prepare a query and send it to the server
    $query = "SELECT category, name, description, price FROM menu";
    $result = mysqli_query($db_connection, $query);

// check the result set for data
    if(mysqli_num_rows($result) > 0)
    {

// show the number of rows (just as an example)
        echo  "<p>Record count:  ".mysqli_num_rows($result)."</p>";

//iterate over the results and write them to the HTML page
        while ($row = mysqli_fetch_assoc($result))
        {
            echo  "<p>Category ".$row['category']. "</p>";
            echo  "<p>Name ".$row['name'] . "</p>";
            echo  "<p>Description ".$row['description'] . "</p>";
            echo  "<p>Price ".$row['price'] . "</p>";
            echo  "<hr>";
       }

// free any memory used by the query
       mysqli_free_result($result); 
    }

//close the connection once done    
    mysqli_close($db_connection); 
?>
</body>
</html>
