<div style="float:left"><?php echo $this->Html->link('<i class="glyphicon glyphicon-plus-sign"></i> Add New', array('action'=>'add'), array('escape'=>false))?></div>
<table class='table table-striped table-hover'>
    <thead><th>ID</th><th>Nombre</th><th>Provinicia</th><th></th></thead>
    <tbody> 
    <?php foreach ($localities as $l): ?>
        <tr>
            <td><?php echo $l['Locality']['id']?></td>
            <td><?php echo $l['Locality']['name']?></td>
            <td><?php echo $l['Province']['name']?></td>
            <td>
                <ul class="list-inline">
                    <li><?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i> Editar', array('action'=>'edit/'.$l['Locality']['id']), array('escape'=>false))?></li>
                    <li><?php echo $this->Html->link('<i class="glyphicon glyphicon-trash"></i> Eliminar', array('action'=>'remove/'.$l['Locality']['id']), array('escape'=>false, 'confirm'=>'¿Está seguro que quiere eliminar esta localidad?'))?></li>
                </ul>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php ?>