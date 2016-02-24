<?php
class LoginController extends ApplicationController {

	//public $template = 'hoja1';
    public $models = array('usuario');   
 
 
	
    public function index(){
		if($this->has_post("login","password")){//Verificamos si se envían datos del formulario
			$login = $this->request("login");/*Tomamos el login del request*/
			$password = $this->request("password");/*Tomamos el pass del request*/
			/*Aqui usamos el modulo Auth de KumbiaPHP para loguear al usuario*/
			$auth = new Auth("model", "class: usuario", "login: $login","password: $password");
			if($auth->authenticate()){/*Si el usuario y la clave son correctos ingresa el usuario*/
				$user = $this->Usuario->find_by_login($login);
				Session::set("userName",$user->login);
				if(Session::get("userName")=='admin'){
					Flash::success("Usuario: ".Session::get("userName"));
					$this->redirect("catalogo");
				}
				else{
					Flash::success("Usuario: ".Session::get("userName"));
					$this->redirect("usuario");
				}
				
			}
			else{
				//Router::route_to('action: index');
				Flash::error("Usuario o Password invalidos");
			}
		}
	}
	public function logout(){
		Auth::destroy_identity();		
		Session::unset_data("userName");
		Flash::notice("Ud. ha salido de la aplicacion");
		Router::route_to('action: index');		
	}
}
?>