<div class="back">
    <i class="fa fa-chevron-left" aria-hidden="true"></i>
    <a href="javascript:history.go(-1)">Back</a>
</div>    
<form name="updateUser" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
    <table>
        <tr>
            <td><label for="User['prenume']">Prenume</label></td>
            <td><input type="text" name="User[prenume]" id="User[prenume]" value="<?php echo isset($_POST['User']['prenume'])? $_POST['User']['prenume']:$vars['user']['prenume']; ?>" /></td>
        </tr>
        <tr>
            <td><label for="User['nume']">Nume</label></td>
            <td><input type="text" name="User[nume]" id="User[nume]" value="<?php echo isset($_POST['User']['nume'])? $_POST['User']['nume']:$vars['user']['nume']; ?>" /></td>
        </tr>
        <tr>
            <td><label for="User['email']">Email</label></td>
            <td><input type="email" name="User[email]" id="User[email]" value="<?php echo isset($_POST['User']['email'])? $_POST['User']['email']:$vars['user']['email']; ?>" /></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input class="button" type="submit" name="User[saveUser]" value="Update" /></td>
        </tr>
    </table>    
</form>