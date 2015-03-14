<?php //ob_start(); header('Cache-Control: no-store, no-cache, must-revalidate');
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "sscdb";
	$resultado = "";
	$conn = mysqli_connect($servername, $username, $password, $database);

	if (!$conn) {
	    $resultado = ("Connection failed: " . mysqli_connect_error());
	}
	
	if(isset($_POST['idRecorrido'])){
		
		$data = $_POST['idRecorrido'];
		$id = json_decode($data);
		$sql = "select recorrido from linea where id= '$id'";
		if(!($resultado = mysqli_query($conn, $sql)) ) {
			$resultado = mysqli_error();
		}else{
			$row = mysqli_fetch_assoc($resultado);
			$resultado = $row['value'];
		}
		
	}


	header('Content-type: application/json');
	echo json_encode($resultado);
	
	mysqli_close($conn);
?>