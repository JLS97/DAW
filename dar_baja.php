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
                     $sentencia1 = "SELECT * FROM usuarios WHERE Clave ='".$_POST['contra']."'";
                     mysqli_query($link,"SET CHARACTER SET 'utf8'");
                     mysqli_query($link,"SET SESSION collation_connection ='utf8_bin'");

                     if(!($resultado1 = @mysqli_query($link, $sentencia1))) { 
                       echo "<p>Error al ejecutar la sentencia <b>$sentencia1</b>: " . mysqli_error($link); 
                       echo '</p>'; 
                       exit; 
                     } 

                     // Recorre el resultado y lo muestra en forma de tabla HTML 
                     while($fila1 = mysqli_fetch_assoc($resultado1)) {
                      	$contrase = $fila1['Clave'];
                     } 


	if(!empty($contrase)) {
    $sentencia2 = "DELETE FROM usuarios WHERE Clave ='".$_POST['contra']."'";
    if(!($resultado1 = @mysqli_query($link, $sentencia2))) { 
                       echo "<p>Error al ejecutar la sentencia <b>$sentencia1</b>: " . mysqli_error($link); 
                       echo '</p>'; 
                       exit; 
                     } 
		header("Location: index.php?err=fuera&sesionn=si");
		exit;
}
else {
	header("Location: confirmar.php?err=si");
		exit;
}

// Libera la memoria ocupada por el resultado 
                     mysqli_free_result($resultado1); 
                     // Cierra la conexión 
                     mysqli_close($link);
 ?>