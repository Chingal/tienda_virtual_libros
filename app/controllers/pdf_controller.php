<?php
class PdfController extends ApplicationController {

public function reporte (){
	$this->set_response('view');
	$j=0;
	for ($i=0;$i<100;$i++){
		$this->var = Session::get($i);
		if(Session::isset_data($i)){
			$this->var[1];
			$this->var[2];
			$this->var[2]*$this->var[3];
			$j=$j+($this->var[2]*$this->var[3]);
		}
	}
        
}

}
?>