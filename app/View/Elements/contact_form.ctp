<?php $isLoggedIn = AuthComponent::user('id') ? true : false;?>

<?php
echo $this->Form->create('Contact', array('url' => array('controller' => 'contacts', 'action' => 'contact')));
?>
<fieldset>
    <?php
    echo $this->Form->input('name', array('type' => 'text', 'label' => 'Nombre', 'placeholder' => 'Tu nombre', 'required'=>true));
    if(!$isLoggedIn) echo $this->Form->input('email', array('type' => 'email', 'label' => 'Correo electrónico <small class="text-info">(si no tienes correo electrónico, escribe alguna vía de contacto en el <em>Texto</em>)</small>', 'placeholder' => 'Tu correo para contactarte'));
    echo $this->Form->input('text', array('type'=>'textarea', 'label' => 'Texto', 'placeholder'=>'Lo que quieras decirnos, escríbelo aquí', 'required'=>true));
    
    if($isLoggedIn) echo '<div class="text-info" style="padding-bottom:20px">Estás contactándonos a nombre de <b>'.AuthComponent::user('username').'</b></div>';
    echo $this->Form->submit('Enviar');        
    ?>
</fieldset>
<?php echo $this->Form->end(); ?>