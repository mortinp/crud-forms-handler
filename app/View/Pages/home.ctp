<?php 
$isLoggedIn = AuthComponent::user('id') ? true : false;
?>

<div class="container">
    <!--<div class="row">
        <div class="col-md-4">
            <h1><big><big>YoTeLlevo</big></big></h1>
        </div>
        <div class="col-md-8">
            <h1><small>Consigue un chofer con carro que te lleve a cualquier parte de Cuba, de la manera más fácil, cómoda y rápida. Garantizado.</small></h1>
        </div>
    </div>
    <br/>-->
    <div class="row">
        <div class="col-md-5">
           <div style="font-size: 40pt"><!--<i class="glyphicon glyphicon-road"></i>-->YoTeLlevo</div>
            <div style="font-size: 16pt">
                <p>
                    Consigue un chofer con carro que te lleve a cualquier parte de Cuba, de la manera más fácil, cómoda y rápida. Garantizado.
                </p>
            </div>
            
            <!--<div>
                <big><b><em>YoTeLlevo</em> te permite encontrar un chofer con carro para que te lleve a cualquier lugar en Cuba.</b> 
                Avísale a los choferes sobre tu necesidad de viaje directamente a través de nuestra página web, 
                llenando un formulario con los datos del viaje. No tienes que contactarlos; ellos te contactarán a tí.
                </big>
            </div>-->  
            <br/>
            <?php echo $this->Html->link('Crear un Anuncio de Viaje ahora mismo 
                <div style="font-size:10pt;padding-left:50px;padding-right:50px">En poco tiempo te contactará un chofer para acordar los términos del viaje</div>', 
                    array('controller'=>'travels', 'action'=>'add_pending'), 
                    array('class'=>'btn btn-success', 'style'=>'font-size:16pt;white-space: normal;', 'escape'=>false));?>
                        
            <br/>
            <br/>
            <p><b>¿Ya estás registrado en <em>YoTeLlevo</em>?</b> <big><?php echo $this->Html->link(__('Entra con tu cuenta'), array('controller' => 'users', 'action' => 'login')) ?></big></p>
              
            <br/>
            <br/>
            <div class="text-muted" style="/*padding: 40px;*/">
                <big>
                    <blockquote>Con <em>YoTeLlevo</em> las personas no dependen de nadie que les gestione sus viajes. 
                    Uno mismo puede gestionárselos entrando a la página web y publicando un anuncio. 
                    Es tan fácil como llenar los datos de un formulario, enviarlo, y esperar a que los mismos choferes te contacten. 
                    Y es gratis.
                    <small>Creador de <em>YoTeLlevo</em></small>
                    </blockquote>
                </big>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-1" style="/*margin-top:-20px*/">
            <!--<h3>Comienza registrándote en <em>YoTeLlevo</em> <p><small>Enseguida podrás hacer anuncios de viajes y encontrar un chofer que te lleve</small></p></h3>
            <br/>
            <?php echo $this->element('register_form')?>
            <br/>
            <div><big><b>O puedes</b></big></div>
            <br/>-->
            
            <h2>¿Cómo funciona?</h2>
            <br/>
            <big>
            <ul style="list-style-type: none;padding-left:20px">
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    <b>Creas tu anuncio de viaje especificando los detalles</b>: origen, destino, cantidad de personas, fecha del viaje, etc. 
                    Puedes especificar también si tienes alguna preferencia como un carro moderno y/o aire acondicionado.
                </li>
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    En el anuncio <b>debes especificar alguna información para que el chofer te contacte</b>; puede ser un número de teléfono, 
                    correo electrónico o cualquier otro dato.
                </li>
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    Cuando confirmas el anuncio de viaje, <b>varios choferes son notificados con los detalles del mismo y 
                    la información de contacto que hayas brindado</b>.<!-- De esta forma, puedes <b>esperar a que un chofer te contacte 
                    en poco tiempo para acordar los términos del viaje contigo directamente</b>; no hay intermediarios.-->
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
</div>

<br/>
<br/>
<br/>

<div class="container" style="background-color: lightblue">
    <div class="row">
        
        <div class="col-md-2">
          <h3>Base de choferes</h3>
          <p>Tenemos una base de choferes dispuestos a atender tu petición de viaje. Todos los carros son confortables.</p>
        </div>
        
        <div class="col-md-2">
          <h3>Todo tipo de viajes</h3>
          <p>Los viajes pueden ser de corta o larga distancia; y pueden ser para llevarte y/o para recogerte. Por toda Cuba.</p>
        </div>
        
        <div class="col-md-2">
          <h3>Viajes planificados</h3>
          <p>Puedes anunciar tu viaje con varios días de antelación y dejarlo acordado con un chofer.</p>
        </div>
        
        <div class="col-md-2">
          <h3>Precio negociado</h3>
          <p>El precio del viaje lo negocias tú directamente con el chofer, sin intermediarios.</p>
        </div>
        
        <div class="col-md-2">
          <h3>Anuncios gratis</h3>
          <p>Puedes crear tu anuncio de viaje de forma <big>gratis</big>. La cantidad de anuncios es ilimitada.</p>
        </div>
        
        <div class="col-md-2">
          <h3>Datos privados</h3>
          <p>Los datos de tu viaje lo pueden ver exclusivamente tú y algunos choferes que pudieran atender tu petición.</p>
        </div>
    </div>
</div>

<br/>
<br/>

<!--<?php if(!$isLoggedIn):?>
<div class="container" style="background-color: lightblue">
    <div class="row">
        <div class="col-md-6">
            <legend class="text-info">
                <b>¿No tienes una cuenta todavía?</b> Regístrate ahora: 
            </legend>
            <?php echo $this->element('register_form')?>
        </div>  
        
        <div class="col-md-6">
            <h1><small class="text-info">Deja de buscar choferes con carro por ahí. Anúnciate en <em>YoTeLlevo</em> y espera a que un chofer te contacte para llevarte.</small></h1>
        </div>         
    </div>
    <br/>
</div>
<?php endif?>-->


<?php $this->Html->css('home', null, array('inline' => false));?>