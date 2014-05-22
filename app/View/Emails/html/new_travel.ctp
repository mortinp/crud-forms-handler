<h2>Hola Chofer,</h2>
<div>
    <p>
        Un nuevo anuncio de viaje ha sido registrado recientemente con los siguientes datos:
    </p>
    <p>
        <?php echo $this->element('travel', array('travel'=>$travel, 'actions'=>false))?>
    </p>
    
    <br/>
    <p>
        <b>¡Ponte en contacto con el viajero y haz que tu oferta sea la mejor!</b>
    </p>
</div>

<?php 
if(!isset ($creator_role)) $creator_role = 'regular';
?>

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
            <?php if($creator_role === 'regular'):?>
                Se notificaron exitosamente <b><?php echo $admin['notified_count']?></b> choferes.
            <?php else:?>
                Este viaje fue creado por un <b><?php echo $creator_role?></b>, por lo cual <b>no fue enviado realmente a ningún chofer</b>.
            <?php endif;?>
        </p>
    <?php endif?>
<?php else: ?>
    <p>
        Usted recibió este correo porque está registrado en 
        <a href='<?php echo $this->Html->url('/', true)?>'><em>YoTeLlevo</em></a> 
        como chofer que atiende viajes desde/hasta <?php echo $travel['Locality']['name']?>.
    </p>
<?php endif?>