<?php
class RegistrarController extends ApplicationController {

	//public $template = 'hoja1';
    public $models = array('usuario');   
 
 
	
    public function index(){
		$this->conf = $this->request("Npass");
		$this->pass = $this->request('usuario.password');
		if($this->has_post("usuario")){
			if($this->conf == $this->pass){
				//if($this->conf.val.length < 7){
					$obj=new Usuario($this->post("usuario"));
					if(!$obj->save()){
						Flash::error("Hubo un error en el registro del usuario");
						$this->usuario=$obj;
					}
					else{
						$this->redirect("login/index");
						Flash::success("Registro exitoso");
					}
				//}
			}
			else{
				Flash::error("Las contraseñas no coinciden");
			}
		}
	}
	
	public function create ()
    {
        if($this->has_post('catalogo')){
            $catalogo = new Catalogo($this->post('catalogo'));
            if(!$catalogo->save()){
                Flash::error('Falló Operación');
                $this->catalogo = $this->post('catalogo');
            }else{
                Flash::success('Operación exitosa');
            }
			Router::route_to('action: index');
        }
    }
	
	
}
?>