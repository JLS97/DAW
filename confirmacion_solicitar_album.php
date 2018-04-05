
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
          
          <article class="explicacion">
              <h3>Confirmación de solicitud de impresión de álbum</h3>
              <p>Vamos a enseñarte de nuevo tu pedido para que confirmes que no hay ningún dato erróneo. Tómate el tiempo que necesites para comprobarlo.</p>
              <p>Recuerda que el álbum tiene un tiempo estimado de entrega de <strong>entre 5 y 10 días laborables</strong>. Puede ser enviado por <strong>correo urgente con un coste adicional</strong>. No se admiten devoluciones de los álbumes. Si te equivocas a la hora de enviar el formulario o deseas cambiar algo ponte en contacto con nuestro equipo de atención al cliente. Muchas gracias por solicitar tu álbum y esperemos que lo disfrutes.</p>
          </article>    
        
        <!-- Comprobacion y saneamiento de los parametros -->
        
        <?php 
                 // Recoge los datos del formulario 
                 $nombre = $_GET['nombre'];    // text 
                 $titulo = $_GET['titulo'];  // text 
                 $adicional = $_GET['adicional'];     // text 
                 $mail = $_GET['mail']; // text

                 
                 $direccion= $_GET['calle']. "  " . $_GET['numcalle']. "  " . $_GET['cpcalle']. "  " . $_GET['localidad']. "  ". $_GET['opcion']; //text

                 $telefono = $_GET['telefono'];    // int
                 $color=  $_GET['color'];
                 $copias = $_GET['copias'];    // int
                 $resolucion = (int) substr($_GET['resolucion'], 0, -3);    // int
                 $album = $_GET['album'];    // text
                 $icolor = $_GET['opcion'];    // int
                 $fechaentrega = $_GET['fecha'];    // date
                 $coste = costeAlbum($_GET['copias'],$_GET['opcion'],$_GET['resolucion']);    // int
                 $fechaactual= date_default_timezone_get();
        
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
                 
        
                    
                 $sentencia = "INSERT INTO solicitudes VALUES (NULL, '3', '$nombre', '$titulo', '$adicional', '$mail', '$direccion', '$color', $copias, $resolucion, '$fechaentrega',
                               $icolor, CURRENT_TIMESTAMP, $coste)";
                
                 // Ejecuta la sentencia SQL 
                 if(!mysqli_query($link, $sentencia)) 
                   die("Error: no se pudo realizar la inserción"); 

                 echo 'Se ha insertado un nuevo libro en la base de datos'; 

                 // Cierra la conexión con la base de datos 
                 mysqli_close($link); 
        ?>
        
        
            
            <article class="datos_solicitud">
                  <h3>Datos de la solicitud</h3>

                  <p>Nombre: <strong> <?php  if(!empty($_GET['nombre'])){ echo  htmlspecialchars($_GET['nombre']);} else{echo 'campo vacio';} ?></strong></p>
                  <p>Título del album: <strong><?php  if(!empty($_GET['titulo'])){ echo  htmlspecialchars($_GET['titulo']);} else{echo 'campo vacio';} ?></strong></p>
                  <p>Texto adicional: <strong><?php  if(!empty($_GET['adicional'])){ echo  htmlspecialchars($_GET['adicional']);} else{echo 'campo vacio';} ?></strong></p>
                  <p>E-mail: <strong> <?php  if(!empty($_GET['mail'])){ echo  htmlspecialchars($_GET['mail']);} else{echo 'campo vacio';} ?> </strong></p>
                
                  <p>Dirección: <strong> <?php  if(!empty($_GET['calle'])){ echo  htmlspecialchars($_GET['calle']);} else{echo 'campo vacio';} ?> ,
                      <?php  if(!empty($_GET['numcalle'])){ echo  htmlspecialchars($_GET['numcalle']);} else{echo 'campo vacio';} ?>,
                      <?php  if(!empty($_GET['cpcalle'])){ echo  htmlspecialchars($_GET['cpcalle']);} else{echo 'campo vacio';} ?>,
                      <?php  if(!empty($_GET['localidad'])){ echo  htmlspecialchars($_GET['localidad']);} else{echo 'campo vacio';} ?>
                    
                      </strong>

                  </p>

                  <p>Teléfono de contacto: <strong> <?php  if(!empty($_GET['telefono'])){ echo  htmlspecialchars($_GET['telefono']);} else{echo 'campo vacio';} ?> </strong> </p>
                <p><label for='color'>Color de portada: </label><input type="color" id="color" name="color" 
                                                                       value="<?php  if(!empty($_GET['color'])){ echo  htmlspecialchars($_GET['color']);} else{echo 'campo vacio';} ?>"> </p>
                

                  <p>Numero de copias: <strong> <?php  if(!empty($_GET['copias'])){ echo  htmlspecialchars($_GET['copias']);} else{echo 'campo vacio';} ?> </strong></p>
                  <p>Resolución: <strong> <?php  if(!empty($_GET['resolucion'])){ echo  htmlspecialchars($_GET['resolucion']);} else{echo 'campo vacio';} ?> </strong></p>

                  <p>Álbum a solicitar: <strong> <?php  if(!empty($_GET['album'])){ echo  htmlspecialchars($_GET['album']);} else{echo 'campo vacio';} ?> </strong></p>
                  <p>¿Impresión a color? <strong> <?php  echo htmlspecialchars($_GET['opcion']); ?>  </strong></p>
                  <p>Fecha de entrega: <strong> <?php  if(!empty($_GET['fecha'])){ echo  htmlspecialchars($_GET['fecha']);} else{echo 'campo vacio';} ?> </strong></p>

                  <p> <?php echo "El album tiene un coste de <strong>". costeAlbum($_GET['copias'],$_GET['opcion'],$_GET['resolucion']) ." euros </strong>"; ?></p>

                  <p><strong>¡Recuerda comprobar todos los datos antes de hacer el pedido!</strong></p>
                  <form action="solicitar_album.php">
                       <h3><input type="submit" value="Quiero corregir algo" /></h3>
                  </form>
            </article> 
                
            <article class="confirmar">
                    <h3>Confirmar pedido</h3>
                    
                  <p>Fecha aproximada de recepción entre 5 y 10 días laborables despues del pedido.</p>

                  <form action="#">
                       <h3><input type="submit" value="Pedir álbum" /></h3>
                  </form>
            </article> 
                
                
        <?php include('inc/footer.php'); ?>
        <?php 
            function costeAlbum($copias, $opcion, $resolucion) {

            $fotografias = 15;
            $paginas = 10;

            $costepagina = $paginas * 0.10;
    
            if(strcmp($opcion, "0") == 0) {
              $costefoto = 0;
            }
            else {
              $costefoto = $fotografias * 0.05;
            }

            if(strcmp($resolucion, "600dpi") == 0 || strcmp($resolucion, "1200dpi") == 0) {
              $costeresolucion = $fotografias * 0.10;
            }
            else {
              $costeresolucion = 0;
            }

            $coste = $costepagina + $costefoto + $costeresolucion;

            if($copias > 1) {
            $coste = $coste * $copias;
            }

            return $coste ;
          }
      ?>
        
    </body> 
</html>