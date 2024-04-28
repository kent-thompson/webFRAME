<?php
$data = $GLOBALS['error_data'];
header('HTTP/1.0 404 Not Found');
echo 'Kent Thompson Consulting Server Error <br> <h1>Error 404 - ' . $data .'</h1> Please Press Go Back Button <br>';
?>
