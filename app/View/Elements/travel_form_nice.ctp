<div>
    <?php echo $this->Form->create('Travel', array('url' => array('controller' => 'travels', 'action' => 'add_nice')));?>
    <fieldset>
        <?php
        echo $this->Form->input('locality_id', array('type' => 'text', 'class'=>'locality-typeahead', 'label' => 'Origen', 'placeholder' => 'Origen del viaje', 'required'=>true));

        echo $this->Form->submit('Crear Anuncio');        
        ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>


<!--<div>
    <form>
        <fieldset>
            <h3>Product Search</h3>
            <input type="text" placeholder="product name" class="locality-typeahead">
        </fieldset>
    </form>
</div>-->


<?php
// CSS
$this->Html->css('bootstrap', array('inline' => false));
$this->Html->css('typeaheadjs-bootstrapcss/typeahead.js-bootstrap', array('inline' => false));

//JS
$this->Html->script('jquery', array('inline' => false));
$this->Html->script('bootstrap', array('inline' => false));
$this->Html->script('typeaheadjs/dist/typeahead-martin', array('inline' => false));

    
$this->Js->set('localities', $localities);
echo $this->Js->writeBuffer(array('inline' => false));

?>

<script type="text/javascript">
    $(document).ready(function() {
        $('input.locality-typeahead').typeahead({
            name: 'localities',
            header: '<b>Localidades disponibles</b>',
            valueKey: 'name',
            local: window.app.localities
        });
        
        $('input.tt-hint').addClass('form-control');
        $('.twitter-typeahead').css('display', 'table');
      
      //alert(window.app.localities[0].name);
    });

</script>