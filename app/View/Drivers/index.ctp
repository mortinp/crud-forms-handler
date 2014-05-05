<table class='table table-striped table-hover'>
    <thead><th>Username</th><th>Max People Count</th><th>Moder Car</th><th>Air Conditioner</th><th>Active</th><th>Description</th></thead>
    <tbody> 
    <?php foreach ($drivers as $d): ?>
        <tr>
            <td><?php echo $d['Driver']['username']?></td>
            <td><?php echo $d['Driver']['max_people_count']?></td>
            <td><?php echo $d['Driver']['has_modern_car']?></td>
            <td><?php echo $d['Driver']['has_air_conditioner']?></td>
            <td><?php echo $d['Driver']['active']?></td>
            <td><?php echo $d['Driver']['description']?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php ?>