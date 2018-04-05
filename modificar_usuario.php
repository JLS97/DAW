<?php 
    if(isset($_COOKIE['usuario'])) {
       $nomusuario = $_COOKIE['usuario'];
       $sexousuario= $_COOKIE['sexousuario'];
       $nacimiento_usuario= $_COOKIE['nacimiento_usuario'];
       $ubicacion_usuario= $_COOKIE['ubicacion_usuario'];
       $idusuario = $_COOKIE['idusuario'];
    }
    else {
        header("Location: index.php?err=noreg");
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
        <link rel="stylesheet" type="text/css" href="css/standard/registro.css" title="Estilo principal" media="screen"/>
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
        
        
        <h3>Modificar el perfil:</h3>

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
 $sentencia = "SELECT * FROM usuarios WHERE NomUsuario='".$nomusuario."'";
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
   echo '<h3>'. "Datos personales" . '</h3>' ;  
   echo "<form action='actualiza.php' method='POST'><label for='nombre'>Nombre de usuario:<input id='nombre' name='nombre' type='text' value='".$fila['NomUsuario']."'></label>";
   echo "<label for='c'>Correo:<input id='c' type='text' name='c' value='".$fila['Email']."'></label>";
   echo "<label for='f'>Fecha de nacimiento:<input id='f' name='f' type='text' value='".$fila['FNacimiento']."'></label>";
   echo "<label for='cc'>Contraseña:<input id='cc' name='cc' type='password' value='".$fila['Clave']."'></label>";
   echo "<label for='ccc'>Repetir contraseña:<input id='ccc' name='ccc' type='password' value=''></label>";
   echo "<label for='ciuda'>Ciudad:<input id='ciuda' name='ciuda' type='text' value='".$fila['Ciudad']."'></label>";
   echo "<label for='pa'>Pais:<input id='pa' type='text' name='pa' value='".$fila['Pais']."'></label>";
   echo "<label for='s'>Sexo:<input id='s' type='text' name='s' value='".$fila['Sexo']."'></label>";
   echo "<label for='nombre'>Fecha de registro: <br>
   ".$fila['FRegistro']."</label>";

  echo "<label for='foto'>Foto de perfil: </label>
                       <input type='file' name='fichero' /><br/><br />";
  echo"</form>";

   echo "<label><input type='submit' value='Actualizar'></from><label>";
   echo "</article>";
 } 
 
 // Libera la memoria ocupada por el resultado 
 mysqli_free_result($resultado); 
 // Cierra la conexión 
 mysqli_close($link); 
?> 
   
         <?php include('inc/footer.php'); ?>
        
  </body> 
    
</html>