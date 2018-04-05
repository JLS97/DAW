<!DOCTYPE html> 
<html lang="es"> 
<head> 
<meta charset="utf-8" /> 
<title>Prueba de INSERT y MySQL</title> 
</head> 
<body> 
<p> 
<?php 
 // Recoge los datos del formulario 
 $nombre = $_POST['nombre'];  
 $correo = $_POST['c'];  
 $fechaNacimiento = $_POST['f']; 
 $contraseña1 = $_POST['cc'];  
 $contraseña2 = $_POST['ccc'];  
 $ciudad = $_POST['ciuda']; 
 $pais = $_POST['pa'];
 $sexo = $_POST['s'];      
 
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

  move_uploaded_file($_FILES["fichero"]["tmp_name"], 
                                "images/foto_perfil/" . $_FILES["fichero"]["name"]); 
                  echo "Almacenado en: " . "images/foto_perfil/" . $_FILES["fichero"]["name"]; 
 

 $path = "images/foto_perfil/" . $_FILES['fichero']['name'];


 // Sentencia SQL: inserta un nuevo libro 
 $sentencia = "UPDATE usuarios SET NomUsuario='".$nombre."', Clave='".$contraseña1."', Email='".$correo."', Sexo='".$sexo."' ,Ciudad='".$ciudad."', Pais='".$pais."', FNacimiento='".$fechaNacimiento."', Foto='".$path."' WHERE IdUsuario='".$_COOKIE['idusuario']."'";
 


 // Ejecuta la sentencia SQL 
 if(!mysqli_query($link, $sentencia)) {
   die("Error: no se pudo realizar la inserción");
   header("Location: modificar_usuario.php");
   exit;
 } 
 else {
 	 header("Location: menu_usuario_registrado.php");
 	 exit; 
 }
 
 // Cierra la conexión 
 mysqli_close($link); 
?> 
</p> 
</body> 
</html>