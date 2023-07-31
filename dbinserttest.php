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

//assume data validation has been done
//prepare the and make provision for the variable data - ? place holders
    $query = "INSERT INTO member (firstname,lastname,email) VALUES (?,?,?) ";
    $stmt = mysqli_prepare($db_connection, $query); //prepare the query
//bind the 3 strings to the valuses from above
    mysqli_stmt_bind_param($stmt, 'sss', $firstname, $lastname, $email); //associate the ? with variables
//place data into the variables
    $firstname = "MAXIMILLIAN"; //make it obvious to find for now
    $lastname = "ROTHCHILDS";
    $email = "MROTHCHILDS@mail.com";
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
	
//close the connection once done    
    mysqli_close($db_connection); 
?>
    <p>data inserted</p>
</body>
</html>
