<form action="control_acceso.php" method="GET">


           <fieldset class="registro">
           <legend>¿Estás ya registrado?</legend>
           <label for="correo">Correo electrónico: </label><input type="email" id="correo" name="correo" placeholder="example@email.com" value="
              <?php 
                if(!empty($_GET['err'])) {
                  if($_GET['err'] == 'fuera') {
                    echo htmlspecialchars(" ");
                  }
                }
                if(!empty($_COOKIE['recordar1'])) { 
                  echo htmlspecialchars($_COOKIE['recordar1']);
                }
              ?>" 
            required>
           <br />
           <label>Contraseña: </label><input type="password" name="contraseña" value="<?php if(!empty($_COOKIE['recordar2'])) echo htmlspecialchars($_COOKIE['recordar2']); ?>" required>
            <br />
            <label for="recuerda">Recuerdame en el equipo: </label>
               <input type="checkbox" id="recuerda" name="recu" 
               <?php 
                  if(!empty($_COOKIE['recordar2'])) 
                    echo htmlspecialchars("checked"); 
               ?>
               >
            <br/>
                
               
            <input type="submit" value="Iniciar Sesión" class="centrado"/>
                
            </fieldset>
  </form>
