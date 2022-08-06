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

function getColor($numeroColor){
    $color = "roj";

    switch ($numeroColor) {
        case 0:
            $color = "roj";
            break;
        case 1:
            $color = "ama";
            break;
        case 2:
            $color = "verd";
            break;
        case 3:
            $color = "negr";
            break;
        case 4:
            $color = "azu";
            break;
        case 5:
            $color = "rosa";
            break;
    }

    return $color;
}

$nuevo = false;

if( isset($_GET["go"]) && !$nuevo ){
    $nuevo = true;
    $juego = generarJuego();

    setcookie("juego", json_encode($juego), time() + (999999), "/");
}

$juego = json_decode($_COOKIE['juego']);
echo '<pre>';
var_dump($_COOKIE['juego']);
echo '</pre>';
?>

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
    
	<?php include_once('includes/menu.php');?>
    <div class="container container_m">

    <form class="form" action="#" method="POST" name="login">
            <div class="div_form_container">
                <?php  foreach($juego as $i => $fila): ?>
                <div class="div_form">
                    <tr class="tr_form">      
                        <?php  foreach($fila as $j => $punto): ?>
                            <?php  $name_id = $i."".$j; ?>
                            <td ><span class="span_form"><input 
                                id="<?php echo $name_id; ?>" 
                                name="<?php echo $name_id; ?>" 
                                class="<?php echo getColor($punto); ?>"  
                                value="<?php echo $name_id; ?>" disabled>
                            </span></td>
                        <?php endforeach; ?>
                    </tr> 
                </div>
                <?php endforeach; ?>
            </div>
        
        <button type="submit" class="" name="login">Acceso</button>
    </form>

    </div>

</body>
</html>

