<div>
    <?php echo $this->Form->create('Driver'); ?>
    <fieldset>
        <legend><?php echo __('Crear Chofer'); ?></legend>
        <?php
        echo $this->Form->input('username', array('type'=>'text'));
        echo $this->Form->input('password');
        echo $this->Form->input('max_people_count');
        echo $this->Form->checkbox_group(array('has_modern_car'=>'Carro Moderno', 'has_air_conditioner'=>'Aire Acondicionado'), array('header'=>'Características'));
        echo $this->Form->input('description');
        
        echo $this->Form->input('localities', array('id'=>'LocalitiesSelect', 'type' => 'select', 'multiple', 'options' => $localities, 'showParents' => true, 
            'label' => __('Localidades <small class="text-info">(seleccionar con <b>Ctrl + Click</b>)</small>')));
        
        echo $this->Form->checkbox('active').' Active';
        
        echo $this->Form->submit(__('Salvar'));
        ?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>

<?php
/*// CSS
//$this->Html->css('bootstrap', array('inline' => false));
$this->Html->css('select2/select2', array('inline' => false));

// JS
$this->Html->script('jquery', array('inline' => false));
$this->Html->script('select2/select2', array('inline' => false));*/
?>

<!--<script type="text/javascript">
    $(document).ready(function() {
        $('#LocalitiesSelect').select2();
    });
</script>-->