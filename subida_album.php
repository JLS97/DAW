
<?php 
    if(!isset($_COOKIE['usuario'])) {
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
            <link rel="stylesheet" type="text/css" href="css/standard/index.css"  title="Estilo principal" media="screen"/>
            <link rel="stylesheet" type="text/css" href="css/standard/confirmacion_solicitar_album.css" title="Estilo principal" media="screen"/>
            <!-- ESTILO ACCESIBLE -->
            <link rel="stylesheet" type="text/css" href="css/accesible/index.css"  title="Estilo accesible" media="screen"/>
            <link rel="stylesheet" type="text/css" href="css/accesible/confirmacion_solicitar_album.css" title="Estilo accesible" media="screen"/>
            <!-- IMPRIMIR -->
            <link rel="stylesheet" type="text/css" href="css/imprimir.css" media="print"/>
        </head> 

    <!-- El cuerpo --> 
    <body> 
          <?php include('inc/cabecera.php'); ?>

          <?php include('inc/nav.php'); ?>


        <?php 
                 // Recoge los datos del formulario 
                 $titulo = $_POST['nombrealbum'];  // text 
                 $descripcion = $_POST['descripcion'];     // text 
                 $fechacreacion = $_POST['creacion']; // date
                 $pais = $_POST['pais']; // text

                 $idusuario= (int)$_COOKIE['idusuario'];
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
                    
                 // Sentencia SQL: inserta un nuevo libro 
                // $sentencia = "INSERT INTO solicitudes VALUES ('$album', $nombre', '$titulo', '$adicional', '$mail', '$calle', "; 
                // $sentencia .= "$numcalle, $cpcalle, '$localidad', $telefono, '$color', $copias, $resolucion, $fechaentrega, $icolor, $fechaactual, $coste )";
                 
        
                    
                 $sentencia = "INSERT INTO albumes VALUES (NULL, '$titulo', '$descripcion', '$fechacreacion', '$pais', $idusuario)";
                
                 // Ejecuta la sentencia SQL 
                 if(!mysqli_query($link, $sentencia)) 
                   die("Error: no se pudo realizar la inserción"); 

                 echo 'Se ha insertado un nuevo album en la base de datos'; 

                 // Cierra la conexión con la base de datos 
                 mysqli_close($link); 

                //Volvemos al perfil
               // header("Location: ../menu_usuario_registrado.php");
        ?>
        
        
            
           <article class="datos_solicitud">
                  <h3>Datos del álbum creado:</h3>

                  <p>Título del álbum: <strong> <?php  if(!empty($_POST['nombrealbum'])){ echo  htmlspecialchars($_POST['nombrealbum']);} else{echo 'campo vacio';} ?></strong></p>
                  <p>Descripción del album: <strong><?php  if(!empty($_POST['descripcion'])){ echo  htmlspecialchars($_POST['descripcion']);} else{echo 'campo vacio';} ?></strong></p>
                  <p>Fecha de creación: <strong><?php  if(!empty($_POST['creacion'])){ echo  htmlspecialchars($_POST['creacion']);} else{echo 'campo vacio';} ?></strong></p>
                  
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

                         $sentencia2 = "SELECT * FROM paises WHERE IdPais = '".$_POST['pais']."' ";

                         if(!($resultado2 = @mysqli_query($link, $sentencia2))) {
                            echo "<p> Error al ejecutar la sentencia SQL". mysqli_error($link);
                            echo '</p>';
                            exit;
                           }

                        $fila2 = mysqli_fetch_assoc($resultado2);

                         echo "<p>País: <strong>". $fila2['NomPais']. "</strong></p>";

                          mysqli_close($link); 
                ?>
                
                  <form action="menu_usuario_registrado.php">
                       <h3><input type="submit" value="Ir a mi perfil" /></h3>
                  </form>
            </article>    

            <?php include('inc/footer.php'); ?> 
    </body> 
</html>