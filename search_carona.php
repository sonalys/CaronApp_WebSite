<?php 
include 'configs.php';
$query = 'SELECT * FROM caronas';
$result = queryData($conn, $query);
$resultset = fetchData($result, array('c_id', 'origem','paradas', 'destino', 'data'));

echo "Origem: ".$resultset[0]['origem']."<br><br> Paradas: <br>";
$vetor = explode(";", $resultset[0]['paradas']);
foreach($vetor as &$paradas)
echo $paradas."<br>";
echo " <br>Destino: ".$resultset[0]['destino']." <br>Data: ".$resultset[0]['data'];
?>
<html>
<script>
      function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
        var map = new google.maps.Map(document.getElementById('map_canvas'), {
          zoom: 10,
          center: {lat: -22.4160484, lng: -45.4447126},
		  gestureHandling: 'greedy'
        });
        directionsDisplay.setMap(map);
		calculateAndDisplayRoute(directionsService, directionsDisplay);
		setMapOnAll(null);

	  }


      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
		var array = "<?php echo $resultset[0]['paradas']; ?>".split(";");
        var waypts = [];
			for(var objs in array)
            waypts.push({
              location: array[objs],
              stopover: true
            });
		console.log(waypts);
        directionsService.route({
          origin: '<?php echo $resultset[0]['origem']; ?>',
          destination: '<?php echo $resultset[0]['destino']; ?>',
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
           
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    </script>
	
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCM84BS7amILj_fDiM9PR-vsAgVqmIR4cs&callback=initMap">
    </script>
	<div id = "map_canvas" style="width: 500px;height: 500px;"></div>
</html>