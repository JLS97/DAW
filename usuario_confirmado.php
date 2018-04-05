
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

            <!-- Enlaces de base --> 
          <?php include('inc/nav.php'); ?>
          <br>
          <br>  
            
            <article class="datos_solicitud">
                  <h3>Se ha registrado el usuario con los siguientes datos:</h3>

                  <p>Nombre: <strong> <?php   echo  htmlspecialchars($_GET['pno']); ?> </strong></p>
                  <p>Email: <strong>  <?php  echo  htmlspecialchars($_GET['pmail']);?> </strong></p>
                  <p>Sexo: <strong>   <?php if($_GET['sexo']==1) {echo "Hombre";}else{echo"Mujer";}?></strong></p>
                  <p>Fecha de nacimiento: <strong>   <?php   echo  htmlspecialchars($_GET['fe']);?></strong></p>
                  <p>País: <strong>  <?php  echo  htmlspecialchars($_GET['pais']); ?> </strong> </p>
                  <p>Ciudad: <strong>  <?php echo  htmlspecialchars($_GET['ciu']);?> </strong></p>


                  
            
                  <form action="subida_fichero.php"  method="POST"  enctype="multipart/form-data">

                       <label for='foto'>Foto de perfil: </label>
                       <!-- Subir archivo -->
                       <input type="file" name="fichero" /><br/><br />
                       <h3><input type="submit" value="Confirmar" id="enviar" /></h3>

                  </form>
            </article> 
                
                
                
        <?php include('inc/footer.php'); ?>
            
    </body> 
</html>