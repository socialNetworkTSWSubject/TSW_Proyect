﻿
<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $solicitudes = $view->getVariable("solicitudes");
?>

<div>
	<h1 class="txtsolicitudes">Solicitudes pendientes</h1>
</div>

<?php foreach ($solicitudes as $solicitud): ?>
	<div class="solicitud">
		<img  class="usercomentario" src="assets/img/userb.jpg" alt="LogOut" height="50" width="50">
		<h2 class="nombresolicitud" ><?=$solicitud->getName()?></h2>
		<div class="botonessolicitud">
			<button class="botonsolicitud">Aceptar</button>
			<button class="botonsolicitud">Rechazar</button>
		</div>
	</div>
<?php endforeach; ?>

<div class="vermas">Ver más</div>
	