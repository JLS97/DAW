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
		<link rel="stylesheet" type="text/css" href="css/standard/busqueda.css" title="Estilo principal" media="screen"/>
        <!-- ESTILO ACCESIBLE -->
        <link rel="stylesheet" type="text/css" href="css/accesible/index.css" title="Estilo accesible" media="screen"/>
        <link rel="stylesheet" type="text/css" href="css/accesible/busqueda.css" title="Estilo accesible" media="screen"/>
        <!-- IMPRIMIR -->
        <link rel="stylesheet" type="text/css" href="css/imprimir.css" media="print"/>
	</head> 
    
<!-- El cuerpo --> 
	<body> 
		<?php include('inc/cabecera.php'); ?>

		<?php include('inc/nav.php'); ?>

		<form action="resultado_busqueda.php" id="form1" method="get"> 
			<fieldset> 
				<legend>Buscar: </legend> 
						<label for="titulo" class="este">Título:</label> 
								<input type="text" id="titulo" name="tit"/> 
						<br /> 
                
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
             echo '<select id"pais" name="pa" size="1">';
             echo '<option> </option>';
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
                
                <br />
				<label for="fecha1" class="fecha">Fecha entre:
					<input type="date" id="fecha1" step="1" min="1901-01-01" max="2018-12-31" value="" name="fecha1"> 
				</label>
				<label for="fecha2" id="y">y :
				<input type="date" id="fecha2" step="1" min="1901-01-01" max="2018-12-31" value="" name="fecha2">
				</label> <br /> 
				<input type="submit" value="Enviar" class="centrado" /> 
			</fieldset> 
		</form> 
        
        <?php include('inc/footer.php'); ?>
        
	</body> 
    
</html>