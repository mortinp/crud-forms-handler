<div style="float:left;padding-right:20px"><?php echo count($emails)?> emails</div>
<table class='table table-striped table-hover'>
    <thead><th>To</th><th>From Name</th><th>From Email</th><th>Subject</th><th>Template</th><th>Template Vars</th><th>Sent</th><th>Locked</th><th>Send Tries</th></thead>
    <tbody> 
    <?php foreach ($emails as $e): ?>
        <tr>
            <td><?php echo $e['EmailQueue']['to']?></td>
            <td><?php echo $e['EmailQueue']['from_name']?></td>
            <td><?php echo $e['EmailQueue']['from_email']?></td>
            <td><?php echo $e['EmailQueue']['subject']?></td>
            <td><?php echo $e['EmailQueue']['template']?></td>
            <td>
            <?php 
            if(isset ($e['EmailQueue']['template_vars']['travel'])) {
                echo json_encode($e['EmailQueue']['template_vars']['travel']);
            } else {
                echo json_encode($e['EmailQueue']['template_vars']);
            }
            ?>
            </td>
            <td><?php echo $e['EmailQueue']['sent']?></td>
            <td><?php echo $e['EmailQueue']['locked']?></td>
            <td><?php echo $e['EmailQueue']['send_tries']?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php ?>