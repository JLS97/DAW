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
        
        
        <h3>Resultado de búsqueda:</h3>

        <h3>Título: <?php  if(!empty($_GET['tit'])){ echo  htmlspecialchars($_GET['tit']);} else{echo ' ';} ?></h3>  
        <h3>Fecha entre: <?php if(!empty($_GET['fecha1'])) {echo htmlspecialchars($_GET['fecha1']);} else{ echo ' ';}?> y <?php if(!empty($_GET['fecha2'])) {echo htmlspecialchars($_GET['fecha2']);} else{ echo ' ';} ?></h3>
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

if($_GET['tit']!="'or'1'='1") {
if(!empty($_GET['tit']) || !empty($_GET['pa']) || !empty($_GET['fecha1']) || !empty($_GET['fecha2'])) {
$primera = false;
if(!empty($_GET['tit'])) {
 $sentenciatitulo = "WHERE titulo='".$_GET['tit']."' AND ";
 $primera = true;
}
else {
  $sentenciatitulo = " ";
}
if(!empty($_GET['pa'])) {
  if(!$primera) {
    $primera = true;
    $sentenciapais = " WHERE Pais = '".$_GET['pa']."' AND ";
  }
  else {
    $sentenciapais = "Pais = '".$_GET['pa']."' AND ";
  }
}
else {
  $sentenciapais = " ";
}
if(!empty($_GET['fecha1'])) {
  if(!$primera) {
    $sentenciafecha1 = "WHERE Fecha > '".$_GET['fecha1']."' AND ";
    $primera = true;
  }
  else {
    $sentenciafecha1 = " Fecha > '".$_GET['fecha1']."' AND ";
  }
}
else {
  $sentenciafecha1 = " ";
}
if(!empty($_GET['fecha2'])) {
  if(!$primera) {
    $sentenciafecha2 = "WHERE Fecha < '".$_GET['fecha2']."'";
    $primera = true;
  }
  else {
    $sentenciafecha2 = "Fecha < '".$_GET['fecha2']."'";
  }
}
else {
  $sentenciafecha2 = " 1=1";
}
$sentencia = "SELECT * FROM fotos " .$sentenciatitulo. $sentenciapais. $sentenciafecha1. $sentenciafecha2;
}
else {
  $sentencia = "SELECT * FROM fotos ORDER BY FRegistro desc";
}



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
   echo '</article>'; 
 }
  // Libera la memoria ocupada por el resultado 
 mysqli_free_result($resultado); 
 // Cierra la conexión 
 mysqli_close($link);  
}
else {
  echo "<h1>POR FAVOR NO HAGAS ESO.</h1>";
}
?> 
   
         <?php include('inc/footer.php'); ?>
        
	</body> 
    
</html>