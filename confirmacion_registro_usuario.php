
<?php 
    if(!empty($_GET['nombre']) && !empty($_GET['mail']) && !empty($_GET['sexo']) && !empty($_GET['pais']) && !empty($_GET['fecha']) && !empty($_GET['ciudad']) && !empty($_GET['foto']) && !empty($_GET['contra']) && !empty($_GET['contra2'])) {
      header("Location: registro_usuario.php?err=falta");
      exit;
    }
    else {
      $mal=false;
      if(!nombreCorrecto($_GET['nombre'])) {
        $err1="&err1=".$_GET['nombre'];
        $mal=true;
      }
      if(!mailCorrecto($_GET['mail'])) {
        $err2="&err2=".$_GET['mail'];
        $mal = true;
      }
      if(!contraseñaCorrecta($_GET['contra'])) {
        $err3="&err3=".$_GET['contra'];
        $mal = true;
      }
      if(!fechaValida($_GET['fecha'])) {
        $err4="&err4=".$_GET['fecha'];
        $mal = true;
      }
      if(!coinciden($_GET['contra'],$_GET['contra2'])) {
          $err5="&err5=".$_GET['contra'];
          $mal = true;
      }

      if($mal==true) {  //algun dato esta mal
        $pno="&nom=".$_GET['nombre'];
        $pmail="&ma=".$_GET['mail'];
        $ccc="&contra=".$_GET['contra2'];
        $fe="&fec=".$_GET['fecha'];
        $ciudaddd="&ciu=".$_GET['ciudad'];
        $concatena = "Location: registro_usuario.php?".$err1.$err2.$err3.$err4.$err5.$pno.$pmail.$ccc.$fe.$ciudaddd;
        header($concatena);
        exit;
      }
      else if($mal==false) { //todos los datos son correctos y se puede realizar la inserccion
        $link = @mysqli_connect( 
                     'localhost',   // El servidor 
                     'root',    // El usuario 
                     '',        // La contraseña 
                     'pibd');
        if(!$link) { 
               echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error(); 
               echo '</p>'; 
               exit; 
             }
             $sinfoto="Sin foto";
              $n = $_GET['nombre'];
              $c = $_GET['contra'];
              $m = $_GET['mail'];
              $s = $_GET['sexo'];
              $f = $_GET['fecha'];
              $cc = $_GET['ciudad'];
              $p = $_GET['pais'];
              $no = "sin foto";

              $sentencia = "INSERT INTO usuarios VALUES (NULL, '$n', '$c', '$m', $s, '$f', '$cc', '$p', '$no',CURRENT_TIMESTAMP)";
             mysqli_query($link,"SET CHARACTER SET 'utf8'");
             mysqli_query($link,"SET SESSION collation_connection ='utf8_bin'"); 
             if(!($resultado = @mysqli_query($link, $sentencia))) { 
                  echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link); 
                  echo '</p>'; 
                  exit; 
              }
              else {
                $pno="&pno=".$_GET['nombre'];
                $pmail="&pmail=".$_GET['mail'];
                $ccc="&ccc=".$_GET['contra2'];
                $fe="&fe=".$_GET['fecha'];
                $ciu="&ciu=".$_GET['ciudad'];
                $sexo="&sexo=".$_GET['sexo'];
                $pais="&pais=".$_GET['pais'];
                $sen="Location: usuario_confirmado.php?".$pno.$pmail.$ccc.$fe.$ciu.$sexo.$pais;
                header($sen);
                exit;
              } 

// Libera la memoria ocupada por el resultado 
 mysqli_free_result($resultado); 
 // Cierra la conexión 
 mysqli_close($link); 
      }


    }

    function nombreCorrecto($nom) {
     return preg_match("/^[A-Za-z]{3,15}+$/", $nom);
    }

    function mailCorrecto($mail) {
      return filter_var($mail, FILTER_VALIDATE_EMAIL);
    }

    function contraseñaCorrecta($con) {
     if(preg_match("/^[_A-Za-z0-9]{6,15}+$/", $con) && preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/", $con)) {
          return true;
      }
      else {
        return false;
      }
    }

    function fechaValida($fe) {

      $D   = date('d',$time);
      $M = date('m',$time);
      $A  = date('Y',$time);

      if(checkdate($M, $D, $A)) {
        return true;
      }
      else {
        return false;
      }
    }

    function coinciden($con1,$con2) {
      if(strcmp($con1, $con2) !== 0) {
        return false;
      }
      else{
        return true;
      }
    }


 ?>

