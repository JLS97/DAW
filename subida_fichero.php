<?php
//CODIGO RELACIONADO CON LA SUBIDA DEL FICHERO
               $msgError = array(0 => "No hay error, el fichero se subió con éxito", 
                             1 => "El tamaño del fichero supera la directiva 
                                 upload_max_filesize el php.ini", 
                             2 => "El tamaño del fichero supera la directiva 
                                 MAX_FILE_SIZE especificada en el formulario HTML", 
                             3 => "El fichero fue parcialmente subido", 
                             4 => "No se ha subido un fichero", 
                             6 => "No existe un directorio temporal", 
                             7 => "Fallo al escribir el fichero al disco", 
                             8 => "La subida del fichero fue detenida por la extensión"); 
               
               if($_FILES["fichero"]["error"] > 0){ 
                 echo "Error: " . $msgError[$_FILES["fichero"]["error"]] . "<br />"; 
               } 

               else{ 
                 echo "Nombre original: " . $_FILES["fichero"]["name"] . "<br />"; 
                 echo "Tipo: " . $_FILES["fichero"]["type"] . "<br />"; 
                 echo "Tamaño: " . ceil($_FILES["fichero"]["size"] / 1024) . " Kb<br />"; 
                 echo "Nombre temporal: " . $_FILES["fichero"]["tmp_name"] . "<br />"; 
               
                     if(file_exists("images/foto_perfil/" . $_FILES["fichero"]["name"])) { 
                      echo $_FILES["fichero"]["name"] . " ya existe"; 
                     } 
                 
      else{ 
                  move_uploaded_file($_FILES["fichero"]["tmp_name"], 
                                "images/foto_perfil/" . $_FILES["fichero"]["name"]); 
                  echo "Almacenado en: " . "images/foto_perfil/" . $_FILES["fichero"]["name"]; 


                  //HACEMOS EL UPDATE EN LA BASE DE DATOS
                  /*
                  UPDATE table_name
                  SET column1=value, column2=value2,...
                  WHERE some_column=some_value
                  */

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

                        $no = "sin foto";
                        $path = "images/foto_perfil/" . $_FILES['fichero']['name'];

                        //$sentencia = "INSERT INTO usuarios VALUES (NULL, '$n', '$c', '$m', $s, '$f', '$cc', '$p', '$no',CURRENT_TIMESTAMP)";
                        $sentencia = " UPDATE usuarios SET Foto='".$path."' WHERE Foto='".$no."' ";
                        
                        if(!($resultado = @mysqli_query($link, $sentencia))) { 
                             echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($link); 
                             echo '</p>'; 
                             exit; 
                         }

                       mysqli_query($link,"SET CHARACTER SET 'utf8'");
                       mysqli_query($link,"SET SESSION collation_connection ='utf8_bin'"); 

                      // Libera la memoria ocupada por el resultado 
                       mysqli_free_result($resultado); 
                       // Cierra la conexión 
                       mysqli_close($link); 


                 } 

                header('Location: index.php');
      } 
?>