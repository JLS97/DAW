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

           

        <form action="confirmacion_registro_usuario.php" method="GET"  enctype="multipart/form-data">
        <fieldset>
        	<legend>Completa el siguiente formulario:  </legend>
		<label for="nombreUsu">Nombre de usuario:</label> <input type="text" id="nombreUsu" name="nombre" value="<?php  if(!empty($_GET['nom'])){ echo  htmlspecialchars($_GET['nom']);} else{echo ' ';} ?>" required><br />
		<label for="contraseña">Contraseña:</label> <input type="password" id="contraseña" name="contra" value="<?php  if(!empty($_GET['contra'])){ echo  htmlspecialchars($_GET['contra']);} else{echo '';} ?>" required maxlength="15" minlength="6"><br />
		<label for="contraseña2">Repetir contraseña: </label><input type="password" id="contraseña2" name="contra2" value="<?php  if(!empty($_GET['ccc'])){ echo  htmlspecialchars($_GET['ccc']);} else{echo '';} ?>" required maxlength="15" minlength="6"><br />
		<label for="mail">E-mail:</label><input type="email" id="mail" placeholder="example@email.com" value="<?php  if(!empty($_GET['ma'])){ echo  htmlspecialchars($_GET['ma']);} else{echo ' ';} ?>" name="mail" required><br />
    
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
             $sentencia = 'SELECT * FROM usuarios';
             mysqli_query($link,"SET CHARACTER SET 'utf8'");
             mysqli_query($link,"SET SESSION collation_connection ='utf8_bin'"); 
             if(!($resultado = @mysqli_query($link, $sentencia))) { 
               echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link); 
               echo '</p>'; 
               exit; 
             } 
             
             echo '<label for="sexo" class= "este">Sexo:</label>';
             echo '<select id="sexo" name="sexo" size="1">';
            
                // Recorre el resultado y lo muestra en forma de tabla HTML 
                while($fila = mysqli_fetch_assoc($resultado)) { 
                    if($fila['Sexo']=='1'){
                        $sex="Hombre";
                    }
                    else{
                        $sex="Mujer";
                        echo ''.$fila['Sexo'].'';
                    }
                    echo '<option value=' . $fila['Sexo'] . '>' . $sex . '</option>';
                }
                
            echo '</select> <br />';

             // Libera la memoria ocupada por el resultado 
             mysqli_free_result($resultado); 
             // Cierra la conexión 
             mysqli_close($link); 
        ?> 
		<label for="nacimiento">Fecha de nacimiento:</label> <input type="date" id="nacimiento" step="1" min="1901-01-01" max="2018-12-31"  value="<?php  if(!empty($_GET['fec'])){ echo  htmlspecialchars($_GET['fec']);} else{echo '1999-01-01';} ?>" name="fecha" required><br />
            
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
                    echo '<option value=' . $fila['NomPais'] . '>' . $fila['NomPais'] . '</option>';
                }
            echo '</select> <br />';

             // Libera la memoria ocupada por el resultado 
             mysqli_free_result($resultado); 
             // Cierra la conexión 
             mysqli_close($link); 
        ?>     
<!--FIN OBTENER PAISES -->  
            

		<label for="ciudad">Ciudad: </label><input type="text" id="ciudad" value="<?php  if(!empty($_GET['ciu'])){ echo  htmlspecialchars($_GET['ciu']);} else{echo '';} ?>" name="ciudad" required><br />

            <?php  

            if(isset($_GET['err1']) || isset($_GET['err2']) || isset($_GET['err3']) || isset($_GET['err4']) || isset($_GET['err5'])) {
                echo "<h3>Error en los siguientes campos: </h3>";
                if(!empty($_GET['err1'])) {
                    echo "<h4>-Nombre no valido.(Debe tener entre 3 y 15 caracteres.)</h4>";
                }
                if(!empty($_GET['err2'])) {
                    echo "<h4>-Email no valido</h4>";
                }
                if(!empty($_GET['err3'])) {
                    echo "<h4>-Contraseña no valida(Debe contener una mayuscula y un numero minimo.)</h4>";
                }
                if(!empty($_GET['err4'])) {
                    echo "<h4>-Fecha de nacimiento invalida.</h4>";
                }
                if(!empty($_GET['err5'])) {
                    echo "<h4>-Las contraseñas no coinciden</h4>";
                }
            }

            ?>
            <input type="submit" value="Registrarse" id="enviar">
        </fieldset>
        </form>
        
        
         <?php include('inc/footer.php'); ?>
        
	</body> 
    
</html>