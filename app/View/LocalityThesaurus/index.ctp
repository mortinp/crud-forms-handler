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