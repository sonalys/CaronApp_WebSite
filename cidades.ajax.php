<?php
include 'configs.php';
header( 'Cache-Control: no-cache' );
header( 'Content-type: application/xml; charset="utf-8"', true );

$con = mysqli_connect( $db_servername, $db_username, $db_password ) ;
mysqli_select_db( $con, 'cidades_brasil' );
mysqli_query( $con, 'SET CHARACTER SET utf8');
$cod_estados = $_GET['cod_estados'];

$query = "SELECT cod_estados FROM estados WHERE sigla='$cod_estados'";
$result = queryData($con, $query);
$cod_estados = fetchData($result, array('cod_estados'))[0]['cod_estados'];

$cidades = array();

$sql = "SELECT cod_cidades,nome FROM cidades WHERE estados_cod_estados=$cod_estados	ORDER BY nome";
$res = mysqli_query( $con,$sql );
while ( $row = mysqli_fetch_assoc( $res ) ) {
	$cidades[] = array(
		'cod_cidades'	=> $row['cod_cidades'],
		'nome'			=> $row['nome'],
	);
}
echo( json_encode($cidades));
?>