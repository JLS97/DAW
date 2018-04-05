
<?php 
    if(!isset($_COOKIE['usuario'])) {
        header("Location: index.php?err=noreg");
        exit;
    }

    if(isset($_COOKIE['usuario'])) {
        if(strcasecmp($_COOKIE['usuario'], "jaime@gmail.com") && strcasecmp($_COOKIE['usuario'], "juanma@gmail.com") && strcasecmp($_COOKIE['usuario'], "amparo@gmail.com")) {
            
        }
    }
 ?>
<!DOCTYPE html> 
<html lang="es"> 
<!-- La cabecera --> 
	<head> 
		<meta charset="UTF-8" /> 
		<meta name="generator" content="Sublime Text" /> 
		<meta name="author" content="Juanma y Jaime" /> 
		<meta name="keywords" content="HTML5, web, practica, diseño de apliccaciones web" /> 
		<meta name="description" content="Plantilla base de nuestra pagina creada con HTML5" /> 
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
		<title>PI-Pictures and Images</title> 
        <!-- ESTILO BASE -->
        <link rel="stylesheet" type="text/css" href="css/standard/index.css" title="Estilo principal" media="screen"/>
        <link rel="stylesheet" type="text/css" href="css/standard/detalle_imagen.css" title="Estilo principal" media="screen"/>
        <!-- ESTILO ACCESIBLE -->
        <link rel="stylesheet" type="text/css" href="css/accesible/index.css" title="Estilo accesible" media="screen"/>
        <link rel="stylesheet" type="text/css" href="css/accesible/detalle_imagen.css" title="Estilo accesible" media="screen"/>
        <!-- IMPRIMIR -->
        <link rel="stylesheet" type="text/css" href="css/imprimir.css" media="print"/>
	</head> 
    
<!-- El cuerpo --> 
	<body> 
		<?php include('inc/cabecera.php'); ?>
        <?php include('inc/nav.php'); ?>
        <br/ >

        <!-- Inicio sesión --> 
        <?php 
                if(empty($_COOKIE))  {
                    if(empty($_GET['err'])) {
                        include('inc/sesion.php'); 
                    }
                } 
            ?>
        
        <br />
        <br />
        <br />
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
 $sentencia = "SELECT * FROM fotos WHERE Fichero='".$_GET['img']."'"; 
 mysqli_query($link,"SET CHARACTER SET 'utf8'");
 mysqli_query($link,"SET SESSION collation_connection ='utf8_bin'");

 if(!($resultado = @mysqli_query($link, $sentencia))) { 
   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link); 
   echo '</p>'; 
   exit; 
 } 
$fila = mysqli_fetch_assoc($resultado);
 // Recorre el resultado y lo muestra en forma de tabla HTML 
   echo '<article class ="Imagen" >';
   echo '<h3>'. $fila['Titulo'] . '</h3>' ;  
   echo "<img src='".$fila['Fichero']."' alt='Imagen de ejemplo'>";
   echo '<p> Fecha: ' . $fila['Fecha'] . '</p>';

   $sentencia2 = "SELECT * FROM paises WHERE IdPais = '".$fila['Pais']."' ";
   if(!($resultado2 = @mysqli_query($link, $sentencia2))) {
    echo "<p> Error al ejecutar la sentencia SQL". mysqli_error($link);
    echo '</p>';
    exit;
   }
   $fila2 = mysqli_fetch_assoc($resultado2);
   echo '<p> Pais: ' . $fila2['NomPais'] . '</p>' ;

   $sentencia3 = "SELECT * FROM albumes WHERE IdAlbum = '".$fila['Album']."' ";
   if(!($resultado3 = @mysqli_query($link, $sentencia3))) {
    echo "<p> Error al ejecutar la sentencia SQL". mysqli_error($link);
    echo '</p>';
    exit;
   }
   $fila3 = mysqli_fetch_assoc($resultado3);
   echo "<p>Álbum: <a href='detalle_album.php?alb=".$fila['Album']."''>'".$fila3['Titulo']."'</a> </p>";
   echo '</article>'; 
 
 // Libera la memoria ocupada por el resultado 
 mysqli_free_result($resultado); 
 // Cierra la conexión 
 mysqli_close($link); 
?>

         <?php include('inc/footer.php'); ?>
        
	</body> 
    
</html>