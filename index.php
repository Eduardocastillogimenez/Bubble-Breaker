<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
	<title>Document</title>
</head>
<body>
	
<?php 
	define('ROJ', 0);
	define('AMA', 1);
	define('VERD', 2);
	define('NEGR', 3);
	define('AZU', 4);
	define('ROSA', 5);

	define('COLORS', [ROJ, AMA, VERD, NEGR, AZU, ROSA]);

	function generarJuego(){
		$juego;

			for ($i=0; $i < 10 ; $i++)
				for($j=0; $j < 10; $j++) {
					$color = array_rand(COLORS);
					$juego[$i][$j] = $color;
				}

		return $juego;
	}

    $juego = generarJuego();
	$score = 0;

    setcookie("juego", json_encode($juego), time() + (999999), "/");
	setcookie("score", json_encode(0), time() + (999999), "/");

	$juego = json_decode($_COOKIE['juego']);
?>

	<div class="bagra"></div>
	<?php include_once('includes/menu.php');?>
	<div class="container main_container">
		<div>	
			<a href="juego.php?go=1">Juego nuevo</a>
			<p>Eduardo A. Castillo G.</p>
		</div>
	</div>
</body>
</html>