<!DOCTYPE HTML>
<html><head><title>MySQL select test</title></head>
<body>
<?php
    include  "config.php ";  // access the database constants
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $db_connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);

//check if the connection was good
    if (!$db_connection)
    {
        echo "Error: Unable to connect to MySQL ". mysqli_connect_errno()."= ".mysqli_connect_error();
//stop processing the page further
        exit;  
    };

//assume data validation has been done
//prepare the statement with placeholders (?) for the variable data
    $query = "UPDATE member SET firstname=? WHERE firstname=?";
    $stmt = mysqli_prepare($db_connection, $query); //prepare the query

//bind the 2 strings to the valuses from above
    mysqli_stmt_bind_param($stmt, 'ss', $newname, $firstname); //associate the ? with variables
//place data into the variables
    $newname = "WESTMINSTER"; 
    $firstname = "MAXIMILLIAN";
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

//close the connection once done    
    mysqli_close($db_connection); 
?>
    <p>data updated</p>
</body>
</html>
