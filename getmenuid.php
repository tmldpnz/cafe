<?php
// retrieve the menu item id from the URL
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    if (empty($id) or !is_numeric($id)) {
        echo "<h2>Invalid menu item ID</h2>"; //simple error feedback
        exit;
    } 
}
?>