<?php
	namespace Config;
	
	class ConfigView{
		
		private $nome;
		private $dados;
		
		public function __construct($nome, array $dados = null){
			$this->nome = (string) $nome;
			$this->dados = $dados;
			//var_dump($this->dados);
		}
		
		public function renderizar(){
			if(file_exists("app/site/views/{$this->nome}.php")){
				if($this->nome == "error/error404"){
					include_once('app/site/views/includes/deslogado/header.php');
					include_once("app/site/views/{$this->nome}.php");
				}else if(!isset($_SESSION['idCliente'])){ 
					include_once('app/site/views/includes/deslogado/header.php');
					include_once('app/site/views/includes/deslogado/menu.php');
					include_once("app/site/views/{$this->nome}.php");
					include_once('app/site/views/includes/deslogado/footer.php');
				}else{
					include_once('app/site/views/includes/logado/header.php');
					include_once('app/site/views/includes/logado/menu.php');
					include_once("app/site/views/{$this->nome}.php");
					include_once('app/site/views/includes/logado/footer.php');
				}
			}else{
				echo "Erro ao carregar a página: {$this->nome}";
			}
		}

	    public function renderizarAdm(){
	        if (file_exists("app/adm/views/{$this->nome}.php")){
	            include_once('app/adm/views/includes/header.php');
	            include_once('app/adm/views/includes/menu.php');
	            include_once("app/adm/views/{$this->nome}.php");
	            include_once('app/adm/views/includes/footer.php');
	        }else{
	            echo "Erro ao carregar a página: {$this->nome}";
	        }
	    }

	    public function renderizarAuth(){
	        if (file_exists("app/adm/views/{$this->nome}.php")){
	            include_once("app/adm/views/{$this->nome}.php");
	        }else{
	            echo "Erro ao carregar a página: {$this->nome}";
	        }
	    }
	}