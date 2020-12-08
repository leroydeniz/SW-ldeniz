<?php

	class GoogleAuth{
		protected $client;
		
		public function __construct(Google_Client $googleClient = null){
			
			$this -> client= $googleClient;
			if($this->client){
				$this->client->setClientId('906531296038-91gcbpoufqh8s26g46a1a896np7brl1a.apps.googleusercontent.com');
				$this->client->setClientSecret('z7H9tegIxS8ftbiFrpdar9aP');
				$this->client->setRedirectUri('http://localhost:8080/logingoogle/index.php');
				$this->client->setScopes('email');
			}
			
		}
		public function isLoggedIn(){
				return isset($_SESSION['access_token']);
		}
		
		public function getAuthUrl(){
			return $this ->client->createAuthUrl();
		}
		public function checkRedirectCode(){
				if(isset($_GET['code'])){
					$this->client->authenticate($_GET['code']);
					$this->setToken($this->client->getAccessToken());
					return true;
				}
				return false;
		}
		public function setToken($token){
			$_SESSION['access_token']= $token;
			
			
		}
	}
?>
