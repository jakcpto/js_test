<?php 
include "header.php";
include "db.php";

?>

Страна: <input type='text' id='cntr' name='country'>&nbsp;
<br />

<div id='cities'></div>

<script>
$(document).ready(function() {

$( "#cntr" ).keyup( function () { 

var countr = $( "#cntr" ).val();
var page = $( "#nonopage" ).val();

var req = $.ajax({
  url: "7_back.php",
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
  url: "7_back.php",
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

<div id="map_canvas"></div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script function initialize() {     
	var myLatlng = new google.maps.LatLng(-34.397, 150.644);
	var myOptions = {
		zoom: 8,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); 
};

var marker = new google.maps.Marker({
	position: myLatlng,
	map: map,
	title:"Hello World!" 
});

</script>


<?php

include "footer.php";
?>