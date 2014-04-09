<?php echo $this->Form->create('User', array('controller' => 'users', 'action' => 'register')); ?>
<fieldset>
    <?php
    echo $this->Form->input('username', array('label' => 'Correo electrónico', 'type' => 'email'));
    echo $this->Form->input('password', array('label'=> 'Contraseña'));
    echo $this->Form->submit(__('Registrarse'));
    ?>
</fieldset>
<?php echo $this->Form->end(); ?>