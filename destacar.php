
<?php 
    if(!isset($_COOKIE['usuario'])&&!empty($_GET['es'])) {
        header("Location: index.php?err=noreg");
        exit;
    }

    if(isset($_COOKIE['usuario'])) {
        if(strcasecmp($_COOKIE['usuario'], "jaime@gmail.com") && strcasecmp($_COOKIE['usuario'], "juanma@gmail.com") && strcasecmp($_COOKIE['usuario'], "amparo@gmail.com")) {
         
         $guarda = $_GET['es'];
         $guardado = $guarda ."\n";
         $abierto = fopen("fotos.txt", "a");
         fwrite($abierto, $guardado);
         fclose($abierto);
         $comenta = $_GET['des'];
         $guar = $comenta."\n";
         $abre = fopen("comentarios.txt","a");
         fwrite($abre, $guar);
         fclose($abre);
         $tt = $_GET['t'];
         $guar = $tt."\n";
         $abre = fopen("titulos.txt","a");
         fwrite($abre, $guar);
         fclose($abre);
         header("Location: index.php");
         exit;

        }
    }
 ?>