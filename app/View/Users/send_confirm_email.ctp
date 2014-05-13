<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            
            <h2>Verificación de cuenta de correo electrónico</h2>
            <h3>
                Ya enviamos un correo a la cuenta <b><?php echo AuthComponent::user('username')?></b> para ser verificada. <b>Revisa tu correo y sigue las instrucciones</b>.
            </h3>
            
            <?php echo $this->element('email_sent_tips', array('link'=>$this->Html->link('<i class="glyphicon glyphicon-ok"></i> Enviar correo de verificación', array('controller'=>'users', 'action'=>'send_confirm_email'), array('escape'=>false))))?>
                        
        </div>
    </div>
    
</div>