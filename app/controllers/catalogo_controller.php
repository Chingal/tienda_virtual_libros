<?php
class CatalogoController extends ApplicationController {

	//public $template = 'hoja1';
     public $models = array('catalogo', 'usuario');   
	 
	
    public function index($page=1) 
    {
		if(Session::get("userName")=='admin'){
							
						
			if(Auth::is_valid()){
				$usuario_id=Auth::get("id");
				$this->user=$this->Usuario->find_by_id($usuario_id);
				
			}
			$this->listCatalogo = $this->Catalogo->getCatalogo($page);
		}
		else{
			Flash::error('P&aacute;gina no encontrada');
			Router::route_to('controller: usuario');
		}
    }
 
 public function index_catalogo() 
    {
	
	if(Session::get("userName")=='admin'){
		if(Auth::is_valid()){
			$usuario_id=Auth::get("id");
			$this->user=$this->Usuario->find_by_id($usuario_id);
			
		}
        $this->listCatalogo = $this->Catalogo->getCatalogo($page=1);
		}
		else{
			Flash::error('P&aacute;gina no encontrada');
			Router::route_to('controller: usuario');
		}
    }
	public function acerca() 
    {    }
	public function mision() 
    {    }
 

       
public function create ()
{
	if(Session::get("userName")=='admin'){
		
		if(Auth::is_valid()){
			$usuario_id=Auth::get("id");
			$this->user=$this->Usuario->find_by_id($usuario_id);
			
		}
		if($this->has_post('catalogo')){
			//if($this->titulo and $this->isbn and $this->autor and $this->categoria and $this->precio and $this->cantidad and $this->editorial and $this->anio){
				Load::lib('upload');
				Upload::image('img');
				$this->nombre_img=$_FILES['img']['name'];
				$this->temp = $this->nombre_img;
				$catalogo = new Catalogo($this->post('catalogo'));
				$catalogo->img = $this->temp;
				if(!$catalogo->save()){
					$this->catalogo = $this->post('catalogo');
				}
				else{
					Flash::success('Operación exitosa');
					Router::route_to('action: index');
				}				
			/*}
			else{
				Flash::error('Faltan campos por llenar');			
			}*/			
		}		
	}	
	else{
		Flash::error('P&aacute;gina no encontrada');
		Router::route_to('controller: usuario');
	}
		
}
 
    public function edit($id = null)
    {
	if(Session::get("userName")=='admin'){
	if(Auth::is_valid()){
			$usuario_id=Auth::get("id");
			$this->user=$this->Usuario->find_by_id($usuario_id);
			
		}
    	if($id != null){

            $this->catalogo = $this->Catalogo->find($id);
    	}

        if($this->has_post('catalogo')){
 
            if(!$this->Catalogo->update($this->post('catalogo'))){
                Flash::error('Falló Operación');

                $this->catalogo = $this->post('catalogo');
            } else {
			    Flash::success('Operación exitosa');
                Router::route_to('action: index');
            }
        }
		}
		else{
			Flash::error('P&aacute;gina no encontrada');
			Router::route_to('controller: usuario','action: index');
		}
    }
	
	public function ver($id = null)
    {
	if(Session::get("userName")=='admin'){
		
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
		else{
			Flash::error('P&aacute;gina no encontrada');
			Router::route_to('controller: usuario');
		}
    }
	
	
    
    public function del($id = null)
    {
		if(Session::get("userName")=='admin'){
			if ($id) {
				if (!$this->Catalogo->delete($id)) {
					Flash::error('Falló Operación');
				}
			}
			Flash::success('Producto eliminado');
			Router::route_to('action: index_catalogo');
			}
			else{
				Flash::error('P&aacute;gina no encontrada');
				Router::route_to('controller: usuario');
			}
	}
	
}
?>