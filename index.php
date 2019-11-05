<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<title>
		
	</title>
</head>
<body>
	<?php 
		$ps = ["4a0","2a0","a0","a1","a2","a3","a4","a5","a6","a7","a8","a9","a10","b0","b1","b2","b3","b4","b5","b6","b7","b8","b9","b10","c0","c1","c2","c3","c4","c5","c6","c7","c8","c9","c10","ra0","ra1","ra2","ra3","ra4","sra0","sra1","sra2","sra3","sra4","letter","half-letter","legal","ledger","tabloid","executive","folio","commercial #10 envelope","catalog #10 1/2 envelope","8.5x11","8.5x14","11x17"];
	?>
	<div class="col-md-4">
		<form method="post" action="pdf.php">
		  <div class="form-group">
		    <label for="imageurl">Image URL</label>
		    <input type="text" class="form-control" name="imageurl" id="imageurl" placeholder="Image URL">
		  </div>
		  <div class="form-group">
		    <label for="topinput">Top</label>
		    <input type="text" class="form-control" name="topinput" id="topinput" placeholder="Top">
		  </div>
		  <div class="form-group">
		    <label for="leftinput">Left</label>
		    <input type="text" class="form-control" name="leftinput" id="leftinput" placeholder="Left">
		  </div>
		  <div class="form-group">
		    <label for="pagesize">Page size</label>
		  	<select class="form-control" name="pagesize" id="pagesize">
		  		<?php foreach($ps as $v){
		  			echo $v == 'letter' ? '<option selected value="'.$v.'">'.ucwords($v).'</option>' : '<option value="'.$v.'">'.ucwords($v).'</option>';
		  		} ?>
		  	</select>
		  </div>
		  <div class="form-group">
		    <label for="orientation">Orientation</label>
		  	<select class="form-control" name="orientation" id="orientation">
		  		<option selected value="portrait">Portrait</option>
		  		<option value="landscape">Landscape</option>
		  	</select>
		  </div>
		  <button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</body>
</html>

