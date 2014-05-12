<div style="float:left;padding-right:20px"><?php echo count($drivers)?> choferes</div>
<div style="float:left"><?php echo $this->Html->link('<i class="glyphicon glyphicon-plus-sign"></i> Add New', array('action'=>'add'), array('escape'=>false))?></div>
<table class='table table-striped table-hover'>
    <thead><th>Username</th><th>Max People Count</th><th>Moder Car</th><th>Air Conditioner</th><th>Active</th><th>Description</th><th>Localities</th><th></th></thead>
    <tbody> 
    <?php foreach ($drivers as $d): ?>
        <tr>
            <td><?php echo $d['Driver']['username']?></td>
            <td><?php echo $d['Driver']['max_people_count']?></td>
            <td><?php echo $d['Driver']['has_modern_car']?></td>
            <td><?php echo $d['Driver']['has_air_conditioner']?></td>
            <td><?php echo $d['Driver']['active']?></td>
            <td><?php echo $d['Driver']['description']?></td>
            <td>
                <?php 
                $sep = '';
                foreach ($d['Locality'] as $l) {
                    echo $sep.$l['name'];
                    $sep = ', ';
                }
                ?>
            </td>
            <td>
                <ul class="list-inline">
                    <li><?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i> Editar', array('action'=>'edit/'.$d['Driver']['id']), array('escape'=>false))?></li>
                    <!--<li><?php echo $this->Html->link('<i class="glyphicon glyphicon-trash"></i> Eliminar', array('action'=>'remove/'.$d['Driver']['id']), array('escape'=>false))?></li>-->
                </ul>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php ?>