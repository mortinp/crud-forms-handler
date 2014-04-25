<?php $urlDef = array('controller' => 'users', 'action' => 'confirm_email/' . $confirmation_code) ?>

<p>
    Este correo te llegó porque estás registrado en <em>YoTeLlevo</em>, y quieres verificar tu cuenta de correo electrónico 
    para poder seguir creando anuncios de viajes. Para verficar tu cuenta, da click en  
    <a href='<?php echo $this->Html->url($urlDef, true) ?>'>
        <?php echo __('este link')?>
    </a>.
</p>

<p><?php echo __('Si este correo te llegó por error, simplemente bórralo y olvida lo ocurrido')?>.</p>
<a href='<?php echo $this->Html->url($urlDef, true) ?>'>
    <?php echo __('Da click aquí para verificar tu cuenta')?>
</a>
