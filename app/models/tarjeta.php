<?php
      class Tarjeta extends ActiveRecord
      {

          public function getTarjeta($page, $ppage=5)
          {
              return $this->paginate("page: $page", "per_page: $ppage");
          }
		  
		
	 }
?>