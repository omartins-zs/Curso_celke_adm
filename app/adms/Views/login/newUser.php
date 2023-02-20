<?php
if (isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
}
//Criptografar a senha
// echo password_hash(123456, PASSWORD_DEFAULT);
?>
<h1>Área Restrita</h1>

<?php 
if(isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);
}
?>
<form method="POST" action="">
    <label>Nome</label>
    <input name="name" type="text" id="name" placeholder="Digite o usuário" value="<?php
    if (isset($valorForm['user'])) {
        echo $valorForm['user'];
    }
    ?>"><br><br>

    <label>Email</label>
    <input name="email" type="text" id="email" placeholder="Digite o seu melhor email" value="<?php
    if (isset($valorForm['email'])) {
        echo $valorForm['email'];
    }
    ?>"><br><br>

    <label>Senha</label>
    <input name="password" type="password" id="password" placeholder="Digite a senha"value="<?php
    if (isset($valorForm['password'])) {
        echo $valorForm['password'];
    }
    ?>"><br><br>

    <input name="SendNewUser" type="submit" value="Cadastrar">
</form>

<p><a href="<?php echo URLADM; ?>new-user/index">Clique aqui </a>para acessar</p>
