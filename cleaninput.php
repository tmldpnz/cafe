<?php
// function to clean input but not validate type and content
function clean_input($data)
{  
  return htmlspecialchars(stripslashes(trim($data)));
}
?>