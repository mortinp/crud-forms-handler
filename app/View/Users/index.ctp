<table class='table table-striped table-hover'>
    <thead><th>Username</th><th>Role</th></thead>
    <tbody> 
    <?php foreach ($users as $u): ?>
        <tr>
            <td><?php echo $u['User']['username']?></td>
            <td><?php echo $u['User']['role']?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php ?>