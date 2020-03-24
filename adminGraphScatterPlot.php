<?php
	session_start();
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
 	
	$myData = new pData();  

	//for ($i=0;$i<$responseArray1[0]["number"];$i=$i+1) { $myData->addPoints($responseArray[$i]["views"],"Probe 1"); }
	for ($i=0;$i<100;$i=$i+1) { $myData->addPoints(rand(9,10),"Probe 1"); }
	$myData->setAxisName(0,"Time of Videos");
	$myData->setAxisXY(0,AXIS_X);
	$myData->setAxisPosition(0,AXIS_POSITION_BOTTOM);

	 /* Create the Y axis and the binded series */
	 //for ($i=1;$i<=$responseArray1[0]["number"];$i=$i+1) { $myData->addPoints(1,"Probe 2"); }
	 for ($i=1;$i<=100;$i=$i+1) { $myData->addPoints(1,"Probe 2"); }
	 $myData->setSerieOnAxis("Probe 2",1);
	 $myData->setAxisName(1,"Y");
	 $myData->setAxisXY(1,AXIS_Y);
	 $myData->setAxisPosition(1,AXIS_POSITION_LEFT);

	 /* Create the 1st scatter chart binding */
	 $myData->setScatterSerie("Probe 1","Probe 2",0);
	 $myData->setScatterSerieColor(0,array("R"=>0,"G"=>0,"B"=>0));

	 /* Create the pChart object */
	 $myPicture = new pImage(1000,1000,$myData);

	 /* Turn of Anti-aliasing */
	 $myPicture->Antialias = FALSE;

	 /* Set the default font */
	 $myPicture->setFontProperties(array("FontName"=>"./pchart/fonts/pf_arma_five.ttf","FontSize"=>6));
	 
	 /* Set the graph area */
	 $myPicture->setGraphArea(40,40,500,500);

	 /* Create the Scatter chart object */
	 $myScatter = new pScatter($myPicture,$myData);

	 /* Draw the scale */
	 $scaleSettings = array("XMargin"=>15,"YMargin"=>15,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
	 $myScatter->drawScatterScale($scaleSettings);

	 /* Draw the legend */
	 $myScatter->drawScatterLegend(280,380,array("Mode"=>LEGEND_HORIZONTAL,"Style"=>LEGEND_NOBORDER));

	 /* Draw a scatter plot chart */
	 $myPicture->Antialias = TRUE;
	 $myScatter->drawScatterPlotChart();

	 /* Render the picture (choose the best way) */
	 $myPicture->render("analytics.png");
?>