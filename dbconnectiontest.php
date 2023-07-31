<!DOCTYPE HTML>
<html><head><title>MySQL connection test</title> </head>
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

// confirm that we have a connection by echoing the host name
    echo "Connected to ".mysqli_get_host_info($db_connection); 

//close the connection once done    
    mysqli_close($db_connection); 
?>
</body>
</html>
