<div class="container">
<div class="row">
<?php if(!empty ($travels)): ?>
    <div class="col-md-5">
        <h3>Tus Anuncios de Viajes</h3>
        <br/>

        <ul style="list-style-type: none;padding: 0px">
        <?php foreach ($travels as $travel) :?>                
            <li style="margin-bottom: 20px">
                <?php echo $this->element('travel', array('travel'=>$travel))?>
            </li>                
        <?php endforeach; ?>
        </ul>
    </div>
    <div class="col-md-6 col-md-offset-1">
        <legend>Crea un anuncio de viaje</legend>
        <?php echo $this->element('travel_form')?>
    </div>
        
<?php else :?>
    <div class="col-md-6">
        <legend>No tienes ningún anuncio de viaje. Crea uno ahora</legend>
        <?php echo $this->element('travel_form')?>
    </div>
    
    <div class="col-md-4 col-md-offset-1">  
        <?php echo $this->element('travel_tips'); ?>
    </div>

<?php endif; ?>
      
</div>
</div>