<?php 
$isLoggedIn = AuthComponent::user('id') ? true : false;
?>

<div class="container">

    <div class="row">
        <div class="col-md-5">
            <div style="font-size: 48pt">
                <!--<?php echo $this->Html->image('i.jpg', array('alt'=>'YoTeLlevo', 'class'=>'img-responsive'))?>-->
                YoTeLlevo
            </div>
            
            <h2 style="font-size: 16pt;line-height: 28px;/*text-align: center*/">
                Consigue un taxi que te lleve a cualquier parte de Cuba, de la manera más fácil, cómoda y rápida. Garantizado.
            </h2>
            
            <br/> 
            <div style="background-color: lightyellow"><?php echo $this->element('features', array('colspan'=>6))?></div>
            
            <br/>
            <br/>
            <p><b>¿Ya estás registrado en <em>YoTeLlevo</em>?</b> <big><?php echo $this->Html->link(__('Entra y mira tus anuncios'), array('controller' => 'users', 'action' => 'login')) ?></big></p>
            
        </div>
        <div class="col-md-6 col-md-offset-1 well" style="background-color: lightblue">
            <legend><big>Crear Anuncio de Viaje</big></legend>
            <?php echo $this->element('pending_travel_form', array('bigButton'=>true)); ?>
        </div>
    </div>
</div>