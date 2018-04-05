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
        <br>
        <br>
        <br>
        <article><h3>Si te das de baja todos tus datos se borraran.</h3></article>
        <form method="POST" action="dar_baja.php">
        <label for="hola"><h3>Inserta la <strong>contraseña</strong> para poder darte de baja: </h3><input id="hola" type="password" name="contra" class="contr"></label>
        <input type="submit" value="Darme de baja" name="sesionn" />
        </form>
        <br>
        <br>
        <br>


        <?php 

        if(!empty($_GET['err'])){
            echo "<h3>Contraseña incorrecta.</h3>";
        }

        ?>

        <label><h3>¿No estas seguro?</h3></label>
        <br>
        <br>
        
        <form class="boton2" action="menu_usuario_registrado.php" method="POST">
                <input type="submit" value="Cancelar" name="sesionn" />
        </form>
        <br>
        <br>
        <br>



         <?php include('inc/footer.php'); ?>
        
    </body> 
    
</html>