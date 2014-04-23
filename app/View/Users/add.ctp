<div class="users form">
    <?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Crear Usuario'); ?></legend>
        <?php
        echo $this->Form->input('username', array('type'=>'text'));
        echo $this->Form->input('password');
        echo $this->Form->input('role', array(
            'options' => array('regular' => 'Regular', 'admin' => 'Admin')
        ));
        echo $this->Form->submit(__('Salvar'));
        ?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>