<?php 
$isLoggedIn = AuthComponent::user('id') ? true : false;
?>

<?php if(!$isLoggedIn) :?>
<p>
    <small>¿Ya sabes qué es <em>YoTeLlevo</em>? 
    <?php echo $this->Html->link(__('Entra'), array('controller' => 'users', 'action' => 'login')) ?> 
    o 
    <?php echo $this->Html->link(__('Regístrate'), array('controller' => 'users', 'action' => 'register')) ?>
    </small>
</p>
<?php endif?>

<div class="container" style="/*background-color: lightblue*/">
    <div class="row">
        <div class="col-md-6">
            <h1><big><i class="glyphicon glyphicon-road"></i> YoTeLlevo</big></h1>
            <h1><small>La mejor manera de viajar en Cuba si no tienes carro</small></h1>
            <div class="text-muted">
                <big><b><em>YoTeLlevo</em> te permite encontrar un chofer con carro para que te lleve a cualquier parte.</b> Este tipo de acuerdo se realiza 
                actualmente con intermediarios o corredores; <em>YoTeLlevo</em> ahora es el intermediario, con la diferencia de que 
                <b><em>YoTeLlevo</em> es gratis</b>: puedes hacer todos los anuncios que desees, sin costo alguno.</big>
            </div>
            <h1><small class="text-info">Deja de buscar choferes con carro por ahí. Anúnciate en <em>YoTeLlevo</em> y espera a que un chofer te contacte para llevarte.</small></h1>
        </div>
        <div class="col-md-6" style="margin-top:15px">
            <legend>Algunos casos en que puedes usar <em>YoTeLlevo</em></legend>
            <ul style="list-style-type: none">
                <li style="padding-bottom: 15px"><i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> Deseas viajar de una provincia a otra por algún evento o paseo</li>
                <li style="padding-bottom: 15px"><i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> Necesitas recoger o llevar algún familiar o amigo a un aeropuerto</li>
                <li style="padding-bottom: 15px"><i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> Necesitas que te lleven a algún lugar lejano y te esperen para el regreso</li>
                <li style="padding-bottom: 15px"><i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> Quieres realizar un paseo de diversión y necesitas que te lleven</li>
            </ul>
            <div>
                <big>En cualquiera de estos casos, u otros: 
                <?php echo $this->Html->link("<i class='glyphicon glyphicon-flag'></i> Crea un anuncio de viaje", array('controller'=>'travels', 'action'=>'add'), array('escape'=>false))?>
                </big>
            </div>
            <div class="text-muted" style="padding: 40px;">
                <big><!--<i class="icon-quote-left"></i> -->
                    <div style="position: absolute;margin-left: -10px"><big><b>"</b></big></div> 
                    Con <em>YoTeLlevo</em> las personas no dependen de nadie que les gestione sus viajes. 
                    Uno mismo puede gestionárselos entrando a la página web y publicando un anuncio. 
                    Es tan fácil como llenar los datos de un formulario, enviarlo, y esperar a que los mismos choferes te contacten. 
                    Y es gratis
                    <big><b>"</b></big><!-- <i class="icon-quote-right"></i> -->
                    <span style="/*color: #000*/">&ndash; <a href="http://twitter.com/martinproenza" style="text-decoration: none">Martín</a>, creador de <em>YoTeLlevo</em></span>
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
                <div style="margin:20px"><big><?php echo $this->Html->link("<i class='glyphicon glyphicon-flag'></i> Crea un anuncio de viaje ahora", array('controller'=>'travels', 'action'=>'add'), array('escape'=>false))?></big></div>
            </div>
        </div>
        <div class="col-md-6">
            <h1>Chofer</h1>
            <h1><small>Recibe notificaciones de viajes y lleva al interesado</small></h1>
            <div class="text-muted">
                Una vez registrados, <b>los choferes reciben notificaciones de los viajes</b> que publican los viajeros.
                <b>Las notificaciones se reciben por correo electrónico</b>, de tal forma que enterarse de un anuncio es más rápido y fácil.
                En cada notificación, el chofer recibe los detalles del viaje y la forma de contactar al viajero interesado.
                A partir de aquí, <b>es decisión del chofer el contactar o no a un viajero, dependiendo de su propio interés</b>.
            </div>
            <br/>
            <br/>
            <div>
                <ul style="list-style-type: none">
                    <li style="padding-bottom: 15px"><i class="glyphicon glyphicon-user" style="margin-left: -20px"></i> Regístrate en <em>YoTeLlevo</em> para comenzar a recibir notificaciones de viajes</li>
                    <li style="padding-bottom: 15px"><i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> Decide qué notificaciones recibir (ej. las de tu municipio de residencia)</li>
                    <li style="padding-bottom: 15px"><i class="glyphicon glyphicon-envelope" style="margin-left: -20px"></i> Recibe las notificaciones de viajes en tu buzón de correo electrónico</li>
                    <li style="padding-bottom: 15px"><i class="glyphicon glyphicon-phone-alt" style="margin-left: -20px"></i> Contacta con los interesados en viajar usando los contactos especificados en el anuncio de viaje, y acuerda los términos del viaje</li>
                </ul>
                <div style="margin:20px"><big><b>Finalmente, lleva al viajero a su destino cumpliendo los términos acordados</b></big></div>
                <div style="margin:20px"><big><?php echo $this->Html->link("<i class='glyphicon glyphicon-earphone'></i> Contáctanos para registrarte como chofer ahora", array('controller'=>'pages', 'action'=>'display', 'contact'), array('escape'=>false))?></big></div>
            </div>
        </div>
    </div>
</div>

<br/>
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