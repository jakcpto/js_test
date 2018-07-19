<?php
// debug
// VAR_DUMP($_POST);
include('db.php');
$link = connect();

$country_search = "";

if ( isset($_POST['country']) ) $country_search = mysqli_escape_string($link, $_POST['country']);
	else $country_search = "0";

if ( isset($_POST['page']) ) 
	     $page = $_POST['page'];
	else $page = 0;

if ( $country_search != "" ) {
// output cities of selected country

// calcs for pagination
$total_query = "SELECT count(`test_cities`.`name`) FROM `test_cities` RIGHT JOIN `test_countries` ON `test_countries`.`id` = `test_cities`.`country_id` WHERE `test_countries`.`name` like '%".$country_search."%'";
$q_cities = mysqli_query($link, $total_query);
$r_cities = mysqli_fetch_row($q_cities);
$num_cities = $r_cities[0];

$num_pages = ceil($num_cities / 5);
$full_pages = $num_cities / 5;

$ostat = $num_cities - ($num_pages * 5);

$from = $page*5;
$limit = min($num_cities-($page*5), 5);

$query = "SELECT `test_cities`.`name` FROM `test_cities` RIGHT JOIN `test_countries` ON `test_countries`.`id` = `test_cities`.`country_id` WHERE `test_countries`.`name` like '%".$country_search."%' LIMIT ".$from.", ".$limit;
$result = mysqli_query($link, $query);
if ( !$result ) echo "Fault";

while (  $row  =  mysqli_fetch_row($result)  )
{                                   
    echo "".$row[0]."/";
}

};

//var_dump($_POST);
//var_dump($country_search);

close_db($link);
?>
