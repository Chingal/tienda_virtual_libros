<?php
      class Catalogo extends ActiveRecord
      {

          public function getCatalogo($page, $ppage=5)
          {
              return $this->paginate("page: $page", "per_page: $ppage");
          }
		  
		public function buscar($busqueda){
		 
			$busqueda = filter_var($busqueda, FILTER_SANITIZE_STRING);
			return $this->find_all_by_sql("SELECT * FROM test.catalogo WHERE titulo like \"%$busqueda%\" or autor like \"%$busqueda%\" or editorial like \"%$busqueda%\" or categoria like \"%$busqueda%\" or precio like \"%$busqueda%\"");
      }
	 }
?>