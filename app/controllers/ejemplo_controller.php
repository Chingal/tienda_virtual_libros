<?php
 
class EjemploController extends ApplicationController{
 
function index($page=1){ }
 var $name = 'Datos';
function subir(){ 
Load::lib('upload');
Upload::image('foto');
//$imgname=$_FILES["foto"]['name'];
$registro->img = $_FILES['foto']['name'];
//echo img_tag('upload/'.$registro->foto); 

        /*if(isset($_FILES['foto'])){
			Load::lib('upload');
            mkdir(APP_PATH . 'public/img/upload/' . Session::get('idusuario'), 777);
            if(Upload::file_in_path('foto', APP_PATH . 'public/img/upload/' . Session::get('idusuario').'/'))  Flash::success('La foto ha sido subida con éxito.');
            else Flash::error('Ocurrió un error subiendo el archivo.');
        }*/
    

}
 
}