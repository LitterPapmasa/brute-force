<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Brut-force</title>

	<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css"> -->
	<?php 
		require __DIR__.'/BrutforceClass.php';
		if ($_SERVER['REQUEST_METHOD'] == "GET" and $_GET != false){
			if(	empty($_GET['maxValues']) == false and
				empty($_GET['minValues']) == false and
				(empty($_GET['chars']) == false or $_GET['chars'] == "0")){
				
				$maxVals = htmlspecialchars($_GET['maxValues']);
				$minVals = htmlspecialchars($_GET['minValues']);			
				$brutik = new Brutforce($maxVals, $minVals); 
				$brutik->chars = htmlspecialchars($_GET['chars']);
				$brutik->genBrut(); 
				$message="";
			} else {
				$message = "Configuration isn't set"; 
			}
		} else {
			$message = "";
		}
	?>	


	<style>
	  div.data{
	    display: none;
	    font-size: 15px;
	    width: <?= ($maxVals*8.4)+40; ?>px;
	    max-width: 100%;
	    text-align: center;
	    padding-left: auto;
	    padding-right: auto;
	    border: 1px solid #000;*/
	  }
	  .warning {
	  	color: #ff9999;
	  	font-family: 'console';
		margin-top: 0px;
	  	padding-left: 65px;
	  }
  	</style>


	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>  	
		
</head>
<body>

	<h1> Brut-force </h1>	

	<form action="<?= $_PHP["SELF"]; ?>" method="get">
		chars:<input type="text" name="chars" value="<?= isset($brutik->chars)? $brutik->chars : '+-|';?>">
		Max Value:<input type="text" name="maxValues" value="<?= isset($maxVals)? $maxVals : '3';?>">
		Min Value:<input type="text" name="minValues" value="<?= isset($minVals)? $minVals : '1';?>">
		<input type="submit" value="Generate">
		<h6 class="warning">Html tags woudn't work</h6>
	</form>

	<?php if ($brutik->counter > 0 ): ; ?>
		<p>You can see Brut-force data here -> <a id="show-brut" href="#">show</a></p>		
		<div class="data">
			<code><pre><?php include $brutik->savePath; ?></pre></code>
		</div>
	<?php else: ?>
		<p> <?=$message ?></p>
	<?php endif;?>

<script>
	$( "#show-brut" ).click(function() {
		$( "div.data" ).slideToggle( "100", function(){

			if ($('#show-brut').html() == "show"){
				$('#show-brut').html("hide");				
			} else {
				$('#show-brut').html("show");
			}
		});
	});
</script>

</body>
</html>

