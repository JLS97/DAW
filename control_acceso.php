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

$email = $_GET['correo'];
$pas = $_GET['contraseña'];


$iniciado= false;



/* Comprobacion de credenciales */
while($fila = mysqli_fetch_assoc($resultado)){
        
        $op = $fila['Email'];
        $con = $fila['Clave'];

        if((strcasecmp($email,$op) == 0) && (strcasecmp($pas,$con) == 0) ) {
            //AUTOMATICO 
                    $iniciado=true;
                    //Comprobante de que se ha creado la cookie
                    if(!empty($_COOKIE['usuario'])) {  
                        header("Location: menu_usuario_registrado.php");
                        exit;
                    } 
                    else 
                    { 
                        setcookie('usuario', $fila['NomUsuario'], time() + 365 * 24 * 60 * 60);
                        if($fila['Sexo']) {
                            $sex = "Hombre";
                        }
                        else {
                            $sex = "Mujer";
                        }
                        setcookie('sexousuario', $sex, time() + 365 * 24 * 60 * 60);
                        setcookie('nacimiento_usuario', $fila['FNacimiento'], time() + 365 * 24 * 60 * 60);
                        setcookie('ubicacion_usuario', $fila['Ciudad'], time() + 365 * 24 * 60 * 60);
                        setcookie('idusuario', $fila['IdUsuario'], time() + 365 * 24 * 60 * 60);

                        if($_GET['recu'] == true) {
                            setcookie('recordar1',$op,time() +365*24*60*60);
                            setcookie('recordar2',$con,time() +365*24*60*60);
                        }

                        //setcookie('fecha_sesion', $datos[$i][6], time() + 365 * 24 * 60 * 60);

                       // header("Location: menu_usuario_registrado.php?sexo=Hombre&fnac=26/06/1997&vive=San Vicente, Alicante");
                        header("Location: menu_usuario_registrado.php");
                        exit;
                    } 
        }
}

if($iniciado == false) {
            header("Location: index.php?err=error"); 
            exit;
}

 // Libera la memoria ocupada por el resultado 
 mysqli_free_result($resultado); 
 // Cierra la conexión 
 mysqli_close($link); 
                 
?>