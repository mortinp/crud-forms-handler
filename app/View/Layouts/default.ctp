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
    if($role === 'admin' || $role === 'tester') $pretty_user_name.= ' (<b>'.$role.'</b>)';
    //$pretty_user_date = date('M j, Y', strtotime($user['created']));
}

?>
<!DOCTYPE html>
<html>
    <head>        
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo "YoTeLlevo | ".$page_title ?>
        </title>
        <?php
        // META
        $this->Html->meta('icon');
        
        // CSS
        /*//$this->Html->css('prettify', array('inline' => false));
        $this->Html->css('bootstrap', array('inline' => false));        
        $this->Html->css('common/font-awesome.min', array('inline' => false));
        $this->Html->css('default', array('inline' => false));*/
        
        $this->Html->css('default-bundle', array('inline' => false));        
        
        //JS
        /*$this->Html->script('jquery', array('inline' => false));
        $this->Html->script('bootstrap', array('inline' => false));*/
        
        $this->Html->script('default-bundle', array('inline' => false));
        

        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
        
        <script type="text/javascript">
            $(document).ready(function() {
                $('.info').tooltip({placement:'bottom', html:true});
            })
        </script>
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
                        <div class="navbar-brand"><!--<i class="glyphicon glyphicon-road"></i> -->YoTeLlevo</div>
                        <!--<big><?php echo $this->Html->link('<i class="glyphicon glyphicon-road"></i> YoTeLlevo', '/', array('class' => 'navbar-brand', 'escape' => false));?></big>-->
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <?php if ($isLoggedIn) :?>
                            
                                <?php if($role === 'regular' || $role === 'admin' || $role === 'tester') :?>
                                    <li><?php echo $this->Html->link(__('<i class="glyphicon glyphicon-bell"></i> Mis anuncios'), array('controller' => 'travels', 'action' => 'index'), array('escape'=>false));?></li>
                                    <li><?php echo $this->Html->link(__('<i class="glyphicon glyphicon-flag"></i> <big><b>Anunciar viaje</b></big>'), array('controller' => 'travels', 'action' => 'add'), array('escape'=>false));?></li> 
                                    
                                    <?php if($role === 'admin') :?>
                                    <li class="dropdown">
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                            Administrar
                                            <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><?php echo $this->Html->link(__('Usuarios'), array('controller' => 'users', 'action' => 'index')) ?></li>
                                            <li><?php echo $this->Html->link(__('Choferes'), array('controller' => 'drivers', 'action' => 'index')) ?></li>                                            
                                            <li class="divider"></li>
                                            <li><?php echo $this->Html->link(__('Provincias'), array('controller' => 'provinces', 'action' => 'index')) ?></li>
                                            <li><?php echo $this->Html->link(__('Localidades'), array('controller' => 'localities', 'action' => 'index')) ?></li>
                                            <li><?php echo $this->Html->link(__('Tesauro'), array('controller' => 'locality_thesaurus', 'action' => 'index')) ?></li>
                                        </ul>
                                    </li>
                                    <?php endif;?>
                                <?php endif;?>
                                    
                            <?php else: ?>
                                <li><?php echo $this->Html->link(__('<i class="glyphicon glyphicon-home"></i> Inicio'), '/', array('escape'=>false));?></li>
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
                                        <li><?php echo $this->Html->link(__('Perfil'), array('controller' => 'users', 'action' => 'profile')) ?></li>
                                        <li class="divider"></li>
                                        <li><?php echo $this->Html->link(__('Salir'), array('controller' => 'users', 'action' => 'logout')) ?></li>
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
            
            
            <?php echo $this->Session->flash('auth'); ?>

            <div id="content" class="container-fluid">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
            </div>

            <div id="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <p class="text-muted" style="margin: 20px 0;">
                                Creado por <a href="http://ksabes.com">Casabe&trade;</a>
                            </p>
                        </div>
                        <div class="col-md-6" style="text-align: center">
                            <p class="text-muted" style="margin: 20px 0;">
                                <!--<?php echo $this->Html->link('¿Cómo usarlo?', array('controller'=>'pages', 'action'=>'display', 'tour')); ?>
                                |-->
                               <?php echo $this->Html->link('Contactar', array('controller'=>'pages', 'action'=>'display', 'contact')); ?>                                
                                |
                               <?php echo $this->Html->link('Preguntas Frecuentes', array('controller'=>'pages', 'action'=>'display', 'faq')); ?>
                                |
                               <?php echo $this->Html->link('Términos de Uso', array('controller'=>'pages', 'action'=>'display', 'use_terms')); ?>
                            </p>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </body>
</html>
