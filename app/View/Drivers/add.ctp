<div>
    <?php echo $this->Form->create('Driver'); ?>
    <fieldset>
        <legend><?php echo __('Crear Chofer'); ?></legend>
        <?php
        echo $this->Form->input('username', array('type'=>'text'));
        echo $this->Form->input('password');
        echo $this->Form->input('max_people_count');
        echo $this->Form->checkbox_group(array('has_modern_car'=>'Carro Moderno', 'has_air_conditioner'=>'Aire Acondicionado'), array('header'=>'Características'));
        echo $this->Form->input('contact_name');
        echo $this->Form->submit(__('Salvar'));
        ?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>