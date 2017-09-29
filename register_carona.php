<html>
<?php
	include 'configs.php';
	$con = mysqli_connect( $db_servername, $db_username, $db_password );
	mysqli_select_db($con, 'cidades_brasil');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<label for="cod_estados">Estado:</label>
<input list="cod_estados" style="width: 30px;" id="estados_input">
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

<label for="cod_cidades">Cidade:</label>
<input list="cod_cidades">
<datalist name="cod_cidades" id="cod_cidades">
</datalist>

<script>
	$(function(){
	$('#estados_input').bind('input', function(){
		if( ($(this).val()).length == 2 ) {
			$('#cod_cidades').hide();
			$('.carregando').show();
			$.getJSON('cidades.ajax.php?search=',{cod_estados: $(this).val()}, function(j){
				var options = '<option value=""></option>';	
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].nome + '">';// + j[i].nome + '</option>';
				}	
				$('#cod_cidades').html(options).show();
				$('.carregando').hide();
			});
		} else {
			$('#cod_cidades').html('<option value="">-- Escolha um estado --</option>');
		}
	});
});
</script>
</html>