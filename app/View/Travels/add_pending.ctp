<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <p>
                Estás creando un anuncio sin haber iniciado sesión en <em>YoTeLlevo</em>. 
                Si ya estás registrado <?php echo $this->Html->link(__('entra con tu cuenta'), array('controller' => 'users', 'action' => 'login')) ?>
            </p>
            <legend><big>Crear Anuncio de Viaje</big></legend>
            <?php echo $this->element('pending_travel_form'); ?>
        </div>
    </div>
</div>