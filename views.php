<?php
	$username = $_POST["username"];
	$db = mysqli_connect("localhost","root","","youtube") or die("Error Connecting");
	$query = "select views from `youtube` where username = '$username'";
	$result = mysqli_query($db,$query) or die(mysqli_error($db));
	$responseArray = mysqli_fetch_all($result,MYSQLI_ASSOC);
	$view = $_POST["ViewTime"];
	echo $view;
	if($view > $responseArray[0]["views"]) {
  		$query1 = "UPDATE youtube SET views = '$view' WHERE username='$username'";
		$result1 = mysqli_query($db,$query1) or die(mysqli_error($db));
	}
	@flush();

?>


<!DOCTYPE html>
<html>
<meta charset="utf-8"/>
</html>