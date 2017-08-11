<div class="back">
    <i class="fa fa-chevron-left" aria-hidden="true"></i>
    <a href="javascript:history.go(-1)">Back</a>
</div>
<div class="title">
    Sign-Up
</div>
<div class="pagcontent">
    <form name="addUser" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
        <table>
            <tr>
                <td><label for="addUser['prenume']">Prenume</label></td>
                <td><input type="text" name="addUser[prenume]" id="addUser[prenume]" value="" /></td>
            </tr>
            <tr>
                <td><label for="addUser['nume']">Nume</label></td>
                <td><input type="text" name="addUser[nume]" id="addUser[nume]" value="" /></td>
            </tr>
            <tr>
                <td><label for="addUser['email']">Email</label></td>
                <td><input type="email" name="addUser[email]" id="addUser[email]" value="" /></td>
            </tr>
            <tr>
                <td><label for="addUser['password']">Password</label></td>
                <td><input type="password" name="addUser[password]" id="addUser[password]" value="" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input class="button" type="submit" name="addUser[saveUser]" value="Add" /></td>
            </tr>
        </table>    
    </form>
</div>