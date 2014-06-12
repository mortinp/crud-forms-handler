<?php
App::uses('Auth', 'Component');
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <div id="travel">
                <p>
                    Tienes el siguiente viaje 
                    <span style="color:<?php echo Travel::$STATE[$travel['PendingTravel']['state']]['color']?>">
                        <b><?php echo Travel::$STATE[$travel['PendingTravel']['state']]['label']?></b>
                    </span>:
                </p>
                <?php echo $this->element('pending_travel', array('actions'=>false))?>
                <a title="Edita este viaje" href="#!" class="edit-travel">&ndash; Editar este Viaje</a>
            </div>
            <div id='travel-form' style="display:none">
                <legend>Edita los datos de este viaje antes de confirmarlo <div><a href="#!" class="cancel-edit-travel">&ndash; no editar este viaje</a></div></legend>
                <?php echo $this->element('pending_travel_form', array('do_ajax' => true, 'form_action' => 'edit_pending/' . $travel['PendingTravel']['id'], 'intent'=>'edit')); ?>
                <br/>
            </div>
        </div>

    </div>
</div>
<br/>
<br/>
<div class="row alert alert-info" style="/*background-color: lightblue*/">
    <div class="col-md-8 col-md-offset-2">
        
        <div class="col-md-6">
            <p><b>Estás a sólo un paso</b> de que los choferes puedan contactarte para acordar los términos del viaje.</p>
        
            <p>
            <big><big><b>Regístrate para confirmar este viaje</b></big></big> <span style="display: inline-block">(usa el formulario de la derecha)</span>
                <!--<div>Para confirmar y notificar a los choferes debes estar registrado.</div>-->
                
                <br/>
                <p>Además podrás:</p>
                <ul>
                    <li>Entrar a <em>YoTeLlevo</em> y crear un número ilimitado de viajes.</li>
                    <li>Tener acceso a todas las funcionalidades de <em>YoTeLlevo</em>.</li>
                </ul>
            </p>
        </div>
        <!--<div style="background-color: lightblue;width: 20px;height: 20px"></div>-->
        <div class="col-md-6">
            <?php echo $this->Form->create('User', array('controller' => 'users', 'action' => 'register_and_create/'.$travel['PendingTravel']['id'])); ?>
            <fieldset>
                <?php
                echo $this->Form->input('username', array('label' => 'Correo electrónico', 'type' => 'email', 'id'=>'UserRegisterForm'));
                echo $this->Form->input('password', array('label'=> 'Contraseña', 'placeholder'=>'Escribe la contraseña que usarás para YoTeLlevo'));
                echo $this->Form->submit(__('Registrarme y Confirmar este Anuncio de Viaje'));
                ?>
            </fieldset>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<?php
$this->Html->script('jquery', array('inline' => false));
    
$this->Js->set('travel', $travel);
$this->Js->set('travels_preferences', Travel::$preferences);
$this->Js->set('localities', $localities);
echo $this->Js->writeBuffer(array('inline' => false));

//$this->Html->script('common/ajax-forms', array('inline' => false));
?>

<?php echo $this->Html->script('travels_view', array('inline' => false));?>
<!--<script type="text/javascript">
function _ajaxifyForm(a,b,c,d){null!=b&&setupFormForEdit(a,b,c);var e=c[0].toUpperCase()+c.substring(1),f=""!=a.attr("onsubmit")&&null!=a.attr("onsubmit")&&void 0!=a.attr("onsubmit");if(1==f){var g=$("#"+c+"-ajax-message");a.submit(function(){var b=$("#"+e+"Submit").val();$("#"+e+"Submit").attr("disabled",!0),$("#"+e+"Submit").val("Espera ..."),$(this).serialize(),$(this).attr("action"),$.ajax({type:"POST",data:$(this).serialize(),url:$(this).attr("action"),success:function(b){b=JSON.parse(b);var f=e;if(void 0!=aliases[c]&&null!=aliases[c]&&(f=aliases[c]),g.empty().append($("<div class='alert alert-success'>Los datos del <b>"+f+"</b> fueron salvados exitosamente.</div>")),setTimeout(function(){g.empty()},5e3),d)if(null!=b&&"object"==typeof b&&null!=b.object)d(b.object);else{var h=a.find("input, textarea"),i={};$.each(h,function(a,b){elem=$(b),null!=elem.attr("id")&&(entryName=elem.attr("id").replace(e,"").toLowerCase(),i[entryName]=elem.val())}),d(i)}},error:function(){g.append("<div class='alert alert-danger'><b>"+c[0].toUpperCase()+c.substring(1)+"</b> data could not be saved.</div>")},complete:function(){$("#"+e+"Submit").attr("disabled",!1),$("#"+e+"Submit").val(b)}})})}}function setupFormForEdit(a,b,c){if(null!=b.id){var d=capitalizarAlias(c);for(k in b){var e=capitalizarAlias(k),f=a.find("#"+d+e);f.val(b[k])}a.attr("action",a.attr("action").replace("/add","/edit/"+b.id))}}function capitalizarAlias(a){return splitWith(a,"")}function stringifyAlias(a){return splitWith(a," ")}function splitWith(a,b){result="",parts=a.split("_"),sep="";for(p in parts)result+=sep+parts[p].substring(0,1).toUpperCase()+parts[p].substring(1,parts[p].length),sep=b;return result}function hasPreferences(a){for(var b in window.app.travels_preferences)if("1"==a[b])return!0;return!1}var aliases={travel:"viaje"},months=new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"),weekDays=new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");$(document).ready(function(){_ajaxifyForm($("#TravelForm"),null,"travel",function(a){$("#travel-locality-label").text($("#TravelLocalityId option:selected").text()),$("#travel-where-label").text(a.where);var b=a.date.split("/"),c=new Date(b[1]+"/"+b[0]+"/"+b[2]),d=c.getDate()+" "+months[c.getMonth()]+", "+c.getFullYear()+" ("+weekDays[c.getDay()]+")";$("#travel-date-label").text(d);var e=a.people_count+" persona";a.people_count>1&&(e+="s"),$("#travel-prettypeoplecount-label").text(e);var f=$("#preferences-place");if(f.empty(),hasPreferences(a)){f.append("<p><b>Preferencias:</b> <span id='travel-preferences-label'></span></p>");var g=$("#travel-preferences-label");g.text("");var h="";for(var i in window.app.travels_preferences)"1"==a[i]&&(g.text(g.text()+h+window.app.travels_preferences[i]),h=", ");f.show()}else f.empty(),f.hide();$("#travel-contact-label").text(a.contact),$("#travel-form, #travel").toggle()}),$(".edit-travel, .cancel-edit-travel").click(function(){$("#travel-form, #travel").toggle()})});
</script>-->
