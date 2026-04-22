# 🖨️ V3Dev

> **Webapp para gerenciamento de um negócio de impressão 3D**

O **V3Dev** é um sistema web desenvolvido para centralizar e facilitar a gestão de operações de impressão 3D. Desde o controle de fila de peças até a integração direta com o equipamento, o sistema foi pensado para otimizar o fluxo de trabalho de um estúdio de impressão.

---

## 🚀 Funcionalidades (Exemplos)

* **Gestão de Pedidos:** Controle do fluxo de vendas e demandas do estúdio.
* **Monitoramento:** Integração de rede direta com a impressora para acompanhamento (Atualmente otimizado para a **Creality Ender 3 V3 KE**).
* **Painel do Estúdio:** Área dedicada (`/estudio`) para controle interno.

## 🛠️ Tecnologias Utilizadas

* **Back-end:** PHP (Arquitetura MVC Customizada)
* **Banco de Dados:** MySQL
* **Servidor:** Apache/Nginx (Recomendado)

## 📂 Estrutura do Projeto

O sistema utiliza um *autoloader* nativo para gerenciar as classes, organizado na seguinte estrutura de diretórios dentro de `app/`:

* `/Models/` - Regras de negócio e comunicação com o banco de dados.
* `/Controllers/` - Lógica de controle e intermediação entre as views e models.
* `/Config/` - Arquivos de configuração e variáveis de ambiente.
* `/Utils/` - Classes utilitárias e funções auxiliares.

---

## ⚙️ Instalação e Configuração

Siga os passos abaixo para rodar o projeto localmente ou em seu servidor.

### 1. Requisitos
* PHP 8.0+ 
* Servidor MySQL
* Impressora conectada à mesma rede do servidor (para uso da integração IP).

### 2. Configurando o Banco de Dados
1. Crie um banco de dados no seu servidor MySQL.
2. *(Opcional)* Importe o arquivo `database.sql` (caso possua um script de criação das tabelas).

### 3. Configurando as Credenciais

Para o sistema funcionar corretamente, é necessário criar e configurar o arquivo principal de credenciais.

1. Navegue até a pasta `app/Config/`.
2. Crie um arquivo chamado `config.php`.
3. Insira o seguinte código, substituindo as tags `<<...>>` com as informações do seu ambiente:

```php
<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

// --- AUTOLOADER DE CLASSES ---
spl_autoload_register(function ($class_name) {
    // Caminho base: Volta uma pasta a partir de 'Config' para chegar em 'app'
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

// --- VARIÁVEIS DE AMBIENTE ---
define('PATH', '<<Link do seu site ou localhost>>');
define('PATH_ESTUDIO', PATH . 'estudio/');

// --- INTEGRAÇÃO COM IMPRESSORA ---
// Atualmente homologado apenas para Ender 3 V3 KE
define('IP_IMPRESSORA', '<<IP da sua impressora na rede>>');

// --- CREDENCIAIS DO BANCO DE DADOS ---
define('HOST', '<<Host do MySql (ex: localhost)>>');
define('USER', '<<Usuário do MySql>>');
define('PASSWORD', '<<Senha do MySql>>');
define('DBNAME', '<<Nome do Banco de Dados>>');
