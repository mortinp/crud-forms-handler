<?php
App::uses('Auth', 'Component');
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">

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
                <?php echo $this->element('pending_travel_form', array('do_ajax' => true, 'form_action' => 'edit_pending', 'intent'=>'edit')); ?>
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
                echo $this->Form->checkbox('remember_me').' Recordarme';
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
?>

<?php echo $this->Html->script('travels_view', array('inline' => false));?>