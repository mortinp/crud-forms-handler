<?php App::uses('CakeTime', 'Utility')?>
<?php App::uses('Travel', 'Model')?>

<?php
// INIT
if (!isset($actions)) $actions = true;

$months_es = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
$days_es = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');

$pretty_people_count = $travel['Travel']['people_count'].' persona';
if($travel['Travel']['people_count'] > 1) $pretty_people_count .='s';

$date_converted = strtotime($travel['Travel']['date']);
$day = date('j', $date_converted);
$month = $months_es[date('n', $date_converted) - 1];
$day_of_week = $days_es[date('w', $date_converted)];
$year = date('Y', $date_converted);
$pretty_date = $day.' '.$month.', '.$year.' ('.$day_of_week.')';
//$pretty_date = date('j F, Y (l)', strtotime($travel['Travel']['date']));

$expired = CakeTime::isPast($date_converted) && !CakeTime::isToday($date_converted);
?>

<?php
    $notice = array();
    if($expired) {
        $notice['color'] = Travel::$STATE['E']['color'];
        $notice['label'] = Travel::$STATE['E']['label'];
    } else {
        $notice['color'] = Travel::$STATE[$travel['Travel']['state']]['color'];
        $notice['label'] = Travel::$STATE[$travel['Travel']['state']]['label'];
    }
?>

<?php if($expired) echo '<s>'?>

<legend>
   
    <small style="/*color: */"><i title="<?php echo $notice['label']?>" class="glyphicon glyphicon-flag" style="margin-left:-20px;color:<?php echo $notice['color']?>;display: inline-block"></i></small> 
    
    <big><span id='travel-origin-label'><?php echo $travel['Locality']['name']?></span> - 
        <span id='travel-destination-label'><?php echo $travel['Travel']['destination']?></span>
    </big> 
    <small class="text-muted"><span id='travel-prettypeoplecount-label'><?php echo $pretty_people_count?></span></small>
</legend>
    
<p><b>Día del viaje:</b> <span id='travel-date-label'><?php echo $pretty_date?></span></p>
<p><b>Contactos:</b> <span id='travel-contact-label'><?php echo $travel['Travel']['contact']?></span></p>

<?php if($actions):?>
    <ul style="list-style-type: none;padding:0px">
        
        <?php if(!$expired):?>
        <li style="padding-right: 10px;display: inline-block">
        <?php echo $this->Html->link(
                '<i class="glyphicon glyphicon-eye-open"></i> Ver', 
                array('controller'=>'travels', 'action'=>'view/'.$travel['Travel']['id']), 
                array('escape'=>false, 'class'=>'text-warning', 'title'=>'Ver este viaje'));?>
        </li>
        <?php endif?>
        
    <?php if(!Travel::isConfirmed($travel['Travel']['state'])):?>
        
        <li style="padding-right: 10px;display: inline-block">
        <?php echo $this->Html->link(
            '<i class="glyphicon glyphicon-trash"></i> Eliminar', 
            array('controller'=>'travels', 'action'=>'delete/'.$travel['Travel']['id']), 
                array('escape'=>false, 'class'=>'text-danger', 'title'=>'Eliminar este viaje'));?>
        </li>
        
        <?php if(!$expired):?>
        <li style="padding-right: 10px;display: inline-block">
        <?php echo $this->Html->link(
            '<i class="glyphicon glyphicon-envelope"></i> <b>Confirmar</b>', 
            array('controller'=>'travels', 'action'=>'confirm/'.$travel['Travel']['id']), 
                array('escape'=>false, 'title'=>'Confirmar y Enviar este viaje a los choferes'));?>
        </li>
        <?php endif?>
    <?php elseif(AuthComponent::user('role') === 'admin'):?>
        <li style="padding-right: 10px;display: inline-block">
        <?php echo $this->Html->link(
            '<i class="glyphicon glyphicon-trash"></i> Eliminar', 
            array('controller'=>'travels', 'action'=>'delete/'.$travel['Travel']['id']), 
                array('escape'=>false, 'class'=>'text-danger', 'title'=>'Eliminar este viaje'));?>
        </li>
    <?php endif?>
        
    </ul>
<?php endif?>

<?php if($expired) echo '</s>'?>