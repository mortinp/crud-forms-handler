<div class="row">
<?php if(!empty ($travels)): ?>
    <div class="col-md-5 col-md-offset-1">
        <?php
            $months_es = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
            $days_es = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
            ?>
            <h3>Tus Anuncios de Viajes</h3>
            <br/>

            <ul style="list-style-type: none;padding: 0px">
            <?php foreach ($travels as $travel) :?>
                <?php
                $pretty_people_count = $travel['Travel']['people_count'].' persona';
                if($travel['Travel']['people_count'] > 1) $pretty_people_count .='s';


                $date_converted = strtotime($travel['Travel']['date']);
                $day = date('j', $date_converted);
                $month = $months_es[date('n', $date_converted) - 1];
                $day_of_week = $days_es[date('w', $date_converted)];
                $year = date('Y', $date_converted);
                $pretty_date = $day.' '.$month.', '.$year.' ('.$day_of_week.')';
                //$pretty_date = date('j F, Y (l)', strtotime($travel['Travel']['date']));
                ?>

                
                <li style="margin-bottom: 20px">
                    <?php echo $this->element('travel', array('travel'=>$travel))?>
                    <!--<legend><big><?php echo $travel['Locality']['name'].' - '.$travel['Travel']['destination']?></big> <small class="text-muted"><?php echo $pretty_people_count?></small></legend>
                    <p><b>Día del viaje:</b> <?php echo $pretty_date?></p>
                    <p><b>Contactos:</b> <?php echo $travel['Travel']['contact']?></p>-->
                </li>
                
            <?php endforeach; ?>
            </ul>
            
        <!--<?php echo $this->Html->link("<i class='glyphicon glyphicon-flag'></i> <big>Crear un nuevo anuncio</big>", array('controller'=>'travels', 'action'=>'add'), array('escape'=>false))?>-->
            
    </div>
    <div class="col-md-4 col-md-offset-1">
        <legend>Crea un nuevo anuncio de viaje</legend>
        <?php echo $this->element('travel_form')?>
    </div>
        
<?php else :?>
    <div class="col-md-6 col-md-offset-3">
        <legend>No tienes ningún anuncio de viaje. Crea uno ahora</legend>
        <?php echo $this->element('travel_form')?>
    </div>

<?php endif; ?>
      
</div>