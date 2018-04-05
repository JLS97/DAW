<?php  

  if(!isset($_COOKIE['idusuario'])) {
    header("Location: menu_usuario_registrado.php");
        exit;
  }
  else if($_GET['user'] != $_COOKIE['idusuario']) {
    header("Location: menu_usuario_registrado.php");
        exit;
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
        <link rel="stylesheet" type="text/css" href="css/standard/imagenes.css" title="Estilo principal" media="screen"/>
        <!-- ESTILO ACCESIBLE -->
        <link rel="stylesheet" type="text/css" href="css/accesible/index.css" title="Estilo accesible" media="screen"/>
        <link rel="stylesheet" type="text/css" href="css/accesible/imagenes.css" title="Estilo accesible" media="screen"/>
        <!-- IMPRIMIR -->
        <link rel="stylesheet" type="text/css" href="css/imprimir/imprimir.css" media="print"/>
	</head> 
    
<!-- El cuerpo --> 
	<body> 
		<?php include('inc/cabecera.php'); ?>
        <?php include('inc/nav.php'); ?>
            

        <!-- Inicio sesión --> 
        <?php 
                if(empty($_COOKIE))  {
                    if(empty($_GET['err'])) {
                        include('inc/sesion.php'); 
                    }
                } 
            ?>
        
        
        <h3>Mis álbumes</h3>
        
         <!-- Mostrar los albumes -->
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
                     $sentencia1 = "SELECT * FROM albumes WHERE usuario ='".$_GET['user']."'";
                     mysqli_query($link,"SET CHARACTER SET 'utf8'");
                     mysqli_query($link,"SET SESSION collation_connection ='utf8_bin'");

                     if(!($resultado1 = @mysqli_query($link, $sentencia1))) { 
                       echo "<p>Error al ejecutar la sentencia <b>$sentencia1</b>: " . mysqli_error($link); 
                       echo '</p>'; 
                       exit; 
                     } 

                     // Recorre el resultado y lo muestra en forma de tabla HTML 
                     while($fila1 = mysqli_fetch_assoc($resultado1)) {
                        echo '<article class="Imagen">';
                        echo '<p>Nombre del Album : '.$fila1['Titulo'].'</p>';
                        echo '<p>Descripcion del album : '.$fila1['Descripcion'].'</p>';
                        echo '<p>Fecha de creacion del album : '.$fila1['Fecha'].'</p>';

                       
                       $sentencia2 = "SELECT * FROM paises WHERE IdPais = '".$fila1['Pais']."' ";
                       if(!($resultado2 = @mysqli_query($link, $sentencia2))) {
                        echo "<p> Error al ejecutar la sentencia SQL". mysqli_error($link);
                        echo '</p>';
                        exit;
                       }
                       $fila2 = mysqli_fetch_assoc($resultado2);
                       echo '<p> Pais:' . $fila2['NomPais'] . '</p>' ;
                       echo "<a href='detalle_album.php?alb=".$fila1['IdAlbum']."'>Ver Album</a>";
                       echo '</article>'; 
                     } 

                     // Libera la memoria ocupada por el resultado 
                     mysqli_free_result($resultado1); 
                     // Cierra la conexión 
                     mysqli_close($link); 
            ?> 

        
         <?php include('inc/footer.php'); ?>
        
	</body> 
    
</html>