<?php
if (isset($this->dados['form'])) {
    $valorForm = $this->dados['form'];
}
?>
<h1>Novo Usuário</h1>
<?php 
if(isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset ($_SESSION['msg']);
}
?>
<span class="msg"></span>
<form method="POST" id="newUser" action="">
    <label>Nome</label>
    <input name="name" type="text" id="name" placeholder="Digite o seu nome" value="<?php
    if (isset($valorForm['name'])) {
        echo $valorForm['name'];
    }
    ?>"><br><br>

    <label>Email</label>
    <input name="email" type="text" id="email" placeholder="Digite o seu melhor email" value="<?php
    if (isset($valorForm['email'])) {
        echo $valorForm['email'];
    }
    ?>"><br><br>

    <label>Senha</label>
    <input name="password" type="text" id="password" placeholder="Digite a senha" onkeyup="passwordStrength()">
    <span id="msgViewStrength"></span><br><br>

    <input name="SendNewUser" type="submit" value="Cadastrar">
</form>

<p><a href="<?php echo URLADM; ?>login/index">Clique aqui</a> para acessar</p>