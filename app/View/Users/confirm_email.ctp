<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>Tu cuenta de correo <!--(<b><?php echo $user['User']['username']?></b>) -->fue verificada exitosamente</h2>
            <h3>
                Ahora puedes realizar todos los anuncios de viajes que desees, de forma <big>gratis</big>.
            </h3>
            
            <br/>
            <div>
                <ul style="list-style-type: none; padding-left: 0px">
                <?php if($isLoggedIn): ?>
                   <li><?php echo $this->Html->link("<i class='glyphicon glyphicon-bell'></i> <big>Ver todos mis anuncios</big>", array('controller'=>'travels', 'action'=>'index'), array('escape'=>false));?></li>
                   <li><?php echo $this->Html->link(__('<i class="glyphicon glyphicon-flag"></i> <big>Anunciar viaje</big>'), array('controller' => 'travels', 'action' => 'add'), array('escape'=>false));?></li>
                <?php else: ?>
                    <li><big><?php echo $this->Html->link(__('Entra ahora'), array('controller' => 'users', 'action' => 'login'), array('escape'=>false));?> para crear anuncios de viajes</big></li>
                <?php endif ?>
                </ul>
            </div>
        </div>
    </div>
</div>