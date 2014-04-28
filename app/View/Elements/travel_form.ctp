<?php
if (!isset($do_ajax))
    $do_ajax = false;

if(!isset ($intent)) $intent = 'add';
if (!isset($form_action)) {
    $form_action = 'add';
    $intent = 'add';
}

if (!isset($style))
    $style = '';
if (!isset($is_modal))
    $is_modal = false;

$buttonStyle = '';
if ($is_modal)
    $buttonStyle = 'display:inline-block;float:left';

if (empty($this->request->data))
    $saveButtonText = 'Crear';
else
    $saveButtonText = 'Salvar';


?>

<?php if($intent === 'add' && AuthComponent::user('travel_count') > 0 && !AuthComponent::user('email_confirmed')):?>
    <div class="alert alert-warning">
        <b>Verifica tu cuenta de correo electrónico</b> para crear más anuncios de viajes. 
        El formulario de viajes permanecerá desactivado hasta que verifiques tu cuenta. 
        <div>
            <big><b><?php echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i> Verificar cuenta', array('controller'=>'users', 'action'=>'send_confirm_email'), array('escape'=>false))?></b></big>
            <div><small>(Enviaremos un correo a <b><?php echo AuthComponent::user('username')?></b> con las instrucciones)</small></div>
        </div>        
    </div>
<?php else:?>
    <div>
        <div id='travel-ajax-message'></div>
            <?php
            echo $this->Form->create('Travel', array('default' => !$do_ajax, 'url' => array('controller' => 'travels', 'action' => $form_action), 'style' => $style, 'id' => 'TravelForm'));
            ?>
        
        <fieldset>
            <?php
            
            $travel_out_switcher = 'Escoge el origen y escribe el destino <div style="display:inline"><a href="#!" class="travel-switch">&ndash; Prefiero <b>escribir el origen</b> y <b>escoger el destino</b></a></div><br/><br/>';
            $travel_in_switcher = 'Escribe el origen y escoge el destino <div style="display:inline"><a href="#!" class="travel-switch">&ndash; Prefiero <b>escoger el origen</b> y <b>escribir el destino</b></a></div><br/><br/>';
            
            // Viajes que son desde una localidad, hacia otro lugar
            $travel_out =
                $this->Form->input('locality_id', array('type' => 'select', 'options' => $localities, 'showParents' => true,
                'label' => __('Origen del viaje') . ' 
                <small><a class="popover-info" href="#!" data-container="body" data-toggle="popover" data-placement="bottom" 
                    data-content="Para que un origen de viaje aparezca en esta lista, <b>debe haber choferes registrados para ese origen</b>, de tal forma que los viajeros puedan ser atendidos. Los orígenes de viaje se adicionan en cuanto se registra el primer chofer para ese origen.">&ndash; ¿Por qué mi <em>origen de viaje</em> no aparece aquí?</a>
                </small>')).
                $this->Form->input('where', array('type' => 'text', 'label' => __('Destino'), 'placeholder' => 'Nombre de tu destino (puede ser cualquier lugar)')).
                $this->Form->input('direction', array('type'=>'hidden', 'value'=>'0'));
            
            // Viajes que son desde otro lugar hacia una localidad
            $travel_in =                
                $this->Form->input('where', array('type' => 'text', 'label' => __('Origen del viaje'), 'placeholder' => 'Nombre de tu origen de viaje (puede ser cualquier lugar)')).
                    $this->Form->input('locality_id', array('type' => 'select', 'options' => $localities, 'showParents' => true,
                'label' => __('Destino') . ' 
                <small><a class="popover-info" href="#!" data-container="body" data-toggle="popover" data-placement="bottom" 
                    data-content="Para que un destino aparezca en esta lista, <b>debe haber choferes registrados para ese destino</b>, de tal forma que los viajeros puedan ser atendidos. Los destinos de viaje se adicionan en cuanto se registra el primer chofer para ese destino.">&ndash; ¿Por qué mi <em>destino</em> no aparece aquí?</a>
                </small>')).
                $this->Form->input('direction', array('type'=>'hidden', 'value'=>'1'));
            
            ?>
            
            <div id="travel-def">
                <?php
                    if($intent == 'add') {
                        echo $travel_out_switcher.$travel_out;
                    } else {
                         if($travel['Travel']['direction'] == 0) echo $travel_out;
                         else echo $travel_in;
                    }   
                ?>
            </div>
            
            <!--Escoge el origen y escribe el destino <div style="display:inline"><a href="#!">&ndash; Prefiero <b>escribir el origen</b> y <b>escoger el destino</b></a></div>
            <br/>
            <br/>-->
            <?php
            /*echo $this->Form->input('locality_id', array('type' => 'select', 'options' => $localities, 'showParents' => true,
                'label' => __('Origen del viaje') . ' 
            <small><a class="popover-info" href="#!" data-container="body" data-toggle="popover" data-placement="bottom" 
                data-content="Para que un origen de viaje aparezca en esta lista, <b>debe haber choferes registrados para ese origen</b>, de tal forma que los viajeros puedan ser atendidos. Los orígenes de viaje se adicionan en cuanto se registra el primer chofer para ese origen.">&ndash; ¿Por qué mi <em>origen de viaje</em> no aparece aquí?</a>
            </small>'));
            echo $this->Form->input('where', array('type' => 'text', 'label' => __('Destino'), 'placeholder' => 'Nombre de tu destino (puede ser cualquier lugar)'));
            echo $this->Form->input('direction', array('type'=>'hidden', 'value'=>'0'));*/
            
            echo $this->Form->custom_date('date', array('label' => __('Cuándo'), 'dateFormat' => 'dd/mm/yyyy'));
            echo $this->Form->input('people_count', array('label' => __('Personas que viajan <small class="text-info">(máximo número de personas)</small>'), 'default' => 1, 'min' => 1));
            echo $this->Form->checkbox_group(Travel::$preferences, array('header'=>'Preferencias <small class="text-info">(selecciona sólo si quieres esto obligatoriamente)</small>'));
            echo $this->Form->input('contact', array('label' => __('Contactos'), 'placeholder' => 'Explica a los choferes la forma de contactarte (número de teléfono, correo electrónico o cualquier otra forma que prefieras). Especifica detalles si deseas, como la hora para contactarte, tu nombre, etc.'));
            echo $this->Form->input('id', array('type' => 'hidden'));
            echo $this->Form->submit(__($saveButtonText), array('style' => $buttonStyle));
            if ($is_modal)
                echo $this->Form->button(__('Cancelar'), array('id' => 'btn-cancel-travel', 'style' => 'display:inline-block'));
            ?>
        </fieldset>
    <?php echo $this->Form->end(); ?>
    </div>
<?php endif?>



<?php
// CSS
$this->Html->css('bootstrap', array('inline' => false));
$this->Html->css('vitalets-bootstrap-datepicker/datepicker.min', array('inline' => false));

//JS
$this->Html->script('jquery', array('inline' => false));
//$this->Html->script('jquery-ui', array('inline' => false)); 
$this->Html->script('bootstrap', array('inline' => false));
$this->Html->script('vitalets-bootstrap-datepicker/bootstrap-datepicker.min', array('inline' => false));
$this->Html->script('vitalets-bootstrap-datepicker/locales/bootstrap-datepicker.es', array('inline' => false));

$this->Html->script('jquery-validation-1.10.0/dist/jquery.validate.min', array('inline' => false));
$this->Html->script('jquery-validation-1.10.0/localization/messages_es', array('inline' => false));

    
// Pass to js
if($intent == 'add') {
    $this->Js->set('travel_on', $travel_out_switcher.$travel_out);
    $this->Js->set('travel_off', $travel_in_switcher.$travel_in);
    echo $this->Js->writeBuffer(array('inline' => false));
}
?>

<script type="text/javascript">
    $(document).ready(function() {
        <?php if($intent == 'add'):?>
        var travelOn = window.app.travel_on;
        var travelOff = window.app.travel_off;
        var switcher = function() {
            $('#travel-def').empty().append(travelOff);
            var temp = travelOn;
            travelOn = travelOff;
            travelOff = temp;
            $('.travel-switch').click(switcher);
            $('.popover-info').popover({html:true});
        };
        $('.travel-switch').click(switcher);
        <?php endif?>
        $('.popover-info').popover({html:true});
        
        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            language: 'es',
            startDate: 'today',
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true
        });
        
        $('#TravelForm').validate({
            wrapper: 'div',
            errorClass: 'text-danger',
            errorElement: 'div'
        });        
    })
</script>