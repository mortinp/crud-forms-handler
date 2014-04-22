<?php
echo $this->Form->create('Contact', array('url' => array('controller' => 'contacts', 'action' => 'contact')));
?>
<fieldset>
    <?php
    echo $this->Form->input('name', array('type' => 'text', 'label' => 'Nombre', 'placeholder' => 'Tu nombre'));
    echo $this->Form->input('text', array('type'=>'textarea', 'label' => 'Texto', 'placeholder'=>'Lo que quieras decirnos, escríbelo aquí'));
    echo $this->Form->submit('Enviar');        
    ?>
</fieldset>
<?php echo $this->Form->end(); ?>