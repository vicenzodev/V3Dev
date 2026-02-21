<?php 
    include('app/config/config.php');
    $url = isset($_GET['url']) ? $_GET['url'] : 'home';//Carregamento da url na variável de mesmo nome
	if(!Controller::isLogged() && $url != 'login'){
		header('Location: '.PATH.'login');
		exit;
	}

	if(isset($_GET['sair'])){
		session_destroy();
		setcookie('login',null,time()-3600);
		header('Location: '.PATH.'login');
		exit;
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>V3Dev</title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo PATH?>css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>
   <header>
        <div class="container">
            <nav>
                <a href="<?php echo PATH;?>" class="brand">
                    <i class="ph ph-cube-transparent" style="font-size: 1.5rem; color: var(--accent-primary);"></i>
                    V3Dev
                </a>
                <ul class="nav-links">
                    <li><a href="#">Início</a></li>
                    <li><a href="#portfolio">Portfólio</a></li>
                    <li><a href="#commercial">Loja</a></li>
                    <li><a href="<?php echo PATH.'estudio/dashboard'?>" class="btn-nav"><i class="ph ph-gear-six"></i> Estúdio</a></li>
                    <li><a href="<?php echo PATH.'?sair=1'?>"><i class="ph ph-sign-out"></i></a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <?php
			if(explode('/',$url)[0] != 'estudio'){
				if(file_exists('views/'.$url.'.php')){
					include('views/'.$url.'.php');//Página encontrada e incluída no site
				}else{
					include('views/404.php');//Página não encontrada
				}
			}
		?>
    </main>
    <footer>
        <div class="container footer-content">
            <div>
                <strong>V3Dev</strong>
                <p style="font-size: 0.9rem; color: #555; margin-top: 5px;">Transformando bits em átomos.</p>
            </div>
            <div class="social-icons">
                <a href="#"><i class="ph ph-instagram-logo"></i></a>
                <a href="#"><i class="ph ph-whatsapp-logo"></i></a>
                <a href="#"><i class="ph ph-envelope-simple"></i></a>
            </div>
        </div>
    </footer>

</body>
</html>