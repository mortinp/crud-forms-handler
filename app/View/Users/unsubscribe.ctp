<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <legend>
                <div><big>Eliminación de Cuenta de Usuario</big></div>
                <div><small class="text-muted">
                    <p>
                        Es una lástima saber que ya no quieres usar <em>YoTeLlevo</em> :(
                    </p>
                </small></div>
            </legend>
            <p>
                Consideraríamos una gran amabilidad que nos escribieras las razones de tu decisión, y sería además de grandísima utilidad
                para nosotros el conocerlas. Dado que creemos en las segundas oportunidades, tal vez puedas <big><?php echo $this->Html->link('contactarnos', array('controller'=>'pages', 'action'=>'contact'))?></big>
                para valorar cualquier situación antes de irte.
            </p>
            <?php
            echo $this->Form->create('Unsubscribe', array('url' => array('controller' => 'users', 'action' => 'unsubscribe')));
            ?>
            <fieldset>
                <?php
                echo $this->Form->input('text', array('type'=>'textarea', 'label' => false, 'placeholder'=>'Si realmente quieres irte ahora, explícanos tus razones aquí', 'required'=>false));                
                echo $this->Form->submit('Eliminar mi cuenta ahora mismo', array('class'=>'btn btn-danger'));        
                ?>
            </fieldset>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>