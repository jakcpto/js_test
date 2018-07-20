<?php
include "header7.php";
include "db.php";

?>
<h1>Задание 7</h1>
<p>
Страна: <input type='text' id='cntr' name='country'>&nbsp;
</p>

<div id='cities'></div>

<script>
$(document).ready(function() {

// search input
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

// req for maps
var req2 = $.ajax({
  url: "7_back_for_map.php",
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

 req2.done(function (response, textStatus, jqXHR){
	// clear map
	//clear_Map();
	deleteOverlays(); // попробовать обе функции
          // show successfully for submit message
     var c_arr = response.split("/");
	c_arr.forEach(function(item,i,arr){
		if ( item.length > 0 ) {
		// alert(item); //debug
		// вычислить location из названия (элемента массива), кроме пустого
		    geocoder.geocode( { 'address': item}, function(results, status) {
      			if (status == 'OK') {

				addMarker(results[0].geometry.location, item); 

		      } else { /* alert("Fu") */ } ;
		}); // geocode

		}; // пустой item
		});
		showOverlays();
          // $("#cities").html(response);
     }); // req for markers from input



});

// buttons  for paging
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

// req for maps from buttons
// req for maps
var req2 = $.ajax({
  url: "7_back_for_map.php",
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

 req2.done(function (response, textStatus, jqXHR){
	// clear map
	//clear_Map();
	deleteOverlays(); // попробовать обе функции
          // show successfully for submit message
     var c_arr = response.split("/");
	c_arr.forEach(function(item,i,arr){
		if ( item.length > 0 ) {
		// alert(item); //debug
		// вычислить location из названия (элемента массива), кроме пустого
		    geocoder.geocode( { 'address': item}, function(results, status) {
      			if (status == 'OK') {

				addMarker(results[0].geometry.location, item); 

		      } else { /* alert("Fu") */ } ;
		}); // geocode

		}; // пустой item
		});
	showOverlays();
          // $("#cities").html(response);
     }); // req for markers from input

});

}); // document ready
</script>

<div id="map" class="map"></div>



<?php

include "footer.php";
?>
