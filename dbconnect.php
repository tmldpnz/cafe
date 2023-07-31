<?php
include "config.php"; // load in the databse related variables
$db_connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBDATABASE);
//check if the connection was good
if (mysqli_connect_errno())
{
    echo "Error: Unable to connect to MySQL. ".mysqli_connect_error() ;
    exit; //stop processing the page further
}
?>