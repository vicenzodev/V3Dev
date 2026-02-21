# V3Dev
Webapp para gerenciamento de um negócio de impressão 3D

# Credenciais
Para configurar a aplicação é necessário criar um arquivo config.php.
Este arquivo fica na pasta `app/Config/config.php` e tem a seguinte estrutura:

		session_start();
		date_default_timezone_set('America/Sao_Paulo');
		spl_autoload_register(function ($class_name) {
	    
	    // Caminho base: Volta uma pasta a partir de 'Config' para chegar em 'app'
	    // __DIR__ é a pasta onde este arquivo está (app/Config)
	    $base_path = __DIR__ . '/../'; 

	    // Lista de pastas onde o sistema deve procurar as classes
	    $directories = [
	        'Models/',
	        'Controllers/',
	        'Config/',
	        'Utils/'
	    ];

	    // Procura o arquivo em cada pasta
	    foreach ($directories as $directory) {
	        $file = $base_path . $directory . $class_name . '.php';
	        
	        if (file_exists($file)) {
	            require_once $file;
	            return; // Para a execução assim que encontrar
	        }
	    }
	});

	
	define('PATH','<<Link do seu site>>');
	define('PATH_ESTUDIO',PATH.'estudio/');
	define('IP_IMPRESSORA','<<IP da sua impressora>>');
	//Atualmente só funciona com Ender 3 V3 KE
	define('HOST','<<Host do MySql>>');
	define('USER','<<Usuário do MySql>>');
	define('PASSWORD','<<Senha do MySql>>');
	define('DBNAME','<<Nome da tabela>>');
`