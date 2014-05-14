<div>
    El <em>ORIGEN</em> y <em>DESTINO</em> especificados no son reconocidos por nuestro sistema. 
    Por favor chequee que <em><?php echo $user_origin ?></em> y <em><?php echo $user_destination ?></em> 
    estén bien escritos. Nuestros especialistas analizarán dichas localidades para programar su inclusión
    en el sistema. Aquí le mostramos un listado de las localidades que manejamos hasta el momento, 
    y otros términos que puede usar como <em>ORIGEN</em> o como <em>DESTINO</em> de sus viajes:
</div>
<div>    
    <?php
    echo 'Localidades: ';
    
    $sep = '';
    foreach ($localities as $province => $municipalities) {
        foreach ($municipalities as $munId=>$munName) {
            echo $sep.$munName;
            $sep = ', ';
        }
    }
    ?>
    
    <br/>
    
    <?php
    echo 'Términos: ';
    
    $sep = '';
    foreach ($thesaurus as $t) {
        echo $sep.$t['LocalityThesaurus']['fake_name'];
        $sep = ', ';
    }
    ?>
</div>

<div>
    Si alguna de estas localidades o términos le es conveniente, vuelva a escribir un correo a [CORREO]
    y ponga la localidad o término como <em>ORIGEN</em> o <em>DESTINO</em>.
</div>