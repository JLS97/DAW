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
        <link rel="stylesheet" type="text/css" href="css/standard/perfil_usuario.css" title="Estilo principal" media="screen"/>
        <!-- ESTILO ACCESIBLE -->
        <link rel="stylesheet" type="text/css" href="css/accesible/index.css" title="Estilo accesible" media="screen"/>
        <link rel="stylesheet" type="text/css" href="css/accesible/perfil_usuario.css" title="Estilo accesible" media="screen"/>
        <!-- IMPRIMIR -->
        <link rel="stylesheet" type="text/css" href="css/imprimir.css" media="print"/>
    </head> 
    
<!-- El cuerpo --> 
    <body> 
        
        
        <?php include('inc/cabecera.php'); ?>
        <?php include('inc/nav.php'); ?>
        
        
        <article class="datos_personales">
            <h3>Mis datos personales</h3>


           <!-- <img src="images/prueba/avatar.png"  alt="Imagen prueba 1" width="200" height="150">     -->
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
                   echo "<img src='".$fila['Foto']."'  alt='Imagen prueba 1' width='200' height='150'>";
                 } 

                 // Libera la memoria ocupada por el resultado 
                 mysqli_free_result($resultado); 
                 // Cierra la conexión 
                 mysqli_close($link); 
             ?>

            <p><strong>Nombre de usuario: </strong> <?php if(!empty($nomusuario)) {echo htmlspecialchars($nomusuario);} ?></p>
            <p><strong>Sexo: </strong> <?php if(!empty($sexousuario)) {echo htmlspecialchars($sexousuario);} ?></p>
            <p><Strong>Nacido/a el: </Strong><?php if(!empty($nacimiento_usuario)) {echo htmlspecialchars($nacimiento_usuario);} ?></p>
            <p><strong>Vive en: </strong> <?php if(!empty($ubicacion_usuario)) {echo htmlspecialchars($ubicacion_usuario);} ?></p>
             <form action="modificar_usuario.php" class="modificar">
                <input type="submit" name="modificar" value="Modificar datos del perfil">
            </form>
         </article>

         <article class="opciones_album">
            <h3>Álbumes</h3>
             
             <p><a href="mis_albumes.php?user=<?php if(!empty($idusuario)) {echo htmlspecialchars($idusuario);} ?>">Ver mis álbumes</a></p>
             <p><a href="crear_album.php">Crear un nuevo álbum</a></p>
             <p><a href="anyadir_foto_album.php?user=<?php if(!empty($idusuario)) {echo htmlspecialchars($idusuario);} ?>">Añadir foto a álbum</a></p>
             <p><a href="solicitar_album.php">Solicitar un álbum</a></p>

         </article>
        
        <article class="salir_del_sistema">
            <h3>Salir del sistema</h3>
            <form action="index.php?err=fuera" method="GET">
                <input type="submit" value="CerrarSesión" name="sesionn" />
            </form>
            <form action="confirmar.php" method="POST">
                <input type="submit" value="Darme de baja"  name="sesion2" />
            </form>
            <?php //index.php?err=fuera ?>
        </article>
        
         <?php include('inc/footer.php'); ?>
        
    </body> 
    
</html>