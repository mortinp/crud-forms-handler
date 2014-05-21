<h2>Hola</h2>
<div>
    <p>
        El <em>ORIGEN</em> y <em>DESTINO</em> especificados en su correo no son reconocidos por <em>YoTeLlevo</em>. 
        Por favor chequee que <em><b><?php echo $user_origin ?></b></em> y <em><b><?php echo $user_destination ?></b></em> 
        estén bien escritos. Nuestros especialistas analizarán dichas localidades para programar su inclusión
        en el sistema. Aquí le mostramos un listado de las localidades que manejamos hasta el momento, 
        y otros términos que puede usar como <em>ORIGEN</em> o como <em>DESTINO</em> de sus viajes:
    </p>
</div>
<div> 
    <p>
    <?php
    echo '<b>Localidades:</b> ';
    
    $sep = '';
    foreach ($localities as $province => $municipalities) {
        foreach ($municipalities as $munId=>$munName) {
            echo $sep.$munName;
            $sep = ', ';
        }
    }
    ?>
    </p>
    
    <p>
    <?php
    echo '<b>Términos:</b> ';
    
    $sep = '';
    foreach ($thesaurus as $t) {
        echo $sep.$t['LocalityThesaurus']['fake_name'];
        $sep = ', ';
    }
    ?>
    </p>
</div>

<div>
    <p>
    Si alguna de estas localidades o términos le es conveniente, vuelva a escribir un correo a <b>viajes@yotellevo.ahiteva.net</b>
    usando una de estas localidades o términos en el asunto, como <em>ORIGEN</em> o como <em>DESTINO</em>.
    </p>
</div>