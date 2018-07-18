<?php 
include "header.php";
include "db.php";


$link = connect();

$query = "select * from test_countries where name like '%%' ";
$result = mysqli_query($link, $query);
if ( !$result ) echo "Fault";
?>

<form name='country_select' action="2.php" method=post>
<select name='country' onchange="document.forms['country_select'].submit()">


<?php

$selected = "";
if ( isset($_POST['country']) ) $country_search = mysqli_escape_string($link, $_POST['country']);
else $country_search = "--none";

while (  $row  =  mysqli_fetch_row($result)  )
{
	if ($row[0] == $country_search) $selected = "selected";
		else $selected = "";
    echo "<option value=".$row[0]." ".$selected.">".$row[1]."</option>";
}

?>

</select>
</form>

<?php
// debug
// VAR_DUMP($_POST);

if ( $country_search != "--none" ) {
// output cities of selected country
$query = "select name from test_cities where country_id = '".$country_search."' ";
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

close_db($link);
include "footer.php";
?>