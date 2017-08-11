<br /><br />
<table class="tblist" cellspacing="0" border="0">
    <tr class="bold">
        <td>Prenume</td>
        <td>Nume</td>
    </tr>
    <?php foreach($vars['users'] as $lastuser): ?>
    <tr>
        <td><?php echo $lastuser['prenume']; ?></td>
        <td><?php echo $lastuser['nume']; ?></td>
    </tr>   
    <?php endforeach; ?>    
</table>