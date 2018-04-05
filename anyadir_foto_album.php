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
		<link rel="stylesheet" type="text/css" href="css/standard/index.css"  title="Estilo principal" media="screen"/>
		<link rel="stylesheet" type="text/css" href="css/standard/registro.css" title="Estilo principal" media="screen"/>
        <!-- ESTILO ACCESIBLE -->
        <link rel="stylesheet" type="text/css" href="css/accesible/index.css"  title="Estilo accesible" media="screen"/>
		<link rel="stylesheet" type="text/css" href="css/accesible/registro.css" title="Estilo accesible" media="screen"/>
        <!-- IMPRIMIR -->
        <link rel="stylesheet" type="text/css" href="css/imprimir/imprimir.css" media="print"/>
	</head> 
    
<!-- El cuerpo --> 
	<body> 
		<?php include('inc/cabecera.php'); ?>
		<?php include('inc/nav.php'); ?>

           

        <form action="subida_foto_album.php" method="POST"  enctype="multipart/form-data">
        <fieldset>
        	<legend>Completa el siguiente formulario:  </legend>
            
		<label for="titulo">Título de la imagen:</label> <input type="text" name="titulo" id="nombreUsu" name="nombre" required><br />
        
        <label for='descripcion'>Descripción: </label><textarea id="adicional" name="descripcion" placeholder="dedicatoria, texto adicional, etc" class="separa" ></textarea><br />

        <label for="fecha">Fecha de creación:</label> <input type="date" name="fecha" id="fecha" step="1" min="1901-01-01" max="2018-12-31" value="1999-01-01" name="fecha" required><br />
            
        <!--OBTENEMOS PAISES DE LA BASE DE DATOS -->
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
             $sentencia = 'SELECT * FROM paises'; 
             mysqli_query($link,"SET CHARACTER SET 'utf8'");
             mysqli_query($link,"SET SESSION collation_connection ='utf8_bin'");
             if(!($resultado = @mysqli_query($link, $sentencia))) { 
               echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link); 
               echo '</p>'; 
               exit; 
             } 
             
             echo '<label for="pais" class= "este">País:</label>';
             echo '<select id="pais" name="pais" size="1">';
            
                // Recorre el resultado y lo muestra en forma de tabla HTML 
                while($fila = mysqli_fetch_assoc($resultado)) { 
                    echo '<option value=' . $fila['IdPais'] . '>' . $fila['NomPais'] . '</option>';
                }
            echo '</select> <br />';

             // Libera la memoria ocupada por el resultado 
             mysqli_free_result($resultado); 
             // Cierra la conexión 
             mysqli_close($link); 
        ?>     
            <!--FIN OBTENER PAISES -->  

            
            
            
            <label for='foto'>Seleccionar imagen: </label>
            <!-- Subir archivo -->
            <input type="file" id="foto" name="foto"/><br/><br />
        
            
            
            <!--OBTENEMOS ALBUMES DE LA BASE DE DATOS -->
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
                 $sentencia = "SELECT * FROM albumes WHERE usuario ='".$_GET['user']."'"; 
                 if(!($resultado = @mysqli_query($link, $sentencia))) { 
                   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link); 
                   echo '</p>'; 
                   exit; 
                 } 

                 echo '<label for="album" class= "este">Álbum:</label>';
                 echo '<select id="album" name="album" size="1">';

                    // Recorre el resultado y lo muestra en forma de tabla HTML 
                    while($fila = mysqli_fetch_assoc($resultado)) { 
                        echo '<option value=' . $fila['IdAlbum'] . '>' . $fila['Titulo'] . '</option>';
                    }
                echo '</select> <br />';

                 // Libera la memoria ocupada por el resultado 
                 mysqli_free_result($resultado); 
                 // Cierra la conexión 
                 mysqli_close($link); 
            ?>     
            <!--FIN OBTENER PAISES -->  
            
            <input type="submit" value="Subir Imagen" id="enviar"> 
            
        </fieldset>
        </form>
        
        
         <?php include('inc/footer.php'); ?>
        
	</body> 
    
</html>