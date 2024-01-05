<?php
if (isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
}
//Criptografar a senha
//echo password_hash(123456, PASSWORD_DEFAULT);
?>
<h1>Área Restrita</h1>

<?php 
if(isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);
}
?>
<span class="msg"></span>
<form method="POST" id="sendLogin" action="">
    <label>Usuário</label>
    <input name="username" type="text" id="username" placeholder="Digite o usuário ou e-mail" value="<?php
    if (isset($valorForm['username'])) {
        echo $valorForm['username'];
    }
    ?>"><br><br>

    <label>Senha</label>
    <input name="password" type="password" id="password" placeholder="Digite a senha"><br><br>

    <input name="SendLogin" type="submit" value="Acessar">
</form>


<p><a href="<?php echo URLADM; ?>new-user/index">Cadastrar Usuario</a></p>

Usuário: cesar@celke.com.br<br>
Senha: 123456a