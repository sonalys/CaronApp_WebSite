<html>
<?php
	include 'configs.php';
	$con = mysqli_connect( $db_servername, $db_username, $db_password );
	mysqli_select_db($con, 'cidades_brasil');
?>

<label>Origem [</label>
<label for="cod_estados">Estado:</label>
<input list="cod_estados" style="width: 30px;" id="estados_input0" onchange="updateDatalist(this);">

<label for="cod_cidades">Cidade:</label>
<input list="cod_cidades" id="cidade0">
<label>]<br></label>

<label>Ponto de Parada [</label>
<label for="cod_estados">Estado:</label>
<input list="cod_estados" style="width: 30px;" id="estados_input1" onchange="updateDatalist(this);">

<label for="cod_cidades">Cidade:</label>
<input list="cod_cidades" id="cidade1">
<label>] <a onclick='generateMore();'>+</a><br> </label>
<div id="waypoints"></div>
<label>Destino [</label>
<label for="cod_estados">Estado:</label>
<input list="cod_estados" style="width: 30px;" id="estados_inputf" onchange="updateDatalist(this);">

<label for="cod_cidades">Cidade:</label>
<input list="cod_cidades" id="cidadef">
<label>] <a onclick='generateMore();'>+</a><br> </label>


<label onclick='saveCarona();'> Enviar </label>
<!-- DATA LIST -->
<datalist name="cod_cidades" id="cod_cidades">
</datalist>

<datalist name="cod_estados" id="cod_estados">
	<option value=""></option>
	<?php
		$sql = "SELECT cod_estados, sigla
				FROM estados
				ORDER BY sigla";
		$res = mysqli_query($con, $sql );
		while ( $row = mysqli_fetch_assoc( $res ) ) {
			echo '<option value="'.$row['sigla'].'">';//.$row['sigla'].'</option>';
		}
	?>
</option></datalist>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
	var i=2;
	function httpGet(params)
	{
		var http = new XMLHttpRequest();
		var url = "get_data.php";
		http.open("POST", url, true);

		//Send the proper header information along with the request
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		http.onreadystatechange = function() {//Call a function when the state changes.
			if(http.readyState == 4 && http.status == 200) {
				alert(http.responseText);
			}
		}
		http.send(params);
	}
	
	function saveCarona(){
		
		var Origem = dataBuilder(0);
		var WayPts = "";
		for(var x = 1; x<i; x++)
			WayPts = WayPts + ";" + dataBuilder(x);
		WayPts = WayPts.substr(1);
		var Destino = dataBuilder('f');
		
		httpGet("Origem='"+Origem+"'&Waypts='"+WayPts+"'&Destino='"+Destino+"'");
	}
	
	function dataBuilder(x){
		return $('#cidade'+x).val() + " , " + $('#estados_input'+x).val();
	}
	
	function generateMore(){
		if(i<6){
			$('#waypoints').append("<div id=\"waypt"+i+"\"><label>Ponto de Parada [</label><label for=\"cod_estados\"> Estado:</label> <input list=\"cod_estados\" style=\"width: 30px;\" id=\"estados_input"+i+"\" onchange=\"updateDatalist(this);\"><label for=\"cod_cidades\"> Cidade: </label><input list=\"cod_cidades\" id=\"cidade"+i+"\"><label> ] <a onclick='generateMore();'>+</a><a onclick='var element = document.getElementById(\"waypt"+i+"\");element.outerHTML = \"\";delete element;'>  -</a><br></label></div>");
			i++;
		}
	}

	function updateDatalist(obj){
			$('#cod_cidades').empty();
			$.getJSON('cidades.ajax.php?search=',{cod_estados: obj.value}, function(j){
				var options = '<option value=""></option>';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].nome + '">';// + j[i].nome + '</option>';
				}	
				
				$('#cod_cidades').append(options);
			});
	}
</script>
</html>