<?php echo $this->element('travel', array('travel'=>$travel, 'actions'=>false))?>

<br/>
<br/>

<?php if(isset ($to_admin) && $to_admin == true):?>
    <p>
        Usted recibió este correo porque es Administrador de <a href='<?php echo $this->Html->url('/', true)?>'><em>YoTeLlevo</em></a>.
    </p>
    <?php if(isset ($drivers) && count($drivers) > 0):?>
        <p>    
            Se encontraron los siguientes choferes para notificar:
            <ul>
                <?php
                foreach ($drivers as $d) {
                    echo '<li>'.$d['Driver']['username'].'</li>';
                }
                ?>
            </ul>
        </p>
    <?php endif?>
<?php else: ?>
    <p>
        Usted recibió este correo porque está registrado en 
        <a href='<?php echo $this->Html->url('/', true)?>'><em>YoTeLlevo</em></a> 
        como chofer que atiende viajes desde <?php echo $travel['Locality']['name']?>.
    </p>
<?php endif?>