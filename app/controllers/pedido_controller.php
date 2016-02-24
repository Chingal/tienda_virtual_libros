<?php
class PedidoController extends ApplicationController {

	//public $template = 'hoja1';
    public $models = array('pedido');   

    public function index($page=1) 
    {
        $this->listPedido = $this->Pedido->getPedido($page);
    }
 
	public function carrito($id = null){
	
		if($id != null){
            $this->pedido = $this->Pedido->find($id);
    	}
		
	
		if($this->has_post('pedido')){
			    Flash::success('Operación exitosa');
                Router::route_to('action: index');
        }
		
	}
	
	public function ver2()
    {
		$this->mensaje=$this->request("nombre");
        if ($this->mensaje) {
			$this->listPedido = $this->Pedido->getPedido($page=1);
            $this->pedido = $this->Pedido->buscar($this->mensaje);
			$this->request("nombre");
        }
    }
	
	public function ver($id = null)
    {
		
    	if($id != null){

            $this->pedido = $this->Pedido->find($id);
			
    	}
        if($this->has_post('pedido')){
			    Flash::success('Operación exitosa');
                Router::route_to('action: index');
        }
    }
    
    
}
?>