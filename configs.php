<?php
$db_servername = "localhost";
$db_tablename = "Caronapp";
$db_username = "root";
$db_password = "";

$conn = new mysqli($db_servername, $db_username, $db_password); // Creating DB Connection

if($conn->connect_error){
 die("Connection Failed to the Database!");	 // Error Catch
}

mysqli_select_db($conn, $db_tablename); // Database selection
mysqli_set_charset($conn, "utf8");
function queryData($conn, $query){
	return mysqli_query($conn, $query);
}

function CheckCookieLogin() {
    $uname = $_COOKIE['uname']; 
    if (!empty($uname)) {   
        $query = "SELECT * FROM `users` WHERE `session`='$uname'";
		$result = mysqli_query($conn, $query);
		if ( mysqli_num_rows($result) > 0 ){
			$_SESSION['logged_in'] = 1;
			$_SESSION['cookie'] = $uname;
			// reset expiry date
			setcookie("uname",$uname,time()+3600*24*365,'/', '.localaddress');
			return true;
		}
    }
}

function executeData($conn, $query){
	$stmt = $conn->stmt_init();
	$stmt->prepare($query);
	$stmt->execute();
	$stmt->close();
}

function fetchData($result, $columns){
	if ($result->num_rows > 0) {
    // output data of each row
	$index = 0;
	$resultset;
	$col;
    while($row = $result->fetch_assoc()){
		foreach($columns as &$col)
			$resultset[$index][$col] = $row[$col];
		$index=$index+1;
	}
	return $resultset;
	}
}
?>