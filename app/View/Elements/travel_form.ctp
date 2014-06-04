<?php App::uses('User', 'Model')?>

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
    $saveButtonText = 'Crear Anuncio';
else
    $saveButtonText = 'Salvar Datos';

$form_disabled = !User::canCreateTravel()/*AuthComponent::user('travel_count') > 0 && !AuthComponent::user('email_confirmed')*/;

$labelOrigin = 'Origen del viaje';
$labelDestination = 'Destino del Viaje';
if($intent == 'add') {
    $labelOrigin .= ' <div style="display:inline"><a href="#!" class="travel-switch">&ndash; Prefiero usar esta lista como <em><b>Destino del Viaje</b></em></a></div>';
    $labelDestination .= ' <div style="display:inline"><a href="#!" class="travel-switch">&ndash; Prefiero usar esta lista como <em><b>Origen del Viaje</b></em></a></div>';
}
?>

<?php if($intent === 'add' && $form_disabled):?>
    <div class="alert alert-warning">
        <b>Verifica tu cuenta de correo electrónico</b> para crear más anuncios de viajes. 
        El formulario de viajes permanecerá desactivado hasta que verifiques tu cuenta. 
        <div style="padding-top: 10px">
            <big><big><b><?php echo $this->Html->link('<i class="glyphicon glyphicon-ok"></i> Enviar correo de verificación', array('controller'=>'users', 'action'=>'send_confirm_email'), array('escape'=>false))?></b></big></big>
            <div><small>(Enviaremos un correo a <b><?php echo AuthComponent::user('username')?></b> con las instrucciones)</small></div>
        </div>        
    </div>
<?php else:?>
    <div>
        <div id='travel-ajax-message'></div>
        <div id="TravelFormDiv">
            <?php
            echo $this->Form->create('Travel', array('default' => !$do_ajax, 'url' => array('controller' => 'travels', 'action' => $form_action), 'style' => $style, 'id' => 'TravelForm'));
            ?>
        
        <fieldset>
            <?php
            
            //$travel_out_switcher = 'Selecciona el <b>Origen del viaje</b> <div style="display:inline"><a href="#!" class="travel-switch">&ndash; Prefiero seleccionar el <b>Destino del viaje</b></a></div><br/><br/>';
            //$travel_in_switcher = 'Selecciona el <b>Destino del viaje</b> <div style="display:inline"><a href="#!" class="travel-switch">&ndash; Prefiero seleccionar el <b>Origen del viaje</b></a></div><br/><br/>';
            
            // Viajes que son desde una localidad, hacia otro lugar
            $travel_out =
                $this->Form->input('locality_id', array('type' => 'select', 'options' => $localities, 'showParents' => true,
                'label' => __($labelOrigin))).
                $this->Form->input('where', array('type' => 'text', 'label' => __('Destino del viaje'), 'placeholder' => 'Nombre de tu destino (puede ser cualquier lugar)')).
                $this->Form->input('direction', array('type'=>'hidden', 'value'=>'0'));
            
            // Viajes que son desde otro lugar hacia una localidad
            $travel_in =                
                $this->Form->input('where', array('type' => 'text', 'label' => __('Origen del viaje'), 'placeholder' => 'Nombre de tu origen de viaje (puede ser cualquier lugar)')).
                    $this->Form->input('locality_id', array('type' => 'select', 'options' => $localities, 'showParents' => true,
                'label' => __($labelDestination))).
                $this->Form->input('direction', array('type'=>'hidden', 'value'=>'1'));
            
            ?>
            
            <div id="travel-def">
                <?php
                    if($intent == 'add') {
                        echo /*$travel_out_switcher.*/$travel_out;
                    } else {
                         if($travel['Travel']['direction'] == 0) echo $travel_out;
                         else echo $travel_in;
                    }   
                ?>
            </div>
            
            <?php            
            echo $this->Form->custom_date('date', array('label' => __('Cuándo'), 'dateFormat' => 'dd/mm/yyyy'));
            echo $this->Form->input('people_count', array('label' => __('Personas que viajan <small class="text-info">(máximo número de personas)</small>'), 'default' => 1, 'min' => 1));
            echo $this->Form->checkbox_group(Travel::$preferences, array('header'=>'Preferencias <small class="text-info">(selecciona sólo si quieres esto obligatoriamente)</small>'));
            echo $this->Form->input('contact', array('label' => __('Información de Contacto'), 
                'placeholder' => 'Explica a los choferes la forma de contactarte (número de teléfono, correo electrónico o cualquier otra forma que prefieras). Escribe algo como: llamar al teléfono 12-3456 a Pepito.'));
            echo $this->Form->input('id', array('type' => 'hidden'));
            
            $submitOptions = array('style' => $buttonStyle, 'id'=>'TravelSubmit');
            //if(!$do_ajax) $submitOptions['onclick'] = 'this.value="Espere ...";this.disabled=true;this.form.disabled=true;this.form.submit();';
            echo $this->Form->submit(__($saveButtonText), $submitOptions);
            if ($is_modal)
                echo $this->Form->button(__('Cancelar'), array('id' => 'btn-cancel-travel', 'style' => 'display:inline-block'));
            ?>
        </fieldset>
    <?php echo $this->Form->end(); ?>
        </div>
        <?php
        if($intent == 'add'):?>
        <br/>
        <div class="alert alert-warning">
            La <b>Información de Contacto</b> es importante para que los choferes lleguen a tí. 
            Asegúrate de que esta información sea correcta.
        </div>
        <?php endif?>
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
//$this->Html->script('vitalets-bootstrap-datepicker/locales/bootstrap-datepicker.es', array('inline' => false));

$this->Html->script('jquery-validation-1.10.0/dist/jquery.validate.min', array('inline' => false));
$this->Html->script('jquery-validation-1.10.0/localization/messages_es', array('inline' => false));

    
// Pass to js
if($intent == 'add' && !$form_disabled) {
    $this->Js->set('travel_on', /*$travel_out_switcher.*/$travel_out);
    $this->Js->set('travel_off', /*$travel_in_switcher.*/$travel_in);
    echo $this->Js->writeBuffer(array('inline' => false));
}
?>

<script type="text/javascript">
    $(document).ready(function() {
        <?php if($intent == 'add' && !$form_disabled):?>
        var travelOn = window.app.travel_on;
        var travelOff = window.app.travel_off;
        var switcher = function() {
            $('#travel-def').empty().append(travelOff);
            var temp = travelOn;
            travelOn = travelOff;
            travelOff = temp;
            $('.travel-switch').click(switcher);
            //$('.popover-info').popover({html:true});
        };
        $('.travel-switch').click(switcher);
        <?php endif?>
        //$('.popover-info').popover({html:true});
        
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
        
        <?php if(!$do_ajax):?>
            $('#TravelForm').submit(function() {
                if (!$(this).valid()) return false;
                
                //$('#TravelForm :input').prop('disabled', true);
                //$('#TravelFormDiv').prop('disabled', true);
                
                $('#TravelSubmit').attr('disabled', true);
                $('#TravelSubmit').val('Espera ...');
            })
        <?php endif?>
    })
</script>