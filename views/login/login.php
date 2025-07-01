<?php require_once(__DIR__ .'/../components/header.php');?>
<div id="tela-login">
    <form action="">
        <div>
            <label>Login</label>
            <input type="text" id="login" required>
        </div>
        <div>
            <label>Senha</label>
            <input type="password" id="senha" required>
        </div>
        <div>
            <button type="button" id="entrar">Entrar</button>
            <a href="/cadastrar">Cadastrar</a>
            <a href="/esqueci-minha-senha">Esqueci minha senha</a>
        </div>
        <div id="msg-erro">Login ou senha incorreto</div>
    </form>
</div>
<?php require_once(__DIR__ .'/../components/footer.php');?>