<?php 
// username bh59804_bh59804
// pass jEzCkrm0gWB7
// db_name: bh59804_star
function connect() {
$link = mysqli_connect('localhost', "bh59804_bh59804", 'jEzCkrm0gWB7', 'bh59804_star');

if ( !$link ) die("Database connection error");

// set correct charset
mysqli_query($link, "SET NAMES utf8 COLLATE utf8_unicode_ci");

return $link;
}

function close_db($link) {
	mysqli_close($link);
}

?>