<?php
// INITIALIZE
$isLoggedIn = AuthComponent::user('id') ? true : false;

if($isLoggedIn) {
    $user = AuthComponent::user();
    
    $role = $user['role'];
    if($user['display_name'] != null) {
        $splitName = explode('@', $user['display_name']);
        if(count($splitName) > 1) $pretty_user_name = $splitName[0];
        else $pretty_user_name = $user['display_name'];
    } else {
        $splitEmail = explode('@', $user['username']);
        $pretty_user_name = $splitEmail[0];
    }
    if($role === 'admin') $pretty_user_name.= ' (<b>admin</b>)';
    //$pretty_user_date = date('M j, Y', strtotime($user['created']));
}

?>
<!DOCTYPE html>
<html>
    <head>        
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo "YoTeLlevo | Encuentra un chofer con carro que te lleve a cualquier lado" ?>
        </title>
        <?php
        // META
        $this->Html->meta('icon');
        
        // CSS
        //$this->Html->css('prettify', array('inline' => false));
        $this->Html->css('bootstrap', array('inline' => false));        
        //$this->Html->css('jquery-ui', array('inline' => false));
        $this->Html->css('common/font-awesome.min', array('inline' => false));
        //$this->Html->script('default', array('inline' => false));
        $this->Html->css('default', array('inline' => false));
        
        
        //JS
        //if($this->here !== '/yotellevo/' && $this->here !== '/yotellevo/pages/home') {
            $this->Html->script('jquery', array('inline' => false));
            $this->Html->script('bootstrap', array('inline' => false));
            
        //}
        //$this->Html->script('prettify', array('inline' => false));
        //$this->Html->script('jquery-ui', array('inline' => false));
        

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        <div id="container">
            <nav id="myNavbar" class="navbar navbar-default" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="navbar-brand"><i class="glyphicon glyphicon-road"></i> YoTeLlevo</div>
                        <!--<big><?php echo $this->Html->link('<i class="glyphicon glyphicon-road"></i> YoTeLlevo', array('controller' => 'pages', 'action' => 'home'), array('class' => 'navbar-brand', 'escape' => false));?></big>-->
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <?php if ($isLoggedIn) :?>
                            
                                <?php if($role === 'regular' || $role === 'admin') :?>
                                    <li><?php echo $this->Html->link(__('<i class="glyphicon glyphicon-bell"></i> Mis anuncios'), array('controller' => 'travels', 'action' => 'index'), array('escape'=>false));?></li>
                                    <li><?php echo $this->Html->link(__('<i class="glyphicon glyphicon-flag"></i> <big><b>Anunciar viaje</b></big>'), array('controller' => 'travels', 'action' => 'add'), array('escape'=>false));?></li> 
                                <?php endif;?>
                                    
                            <?php else: ?>
                                <li><?php echo $this->Html->link(__('<i class="glyphicon glyphicon-home"></i> Inicio'), array('controller' => 'pages', 'action' => 'home'), array('escape'=>false));?></li>
                            <?php endif;?>            
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <?php if ($isLoggedIn): ?>
                                <li class="dropdown">
                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                        <?php echo $pretty_user_name;?>
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><?php echo $this->Html->link(__('Salir'), array('controller' => 'users', 'action' => 'logout')) ?></li>
                                        <li><?php echo $this->Html->link(__('Preferencias'), array('controller' => 'users', 'action' => 'profile')) ?></li>
                                        <!--<li class="divider"></li>
                                        <li><a href="#">Settings</a></li>-->
                                    </ul>
                                </li>
                            <?php else: ?>
                                <li>
                                    <?php echo $this->Html->link(__('Entrar'), array('controller' => 'users', 'action' => 'login')) ?>
                                </li>
                                <li>
                                    <?php echo $this->Html->link(__('Registrarse'), array('controller' => 'users', 'action' => 'register')) ?>
                                </li>
                            <?php endif ?>

                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </nav>
            
            <?php if ($role === 'admin') :?>
            <!--<div class="row">
                <div class="col-md-6">
                    <div class="alert alert-info alert-dismissable">
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        Los anuncios creados por los administradores <b>NO</b> son enviados a ningún chofer.
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-info alert-dismissable">
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        Puedes eliminar viajes confirmados porque eres administrador.
                    </div>
                </div>
            </div>-->
            <?php endif?>


            <div id="content" class="container-fluid">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
            </div>

            <div id="footer">
                <div class="container-fluid">
                    <p class="text-muted" style="margin: 20px 0;"><?php echo __('Creado por ').$this->Html->link('YoTeLlevo&trade;', array('controller' => 'pages', 'action' => 'home'), array('escape' => false)); ?></p>
                </div>
            </div>
        </div>
    </body>
</html>
