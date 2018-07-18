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

echo "<input type='hidden' id='nonopage' name='nonopage' value='".$page."'>";

if ( $country_search != "" ) {
// output cities of selected country

// calcs for pagination
$total_query = "select count(name) from test_cities where country_id = '".$country_search."'";
$q_cities = mysqli_query($link, $total_query);
$r_cities = mysqli_fetch_row($q_cities);
$num_cities = $r_cities[0];

$num_pages = ceil($num_cities / 5);
$full_pages = $num_cities / 5;

$ostat = $num_cities - ($num_pages * 5);

$from = $page*5;
$limit = min($num_cities-($page*5), 5);

$query = "select name from test_cities where country_id = '".$country_search."' LIMIT ".$from.", ".$limit;
$result = mysqli_query($link, $query);
if ( !$result ) echo "Fault";

echo "<table>".
"<th>Город</th>";

while (  $row  =  mysqli_fetch_row($result)  )
{                                   
    echo "<tr><td>".$row[0]."</td></tr>";
}


echo "</table>";



$prev_page=max(0,$page-1);
$next_page=min($num_pages-1, $page+1);

echo "<button id='button_1' name='page' value=".$prev_page.">Предыдущие</button>&nbsp";
echo "<button id='button_1' name='page' value=".$next_page.">Следующие</button><br />";
$page_to_show = $page+1;
echo "Страница ".$page_to_show." из ".$num_pages."";

//var_dump($_POST);
//var_dump($country_search);
};

close_db($link);
?>
