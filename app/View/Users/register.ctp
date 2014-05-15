<div class="container">
<div class="row">
    <div class="col-md-5 col-md-offset-1">
        <?php echo $this->Session->flash('auth'); ?>
        <legend><?php echo __('Regístrate (o ' . $this->Html->link('Entra', array('controller' => 'users', 'action' => 'login')) . ' si ya tienes cuenta)'); ?></legend>
        <?php echo $this->element('register_form') ?>
        
        <!--<br/>
        <div class="alert alert-info">Los choferes no se registran directamente.</div>-->
    </div>
    <div class="col-md-4 col-md-offset-1">
        <legend>Es importante que sepas:</legend>
        <ul style="list-style-type: none;padding-left:20px">
            <li style="padding-bottom: 15px">
                <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                <b>Las cuentas para poner anuncios de viajes son <big>gratis</big></b>, y puedes poner todos los anuncios que desees.
                <b>No hay límites para la cantidad de anuncios</b> que puedes publicar, y <b>tu cuenta sirve por tiempo ilimitado</b>.
            </li>
            <li style="padding-bottom: 15px">
                <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                <b>Tu dirección de correo electrónico en ningún caso será revelada</b>. <!--Lee nuestros 
                <?php echo $this->Html->link('Términos de uso', array('controller'=>'pages', 'action'=>'display', 'use_terms'))?>.-->
            </li>
            <li style="padding-bottom: 15px">
                <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                <b>Puedes cancelar tu cuenta en cualquier momento</b> que desees, sin ser requerido.
            </li>
        </ul>
    </div>
</div>
</div>