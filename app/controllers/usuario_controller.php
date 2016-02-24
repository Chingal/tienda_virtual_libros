<?php
class UsuarioController extends ApplicationController {

	//public $template = 'hoja1';
    public $models = array('catalogo', 'usuario');   

    public function index($page=1) 
    {
		if(Auth::is_valid()){
			$usuario_id=Auth::get("id");
			$this->user=$this->Usuario->find_by_id($usuario_id);
			
		}
        $this->listCatalogo = $this->Catalogo->getCatalogo($page);
    }
	
	/*public function workspace() {
	    if(Auth::is_valid()){
		    $usuario_id=Auth::get("id");
		    $this->metas=Load::model("meta")->find("usuario_id=$usuario_id", "order: nombre asc");
		    //"columns: accion.id, accion.nombre, accion.progreso, accion.completada ",
		    $this->acciones=Load::model("accion")->paginate("columns: accion.id, accion.nombre, accion.progreso, accion.completada ","join: inner join meta on meta.id=accion.meta_id","conditions: completada=0","order: meta_id","page: 1","per_page: 30");
		 }else{
				$this->route_to("controller: usuario","action: login");		 
		 } 
	}*/
	public function edit($id = null)
    {
	if(Auth::is_valid()){
			$usuario_id=Auth::get("id");
			$this->user=$this->Usuario->find_by_id($usuario_id);
			
		}
    	if($id != null){

            $this->usuario = $this->Usuario->find($id);
    	}

        if($this->has_post('usuario')){
 
            if(!$this->Usuario->update($this->post('usuario'))){
                $this->usuario = $this->post('usuario');
            } else {
				if(Session::get("userName")=='admin'){
					Flash::success('Operación exitosa');
					Router::route_to('controller: catalogo');
				}
				else{
				Flash::success('Operación exitosa');
					Router::route_to('action: index');
				}
            }
        }
    }
	public function change_pass($id = null)
    {
		if(Auth::is_valid()){
			$usuario_id=Auth::get("id");
			$this->user=$this->Usuario->find_by_id($usuario_id);
		}
    	if($id != null){
            $this->usuario = $this->Usuario->find($id);
    	}
		if($this->has_post('usuario')){
			$this->pass = $this->request("pass");
			$this->pass1 = $this->request('usuario.password');
			if($this->pass1 == $this->pass){
				$this->passNuevo = $this->request("Npass");
				$this->NpassNuevo = $this->request("NNpass");
				if($this->passNuevo == $this->NpassNuevo){
					$user_id=Auth::get("id");
					$this->usuario=$this->Usuario->find_by_id($user_id);
					$this->usuario->password = $this->passNuevo;					
					if(!$this->usuario->save()){
						Flash::error('Falló Operación');
						$this->usuario = $this->post('usuario');
					} 
					else {
						if(Session::get("userName")=='admin'){
							Flash::success('Operación exitosa');
							Router::route_to('controller: catalogo');
						}
						else{
							Flash::success('Operación exitosa');
							Router::route_to('action: index');
						}
					}
				}
				else{
					Flash::error('Los passwords no coinciden');
					//Router::route_to('controller: usuario', 'action: change_pass', "id: 7");
				}
			}
			else{
				Flash::error('Password incorrecto');
				//Router::route_to("controller: usuario", "action: edit");
			}
			
		}
		
    }
	
	public function ver2()
    {
	if(Auth::is_valid()){
			$usuario_id=Auth::get("id");
			$this->user=$this->Usuario->find_by_id($usuario_id);
			
		}
		$this->mensaje=$this->request("nombre");
        if ($this->mensaje) {
			$this->listCatalogo = $this->Catalogo->getCatalogo($page=1);
            $this->catalogo = $this->Catalogo->buscar($this->mensaje);
			if($this->catalogo){
				$this->request("nombre");
			}
			else{
				Flash::warning('La búsqueda no produjo resultados');
				Router::route_to('action: index');
			}
        }
		else{
			Flash::error('Escriba un parámetro de búsqueda');
			Router::route_to('action: index');
		}
    }
	
	public function ver($id = null)
    {
		if(Auth::is_valid()){
			$usuario_id=Auth::get("id");
			$this->user=$this->Usuario->find_by_id($usuario_id);
			
		}
    	if($id != null){

            $this->catalogo = $this->Catalogo->find($id);
			
    	}
        if($this->has_post('catalogo')){
			    Flash::success('Operación exitosa');
                Router::route_to('action: index');
        }
    }
	    
}
?>