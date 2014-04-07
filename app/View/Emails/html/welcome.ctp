<?php $urlDef = array('controller' => 'users', 'action' => 'authorize/' . $user_id) ?>
<p><?php echo __('Ya has sido registrado en <em>YoTeLlevo</em> y casi estás listo para usar sus servicios. Solamente falta que confirmes tu cuenta en ')?> 
    <a href='<?php echo $this->Html->url($urlDef, true) ?>'>
        <?php echo __('este link')?>
    </a>.
</p>

<p><?php echo __('Si este correo te llegó por error, simplemente bórralo y olvida lo ocurrido')?>.</p>
<a href='<?php echo $this->Html->url($urlDef, true) ?>'>
    <?php echo __('Da click aquí para confirmar')?>
</a>
