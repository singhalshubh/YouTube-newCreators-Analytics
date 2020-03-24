<?php
	$db = mysqli_connect("localhost","root","","youtube") or die("Error Connecting");
	$username = $_GET['username'];
	$query = "select views from `youtube` where username='$username'";
	$result = mysqli_query($db,$query) or die(mysqli_error($db));
	$responseArray = mysqli_fetch_all($result,MYSQLI_ASSOC);
	setcookie("views",$responseArray[0]["views"],time()+600, "/");
	@flush();
?>

<!DOCTYPE html>
<html>
<meta charset="utf-8"/>
<link href="https://fonts.googleapis.com/css?family=Baloo+Da+2&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Acme&display=swap" rel="stylesheet">
<head>
	<title></title>
</head>
<body bgcolor="#F5F5F5">
	<section class="leftside">
		<img src="yt.png" class="youtube"><br>
		<h1 class="heading">YouTube Creator's Analytics</h1>
		<p class="intro">
			YouTube is a platform which promotes various young content developers to outsource their talent. YouTube Creator's Analytics aims to provide a tool which can record the number of users at different watch times in the video so that the youtubers can check their content engangement time for various users and to analyse whether their risky/intuitive element of YouTube worked or not?(By seeing the analytics, one can determine the graph between time points and number of users).
		</p>
		<p class="intro1">
			Made by Shubhendra Pal Singhal. This website is not an official website of YouTube.
		</p>
	</section>
	<section class="rightside">
		<h6 class="intro2">Phone-Number (User) :  <?php $username = $_GET['username']; echo($username);?></h6>
		<video id='vid' controls>
			<source src="video.mp4" type="video/mp4">
		</video>
		<button onclick="playVideo()" class="button">
			Play
		</button>
		<form method="POST" action="views.php" id="form">
			<input type="hidden" step = "any" name="ViewTime" id = "ViewTime">
			<input type="hidden" name="username" id = "username">
			<input type="submit" name="submit" value= "Close and Record View Time" onclick="viewsClose()" class="button">
		</form>
	</section>
</body>

<script type="text/javascript">
	function playVideo() {
		var video = document.getElementById('vid');
		video.currentTime = parseInt(getCookie());
		if(video.paused) {
			//here there is only one cookie..so need of any parameter.
			video.play();
		}
		else {
			video.pause();
		//we can record the time for sessionBased time recording. Use SET Datatype for views in SQL record then.
		}
	}

	function getCookie() {
		var array = document.cookie;
		var value;
		for(let i=0;i<array.length;i++) {
			if(array[i] == "=") {
				value = array[i+1];
				break;
			}
		}
		return value;
	}

	function viewTime() {
		document.getElementById('vid').currentTime = $_COOKIE("views");
	}

	function viewsClose() {
		document.getElementById("ViewTime").value = document.getElementById("vid").currentTime;
		document.getElementById("username").value = <?php echo($_GET['username']);?>;
	}
</script>

<style type="text/css">
	#vid {
		width: 40%;
		align-self: center;
		alignment-baseline: central;
		height: 40%;
		margin-left: 10%;
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
	.leftside {
		background: black;
		float: left;
		color: white;
		width: 50%;
		margin: 1%;
	}
	.rightside {
		float: right;
		margin-top: 5%;
		margin-right: 4%;
		padding: 0%;
		width: 40%;
		height: 200%;
		background: #add8e6;
		border-color: black;
		
	}
	.youtube {
		width: 30%;
		height: 30%;
		padding: 1%;
		margin-top: 3%;
		margin-left: 3%;
	}
	.intro {
		margin: 5%;
		padding-top: 10%;
		overflow: hidden;
		padding-bottom: none;
		font-family: 'Baloo Da 2', cursive;

	}
	.intro1 {
		margin: 5%;
		padding-top: 10%;
		overflow: hidden;
		padding-bottom: none;
		font-size: 5%;
		text-align: center;
		font-family: 'Baloo Da 2', cursive;

	}
	.heading {
		font-family: 'Acme', sans-serif;
		width: 30%;
		height: 30%;
		padding: 1%;
		margin-top: 3%;
		margin-left: 3%;
	}
	.intro2 {
		margin: 5%;
		padding-top: 1%;
		overflow: hidden;
		padding-bottom: none;
		font-size: 20px;
		text-align: center;
		font-family: 'Baloo Da 2', cursive;
	}
	.button {
		font-family: 'Baloo Da 2', cursive;
		color: black;
		background: #ffcccb;
		margin-left: 50%;
		margin-top: 10%;
		margin-bottom: 5%;
	}
</style>

</html>