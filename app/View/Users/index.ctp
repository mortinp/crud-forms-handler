<table class='table table-striped table-hover'>
    <thead><th>ID</th><th>Usuario</th><th>Rol</th><th>Viajes</th><th>Por Correo</th><th>Registro</th><th>IP Registro</th></thead>
    <tbody> 
    <?php foreach ($users as $u): ?>
        <tr>
            <td><?php echo $u['User']['id']?></td>
            <td><?php echo $u['User']['username']?></td>
            <td><?php echo $u['User']['role']?></td>
            <td><?php echo $u['User']['travel_count']?></td>
            <td><?php echo $u['User']['travel_by_email_count']?></td>
            <td><?php echo $u['User']['register_type']?></td>
            <td><?php echo $u['User']['registered_from_ip']?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>