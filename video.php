<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	USER : 
	<?php 
		$username = $_GET['username']; 
		echo($username) 
	?>
	<video id='vid'>
		<source src="video.mp4" type="video/mp4">
	</video>
	<section>
		<button onclick="playvideo()" type="button">
			Play/Pause
		</button>
	</section>
</body>

<script>
	window.onbeforeunload = function() {
		alert('Browser window is closing');	
		<?php
			$username = $_GET['username'];
			$db = mysqli_connect("localhost","root","","youtube") or die("Error Connecting");
			$query = "select views from `youtube` where username = '$username'";
			$result = mysqli_query($db,$query) or die(mysqli_error($db));
			$responseArray = mysqli_fetch_all($result,MYSQLI_ASSOC);
			$view = time();
			  if($view > $responseArray[0]["views"]) {
		  		$query1 = "UPDATE `youtube` SET views = '$view' WHERE username='$username'";
				$result1 = mysqli_query($db,$query1) or die(mysqli_error($db));
			}
			@flush();
		?>
		console.log('completed');
		return "Closing..";
	}
	function time() {
		return document.getElementById('vid').currentTime;
	}
	var video = document.getElementById('vid');
	function playvideo() {
		if(video.paused)
			video.play();
		else
			video.pause();
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