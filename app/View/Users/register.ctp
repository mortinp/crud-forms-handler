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
        <legend>Es importante que usted sepa:</legend>
        <ul style="list-style-type: none;padding-left:20px">
            <li style="padding-bottom: 15px">
                <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                <b>Las cuentas para poner anuncios de viajes son <big>gratis</big></b>, y se pueden poner todos los anuncios que se deseen.
                <b>No hay límites para la cantidad de anuncios</b> que puedes publicar, y <b>su cuenta sirve por tiempo ilimitado</b>.
            </li>
            <li style="padding-bottom: 15px">
                <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                <b>Su dirección de correo en ningún caso será revelada</b>. Vea nuestros 
                <?php echo $this->Html->link('Términos de uso', array('controller'=>'pages', 'action'=>'display', 'use_terms'))?>.
            </li>
            <li style="padding-bottom: 15px">
                <i class="glyphicon glyphicon-ok" style="margin-left: -20px"></i> 
                <b>Usted puede cancelar su cuenta en cualquier momento</b> que desee, sin ser requerido.
            </li>
        </ul>
    </div>
</div>
</div>