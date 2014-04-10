<?php echo $this->Form->create('User', array('controller' => 'users', 'action' => 'register')); ?>
<fieldset>
    <?php
    echo $this->Form->input('username', array('label' => 'Correo electrónico', 'type' => 'email', 'id'=>'UserRegisterForm'));
    echo $this->Form->input('password', array('label'=> 'Contraseña', /*'class'=>'{minLength:7}'*/));
    echo $this->Form->submit(__('Registrarse'));
    ?>
</fieldset>
<?php echo $this->Form->end(); ?>

<?php
//JS
/*$this->Html->script('jquery', array('inline' => false));
$this->Html->script('jquery-validation-1.10.0/dist/jquery.validate.min', array('inline' => false));
$this->Html->script('jquery-validation-1.10.0/localization/messages_es', array('inline' => false));*/
?>

<!--<script type="text/javascript">
    $(document).ready(function() {
        $('#UserRegisterForm').validate({
            wrapper: 'div',
            errorClass: 'text-danger',
            errorElement: 'div'/*,
            rules:{UserPassword: {minLength:7}}*/
        });
    })
</script>-->