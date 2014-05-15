<div class="container">
<div class="row">
    <div class="col-md-6 col-md-offset-2">
        <?php echo $this->Session->flash('auth'); ?>
        <legend><?php echo __('Edita tu perfil'); ?></legend>
        <?php echo $this->Form->create('User'); ?>
        <fieldset>
            <?php
            echo $this->Form->input('display_name', array('label' => 'Nombre', 'type' => 'text', 'placeholder'=>'Nombre vacío significa que quieres usar tu correo como nombre'));
            echo $this->Form->input('password', array('label'=>'Contraseña', 'placeholder'=>'Contraseña vacía significa que no quieres cambiarla', 'required'=>false));
            echo $this->Form->input('id', array('type' => 'hidden'));
            echo $this->Form->input('username', array('type' => 'hidden'));
            echo $this->Form->input('role', array('type' => 'hidden'));
            echo $this->Form->input('created', array('type' => 'hidden'));
            echo $this->Form->submit(__('Salvar'));
            ?>
        </fieldset>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
</div>