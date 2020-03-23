<?php 
  $db = mysqli_connect("localhost","root","","youtube") or die("Error Connecting");
  $username = $_POST["username"];
  $password = $_POST["password"];
  if(Math.floor( Math.log($username) / Math.LN10 ) + 1 < 10) {
    header("refresh:0.1,url=wrongIndex.html");
  }
  $views = 0;
  $query = <<<EOD
select username from youtube where username = '$username';
EOD;
  $result = mysqli_query($db,$query) or die(mysqli_error($db));

  $responseArray = mysqli_fetch_all($result,MYSQLI_ASSOC);
if($responseArray[0]["username"] == 0)
 { $password = md5($password);
  $query = <<<EOD
INSERT INTO `youtube` VALUES ('$username','$password', 0);
EOD;

$result1 = mysqli_query($db,$query) or die(mysqli_error($db));
header("refresh:0.1,url=video.php?username=" .$username);
}
else {
  $query = <<<EOD
select password as cp from youtube where username = '$username';
EOD;
 $result2 = mysqli_query($db,$query) or die(mysqli_error($db));

  $responseArray2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);
if($responseArray2[0]["cp"] == md5($password)) {
  header("refresh:0.1,url=video.php?username=" .$username);
}
else {
  echo("Wrong credentials");
}
}
  @flush();

?>
