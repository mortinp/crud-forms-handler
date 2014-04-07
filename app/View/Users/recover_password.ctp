<div class="row">
    <div class="col-md-5 col-md-offset-2">
        <?php echo $this->Session->flash('auth'); ?>
        <legend>
            <div><?php echo __('Recupera tu contraseña')?></div>
            <small class="text-muted"><small>Escribe tu correo electrónico y enviaremos una nueva contraseña a tu buzón</small></small>
        </legend>
        <?php echo $this->Form->create('User'); ?>
        <fieldset>
            <?php
            echo $this->Form->input('username', array('label' => 'Correo electrónico', 'type' => 'email'));
            echo $this->Form->submit(__('Recuperar contraseña'));
            ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
    </div>
</div>