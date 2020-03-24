<?php
	session_start();
	header( "Location: graph.html", TRUE, 301 );
	include("./pchart/class/pData.class.php");
	include("./pchart/class/pDraw.class.php");
	include("./pchart/class/pImage.class.php");
	include("./pchart/class/pScatter.class.php");
	
	$db = mysqli_connect("localhost","root","","youtube") or die("Error Connecting");
	$query = "select views from `youtube`";
	$result = mysqli_query($db,$query) or die(mysqli_error($db));
	$responseArray = mysqli_fetch_all($result,MYSQLI_ASSOC);
	$query1 = "select count(username) as number from `youtube`";
	$result1 = mysqli_query($db,$query1) or die(mysqli_error($db));
	$responseArray1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);
	@flush();
	$MyData = new pData();  
	for ($i=0;$i<$responseArray1[0]["number"];$i=$i+1) { $MyData->addPoints($responseArray[$i]["views"],"View Time"); }
	for ($i=0;$i<10;$i=$i+1) { $MyData->addPoints($i,"Users"); }
	$MyData->setAxisName(0,"View Time");
	$MyData->setAbscissa("Users");

	/* Create the pChart object */
	$myPicture = new pImage(450,230,$MyData);
	 
	$myPicture->setFontProperties(array("FontName"=>"./pChart/fonts/Forgotte.ttf","FontSize"=>6));
	$myPicture->setFontProperties(array("FontName"=>"./pChart/fonts/Forgotte.ttf","FontSize"=>11));

	/* Draw the scale and the 1st chart */
	$myPicture->setGraphArea(60,60,450,190);
	$myPicture->drawScale(array("DrawSubTicks"=>TRUE));
	$myPicture->setFontProperties(array("FontName"=>"./pChart/fonts/Forgotte.ttf","FontSize"=>6));
	$myPicture->drawBarChart(array("DisplayValues"=>TRUE,"DisplayColor"=>DISPLAY_AUTO,"Rounded"=>FALSE,"Surrounding"=>10));

	$myPicture->render("analytics.png");
?>