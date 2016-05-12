<?php
error_reporting(1);
require_once 'in/init.php';
$redis = new Redis();
   		$redis->connect('127.0.0.1', 6379);
   		
/** Getting the Message from POST method**/
 if(!empty($_POST['body']))
{

	 	/**Storing into redis**/
   		$redis->lpush("message",$_POST['body']);
   		echo 'successfuly sent';
		
	 	 

	
   		/**Storing into Elastic search**/
		
		$indexed=$es->index([
		'index'=>'edatabase',
		'type'=>'etable',
		'body'=>[
		
		'body'=>$_POST['body'],
		
		]]);
	
	
}

/** Get the Message From redis**/

?>
<html>
	<body>
		<form action="add.php" method="post">
		<textarea name="body" rows="8" placeholder="Enter your mesage"></textarea ><br>
		
		<input type="submit" value="Submit"><br>
		</form>

		<br>
		<br>
		<form action="add.php" method="GET">
		<textarea name="show" rows="8" placeholder="Enter the Key Value('message') to get messages"></textarea><br>
		
		<input type="submit" value="Submit"><br>
		</form>
	</body>

</html>
<?php
if(!empty($_GET['show']))
{
	 $arlist = $redis->lrange($_GET['show'], 0 ,5);
   echo "<b>Stored messages are:: </b><br>";
  foreach($arlist as $ar)
  {
  	echo $ar.'<br>';
  }
}
?>