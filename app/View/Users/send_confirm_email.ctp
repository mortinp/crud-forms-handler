<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Verificación de cuenta de correo electrónico</h2>
            <h3>
                Ya enviamos un correo a la cuenta <b><?php echo AuthComponent::user('username')?></b> para ser verificada. <b>Revisa tu correo y sigue las instrucciones</b>.
            </h3>
            
            <div class="alert alert-warning">
                <p>
                    <b>IMPORTANTE</b>: Si no recibes un correo de <em>YoTeLlevo</em> en pocos minutos, revisa tu carpeta de correos spam o no deseados. 
                    Si esto no funciona, configura las opciones de correos entrantes, habilita el dominio <em>ksabes.com</em> y vuelve a <b><?php echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i> Verificar cuenta', array('controller'=>'users', 'action'=>'send_confirm_email'), array('escape'=>false))?></b>.
                </p>
                <br/>
                <p>
                    <b><?php echo $this->Html->link('Contáctanos', array('controller'=>'pages', 'action'=>'contact'))?></b> si los problemas persisten y no puedes verificarla.
                </p>
                
            </div>
        </div>
    </div>
    
</div>