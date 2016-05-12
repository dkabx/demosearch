<?php 
error_reporting(1);
require_once 'in/init.php';
  
if(isset($_GET['sear']))
	{
		$q=$_GET['sear'];
		$query=$es->search([
		'body'=>[
		'query'=>[
		'bool'=>[
		'should'=>[
		
		'match'=>['body'=>$q]
		]]]]]
		);
	}
if($query['hits']['total']>=1)
	{
		$results=$query['hits']['hits'];

}	
?>

<html>
	<body>
		<form action="search.php"method="get" autocomplete="off">
			<input type="text" name="sear">
			<input type="submit" value="Sear">		</form>
	</body>
<?php
foreach($results as $result)
{
	
	 echo '<b>'.$result['_source']['body'].'<b><br><br><br>';
	

}
?>
</html>