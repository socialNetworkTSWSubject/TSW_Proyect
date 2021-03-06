﻿
<?php 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $solicitudes = $view->getVariable("solicitudes");
 $view->setVariable("title", "Flaboo -- Solicitudes");
?>

<div>
	<h1 class="txtsolicitudes"><?= i18n("Solicitudes pendientes")?></h1>
</div>

<?php foreach ($solicitudes as $solicitud): ?>
	<div class="solicitud">
		<img  class="usercomentario" src="assets/img/userb.jpg" alt="LogOut" height="50" width="50">
		<h2 class="nombresolicitud" ><?=$solicitud->getName()?></h2>
		<div class="botonessolicitud">
			<a href="index.php?controller=friends&action=aceptarAmistad&id=<?=$solicitud->getEmail()?>" ><button class="botonsolicitud"><?= i18n("Aceptar")?></button></a>
			<a href="index.php?controller=friends&action=rechazarAmistad&id=<?=$solicitud->getEmail()?>" ><button class="botonsolicitud"><?= i18n("Rechazar")?></button></a>
		</div>
	</div>
<?php endforeach; ?>
	