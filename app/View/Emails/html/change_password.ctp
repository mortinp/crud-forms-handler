<?php $urlDef = array('controller' => 'users', 'action' => 'change_password/' . $confirmation_code) ?>

<p>
    Este correo te llegó porque estás registrado en <em>YoTeLlevo</em> y quieres cambiar tu contraseña. Para cambiar tu contraseña, da click en  
    <a href='<?php echo $this->Html->url($urlDef, true) ?>'>
        <?php echo __('este enlace')?>
    </a>.
</p>

<p>Si este correo te llegó por error, simplemente bórralo y olvida lo ocurrido.</p>
<a href='<?php echo $this->Html->url($urlDef, true) ?>'>Da click aquí para cambiar tu contraseña</a>
