<?php App::uses('User', 'Model')?>
<?php App::uses('Travel', 'Model')?>

<?php
if (!isset($do_ajax))
    $do_ajax = false;

if(!isset ($intent)) $intent = 'add_pending';
if (!isset($form_action)) {
    $form_action = 'add_pending';
    $intent = 'add_pending';
}

if (!isset($style))
    $style = '';
if (!isset($is_modal))
    $is_modal = false;

/*if (empty($this->request->data))
    $saveButtonText = 'Crear Anuncio';
else
    $saveButtonText = 'Salvar Datos';*/

if(!isset($horizontal)) $horizontal = false;

$origin = '';
$destination = '';
if(isset ($travel) && !empty ($travel)) {
    $saveButtonText = 'Salvar Datos';
    
    $origin = $travel['PendingTravel']['origin'];
    $destination = $travel['PendingTravel']['destination'];
    
} else {
    $saveButtonText = 'Crear Anuncio';
}

$buttonStyle = '';
if ($is_modal)
    $buttonStyle = 'display:inline-block;float:left';

$asLink = false;
if(isset ($bigButton) && $bigButton == true) {
    $saveButtonText .= "<div style='font-size:12pt;padding-left:50px;padding-right:50px'>Enseguida contactarás con hasta 3 de nuestros choferes</div>";//Enseguida te pondremos en contacto con un chofer para que acuerdes los detalles del viaje
    $buttonStyle = 'font-size:18pt;white-space: normal;';
    $asLink = true;
}


$form_disabled = !User::canCreateTravel()/*AuthComponent::user('travel_count') > 0 && !AuthComponent::user('email_confirmed')*/;
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
        echo $this->Form->create('PendingTravel', array('default' => !$do_ajax, 'url' => array('controller' => 'travels', 'action' => $form_action), 'style' => $style, 'id'=>'TravelForm'));?>
        <fieldset>
        <?php if(!$horizontal):?>
            <?php
            echo $this->Form->input('origin', array('type' => 'text', 'class'=>'locality-typeahead', 'label' => 'Origen del Viaje', 'required'=>true, 'value'=>$origin, 'autofocus'=>'autofocus'));
            echo $this->Form->input('destination', array('type' => 'text', 'class'=>'locality-typeahead', 'label' => 'Destino del Viaje', 'required'=>true, 'value'=>$destination));

            echo $this->Form->custom_date('date', array('label' => __('Cuándo'), 'dateFormat' => 'dd/mm/yyyy'));
            echo $this->Form->input('people_count', array('label' => __('Personas que viajan <small class="text-info">(máximo número de personas)</small>'), 'default' => 1, 'min' => 1));
            echo $this->Form->checkbox_group(Travel::$preferences, array('header'=>'Preferencias <small class="text-info">(selecciona sólo si quieres esto obligatoriamente)</small>'));
            echo $this->Form->input('contact', array('label' => __('Tu Información de Contacto'), 
                'placeholder' => 'Explica a los choferes la forma de contactarte (número de teléfono, correo electrónico o cualquier otra forma que prefieras). Escribe algo como: Llamar al teléfono 12345678 a Pepito.'));
            echo $this->Form->input('id', array('type' => 'hidden'));
            
            $submitOptions = array('style' => $buttonStyle, 'id'=>'TravelSubmit', 'escape'=>false);
            echo $this->Form->submit($saveButtonText, $submitOptions, $asLink);
            ?>
        <?php else:?>
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="TravelOrigin">Origen del Viaje</label>
                        <!--<div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>-->
                            <input name="data[PendingTravel][origin]" class="form-control locality-typeahead" required="required" value="" autofocus="autofocus" type="text" id="TravelOrigin"/>
                        <!--</div>-->
                    </div>
                    <div class="form-group">
                        <label for="TravelDestination">Destino del Viaje</label>
                        <!--<div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>-->
                            <input name="data[PendingTravel][destination]" class="form-control locality-typeahead" required="required" value="" type="text" id="TravelDestination"/>
                        <!--</div>-->
                    </div>
                    <?php 
                    echo $this->Form->custom_date('date', array('label' => __('Cuándo'), 'dateFormat' => 'dd/mm/yyyy'));
                    echo $this->Form->input('people_count', array('label' => __('Personas que viajan <small class="text-info">(máximo número de personas)</small>'), 'default' => 1, 'min' => 1));
                    ?>
                </div>
                <div class="col-md-6">
                    <div class="form-group required">
                        <label for="TravelContact">Información de Contacto</label>
                        <textarea name="data[PendingTravel][contact]" class="form-control" placeholder="Explica a los choferes la forma de contactarte (número de teléfono, correo electrónico o cualquier otra forma que prefieras). Escribe algo como: llamar al teléfono 12-3456 a Pepito." cols="30" rows="6" id="TravelContact" required="required"></textarea>
                    </div>
                    <div style="clear:both;height:100%;overflow:auto;padding-bottom:10px">
                        <div>
                                <label>Preferencias</label>
                        </div>
                        <div style="padding-right:10px;float:left">
                            <input type="hidden" name="data[PendingTravel][need_modern_car]" id="TravelNeedModernCar_" value="0"/>
                            <input type="checkbox" name="data[PendingTravel][need_modern_car]"  value="1" id="TravelNeedModernCar"/> Auto Moderno
                        </div>
                        <div style="padding-right:10px;float:left">
                            <input type="hidden" name="data[PendingTravel][need_air_conditioner]" id="TravelNeedAirConditioner_" value="0"/>
                            <input type="checkbox" name="data[PendingTravel][need_air_conditioner]"  value="1" id="TravelNeedAirConditioner"/> Aire Acondicionado
                        </div>
                    </div>
                    <input type="hidden" name="data[PendingTravel][id]" class="form-control" value="" id="TravelId"/>
                </div>	
            </div>
            <div class="submit col-md-6 col-md-offset-3">
                <!--<a href="javascript:void" class="btn btn-primary" style="font-size:18pt;white-space: normal;" id="TravelSubmit" onclick="form=get_form(this);if($(form).valid())form.submit();return false;">
                                                        Crear Anuncio
                    <div style='font-size:12pt;padding-left:50px;padding-right:50px'>
                                                        Enseguida contactarás con hasta 3 de nuestros choferes
                    </div>
                </a>-->
                <?php $submitOptions = array('style' => $buttonStyle, 'id'=>'TravelSubmit', 'escape'=>false);
                echo $this->Form->submit($saveButtonText, $submitOptions, $asLink);?>
            </div>
            
            
        <?php endif?>        
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
$this->Html->css('typeaheadjs-bootstrapcss/typeahead.js-bootstrap', array('inline' => false));

//JS
$this->Html->script('jquery', array('inline' => false));
$this->Html->script('bootstrap', array('inline' => false));

$this->Html->script('vitalets-bootstrap-datepicker/bootstrap-datepicker.min', array('inline' => false));

$this->Html->script('jquery-validation-1.10.0/dist/jquery.validate.min', array('inline' => false));
$this->Html->script('jquery-validation-1.10.0/localization/messages_es', array('inline' => false));

$this->Html->script('typeaheadjs/typeahead-martin', array('inline' => false));


$this->Js->set('localities', $localities);
echo $this->Js->writeBuffer(array('inline' => false));

?>

<script type="text/javascript">    
    $(document).ready(function() {        
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

<script type="text/javascript">
    $(document).ready(function() {
        $('input.locality-typeahead').typeahead({
            //name: 'localities',
            //header: '<b>Localidades</b>',
            valueKey: 'name',
            local: window.app.localities
        }).on('typeahead:selected', function(event, datum) {
            /*if($(event.target).attr('id') == 'TravelOrigin') {
                $('#TravelForm').find('#TravelOriginId').remove();
                $('#TravelForm').append('<input type="hidden" id="TravelOriginId" name="data[Travel][origin_id]" value="' + datum.id + '">');
            } else if($(event.target).attr('id') == 'TravelDestination') {
                $('#TravelForm').find('#TravelDestinationId').remove();
                $('#TravelForm').append('<input type="hidden" id="TravelDestinationId" name="data[Travel][destination_id]" value="' + datum.id + '">');
            }*/
        });
        
        $('input.tt-hint').addClass('form-control');
        $('.twitter-typeahead').css('display', 'block');
    });
    
    /*var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    // the typeahead jQuery plugin expects suggestions to a
                    // JavaScript object, refer to typeahead docs for more info
                    matches.push({ value: str });
                }
            });

            cb(matches);
        };
    };*/

</script>

<script type="text/javascript">
    //<![CDATA[
    function get_form( element )
    {
        while( element )
        {
            element = element.parentNode
            if( element.tagName.toLowerCase() == "form" )
            {
                //alert( element ) //debug/test
                return element
            }
        }
        return 0; //error: no form found in ancestors
    }
    //]]>
</script>