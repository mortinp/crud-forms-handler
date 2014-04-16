<?php
$isConfirmed = Travel::isConfirmed($travel['Travel']['state']);

if($isConfirmed) {
    $pretty_drivers_count = $travel['Travel']['drivers_sent_count'].' chofer';
    if($travel['Travel']['drivers_sent_count'] > 1) $pretty_drivers_count .= 'es';
}
?>

<div class="row">
    <div class="col-md-6 col-md-offset-1"> 
        <div id="travel">
            <?php echo $this->element('travel', array('actions'=>false))?>
            <?php if(!$isConfirmed):?><a title="Edita este viaje" href="#!" class="edit-travel">&ndash; Editar</a><?php endif?>
        </div>
        <?php if(!$isConfirmed):?>
        <div id='travel-form' style="display:none">
            <legend>Edita los datos de este viaje antes de confirmar <a href="#!" class="cancel-edit-travel">&ndash; no editar</a></legend>
            <?php echo $this->element('travel_form', array('do_ajax' => true, 'form_action' => 'edit/' . $travel['Travel']['id'])); ?>
            <br/>
        </div>
        <?php endif?>
        
        <br/>
        
        <?php if(!$isConfirmed):?>
            <div class="alert alert-info">
                <span class="text-warning">Este viaje está sin confirmar.</span> Los choferes NO te contactarán hasta que confirmes este viaje 
                <div>
                    &mdash; <?php echo $this->Html->link('<i class="glyphicon glyphicon-envelope"></i> Confirmar viaje ahora', 
                        array('controller'=>'travels', 'action'=>'confirm/'.$travel['Travel']['id']), 
                        array('escape'=>false, 'class'=>'alert-link', 'title'=>'Confirmar y Enviar este viaje a los choferes'))?>
                </div>
            </div>
        <?php else:?>
            <div class="alert alert-info">
                <b>Este anuncio de viaje fue confirmado exitosamente y enviado a <big><?php echo $pretty_drivers_count?></big></b>. Pronto serás contactado.
            </div>
        <?php endif;?>
        
        
        <br/>
        <?php echo $this->Html->link("<i class='glyphicon glyphicon-bell'></i> <big>Ver todos mis anuncios</big>", array('controller'=>'travels', 'action'=>'index'), array('escape'=>false))?>
    </div>
    
    
    <div class="col-md-3 col-md-offset-1">
        <?php if(!$isConfirmed):?>
        
            <legend>Sobre este viaje:</legend>
            <ul style="list-style-type: none;padding-left:20px">
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    Este viaje está sin confirmar y no ha sido enviado a ningún chofer todavía.
                    <b>Hasta que confirmes este viaje, tu anuncio no será atendido</b>.
                </li>
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    <b>Puedes hacer modificaciones a los datos del viaje antes de confirmalo</b>.
                    Al confirmarlo, ya no podrás hacer cambios al anuncio.
                </li>
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    Al confirmar el viaje, varios choferes que pudieran atenderte serán notificados.
                    <b>Los choferes interesados contactarán contigo por la vía que indiques en los contactos</b>.
                </li>
                <li style="padding-bottom: 15px">
                    <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                    <b>Asegúrate de que los datos del viaje son correctos antes de confirmarlo</b>. Esto evita que los choferes sean
                    notificados y tú contactado equivocadamente.
                </li>
            </ul>
            
        <?php endif;?>
    </div>
    
</div>

<?php
$this->Html->script('jquery', array('inline' => false));
    
$this->Js->set('travel', $travel);
echo $this->Js->writeBuffer(array('inline' => false));

$this->Html->script('common/ajax-forms', array('inline' => false));
?>

<?php if(!$isConfirmed):?>
<script type="text/javascript">
    
    var months = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    var weekDays = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
    
    $(document).ready(function() {
        _ajaxifyForm($("#TravelForm"), null, "travel", function(obj) {
            $('#travel-origin-label').text($("#TravelLocalityId option:selected").text());
            $('#travel-destination-label').text(obj.destination);            
            
            var d = obj.date.split('/');
            var dd = new Date(d[1] + '/' + d[0] + '/' + d[2]);
            var prettyDate = dd.getDate() + ' ' + months[dd.getMonth()] + ', ' + dd.getFullYear() + ' (' + weekDays[dd.getDay()] + ')';
            $('#travel-date-label').text(prettyDate);
            
            var prettyPeopleCount = obj.people_count + ' persona' 
            if(obj.people_count > 1) prettyPeopleCount += 's';
            $('#travel-prettypeoplecount-label').text(prettyPeopleCount);
            
            $('#travel-contact-label').text(obj.contact);
            
            
            $('#travel-form, #travel').toggle();
        });

        //var show = true
        $('.edit-travel, .cancel-edit-travel').click(function() {
            $('#travel-form, #travel').toggle();
        });
    });
</script>
<?php endif?>