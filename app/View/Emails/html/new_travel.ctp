<?php echo $this->element('travel', array('travel'=>$travel, 'actions'=>false))?>

<br/>
<br/>

<?php if(isset ($admin)):?>
    <p>
        Usted recibió este correo porque es Administrador de <a href='<?php echo $this->Html->url('/', true)?>'><em>YoTeLlevo</em></a>.
    </p>
    <?php if(isset ($admin['drivers']) && count($admin['drivers']) > 0):?>
        <p>
            Se encontraron <?php echo count($admin['drivers'])?> choferes para notificar:
            <ul>
                <?php
                foreach ($admin['drivers'] as $d) {
                    echo '<li>'.$d['Driver']['username'].'</li>';
                }
                ?>
            </ul>
        </p>
        <p>
            <?php if(AuthComponent::user('role') === 'regular'):?>
                Se notificaron exitosamente <b><?php echo $admin['notified_count']?></b> choferes.
            <?php else:?>
                Este viaje fue creado por un administrador, por lo cual <b>no fue enviado realmente a ningún chofer</b>.
            <?php endif;?>
        </p>
    <?php endif?>
<?php else: ?>
    <p>
        Usted recibió este correo porque está registrado en 
        <a href='<?php echo $this->Html->url('/', true)?>'><em>YoTeLlevo</em></a> 
        como chofer que atiende viajes desde <?php echo $travel['Locality']['name']?>.
    </p>
<?php endif?>