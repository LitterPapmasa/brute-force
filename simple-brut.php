

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<title>Перебор</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf" />
</head>
<body>
<?php



function brut($brutLeng = 3, $prefix = ""){
global $all;
	$chars = "abc"; //"defghijklmnopqrstuvwxyz";	
	if ($brutLeng > 0) {
		for ($i = 0; $i < strlen($chars); $i++){			
			$res = $prefix.$chars{$i};
			
			brut(--$brutLeng, $res);
			$all[$brutLeng++][] = $res;
			
			echo $res;
			echo "<br>";			
		}
	} else {
		echo "brut = ".$brutLeng." ";				
	}
}


brut(3);

var_dump(array_reverse($all));
?>

</body>
</html>