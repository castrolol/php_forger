<?php

	require_once("ptf.php");
	$gen_path = '';
	$gen_name = ''; 


	function execute($script, $params = []){

		$path = PHP_BINARY;
	
		$params_line = implode($params, " ");


		return shell_exec($path . " " . $script .  " " . $params_line);

	}

	function gen_recursive($path){

		global $gen_path;
		global $gen_name;
	 

		if(is_dir($path)){
		
			echo "\n\r";	
			echo "\n\r";	
			echo "Folder: " . $path . "\n\r";	
			echo "------------------------------------------";
			echo "\n\r";	
			$files = scandir($path);	 

			foreach($files as $file){
				if($file == "." || $file == "..") continue;
				
				$full_file = $path . DIRECTORY_SEPARATOR . $file;

				gen_recursive($full_file);					 

			}

			return;
		}

 

		if(substr( basename ($path), -3 , 3) == "tpf"){


			$ptf_file = make_ptf($path);
			$gen_path = dirname($path) . DIRECTORY_SEPARATOR;
			$gen_name = basename ($path,".tpf");
		 
			echo execute($ptf_file, array($gen_path, $gen_name));


			//$sandboxfunc($ptf_file, $gen_name, $gen_path);

			 
			 
		}

	}

 
	$file_initial = '';
	if(isset(  $_SERVER['argv'][1]))
	{
		$file_initial = $_SERVER['argv'][1];
	}else{
		$file_initial = dirname(__FILE__);
	}

	echo "searching in '" . $file_initial . "'\n\r";
	gen_recursive($file_initial);



	

 

?>