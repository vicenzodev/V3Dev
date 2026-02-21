<?php 
    include('../app/Config/config.php');
    include('../app/Utils/Controller.php');

	if(!Controller::isLogged() && $_GET['url'] != 'login'){
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
    
    <link rel="stylesheet" type="text/css" href="<?php echo PATH?>estudio/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>

   <aside class="sidebar desktop">
        <div class="brand">
            <i class="ph ph-cube-transparent" style="color: var(--accent-primary);"></i>
            V3Dev Estudio
        </div>

        <div class="menu-label">Principal</div>
        <a href="<?php echo PATH_ESTUDIO?>dashboard" class="nav-item principal"><i class="ph ph-squares-four"></i> Dashboard</a>
        <a href="<?php echo PATH_ESTUDIO?>meus-modelos" class="nav-item"><i class="ph ph-cube"></i> Meus Modelos</a>
        
        <div class="menu-label" style="margin-top: 20px;">Gestão</div>
        <a href="<?php echo PATH_ESTUDIO?>fila-impressao" class="nav-item"><i class="ph ph-printer"></i> Fila de Impressão</a>
        <a href="<?php echo PATH_ESTUDIO?>custos" class="nav-item"><i class="ph ph-coins"></i> Custos & Materiais</a>
        <a href="<?php echo PATH_ESTUDIO?>categorias" class="nav-item"><i class="ph ph-tag"></i> Categorias</a>
        <a href="<?php echo PATH_ESTUDIO?>clientes" class="nav-item"><i class="ph ph-users"></i> Clientes</a>
        <a href="<?php echo PATH_ESTUDIO?>gerenciar-impressoras" class="nav-item"><i class="ph ph-printer"></i> Impressoras</a>
        <a href="<?php echo PATH_ESTUDIO?>config" class="nav-item"><i class="ph ph-gear"></i> Configurações</a>
        

        <div class="user-profile">
            <div class="avatar">H</div>
            <div style="font-size: 0.9rem;">
                <div style="font-weight: 600;">Heitor</div>
                <div style="color: var(--text-muted); font-size: 0.8rem;">Admin</div>
            </div>
            <a href="<?php echo PATH.'?sair=1'?>" style="margin-left: auto; color: var(--text-muted);"><i class="ph ph-sign-out"></i></a>
        </div>
    </aside>
    <aside class="sidebar mobile">
        <div class="brand">
            <i class="ph ph-cube-transparent" style="color: var(--accent-primary);"></i>
        </div>

        <div class="menu-label"></div>
        <a href="<?php echo PATH_ESTUDIO?>dashboard" class="nav-item principal"><i class="ph ph-squares-four"></i></a>
        <a href="<?php echo PATH_ESTUDIO?>meus-modelos" class="nav-item"><i class="ph ph-cube"></i></a>
        
        <div class="menu-label" style="margin-top: 20px;"></div>
        <a href="<?php echo PATH_ESTUDIO?>fila-impressao" class="nav-item"><i class="ph ph-printer"></i></a>
        <a href="<?php echo PATH_ESTUDIO?>custos" class="nav-item"><i class="ph ph-coins"></i></a>
        <a href="<?php echo PATH_ESTUDIO?>categorias" class="nav-item"><i class="ph ph-tag"></i></a>
        <a href="<?php echo PATH_ESTUDIO?>clientes" class="nav-item"><i class="ph ph-users"></i></a>

        <div class="user-profile">
            <div class="avatar">H</div>
            <div style="padding: 5px 0"></div>
            <a href="<?php echo PATH.'?sair=1'?>" style="margin-left: auto; color: var(--text-muted);"><i class="ph ph-sign-out"></i></a>
        </div>
    </aside>
    <main>
        <?php
			$url = isset($_GET['url']) ? $_GET['url'] : 'home';//Carregamento da url na variável de mesmo nome
            if(explode('/',$url)[0] != 'estudio'){
                if(file_exists('views/'.$url.'.php')){
                    include('views/'.$url.'.php');//Página encontrada e incluída no site
                }else{
                    include('views/404.php');//Página não encontrada
                }
            }
		?>
    </main>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            const currentLocation = window.location.href;
            const menuItems = document.querySelectorAll('.sidebar .nav-item');

            menuItems.forEach(item => {
                item.classList.remove('active');

                if(item.href === currentLocation || currentLocation.includes(item.getAttribute('href'))) {
                    item.classList.add('active');
                }
            });
        });
    </script>
    <script>
        // Função Global de Toast
        function showToast(type, msg) {
            // 1. Garante que o container existe
            let container = document.getElementById('toast-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'toast-container';
                document.body.appendChild(container);
            }

            // 2. Define ícones e classes baseados no tipo
            let iconHtml = '';
            let typeClass = '';

            switch(type) {
                case 'sucesso':
                    typeClass = 'sucesso';
                    iconHtml = '<i class="ph ph-check-circle"></i>';
                    break;
                case 'erro':
                    typeClass = 'erro';
                    iconHtml = '<i class="ph ph-warning-circle"></i>';
                    break;
                case 'alerta':
                    typeClass = 'alerta';
                    iconHtml = '<i class="ph ph-warning"></i>';
                    break;
                default:
                    typeClass = 'info';
                    iconHtml = '<i class="ph ph-info"></i>';
            }

            // 3. Cria o elemento HTML do Toast
            const toast = document.createElement('div');
            toast.className = `toast ${typeClass}`;
            toast.innerHTML = `
                <div class="toast-icon">${iconHtml}</div>
                <div class="toast-message">${msg}</div>
            `;

            // 4. Adiciona ao container
            container.appendChild(toast);

            // 5. Remove automaticamente após 4 segundos
            setTimeout(() => {
                toast.classList.add('hide'); // Inicia animação de saída
                setTimeout(() => {
                    toast.remove(); // Remove do DOM
                }, 300); // Espera a animação CSS terminar
            }, 4000);
        }
    </script>
</body>
</html>