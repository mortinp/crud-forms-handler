<?php $urlDef = array('controller' => 'users', 'action' => 'confirm_email/' . $confirmation_code) ?>
<h4>Hola y bienvenido a <em>YoTeLlevo</em>. <small>Ahora te será mucho más fácil viajar en Cuba.</small></h4>

<p>
    Ya puedes comenzar a crear viajes en <em>YoTeLlevo</em>. Podrás crear 1 anuncio de viaje
    sin verificar tu cuenta de correo electrónico, pero tendrás que verificarla para crear más anuncios.
</p>
<p> 
    Para verficar tu cuenta, da click en <a href='<?php echo $this->Html->url($urlDef, true) ?>'>este enlace</a>.
</p>

<p>Si este correo te llegó por error, simplemente bórralo y olvida lo ocurrido.</p>
<a href='<?php echo $this->Html->url($urlDef, true) ?>'>Da click aquí para verificar tu cuenta</a>
