<?php
	namespace Config;
		
	Class ConfigController{
		private $url;
		private $urlConjunto;
		private $urlController;
		private $urlMetodo;
		private $urlParametro;
		private $class;
		private static $formato;
		
		public function __construct(){
			if(!empty(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))){
				$this->url = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
				$this->clearUrl(); //limpa a url
				//separa os valores em array
				$this->urlConjunto = explode("/", $this->url);
				
				//trata o controller e método, caso existam
				if(isset($this->urlConjunto[0]) && (isset($this->urlConjunto[1]))){
					$this->urlController = $this->prepareController($this->urlConjunto[0]);
					$this->urlMetodo = $this->urlConjunto[1];
				}else{
					$this->urlController = CONTROLLER;
					$this->urlMetodo = METHOD;
				}
				
				//trata o parâmetro 
				if(isset($this->urlConjunto[2])){
					$this->urlParametro = $this->urlConjunto[2];
				}else{
					$this->urlParametro = null;
				}
			}else{
				$this->urlController = CONTROLLER;
				$this->urlMetodo = METHOD;
			}
			//echo "Controller: " .$this->urlController."<br/>Método: " .$this->urlMetodo
			//	."<br/>Parâmetro: " .$this->urlParametro; exit(); 
		}
		
		public function carregar(){
			$this->class = "\\Site\\controllers\\" .$this->urlController;
			if(class_exists($this->class)){
				$classLoad = new $this->class;
				$classLoad->{$this->urlMetodo}($this->urlParametro);	
			}else{
				$this->urlController = $this->prepareController(ERROR404);
				$this->carregar();
			}
			
		}
		
		private function clearUrl(){
			//elimina as tags
			$this->url = strip_tags($this->url);
			//elimina espaços
			$this->url = trim($this->url);
			//elimina barra no final
			$this->url = rtrim($this->url, "/");
			
			self::$formato = array();
            self::$formato['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]?;:.,\\\'<>°ºª ';
            self::$formato['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr--------------------------------';
            $this->url = strtr(utf8_decode($this->url), utf8_decode(self::$formato['a']), self::$formato['b']);
		}
		
		public function prepareController($urlController){
			//$urlController = strtolower($urlController);
			//$urlController = explode("-", $urlController);
			//$urlController = implode(" ", $urlController);
			//$urlController = ucwords($urlController);
			//$urlController = str_replace(" ", "", $urlController);
			$urlController = str_replace(" ", "", ucwords(implode(" ", explode("-", strtolower($urlController)))));
			return $urlController;
		}
		
	}