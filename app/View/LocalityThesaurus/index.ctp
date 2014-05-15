<div class="alert alert-info">El Tesauro debe incluir localidades dentro de las provincias soportadas por <em>YoTeLlevo</em>, en forma de términos conocidos, de tal forma que los viajes creados por correo tengan más probabilidades de matchear con algo.
Además, a cada término dentro del Tesauro debe asignársele una localidad de referencia dentro de las soportadas por el sistema; esta localidad de referencia será la usada para seleccionar los choferes a los que se les enviará la notificación.</div>
<div style="float:left"><?php echo $this->Html->link('<i class="glyphicon glyphicon-plus-sign"></i> Add New', array('action'=>'add'), array('escape'=>false))?></div>
<table class='table table-striped table-hover'>
    <thead><th>Alias</th><th>Nombre Real</th><th>Localidad de Referencia</th><th></th></thead>
    <tbody> 
    <?php foreach ($thesaurus as $t): ?>
        <tr>
            <td><?php echo $t['LocalityThesaurus']['fake_name']?></td>
            <td><?php echo $t['LocalityThesaurus']['real_name']?></td>
            <td><?php echo $t['Locality']['name']?></td>
            <td>
                <ul class="list-inline">
                    <li><?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i> Editar', array('action'=>'edit/'.$t['LocalityThesaurus']['id']), array('escape'=>false))?></li>
                    <li><?php echo $this->Html->link('<i class="glyphicon glyphicon-trash"></i> Eliminar', array('action'=>'remove/'.$t['LocalityThesaurus']['id']), array('escape'=>false, 'confirm'=>'¿Está seguro que quiere eliminar esta entrada?'))?></li>
                </ul>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php ?>