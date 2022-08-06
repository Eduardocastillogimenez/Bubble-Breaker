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
        case -1:
            $color = "eliminado";
            break;
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

function coincidencias(&$juego){
    $coincidencia = false;
    $puntoSelec = $_GET["pun"];

    for ($i=0; $i < 10 ; $i++){
        for($j=0; $j < 10; $j++) {
            if($puntoSelec === $i."".$j){
                if($i>0){
                    if($juego[$i][$j] === $juego[$i-1][$j]){
                        $coincidencia = true; 
                    } 
                }
                if($i<9){
                    if($juego[$i][$j] === $juego[$i+1][$j]){
                        $coincidencia = true; 
                    }  
                }
                if($j>0){
                    if($juego[$i][$j] === $juego[$i][$j-1]){
                        $coincidencia = true; 
                    }   
                }
                if($j<9){
                    if($juego[$i][$j] === $juego[$i][$j+1]){
                        $coincidencia = true; 
                    }  
                }                                                                
            }
        }
    }

    return $coincidencia;
}




$nuevo = false;
$juego = json_decode($_COOKIE['juego']);

if( isset($_GET["go"]) && !$juego ){
    $nuevo = true;
    $juego = generarJuego();
    $final = "na";

    setcookie("juego", json_encode($juego), time() + (999999), "/");
    setcookie("score", json_encode(0), time() + (999999), "/");
   
}

$score = json_decode($_COOKIE['score']);

function eliminarEspacioVacio(&$juego){

        $juego2 = $juego;
        unset($_COOKIE["juego"]);

        for ($i=9; $i > -1 ; $i--){
            for($j=0; $j < 10; $j++) {
                if($juego2[$i][$j] === -1 && $i>0){
                    $bajar = $juego2[$i-1][$j];
                    $juego2[$i-1][$j] = $juego2[$i][$j];
                    $juego2[$i][$j] = $bajar;
                }
            }
        }
        for ($i=9; $i > -1 ; $i--){
            for($j=0; $j < 10; $j++) {
                if($juego2[$i][$j] === -1 && $i>0){
                    $bajar = $juego2[$i-1][$j];
                    $juego2[$i-1][$j] = $juego2[$i][$j];
                    $juego2[$i][$j] = $bajar;
                }
            }
        }
        
        for ($i=9; $i > -1 ; $i--){
            for($j=0; $j < 10; $j++) {
                if($juego2[$i][$j] === -1 && $i>0){
                    $bajar = $juego2[$i-1][$j];
                    $juego2[$i-1][$j] = $juego2[$i][$j];
                    $juego2[$i][$j] = $bajar;
                }
            }
        }
        
        for ($i=9; $i > -1 ; $i--){
            for($j=0; $j < 10; $j++) {
                if($juego2[$i][$j] === -1 && $i>0){
                    $bajar = $juego2[$i-1][$j];
                    $juego2[$i-1][$j] = $juego2[$i][$j];
                    $juego2[$i][$j] = $bajar;
                }
            }
        }
        
        for ($i=9; $i > -1 ; $i--){
            for($j=0; $j < 10; $j++) {
                if($juego2[$i][$j] === -1 && $i>0){
                    $bajar = $juego2[$i-1][$j];
                    $juego2[$i-1][$j] = $juego2[$i][$j];
                    $juego2[$i][$j] = $bajar;
                }
            }
        }
        
        $juego = $juego2;
        setcookie("juego", json_encode($juego2), time() + (999999), "/");
    
}
function recur(&$juego2,$puntoSelec){
    for ($i=0; $i < 10 ; $i++){
        for($j=0; $j < 10; $j++) {          
            if($puntoSelec === $i."".$j){                      
                if($juego2[$i][$j] === $juego2[$i+1][$j]){                   
                    $juego2[$i][$j] = -1;
                    $h = $i+1;
                    recur($juego2,$h."".$j);
                }
                if($juego2[$i][$j] === $juego2[$i-1][$j]){                   
                    $juego2[$i][$j] = -1;
                    $h = $i-1;
                    recur($juego2,$h."".$j);
                }
                       
                                                                               
            }
        }
    }
}
function puntosRegistrados($juego2, $i, $j, $col, &$yaVisto) {
    array_push($yaVisto, [$i, $j]);

    if(isset($juego2[$i+1][$j])){
        if($juego2[$i+1][$j] == $col && array_search([$i+1, $j], $yaVisto) === false) {
            puntosRegistrados($juego2, $i+1, $j, $col, $yaVisto);
        }
    }
    if(isset($juego2[$i-1][$j])){
        if($juego2[$i-1][$j] == $col && array_search([$i-1, $j], $yaVisto) === false) {
            puntosRegistrados($juego2, $i-1, $j, $col, $yaVisto);
        }
    }
    if(isset($juego2[$i][$j+1])){
        if($juego2[$i][$j+1] == $col && array_search([$i, $j+1], $yaVisto) === false) {
            puntosRegistrados($juego2, $i, $j+1, $col, $yaVisto);
        }
    }
    if(isset($juego2[$i][$j-1])){
        if($juego2[$i][$j-1] == $col && array_search([$i, $j-1], $yaVisto) === false) {
            puntosRegistrados($juego2, $i, $j-1, $col, $yaVisto);
        }
    }
    return;
}

function reorden(&$juego2, $i, $j, $col) {
    $yaVisto = [];

    puntosRegistrados($juego2, $i, $j, $col, $yaVisto);

    if(count($yaVisto) < 2) {
        return;
    }

    foreach ($yaVisto as $a) {
        $pi = $a[0];
        $pj = $a[1];
        $juego2[$pi][$pj] = -1;
    }
    
    $score = 0;
    if(isset($_COOKIE['score'])){
        $score = $_COOKIE['score'];
    }
    
    setcookie("score", json_encode($score + count($yaVisto) - 1), time() + (999999), "/");
    count($yaVisto);
}

if( isset($_GET["pun"]) ){

    if(coincidencias($juego)){
        $juego2 = $juego;
        unset($_COOKIE["juego"]);
        $puntoSelec = $_GET["pun"];

        $col = 0;
 //       for ($i=0; $i < 10 ; $i++){
   //         for($j=0; $j < 10; $j++) {         
     //           if($puntoSelec === $i."".$j){   
       //             if($i<9){
         //               if($juego2[$i][$j] === $juego2[$i+1][$j]){                   
           //                 $juego2[$i+1][$j] = -1;
             //           }
               //     } 
                 //   if($i>0){
  //                      if($juego2[$i][$j] === $juego2[$i-1][$j]){                   
    //                        $juego2[$i-1][$j] = -1;
      //                  } 
        //            }
          //          if($j<9){
            //            if($juego2[$i][$j] === $juego2[$i][$j+1]){                   
              //              $juego2[$i][$j+1] = -1;
                //        }
 //                   } 
   //                 if($j>0){
     //                   if($juego2[$i][$j] === $juego2[$i][$j-1]){                   
       //                     $juego2[$i][$j-1] = -1;
         //               } 
           //         }
             //       $col =  $juego2[$i][$j];   
               //     $juego2[$i][$j] = -1; 
  //                  unset($_COOKIE["score"]);
    //                $score = $score +1;
      //              setcookie("score", json_encode($score), time() + (999999), "/");                                                                                     
        //        }
          //  }
       // }
        for ($i=0; $i < 10 ; $i++){
            for($j=0; $j < 10; $j++) {         
                if($puntoSelec === $i."".$j){   
                    $col =  $juego2[$i][$j];     
                    reorden($juego2, intval($i), intval($j), $col);                                                                              
                }
            }
        }

        //recur($juego2,$puntoSelec);

 
        $juego = $juego2;
        setcookie("juego", json_encode($juego2), time() + (999999), "/");
        
        eliminarEspacioVacio($juego);
    }
}
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
    <p> score:<?php echo $score; ?></p>
    <div class="container container_m">
        
    <div class="form" >
            <div class="div_form_container">
                <?php  foreach($juego as $i => $fila): ?>
                <div class="div_form">
                    <tr class="tr_form">    
                        <?php  foreach($fila as $j => $punto): ?>
                            <?php  $name_id = $i."".$j; ?>
                            <td ><span class="span_form"><input type="button" 
                                onclick="window.location.href='/Bubble%20Breaker/juego.php?pun=<?php echo $name_id; ?> '"
                                id="<?php echo $name_id; ?>" 
                                name="<?php echo $name_id; ?>" 
                                class="<?php echo getColor($punto); ?>"
                                >
                            </span></td>
                        <?php endforeach; ?>
                    </tr> 
                </div>
                <?php endforeach; ?>
            </div>
    </div>

    </div>

</body>
</html>

