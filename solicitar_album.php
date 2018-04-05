
<?php 
    if(!isset($_COOKIE['usuario'])) {
        header("Location: index.php?err=noreg");
        exit;
    }
 ?>

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
            <link rel="stylesheet" type="text/css" href="css/standard/solicitar_album.css" title="Estilo principal" media="screen"/>
            <!-- ESTILO ACCESIBLE -->
            <link rel="stylesheet" type="text/css" href="css/accesible/index.css" title="Estilo accesible" media="screen" />
            <link rel="stylesheet" type="text/css" href="css/accesible/solicitar_album.css" title="Estilo accesible" media="screen"/>
            <!-- IMPRIMIR -->
            <link rel="stylesheet" type="text/css" href="css/imprimir/imprimir.css" media="print"/>
        </head> 

    <!-- El cuerpo --> 
    <body> 
        <?php include('inc/cabecera.php'); ?>
        <?php include('inc/nav.php'); ?>
        
        <article class="explicacion">
          <h2>Solicitud:</h2>
          <p>Mediante esta opción puedes <strong>solicitar tu álbum impreso</strong>. A todo color y con la maxima resolución, a tu gusto
          y totalmente personalizable.</p>
          <p>A continuación rellena el siguiente formulario con los datos pedidos y personalízalo a tu gusto. El álbum tiene un tiempo estimado de entrega de <strong>entre 5 y 10 días laborables</strong>. Puede ser enviado por <strong>correo urgente con un coste adicional</strong>. No se admiten devoluciones de los álbumes. Si te equivocas a la hora de enviar el formulario o deseas cambiar algo ponte en contacto con nuestro equipo de atención al cliente. Muchas gracias por solicitar tu álbum y esperemos que lo disfrutes.</p>
        </article>
        
         <aside>
          <table> <!-- border="1"-->
              <caption><h3>Tarifas</h3></caption>
            <tr>
              <th><strong>Concepto</strong></th>
              <th><strong>Tarifas</strong></th>
            </tr>
            <tr>
              <td>- de 5 páginas</td>
              <td>0.10€ por página</td>
            </tr>
            <tr>
              <td>Entre 5 y 10</td>
              <td>0.08€ por página</td>
            </tr>
            <tr>
              <td>+ de 11 páginas</td>
              <td>0.06€ por página</td>
            </tr>
            <tr>
              <td>Blanco y negro</td>
              <td>0€</td>
            </tr>
            <tr>
              <td>En color</td>
              <td>0.10€ por fotografía</td>
            </tr>
            <tr>
              <td>Máxima resolución</td>
              <td>0.05€ por fotografía</td>
            </tr>
          </table>
        </aside>

        <form action="confirmacion_solicitar_album.php" method="get">
          <fieldset>
          <legend><h2>Formulario:</h2></legend>
          <p>Rellena los siguientes datos:</p>
          <p>*Campos obligatorios</p>
          <label for='nombre'>*Nombre: </label><input type="text" id="nombre"  name="nombre" required class="separa"><br />
          <label for='titulo'>*Título del album: </label><input type="text" id="titulo" name="titulo" required class="separa"><br />
          <label for='adicional'>Texto adicional: </label><textarea id="adicional" name="adicional" placeholder="dedicatoria, texto adicional, etc" class="separa" ></textarea><br />
          <label for='mail'>*E-mail: </label><input type="email" id="mail" name="mail" placeholder="example@email.com" required class="separa"><br />
          <label for='calle'>*Dirección: </label><input type="text" id="calle" name="calle" placeholder="Calle" class="lado" required><input type="text" id="numcalle" name="numcalle" placeholder="Número" class="lado" required><input type="number" class="lado" placeholder="C.P." id="cpcalle" name="cpcalle" required><input type="text" name="localidad" id="localidad" name="localidad" class="lado" placeholder="Localidad" required>

          <select id="provincia" name="provincia" class="lado" size="1">
            <option value='A Coruña' >A Coruña</option>
            <option value='álava'>Álava</option>
            <option value='Albacete' >Albacete</option>
            <option value='Alicante' selected="selected">Alicante</option>
            <option value='Almería' >Almería</option>
            <option value='Asturias' >Asturias</option>
            <option value='Ávila' >Ávila</option>
            <option value='Badajoz' >Badajoz</option>
            <option value='Barcelona'>Barcelona</option>
            <option value='Burgos' >Burgos</option>
            <option value='Cáceres' >Cáceres</option>
            <option value='Cádiz' >Cádiz</option>
            <option value='Cantabria' >Cantabria</option>
            <option value='Castellón' >Castellón</option>
            <option value='Ceuta' >Ceuta</option>
            <option value='Ciudad Real' >Ciudad Real</option>
            <option value='Córdoba' >Córdoba</option>
            <option value='Cuenca' >Cuenca</option>
            <option value='Gerona' >Gerona</option>
            <option value='Girona' >Girona</option>
            <option value='Las Palmas' >Las Palmas</option>
            <option value='Granada' >Granada</option>
            <option value='Guadalajara' >Guadalajara</option>
            <option value='Guipúzcoa' >Guipúzcoa</option>
            <option value='Huelva' >Huelva</option>
            <option value='Huesca' >Huesca</option>
            <option value='Jaén' >Jaén</option>
            <option value='La Rioja' >La Rioja</option>
            <option value='León' >León</option>
            <option value='Lleida' >Lleida</option>
            <option value='Lugo' >Lugo</option>
            <option value='Madrid' >Madrid</option>
            <option value='Malaga' >Málaga</option>
            <option value='Mallorca' >Mallorca</option>
            <option value='Melilla' >Melilla</option>
            <option value='Murcia' >Murcia</option>
            <option value='Navarra' >Navarra</option>
            <option value='Orense' >Orense</option>
            <option value='Palencia' >Palencia</option>
            <option value='Pontevedra'>Pontevedra</option>
            <option value='Salamanca'>Salamanca</option>
            <option value='Segovia' >Segovia</option>
            <option value='Sevilla' >Sevilla</option>
            <option value='Soria' >Soria</option>
            <option value='Tarragona' >Tarragona</option>
            <option value='Tenerife' >Tenerife</option>
            <option value='Teruel' >Teruel</option>
            <option value='Toledo' >Toledo</option>
            <option value='Valencia' >Valencia</option>
            <option value='Valladolid' >Valladolid</option>
            <option value='Vizcaya' >Vizcaya</option>
            <option value='Zamora' >Zamora</option>
            <option value='Zaragoza'>Zaragoza</option>
          </select>
         <br />
         <label for='telefono'>*Teléfono de contacto:</label> <input type="tel" id="telefono" name="telefono" maxlength="9" placeholder="### ### ###" required class="separa"><br />
         <label for='color'>Color de portada:</label><input type="color" id="color" name="color"><br />
         <label for='copias'>Numero de copias: </label>
          <input id='copias' name="copias" type="number">
        <br />
         <label for='resolucion'> Resolución: </label>
          <select id='resolucion' name="resolucion">
            <option >150dpi</option>
            <option>300dpi</option>
            <option selected="selected">600dpi</option>
            <option>1200dpi</option>
          </select>
         <br />
         
          
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


         <br />
          <label for="fecha">*Fecha de recepción del album: </label><input type="date" id="fecha" name="fecha" required><br />
         <p>¿Impresión a color?</p>
         <label for='si'>Si</label>
              <input name="opcion" type="radio" id="si" value="1" ><br />
          <label for="no">No</label>
              <input name="opcion" type="radio" id="no" value="0" checked/><br />
            <input type="submit" value="Solicitar" class="soliciar"/>
              
            
          </fieldset>
        </form>
         
       
        <?php include('inc/footer.php'); ?>
            
    </body> 
</html>