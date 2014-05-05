<div class="container">
<div class="row">
    <div class="col-md-6 col-md-offset-2">
        <?php echo $this->Session->flash('auth'); ?>
        <div class="text-muted">
            <!--Entra a tu cuenta para ver tus anuncios de viajes, o crear el primer anuncio si aún no tienes.-->
            <b>¿No tienes una cuenta todavía?</b> 
            <?php echo $this->Html->link('Regístrate en <em>YoTeLlevo</em>', array('controller'=>'users', 'action'=>'register'), array('escape'=>false))?> 
            para crear anuncios de viajes.
        </div>
        <br/>
        <legend><?php echo __('Entra (o ' . $this->Html->link('Regístrate', array('controller' => 'users', 'action' => 'register')) . ' si no tienes cuenta)'); ?></legend>
        <?php echo $this->Form->create('User'); ?>
        <fieldset>
            <?php
            echo $this->Form->input('username', array('label' => 'Correo electrónico', 'type' => 'email'));
            echo $this->Form->input('password', array('label' => 'Contraseña'));
            echo $this->Form->checkbox('remember_me').' Recordarme';
            echo $this->Form->submit(__('Entrar'));
            ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
        <br/>
        <?php echo $this->Html->link('¿Olvidaste tu contraseña?', array('controller'=>'users', 'action'=>'forgot_password'))?>
    </div>
</div>
</div>