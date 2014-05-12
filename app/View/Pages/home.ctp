<?php 
$isLoggedIn = AuthComponent::user('id') ? true : false;
?>

<!--
<?php if(!$isLoggedIn) :?>
<p>
    <small>¿Ya sabes qué es <em>YoTeLlevo</em>? 
    <?php echo $this->Html->link(__('Entra'), array('controller' => 'users', 'action' => 'login')) ?> 
    o 
    <?php echo $this->Html->link(__('Regístrate'), array('controller' => 'users', 'action' => 'register')) ?>
    </small>
</p>
<?php endif?>
-->

<div class="container" style="/*background-color: lightblue*/">
    <div class="row">
        <div class="col-md-6">
            <h1><big><i class="glyphicon glyphicon-road"></i> YoTeLlevo</big></h1>
            <h1><small>La mejor manera de viajar en Cuba si no tienes carro</small></h1>
            <div class="text-muted">
                <big><b><em>YoTeLlevo</em> te permite encontrar un chofer con carro para que te lleve a cualquier parte.</b> 
                Sólo tienes que hacerle saber a los choferes a través de nuestra página web, llenando un formulario con los datos del viaje.
                No tienes que contactarlos; ellos te contactarán a tí.
                </big>
            </div>
            <br/>
            
            <big>
            <ul style="list-style-type: none;padding-left:20px">
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    Tenemos una base de choferes dispuestos a atender tu petición de viaje.
                </li>
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    Puedes realizar todos los anuncios de viajes que quieras, de forma <big>gratis</big>. No cuesta nada realizar un anuncio de viaje.
                </li>
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    Los viajes pueden ser de corta o larga distancia; y pueden ser para llevarte y/o para recogerte.
                </li>
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    Puedes anunciar tu viaje con varios días de antelación y dejarlo acordado con un chofer.
                </li>
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    El precio del viaje lo negocias tú directamente con el chofer.
                </li>
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    Los datos de tu viaje no son compartidos con nadie, excepto con los choferes que te pueden llevar.
                </li>
            </ul>
            </big>           
            
        </div>
        <div class="col-md-6" style="margin-top:15px">
            <h3>Comienza registrándote en <em>YoTeLlevo</em> <p><small>Enseguida podrás hacer anuncios de viajes y encontrar un chofer que te lleve</small></p></h3>
            <br/>
            <?php echo $this->element('register_form')?>
            
            </br>
            <p>¿Ya estás registrado en <em>YoTeLlevo</em>? <big><?php echo $this->Html->link(__('Entra ahora'), array('controller' => 'users', 'action' => 'login')) ?></big></p>
            <p>¿Quieres saber más? Las <big><?php echo $this->Html->link('Preguntas y Respuestas', array('action'=>'faq'))?></big> pudieran ayudarte. O puedes <big><?php echo $this->Html->link(__('Aprender cómo usarlo'), array('action' => 'tour')) ?></big></p>
            
            <div class="text-muted" style="padding: 40px;">
                <big>
                    <div style="position: absolute;margin-left: -10px"><big><b>"</b></big></div> 
                    Con <em>YoTeLlevo</em> las personas no dependen de nadie que les gestione sus viajes. 
                    Uno mismo puede gestionárselos entrando a la página web y publicando un anuncio. 
                    Es tan fácil como llenar los datos de un formulario, enviarlo, y esperar a que los mismos choferes te contacten. 
                    Y es gratis
                    <big><b>"</b></big>
                    <span style="/*color: #000*/">&ndash; <!--<a href="http://twitter.com/martinproenza" style="text-decoration: none">Martín</a>, c-->Creador de <em>YoTeLlevo</em></span>
                </big>
            </div>
        </div>
    </div>
</div>

<br/>

<div class="container" style="/*background-color: lightcoral*/">
    <div class="row">
        <div class="col-md-6">
            <h1>Viajero</h1>
            <h1><small>Crea un anuncio de un viaje y encuentra quien te lleve</small></h1>
            <div class="text-muted">
                <b>Los viajeros sólo tienen que crear un anuncio de viaje diciendo el lugar a donde quieren ir y cuándo lo desean hacer</b>. 
                Inmediatamente, varios choferes reciben una notificación de su anuncio, con sus datos de contacto.
                Pronto, <b>el viajero será contactado por algún chofer que desee llevarlo</b>, y ambos se pondrán de acuerdo en los
                términos del viaje.
            </div>
            <br/>
            <br/>
            <div>
                <ul style="list-style-type: none">
                    <li style="padding-bottom: 15px"><i class="glyphicon glyphicon-flag" style="margin-left: -20px"></i> Anuncia que quieres viajar a alguna parte</li>
                    <li style="padding-bottom: 15px"><i class="glyphicon glyphicon-list" style="margin-left: -20px"></i> Especifica los detalles del viaje (a dónde, cuándo, cuántas personas, etc.)</li>
                    <li style="padding-bottom: 15px"><i class="glyphicon glyphicon-user" style="margin-left: -20px"></i> Especifica la forma de contactarte</li>
                    <li style="padding-bottom: 15px"><i class="glyphicon glyphicon-phone-alt" style="margin-left: -20px"></i> Espera a ser contactado por uno de nuestros choferes para acordar los términos del viaje</li>
                </ul>
                <div style="margin:20px"><big><b>Finalmente, haz tu viaje el día acordado, en los términos acordados</b></big></div>
                <!--<div style="margin:20px"><big><?php echo $this->Html->link("<i class='glyphicon glyphicon-flag'></i> Crea un anuncio de viaje ahora", array('controller'=>'travels', 'action'=>'add'), array('escape'=>false))?></big></div>-->
            </div>
        </div>
        <div class="col-md-6" style="padding-top:30px">
            
            <legend>Algunos casos en que puedes usar <em>YoTeLlevo</em></legend>
            <ul style="list-style-type: none">
                <li style="padding-bottom: 15px"><i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> Llegas a Cuba por un aeropuerto lejano de tu lugar de estancia, y quieres llegar a ese lugar.</li>
                <li style="padding-bottom: 15px"><i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> Deseas viajar de una provincia a otra por algún evento o paseo.</li>
                <li style="padding-bottom: 15px"><i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> Necesitas recoger o llevar algún familiar o amigo a un aeropuerto.</li>
                <li style="padding-bottom: 15px"><i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> Necesitas que te lleven a algún lugar lejano y te esperen para el regreso.</li>
                <li style="padding-bottom: 15px"><i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> Quieres realizar un paseo de diversión con la familia y no tienes en qué ir.</li>
            </ul>
            
            <br/>
            <h1><small class="text-info">Deja de buscar choferes con carro por ahí. Anúnciate en <em>YoTeLlevo</em> y espera a que un chofer te contacte para llevarte.</small></h1>
        </div>
    </div>
</div>

<br/>
<br/>

<?php if(!$isLoggedIn):?>
<div class="container" style="background-color: lightblue">
    <div class="row">
        <div class="col-md-6">
            <legend class="text-muted">
                <b>¿No tienes una cuenta todavía?</b> Regístrate ahora: 
            </legend>
            <?php echo $this->element('register_form')?>
        </div>        
    </div>
    <br/>
</div>
<?php endif?>


<?php $this->Html->css('home', null, array('inline' => false));?>