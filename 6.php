<?php 
include "header.php";
include "db.php";

?>

Страна: <input type='text' id='cntr' name='country' >&nbsp;
<br />

<div id='cities'></div>

<script>
$(document).ready(function() {

$( "#cntr" ).keyup( function () { 

var countr = $( "#cntr" ).val();
var page = $( "#nonopage" ).val();

var req = $.ajax({
  url: "6_back.php",
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

var countr = $( "#cntr" ).val();
var page = $( this ).val();

var req = $.ajax({
  url: "6_back.php",
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

include "footer.php";
?>