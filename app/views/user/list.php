<?php 
 namespace app\controllers;
?>
<div id="left"> 
<div class="add">
    <i class="fa fa-plus" aria-hidden="true"></i>
    <a href="index.php?c=user&a=add">Adauga un nou utilizator</a>
</div>
<table class="tblist" cellspacing="0" border="0">
    <tr class="bold">
        <td>ID</td>
        <td>Nume</td>
        <td>Prenume</td>
        <td>Email</td>
        <td>Actions</td>
    </tr>
    <?php foreach($vars['users'] as $user): ?>
    <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['nume']; ?></td>
        <td><?php echo $user['prenume']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td>
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            <a href="index.php?c=user&amp;a=edit&amp;id=<?php echo $user['id']; ?>">Edit</a> | 
            <i class="fa fa-trash-o" aria-hidden="true"></i>
            <a href="index.php?c=user&amp;a=delete&amp;id=<?php echo $user['id']; ?>" Onclick="return ConfirmDelete();">Delete</a>            
        </td>
    </tr>   
    <?php endforeach; ?>    
</table>


<br />
<br />
<?php 
\app\controllers\UserController::pagAction(); 
?>
</div><!-- div-ul asta nu ar trebui sa stea aici ci in index dar nu am gasit deocamdata alta solutie pt box-ul de sidebar -->


<div id="right">
    <h2>Cei mai noi useri</h2>
        <?php foreach($vars['latestusers'] as $user2): ?>
            <div class="latestusr">
                <?php echo $user2['prenume']. ' ' .$user2['nume']; ?>
            </div>
            <div class="datausr">
                    <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date("F j, Y, g:i a", strtotime($user2['date_insert'])); ?>
            </div>
            <hr class="hrusr">
        <?php endforeach; ?> 
</div>