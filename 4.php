<?php 
include "header.php";
include "db.php";


$link = connect();

$query = "select * from test_countries where name like '%%' ";
$result = mysqli_query($link, $query);
if ( !$result ) echo "Fault";

if ( isset($_POST['country']) ) $country_search = mysqli_escape_string($link, $_POST['country']);
else $country_search = "--none";

if ( isset($_POST['page']) ) 
	     $page = $_POST['page'];
	else $page = 0;

?>

<form name="country_select" action="4.php" method=post>
Страна: <input type='text' name='country' value='<?php echo $country_search; ?>'>&nbsp;
<button>Поиск</button><br />


<?php
// debug
// VAR_DUMP($_POST);


if ( $country_search != "--none" ) {
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

echo "<table>".
"<th>Город</th>";

while (  $row  =  mysqli_fetch_row($result)  )
{                                   
    echo "<tr><td>".$row[0]."</td></tr>";
}


echo "</table>";

}

$prev_page=max(0,$page-1);
$next_page=min($num_pages-1, $page+1);

if ( $num_pages > 0) {
echo "<button name='page' value=".$prev_page.">Предыдущие</button>&nbsp;";
echo "<button name='page' value=".$next_page.">Следующие</button><br />";

$page_to_show = $page+1;
echo "Страница ".$page_to_show." из ".$num_pages."";
};

?>

</form>

<?php

close_db($link);
include "footer.php";
?>