<!DOCTYPE html>
<html>
<head>
	<title>Maps</title>
	<link rel="stylesheet" type="text/css" href="../Views/css/estilo.css">
</head>
<body>
	<div id="map"></div>
<script>

	function iniciarMap(){
    var lati = document.getElementById('lat').value;
    var long = document.getElementById('lng').value;

    var coord = {lat:lati ,lng: long};
    var map = new google.maps.Map(document.getElementById('map'),{
      zoom: 10,
      center: coord
    });
    var marker = new google.maps.Marker({
      position: coord,
      map: map
    });
}

</script>
<input type="hidden" id="lat" value='<?= $lat?>'>
<input type="hidden" id="lng" value='<?= $lng?>'>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6NueT28eL7Huh1tP6gzDF25MXOj26mck&callback=iniciarMap"></script>
</body>

</html>