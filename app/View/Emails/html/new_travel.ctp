<?php echo $this->element('travel', array('travel'=>$travel, 'actions'=>false))?>

<br/>
<br/>

<p>
    Usted recibió este correo porque está registrado en 
    <a href='<?php echo $this->Html->url('/', true)?>'><em>YoTeLlevo</em></a> 
    como chofer que atiende viajes desde <?php echo $travel['Locality']['name']?>.
</p>

<?php 
    if(isset ($to_admin) && $to_admin == true && isset ($drivers) && count($drivers) > 0) {
        echo 'se encontraron los siguientes choferes para notificar:<ul>';
        foreach ($drivers as $d) {
            echo '<li>'.$d['Driver']['username'].'</li>';
        }
        echo '</ul>';
    }
?>