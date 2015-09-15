<?php	

class Brutforce 
{
	public $allVariables;
	public $fromValues, $countValues;
	public $chars;
	public $counter;
	public $savePath;

	// default settings here
	function __construct($countVals = 3, $fromValues = 1)
	{	
		// All chars in brut-force
		$this->chars = "abcdefghijklmnopqrstuvwxyz";	
		// Max number chars
		$this->countValues = $countVals;
		// Min number chars
		$this->fromValues = $fromValues;
		// Save path of data values
		$this->savePath = 'brut_data.txt';
		// Make out file clean
		$this->cleanFile($this->savePath);
		// Count of chars (avarage)
		$this->counter = 0;
	}

	// Get last Value of brut-force
	public function lastVar()
	{
		$res = '';
		for($i = 0; $i < $this->fromValues; $i++){
			$res.= $this->chars{strlen($this->chars) -1};
		}
		return $res;
	}
	
	// generate and save data to file. Recursion. 
	public function genBrut($countValues = 3, $prefix = "")
	{	
		if ($prefix == ""){
			$countValues = $this->countValues;
		}
		if ($countValues > 0) {
			for ($i = 0; $i < strlen($this->chars); $i++){			
				$res = $prefix.$this->chars{$i};
				++$this->counter;

				$this->genBrut(--$countValues, $res);
								
				if (strlen($res) >= $this->fromValues ){
					$this->allVariables[$countValues][] = $res;
				}

				$countValues++;

				// Save every 2Mb (average) data										
				if ((($this->counter) % 10000) == 0){
					//var_dump('buffer:'.$this->counter);
				    $this->saveToFile($this->savePath);
					unset($this->allVariables);
				}
			}

			// stop if the end of the all chars exist
			if ($res === $this->lastVar()){
				$this->saveToFile($this->savePath);
					//var_dump("last war =".$res);					
					return;
			}
		} 
	}

	public function getBrut()
	{
		if (isset($this->allVariables) == false){
			// var_dump('isset false');
			return ["empty"];
		}

		if (count($this->allVariables) != false){			
			return array_reverse($this->allVariables);
		} else {
			return ["empty"];
		}
	}

	public function cleanFile($filename)
	{
		$file = fopen($filename, 'w');
    	fwrite($file, '');
    	//var_dump('clean file');
    	fclose($file);
	}

	public function readFile($filename)
	{
		$file = fopen($filename, 'r');	
		fread($file, 9999);
	    fclose($file);
	}

	public function saveToFile($filename, $mode = 0)
	{
		if ($mode == 0) {
			$result = "";
			$reverseArray = $this->getBrut();
			if ($reverseArray != ["empty"]){
				foreach ($reverseArray as $array) {											
	    				$result.= implode("\r\n", $array);
						$result.="\r\n";    				
	    		}
	    		$file = fopen($filename, 'a+');
	    		fwrite($file, $result);
	    		fclose($file);
	    		return '"'.$filename.'"'." saved seccessfully<br>";
    		} else {
    			return 'brut-force array is empty<br>';
    		}
		}
	}
}

