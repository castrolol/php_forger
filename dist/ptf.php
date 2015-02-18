<?php

	include("func.inc.php");
	
	function make_ptf($filename){

		$func_include_path = addslashes( dirname(__FILE__) . DIRECTORY_SEPARATOR . "func.inc.php" );
		$initial_text = '



			$self_script = $_SERVER["argv"][0];
			$gen_path = $_SERVER["argv"][1];
			$gen_name = $_SERVER["argv"][2];

			include("'.$func_include_path.'");

			create_file($gen_name . ".php");
			ob_start("ob_file_callback");




		';

		$filepath = $filename;
		 
		$contents = file_get_contents($filepath);

		$parts = explode("<+", $contents);
	 	
		$strings = array();

		$strings[] = array("string", $parts[0]);

		for($i = 1; $i < sizeof($parts); $i++){
			

			if(strpos($parts[$i], "+>") !== false){
				$subparts = explode("+>", $parts[$i]);
		
				$strings[] = array("code", $subparts[0]);
				$strings[] = array("string", $subparts[1]);

			}

		}
		
		 
		$str_final = "<?php ";
		$str_final .= $initial_text;

		foreach($strings as $string){

			if( $string[0] == "string"){
				$str_final .= "\necho '" . str_ireplace("'", "\'", $string[1]) . "';\n";
			}else{
				if(strpos($string[1], "=") === 0){
					$string[1] =  "echo " . substr($string[1], 1) . ";";
				}
				$str_final .= "\n" . $string[1] . "";
			}
		}

		$str_final .= "


		ob_end_clean();
		?>";

		//$temp_file_name = tempnam(sys_get_temp_dir(), 'php_generated_file');
		$temp_file_name = "d:\\temp.php";//tempnam("c:/", 'php_generated_file');
		echo "  \n\r";
		echo "-- read template: \"" . basename($filename) . "\"\n\r";
		echo " | \n\r";

		file_put_contents($temp_file_name, $str_final);

		return $temp_file_name;
	}

?>