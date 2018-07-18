<?php 
include "header.php";
include "db.php";


$link = connect();

$query = "select * from test_countries where name like '%%' ";
$result = mysqli_query($link, $query);
if ( !$result ) echo "Fault";
?>

<table>
<th>ID</th><th>Name</th>

<?php
$count  =  mysqli_num_rows($result);

while (  $row  =  mysqli_fetch_row($result)  )
{
    echo "<tr><td>".$row[0]."<td>".$row[1]."</td></tr>";
}

echo "</table>";


close_db($link);
include "footer.php";
?>