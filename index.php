
<?php 

    if(isset($_COOKIE['usuario'])) {
        if(!empty($_GET['sesionn'])) {
            setcookie('usuario',"",time()-1000);
            setcookie('sexousuario', "", time()-1000);
            setcookie('nacimiento_usuario', "", time()-1000);
            setcookie('ubicacion_usuario', "", time()-1000);
            setcookie('fecha_sesion', date('r'), time() + 365 * 24 * 60 * 60);
            setcookie('idusuario', "", time() -100);
        }
        if(!empty($_POST['sesion2'])) {
            setcookie('usuario',"",time()-1000);
            setcookie('sexousuario', "", time()-1000);
            setcookie('nacimiento_usuario', "", time()-1000);
            setcookie('ubicacion_usuario', "", time()-1000);
            setcookie('recordar1',"",time() -1000);
            setcookie('recordar2',"",time() -1000);
            setcookie('fecha_sesion',"",time()-1000);
            setcookie('idusuario', "", time() -100);
        }
    } 
?>
<!DOCTYPE html> 
<html lang="es"> 
    
    <!-- La cabecera --> 
        <head> 
            <meta charset="utf8_spanish_ci" /> 
            <meta name="generator" content="Sublime Text" /> 
            <meta name="author" content="Juanma y Jaime" /> 
            <meta name="keywords" content="HTML5, web, practica, diseño de apliccaciones web" /> 
            <meta name="description" content="Plantilla base de nuestra pagina creada con HTML5" />
            <meta name="viewport" content="width=device-width,initial-scale=1.0" /> 
            <title>PI-Pictures and Images</title> 
            <!-- ESTILO BASE -->
            <link rel="stylesheet" type="text/css" href="css/standard/index.css" title="Estilo principal" media="screen"/>
            <link rel="stylesheet" type="text/css" href="css/standard/imagenes.css" title="Estilo principal" media="screen"/>
            <!-- ESTILO ACCESIBLE -->
            <link rel="stylesheet" type="text/css" href="css/accesible/index.css" title="Estilo accesible" media="screen"/>
            <link rel="stylesheet" type="text/css" href="css/accesible/imagenes.css" title="Estilo accesible" media="screen"/>
             <!-- IMPRIMIR -->
            <link rel="stylesheet" type="text/css" href="css/imprimir/imprimir.css" media="print"/>
        </head> 

    <!-- El cuerpo --> 
    
        <body>  

            <!--Enlacce al Header-->
            <?php include('inc/cabecera.php'); ?>

            <!-- Enlaces al navegador --> 
            <?php include('inc/nav.php'); ?>

            <br />


             <!-- Inicio sesión --> 
            <?php 
                if(empty($_COOKIE['usuario']))  {
                    if(empty($_GET['err'])) {
                        include('inc/sesion.php'); 
                    }
                } 
            ?>

            <?php 
                if(!empty($_GET['err'])) {
                    if($_GET['err'] == 'fuera') {
                        include('inc/sesion.php');
                    }
                } 
            ?>

           <?php 
                if(!empty($_GET['err'])) {
                    if($_GET['err'] == 'error') {
                        include('inc/sesion.php');
                        echo "<h3> Credenciales invalidos </h3>";
                    } 
                    else if($_GET['err'] == 'noreg') {
                        include('inc/sesion.php');
                        echo "<h3> Inicia sesión o <a href='registro_usuario.php' > registrate </a> </h3>";
                    }
                    else if($_GET['err'] == 'normal') {
                        include('inc/sesion.php');
                    }
                }
            ?>

            <?php 
                if(!empty($_COOKIE['usuario'])) {
                    if(empty($_GET['err'])) {
                        //AQUI VA EL INCLUDE DE SESION_PERFIL
                        include('inc/sesion_perfil.php');
                    }
                }

             ?>

            <br />
      
            <h3>Últimas Actualizaciones</h3>
            
            <!-- Mostrar las imagenes -->
<?php 
 // Conecta con el servidor de MySQL 
 $link = @mysqli_connect( 
         'localhost',   // El servidor 
         'root',    // El usuario 
         '',        // La contraseña 
         'pibd'); // La base de datos 
 
 if(!$link) { 
   echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error(); 
   echo '</p>'; 
   exit; 
 } 
 
 // Ejecuta una sentencia SQL 
 $sentencia = 'SELECT * FROM fotos ORDER BY FRegistro desc'; //Para limitar a las ultimas 5 fotos LIMIT 0,5 
 mysqli_query($link,"SET CHARACTER SET 'utf8'");
 mysqli_query($link,"SET SESSION collation_connection ='utf8_bin'");

 if(!($resultado = @mysqli_query($link, $sentencia))) { 
   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link); 
   echo '</p>'; 
   exit; 
 } 

 // Recorre el resultado y lo muestra en forma de tabla HTML 
 while($fila = mysqli_fetch_assoc($resultado)) {
   echo '<article class ="Imagen" >';
   echo '<h3>'. $fila['Titulo'] . '</h3>' ;  
   echo "<a href='detalle_imagen.php?img=".$fila['Fichero']."'><img src='".$fila['Fichero']."' width='250' height='200' alt='Imagen de ejemplo'></a>";
   echo '<p> Fecha: ' . $fila['Fecha'] . '</p>';

   $sentencia2 = "SELECT * FROM paises WHERE IdPais = '".$fila['Pais']."' ";
   if(!($resultado2 = @mysqli_query($link, $sentencia2))) {
    echo "<p> Error al ejecutar la sentencia SQL". mysqli_error($link);
    echo '</p>';
    exit;
   }
   $fila2 = mysqli_fetch_assoc($resultado2);
   echo '<p> Pais:' . $fila2['NomPais'] . '</p>' ;
   echo "<a href='destacar.php?es=".$fila['Fichero']."&des=".$fila['Descripcion']."&t=".$fila['Titulo']."' ><button >Destacar</button></a>";
   echo '</article>'; 
 } 
 
 // Libera la memoria ocupada por el resultado 
 mysqli_free_result($resultado); 
 // Cierra la conexión 
 mysqli_close($link); 
?> 
<?php  
    $abre = fopen("fotos.txt", "r");
    $comenta = fopen("comentarios.txt", "r");
    $tit = fopen("titulos.txt", "r");
    $hecho = false;
    $i = -1;
    while(!feof($abre)) {
        $linea = fgets($abre);
        $i = $i+1;
    }
    fclose($abre);
    $j = rand(0,$i-1);
    $s = 0;
    $abre = fopen("fotos.txt", "r");
    while (!feof($abre) && !$hecho && !feof($comenta) && !feof($tit)) { 
       $linea = fgets($abre);
       $comentario = fgets($comenta);
       $titulo = fgets($tit);
       if($j == $s && !empty($linea) && !empty($comentario) && !empty($titulo)) {
       echo '<h3>Foto destacada<h3>';
       echo '<article class="Imagen">';
       echo '<h3>'.$titulo.'</h3>';
       echo "<a href='detalle_imagen.php?img=".$linea."'><img src='".$linea."' width='250' height='200'></a>";
       echo "<p>".$comentario."</p>";
       echo '</article>';
       $hecho = true;
       }
       else {
        $s=$s+1;
       }
    }
    fclose($tit);
    fclose($comenta);
    fclose($abre);
    
?>
  
             <?php include('inc/footer.php'); ?>
        </body> 
    
</html>