<table class='table table-striped table-hover'>
    <thead><th>ID</th><th>Username</th><th>Role</th><th>Travels Count</th><th>Registered from IP</th></thead>
    <tbody> 
    <?php foreach ($users as $u): ?>
        <tr>
            <td><?php echo $u['User']['id']?></td>
            <td><?php echo $u['User']['username']?></td>
            <td><?php echo $u['User']['role']?></td>
            <td><?php echo $u['User']['travel_count']?></td>
            <td><?php echo $u['User']['registered_from_ip']?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php ?>