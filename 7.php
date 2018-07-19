<?php
include "header7.php";
include "db.php";

?>

Страна: <input type='text' id='cntr' name='country'>&nbsp;
<br />

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
		// alert(item);
		// вычислить location из названия (элемента массива), кроме пустого
		    geocoder.geocode( { 'address': item}, function(results, status) {
      			if (status == 'OK') {
		        var marker = new google.maps.Marker({
		            map: map,
		            position: results[0].geometry.location
		        });
		      } else {alert("Fu")} ;
		}); // geocode
		// addMarker(location);
		}; // пустой item
		});
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
		// alert(item);
		// вычислить location из названия (элемента массива), кроме пустого
		    geocoder.geocode( { 'address': item}, function(results, status) {
      			if (status == 'OK') {
		        var marker = new google.maps.Marker({
		            map: map,
		            position: results[0].geometry.location
		        });
		      };
		}); // geocode
		// addMarker(location);
		}; // пустой item
		});
          // $("#cities").html(response);
     }); //markers

});

}); // document ready
</script>

<div id="map" class="map"></div>

<script

// initMap() - функция инициализации карты

function initMap() {
	// Координаты центра на карте. Широта: 56.2928515, Долгота: 43.7866641
	var centerLatLng = new google.maps.LatLng(56.2928515, 43.7866641);
	// Обязательные опции с которыми будет проинициализированна карта
	var mapOptions = {
		center: centerLatLng, // Координаты центра мы берем из переменной centerLatLng
		zoom: 8               // Зум по умолчанию. Возможные значения от 0 до 21
	};
	// Создаем карту внутри элемента #map
	var map = new google.maps.Map(document.getElementById("map"), mapOptions);	
}
// Ждем полной загрузки страницы, после этого запускаем initMap()
google.maps.event.addDomListener(window, "load", initMap);
</script>


<?php

include "footer.php";
?>
