<?php 
$isLoggedIn = AuthComponent::user('id') ? true : false;
?>

<div class="container">

    <div class="row">
        <div class="col-md-5">
            <div style="font-size: 48pt">
                <!--<?php echo $this->Html->image('i.jpg', array('alt'=>'YoTeLlevo', 'class'=>'img-responsive'))?>-->
                YoTeLlevo
            </div>
            
            <h2 style="font-size: 16pt;line-height: 28px">
                Consigue un taxi que te lleve a cualquier parte de Cuba, de la manera más fácil, cómoda y rápida. Garantizado.
            </h2>
 
            <br/>
            <?php echo $this->Html->link('Crear un Anuncio de Viaje 
                <div style="font-size:12pt;padding-left:50px;padding-right:50px">En poco tiempo te contactará un chofer para acordar los términos del viaje</div>', 
                    array('controller'=>'travels', 'action'=>'add_pending'), 
                    array('class'=>'btn btn-primary', 'style'=>'font-size:18pt;white-space: normal;', 'escape'=>false));?>
                        
            <br/>
            <br/>
            <br/>
            <p><b>¿Ya estás registrado en <em>YoTeLlevo</em>?</b> <big><?php echo $this->Html->link(__('Entra con tu cuenta'), array('controller' => 'users', 'action' => 'login')) ?></big></p>
              
            <br/>    
            <div>
                <div class="label label-success" style="font-size: 14px;float:left"><b>NUEVO</b></div>
                <div style="text-align: center;"><b><?php echo $this->Html->link('PUEDES CONSEGUIR UN TAXI USANDO TU CORREO ELECTRÓNICO, SIN NECESIDAD DE TENER INTERNET', array('action'=>'by_email'), array('class'=>'text-success', 'escape'=>false))?></b></div>
            </div>
            
        </div>
        <div class="col-md-6 col-md-offset-1">
            <h2>¿Cómo funciona?</h2>
            <br/>
            <big>
            <ul style="list-style-type: none;padding-left:20px">
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    <b>Creas un anuncio de viaje especificando los detalles</b>: origen, destino, fecha del viaje, etc. 
                    Puedes especificar también si prefieres un carro moderno y aire acondicionado.
                </li>
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    En el anuncio <b>debes especificar alguna información para que el chofer te contacte</b>; puede ser un número de teléfono o 
                    correo electrónico.
                </li>
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    Cuando confirmas el anuncio de viaje, <b>los choferes son notificados con los detalles del mismo y 
                    la información de contacto que hayas brindado</b>.
                </li>
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    <b>Esperas a que un chofer te contacte para acordar los términos del viaje contigo directamente</b>; 
                    no hay intermediarios.
                </li>
            </ul>
            </big>
            <p><b>¿Quieres saber más?</b> Las <?php echo $this->Html->link('Preguntas Frecuentes', array('action'=>'faq'))?> pudieran ayudarte.</p>              
        </div>
    </div>
    
    <br/>
    <br/>
    <?php echo $this->element('features')?>
    
    <!--<br/>
    <br/>
    <br/>
    <div class="row">
        <div class="col-md-12 text-muted">
            <big>
                <blockquote>Con <em>YoTeLlevo</em> las personas no dependen de nadie que les gestione sus viajes. 
                    Uno mismo puede gestionárselos entrando a la página web y publicando un anuncio. 
                    Es tan fácil como llenar los datos de un formulario, enviarlo, y esperar a que los mismos choferes te contacten.
                    Y es gratis.
                    <small>Creador de <em>YoTeLlevo</em></small>
                </blockquote>
            </big>
        </div>
        <div class="col-md-12 text-muted">
            <big>
                <blockquote>Esta aplicación pone a varios choferes de distintos lugares de Cuba al alcance de los viajeros.
                    La distancia entre los viajeros y los choferes está a solo un click, o un correo. 
                    Siempre puedes optar por la mejor opción de taxi dependiendo del lugar donde te encuentres; el proceso es muy rápido.
                    <small>CEO de <em>Casabe&trade;</em></small>
                </blockquote>
            </big>
        </div>
    </div>-->
</div>

<?php $this->Html->css('home', null, array('inline' => false));?>