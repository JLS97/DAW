
<?php 
	
	if(!empty($_COOKIE['fecha_sesion'])) {
		$_anterior = $_COOKIE['fecha_sesion'];
	}
	else {
		$_anterior = "Primera visita       ";
	}

 ?>

<form>
<fieldset class="registro">

           <label><strong>Bienvenido:</strong> <?php if(!empty($_COOKIE['usuario'])) {echo htmlspecialchars($_COOKIE['usuario']);} ?></label>
           <br />
    <!-- Mostramos -->
           <label><strong>Su última visita fue el:</strong><br /> <?php echo substr( htmlspecialchars($_anterior), 0, -6) ;?></label>
           <br />
    
</fieldset>
</form>