<?php echo $this->Form->create('User', array('controller' => 'users', 'action' => 'register')); ?>
<fieldset>
    <?php
    echo $this->Form->input('username', array('label' => 'Correo electrónico', 'type' => 'email', 'id'=>'UserRegisterForm'));
    echo $this->Form->input('password', array('label'=> 'Contraseña', /*'class'=>'{minLength:7}'*/));
    echo $this->Form->submit(__('Registrarse'));
    ?>
</fieldset>
<?php echo $this->Form->end(); ?>