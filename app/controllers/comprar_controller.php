<?php
//Load::lib('carrito');
class ComprarController extends ApplicationController {
   	public $array_titulo = array();
   	public $array_precio = array();
	public $num_productos=200;
   	public $array_cantidad = array();		
	public $models = array('catalogo', 'usuario');   
	
	function index(){
		if(Auth::is_valid()){
			$usuario_id=Auth::get("id");
			$this->user=$this->Usuario->find_by_id($usuario_id);
		}
	}
	
	/*function iniciar(){
		$this->num_productos=0;
		Router::route_to('controller: usuario','action: index');
	}*/
	
	function agregar($id){
		if(Auth::is_valid()){
			$usuario_id=Auth::get("id");
			$this->user=$this->Usuario->find_by_id($usuario_id);
		}		
		$this->catalogo = $this->Catalogo->find($id);
		Session::set($this->catalogo->id, array($this->catalogo->id,$this->catalogo->titulo,$this->catalogo->precio,1));
		Flash::success('Libro agregado');
		//Router::route_to('controller: usuario');
	}
	function compra(){
		if(Auth::is_valid()){
			$x=0;
			$usuario_id=Auth::get("id");
			$this->user=$this->Usuario->find_by_id($usuario_id);
			for($i=0;$i<100;$i++){
				if(Session::isset_data($i)){
					$x=1;
				}
			}
			if($x==0){
				Flash::error('El carrito esta vacio');
				Router::route_to('action: index');
			}
		}
		else{
			Flash::error('Debe iniciar sesi&oacute;n para realizar la compra');
			Router::route_to('controller: login', 'action: index');
		}
	}
	function verificar(){
		if(Auth::is_valid()){
			$usuario_id=Auth::get("id");
			$this->user=$this->Usuario->find_by_id($usuario_id);
		}
		if($this->request("nombre") and $this->request("numero") and $this->request("pass")){
			$this->nombre=$this->request("nombre");
			$this->numero=$this->request("numero");
			$this->pass=$this->request("pass");
			$this->tarjeta = $this->Tarjeta->find($this->numero);
			if($this->tarjeta){
				if(($this->tarjeta->clave == $this->pass) and ($this->tarjeta->titular == $this->nombre)){
					for($i=0;$i<$this->num_productos;$i++){
						Session::unset_data($i);
					}
					Flash::success('compra exitosa');
					Router::route_to('controller: usuario','action: index');
				}
				else{
					Flash::error('Error en la validacion de la tarjeta');
					Router::route_to('action: compra');
				}
			}
			else
			{
					Flash::error('Error en la validacion de la tarjeta');
					Router::route_to('action: compra');
			}
		}
		else{
			Flash::error('Faltan datos');
			Router::route_to('action: compra');
		}
		
	}
	function agregar2(){
		if(Auth::is_valid()){
			$usuario_id=Auth::get("id");
			$this->user=$this->Usuario->find_by_id($usuario_id);
		}
		if($this->request("cod") and $this->request("nombre")){
			$this->mensaje=$this->request("nombre");	
			$this->cod=$this->request("cod");
			$this->catalogo = $this->Catalogo->find($this->cod);
			if($this->mensaje<=$this->catalogo->cantidad){
				$this->mensaje=$this->request("nombre");
				Session::set($this->catalogo->id, array($this->catalogo->id,$this->catalogo->titulo,$this->catalogo->precio,$this->mensaje));
				Flash::success('Libro agregado');
			}
			else{
				$this->catalogo = $this->Catalogo->find($this->cod);
				$codigo = $this->catalogo->id;
				Flash::warning("La cantidad sobrepasa la existente");
				Router::route_to('controller: usuario', 'action: ver', "id: $codigo");
			}
		}
		else{
			$this->cod=$this->request("cod");
			$this->catalogo = $this->Catalogo->find($this->cod);
			Session::set($this->catalogo->id, array($this->catalogo->id,$this->catalogo->titulo,$this->catalogo->precio,1));
			Flash::success('Libro agregado');
		}
	}
	
	
	function borrar_item($id){
		for($i=1;$i<$this->num_productos;$i++){
			Session::unset_data($id);
		}
		Router::route_to('action: index');
	}
	
	function vaciar(){
		for($i=0;$i<$this->num_productos;$i++){
			Session::unset_data($i);
		}
		Router::route_to('action: index');
	}
}
?>	
