<?php
//generated
 

$ob_file = "";


function ob_file_callback($buffer)
{
  global $ob_file;
  fwrite($ob_file,$buffer);
}

function create_file($name){
	global $ob_file;
	global $gen_path;
	global $gen_name;
	echo " |-- file created : \"" . $name ."\"\n\r";
	$ob_file = fopen($gen_path . $name,"w");

}



function close_file(){
	global $ob_file;
	ob_end_flush();
	fclose($ob_file);
	@ob_clean();
}


//user funcions


function start_file($name){

	close_file();
	create_file($name);
	ob_start("ob_file_callback");


}

function resolve_path($path){
	global $gen_path;
	$realpath = realpath($gen_path . $path);
	if(!$realpath){		
		echo "cannot resolve path " . $gen_path . $path;
		return;
	}
	return $realpath;

}


function to_var_name($string){

	$pattern = '/[ \/!@#\$%¨&*();,.-]/i';
	$replacement = '_';
	return preg_replace($pattern, $replacement, $string);	

}



?>