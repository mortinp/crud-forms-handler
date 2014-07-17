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
        <title><?php echo "YoTeLlevo - Cuba | ".$page_title ?></title>
        <meta name="description" content="¿Necesitas alquilar un taxi para ir a cualquier parte de Cuba? Crea un anuncio de viaje en YoTeLlevo y enseguida conseguirás un chofer con carro que te lleve."/>
        
        <?php
        // META
        $this->Html->meta('icon');
        
        // CSS
        /*//$this->Html->css('prettify', array('inline' => false));
        $this->Html->css('bootstrap', array('inline' => false));        
        $this->Html->css('common/font-awesome.min', array('inline' => false));
        $this->Html->css('default', array('inline' => false));*/
        
        $this->Html->css('default-bundle', array('inline' => false)); 
        $this->Html->css('home', array('inline' => false));
        
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
            
        <?php echo $this->Session->flash('auth'); ?>        
        <?php echo $this->fetch('content'); ?>

        <?php if( ROOT != 'C:\wamp\www\yotellevo' && (!$isLoggedIn || $role === 'regular') ):?>
            <!-- Start 1FreeCounter.com code -->

              <script language="JavaScript">
              var data = '&r=' + escape(document.referrer)
                    + '&n=' + escape(navigator.userAgent)
                    + '&p=' + escape(navigator.userAgent)
                    + '&g=' + escape(document.location.href);

              if (navigator.userAgent.substring(0,1)>'3')
                data = data + '&sd=' + screen.colorDepth 
                    + '&sw=' + escape(screen.width+'x'+screen.height);

              document.write('<a href="http://www.1freecounter.com/stats.php?i=107146" target=\"_blank\" >');
              document.write('<img alt="Free Counter" border=0 hspace=0 '+'vspace=0 src="http://www.1freecounter.com/counter.php?i=107146' + data + '">');
              document.write('</a>');
              </script>

            <!-- End 1FreeCounter.com code -->
        <?php endif;?>

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
                           <?php echo $this->Html->link('Contactar', array('controller'=>'pages', 'action'=>'display', 'contact')); ?>                                
                            |
                           <?php echo $this->Html->link('Preguntas Frecuentes', array('controller'=>'pages', 'action'=>'display', 'faq')); ?>
                           <!-- |
                           <?php echo $this->Html->link('Términos de Uso', array('controller'=>'pages', 'action'=>'display', 'use_terms')); ?>-->
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
