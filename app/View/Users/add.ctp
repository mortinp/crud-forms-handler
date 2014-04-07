<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Crear suario'); ?></legend>
        <?php
        echo $this->Form->input('username', array('type'=>'text'));
        echo $this->Form->input('password');
        echo $this->Form->input('role', array(
            'options' => array('driver' => 'Chofer', 'admin' => 'Admin')
        ));
        echo $this->Form->submit(__('Salvar'));
        ?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>