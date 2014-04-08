<?php echo $this->element('travel', array('travel'=>$travel, 'actions'=>false))?>

<br/>
<br/>

<p>
    Usted recibió este correo porque está registrado en 
    <a href='<?php echo $this->Html->url('/', true)?>'><em>YoTeLlevo</em></a> 
    como chofer que atiende viajes desde <?php echo $travel['Locality']['name']?>.
</p>