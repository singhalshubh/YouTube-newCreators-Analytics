<!DOCTYPE html>
<html>
<meta charset="utf-8"/>

<head>
	<title></title>
</head>
<body>
	USER : 
	<?php 
		$username = $_GET['username']; 
		echo($username);
	?>
	<video id='vid' controls>
		<source src="video.mp4" type="video/mp4">
	</video>
	<section>
		<button onclick="close()">
			Cefldekjwfe
		</button>
	</section>
	<form method="POST" action="views.php" id="form">
		<input type="number" step = "any" name="ViewTime" id = "ViewTime">
		<input type="number" name="username" id = "username">
		<input type="submit" name="submit" onclick="viewsClose()">
	</form>
</body>

<script type="text/javascript">
	function viewsClose() {
		document.getElementById("ViewTime").value = document.getElementById("vid").currentTime;
		document.getElementById("username").value = <?php echo($_GET['username']);?>;
	}
</script>

<style type="text/css">
	#vid {
		width: 20%;
		height: 20%;
		border-color: black;
	}
	#buttons {
		height: 300%;
	}
	#button {
		height: 100%;
		width: 2%;
		color: black;
		background : white;
	}
</style>

</html>