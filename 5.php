<?php 
include "header.php";
include "db.php";

$link = connect();

$query = "select * from test_countries where name like '%%' ";
$result = mysqli_query($link, $query);
if ( !$result ) echo "Fault";
?>

<select name='country' id='country'>
<?php

$selected = "";
if ( isset($_POST['country']) ) $country_search = mysqli_escape_string($link, $_POST['country']);
else $country_search = "0";

while (  $row  =  mysqli_fetch_row($result)  )
{
	if ($row[0] == $country_search) $selected = "selected";
		else $selected = "";
    echo "<option value=".$row[0]." ".$selected.">".$row[1]."</option>";
}

?>
</select>

<div id='cities'></div>

<script>
$(document).ready(function() {

$( "#country" ).change( function () { 

var countr = $( "#country option:selected" ).val();
var page = $( "#nonopage" ).val();

var req = $.ajax({
  url: "5_back.php",
  data: { 
        'country': countr,
	'page'	 : page
    	},
  	type: "POST",
	success: function(data){ 
        //  echo(data);
	},
	error: function(data) {
	//        alert(data);
	}
    
 });

 req.done(function (response, textStatus, jqXHR){
          // show successfully for submit message
          $("#cities").html(response);
     });

});

// buttons
// debug + test
$('#cities').on('click', '#button_1', function() {

var countr = $( "#country option:selected" ).val();
var page = $( this ).val();

var req = $.ajax({
  url: "5_back.php",
  data: { 
        'country': countr,
	'page'	 : page
    	},
  	type: "POST",
	success: function(data){ 
        //  echo(data);
	},
	error: function(data) {
	//        alert(data);
	}
    
 });
 req.done(function (response, textStatus, jqXHR){
          // show successfully for submit message
          $("#cities").html(response);
     });
});

}); // document ready
</script>



<?php

close_db($link);
include "footer.php";
?>