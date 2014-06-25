<div class="container">

    <div class="row">
        <div class="col-md-5">
            <div style="font-size: 48pt">
                YoTeLlevo 
            </div>
            <div><span class="text-muted" style="font-size: 20pt"><small>Por correo electrónico</small></span></div>

            <h2 style="font-size: 16pt;line-height: 28px">
                Usa tu correo electrónico para conseguir un taxi que te lleve a cualquier parte de Cuba. 
                Planifica tu viaje por correo.
            </h2>
 
            <!--<br/>
            <a href="mailto:viajes@yotellevo.ahiteva.net" class="btn btn-success" style="font-size:18pt;white-space: normal;">
                Crear un Anuncio de Viaje por correo
                <div style="font-size:12pt;padding-left:50px;padding-right:50px">En poco tiempo te contactará un chofer para acordar los términos del viaje</div>
            </a>-->
                                    
            <!--<br/>
            <br/>-->
            <br/>
            <p><b>¿Prefieres crear tu anuncio por la vía online?</b> <big><?php echo $this->Html->link(__('Ve al Inicio'), array('action' => 'home')) ?></big></p>
            <!--<p><b>¿Ya estás registrado en <em>YoTeLlevo</em>?</b> <big><?php echo $this->Html->link(__('Entra con tu cuenta'), array('controller' => 'users', 'action' => 'login')) ?></big></p>-->
        
        </div>
        <div class="col-md-6 col-md-offset-1 well">
            <h2>¿Cómo hacerlo?</h2>
            <br/>
            <big>
            <ul style="list-style-type: none;padding-left:20px">
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    Envía un correo a <big><b>viajes@yotellevo.ahiteva.net</b></big>
                </li>
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    Escribe en el <b>asunto</b> el origen y el destino del viaje, de la forma <em><b>Origen-Destino</b></em> 
                    (un guión o signo de menos en el medio). Por ejemplo, puedes escribir: <em>Santiago de Cuba-La Habana</em>.
                </li>
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    Escribe en el <b>cuerpo del mensaje</b> una <b>forma para contactarte</b>, preferiblemente tu número de teléfono 
                    o correo electrónico. Por ejemplo, escribe: <em>Llamar al teléfono 12345678 a Pepito</em>.
                </li>
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    Si prefieres un carro moderno y/o aire acondicionado, puedes incluir en el <b>cuerpo del mensaje</b>
                    las etiquetas <em><b>#moderno</b></em> y <em><b>#aire</b></em>.
                </li>
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    Envía el correo y espera a ser contactado por uno de nuestros choferes 
                    para ponerse de acuerdo en los términos del viaje.
                </li>
            </ul>
            </big>
            <p><b>¿Quieres saber más?</b> Escribe un correo a <b>info@yotellevo.ahiteva.net</b></p>
        </div>
    </div>
</div>


<?php $this->Html->css('home', null, array('inline' => false));?>