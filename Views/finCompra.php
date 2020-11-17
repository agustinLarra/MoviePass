

<body>
	<div id="map"></div>
<script>

	function iniciarMap(){
        var lati = parseFloat(document.getElementById('lat').value, 10);
        var long = parseFloat(document.getElementById('lng').value, 10);
        console.log(lati);
        console.log(long);
   // var lati = document.getElementById('lat').value;
    //var long = document.getElementById('lng').value;

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

<div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="single-do text-center mb-80 mt-50">
                    <div class="do-icon">
                         <span  class="flaticon-tasks"></span>
                    </div>
                     <h3> Felicitaciones, su compra se registro correctamente! </h3>
                     <h5> Sus entradas se encuentran disponibles en el mail registrado en esta cuenta</h5>

                     <h3>Cine: <?= $nombreCine?></h3>                
                     <h3>Direccion: <?= $calleCine.'  '. $numeroCine?></h3>      
                </div>
                <div class="col-xl-7 col-lg-7 col-md-7 mt-5">
                        <div class="header-right-btn f-right d-none d-lg-block">
                            <a href="<?= FRONT_ROOT?>Home/viewCartelera" class="btn header-btn">Inicio</a>
                        </div>
            </div>
          
            </div> 
    </div>
</body>

</html>