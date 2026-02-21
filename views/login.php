<?php
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = $_POST['email'];
    	$senha = $_POST['senha'];
		
		$sql = MySql::conect()->prepare("SELECT id,email,senha FROM `usuarios` WHERE email = ?");
		$sql->execute(array($email));
		$sql = $sql->fetch();

		if($sql && password_verify($senha, $sql['senha'])){
			session_regenerate_id();

			$_SESSION['usuario'] = $sql['id'];
			$_SESSION['email'] = $sql['email'];
			setcookie('login',$sql['id'],time()+86400);//86400 = 1 dia
			
			header('Location: '.PATH);
			exit;
		}else{
			$_SESSION['error'] = "E-mail ou senha incorretos.";
		    header("Location: ".PATH.'login');
		    exit;
		}
	}

	if(Controller::isLogged()){
		header('Location: '.PATH);
		exit;
	}
?>
<section class="login">
	<a href="<?php echo PATH?>" class="back-home">
        <i class="ph ph-arrow-left"></i> Voltar para o site
    </a>

    <div class="login-wrapper">
        <div class="login-card">
            
            <a href="#" class="brand">
                <i class="ph ph-cube-transparent" style="font-size: 1.8rem; color: var(--accent-primary);"></i>
                V3Dev
            </a>

            <div class="login-header">
                <h1>Acesso ao Estúdio</h1>
            </div>

            <form method="POST">
                
                <div class="form-group">
                    <label for="email" class="form-label">E-mail</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" class="form-input" placeholder="seu@email.com" required>
                        <i class="ph ph-envelope-simple input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="senha" class="form-label">Senha</label>
                    <div class="input-wrapper">
                        <input type="password" id="senha" name="senha" class="form-input" placeholder="••••••••" required>
                        <i class="ph ph-lock-key input-icon"></i>
                    </div>
                </div>

                <a href="#" class="forgot-pass">Esqueceu sua senha?</a>

                <button type="submit" class="btn-login">
                    Entrar na Plataforma
                </button>
            </form>

            <div class="login-footer">
                Não tem uma conta? <a href="#">Solicitar acesso</a>
            </div>
        </div>
    </div>
</section><!--login-->