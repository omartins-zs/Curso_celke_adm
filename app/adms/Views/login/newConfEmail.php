<?php
if (isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
}
//Criptografar a senha
//echo password_hash(123456, PASSWORD_DEFAULT);
?>
<h1>Novo Link</h1>

<?php 
if(isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);
}
?>
<span class="msg"></span>
<form method="POST" id="sendLogin" action="">
    <label>E-mail</label>
    <input name="email" type="email" id="username" placeholder="Digite o usuário ou e-mail" value="<?php
    if (isset($valorForm['email'])) {
        echo $valorForm['email'];
    }
    ?>"><br><br>

    <input name="NewConfEmail" type="submit" value="Enviar">
</form>


<p><a href="<?php echo URLADM; ?>login/index">Acessar</a></p>
