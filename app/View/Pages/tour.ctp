<?php App::uses('Travel', 'Model')?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <legend><big>¿Cómo usar <em>YoTeLlevo</em>?</big></legend>
            
            <p>
                Lo primero que tienes que hacer para usar <em>YoTeLlevo</em> es <b>registrarte</b> en el formulario de la derecha. 
                Este es un paso que se realiza una sola vez y quedas registrado como usuario de <em>YoTeLlevo</em> hasta que tú mismo decidas dejar de serlo.
            </p>
            
            <p>
                En cuanto te hayas registrado en <em>YoTeLLevo</em>, puedes crear un anuncio de viaje. 
                Para crearlo, tienes que llenar un formulario como este:
            </p>
            
            <br/>
            <p><?php echo $this->Html->image('travel_form.png')?></p>
            <br/>
            
            <p>Cuando le das click al botón <span class="text-info"><b>Crear</b></span>, se crea un viaje como este:</p>
            
            <br/>
            <p><?php echo $this->Html->image('travel_unconfirmed.png')?></p>
            <br/>
            
            <p>
                La <span style="color:<?php echo Travel::$STATE[Travel::$STATE_UNCONFIRMED]['color']?>"><b>banderita amarilla</b></span> al lado del viaje significa que no ha sido confirmado. 
                Esto quiere decir que los datos del viaje todavía no han sido enviados a ningún chofer, por lo cual tu viaje no será atendido aún.
            </p>

            <p>
                En este mismo momento puedes cambiar cualquier dato del viaje, dando click en el botón <span class="text-info"><b>&ndash; Editar</b></span> (debajo del viaje). 
                Cuando estés seguro de que los datos del viaje son correctos, puedes dar click en <span class="text-info"><b><i class="glyphicon glyphicon-envelope"></i> Confirmar viaje ahora</b></span>, para confirmar 
                el viaje y enviar los datos a los choferes.
            </p>

            <p>Cuando das click en <span class="text-info"><b><i class="glyphicon glyphicon-envelope"></i> Confirmar viaje ahora</b></span>, el viaje queda confirmado y los choferes reciben los datos del viaje. 
                Inmediatamente se muestra cuántos choferes recibieron el anuncio y la <span style="color:<?php echo Travel::$STATE[Travel::$STATE_CONFIRMED]['color']?>"><b>banderita</b></span> cambia al color <span style="color:<?php echo Travel::$STATE[Travel::$STATE_CONFIRMED]['color']?>"><b>azul</b></span>.
            </p>
            
            <br/>
            <p><?php echo $this->Html->image('travel_confirmed.png')?></p>
            <br/>
            
            <p>
                En este momento has terminado tu trabajo. Ahora sólo te queda <b>esperar a que los choferes te contacten para acordar los términos del viaje</b>.
                Es muy sencillo!!!
            </p>

            <p>
                Es importante que sepas que ni los datos del viaje, ni los datos para contactarte son compartidos o puestos públicamente
                en ninguna parte: sólo los choferes que te pueden atender reciben los datos de tu viaje; nadie más puede verlos. 
                Además, la mejor forma para que un chofer te contacte es a través de un teléfono, por lo cual es preferible que uses esta forma 
                para el contacto.
            </p>

            <p>
                Ah, algo que también es bueno que sepas: en <em>YoTeLlevo</em> puedes crear todos los anuncios de viaje que quieras, de forma <big><b>gratis</b></big>.
            </p>

            <div style="background-color: lightblue;padding:10px">
                <p><b>¿Te gustaría usar <em>YoTeLlevo</em>? Regístrate ahora:</b></p>

                <p><?php echo $this->element('register_form')?></p>                
            </div>
            <p><big>o <?php echo $this->Html->link('Entra', array('controller'=>'users', 'action'=>'login'))?> si ya tienes una cuenta.</big></p>
        </div>
        
        <div class="col-md-4 col-md-offset-1">
            <p><b>¿Te gustaría usar <em>YoTeLlevo</em>? Regístrate ahora:</b></p>   
            <?php echo $this->element('register_form')?>
        </div>
    </div>
</div>