<h4>
<p><?php echo __('Tu contraseña ha sido cambiada y ya te la enviamos a tu correo electrónico. Cuando estes list@, puedes')?> 
<?php echo $this->Html->link(__('entrar'), array('controller'=>'users', 'action'=>'login'))?> <?php echo __('a la aplicación usando tu nueva contraseña')?>.
</p>
</h4>
<div class="alert alert-warning"><?php echo __('Te recomendamos que cambies tu contraseña nuevamente en '.$this->Html->link(__('tus preferencias'), array('controller'=>'users', 'action'=>'profile')).' cuando hayas entrado.')?></div>