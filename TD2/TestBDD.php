<?php
	require( "../Common/Database.php" );
	
	$Title = "Test Database";
	include( "../Common/HTMLHead.php" );
?>
<form method="post">
	<button type="submite" name='TestMysqliProc' >Test mysqli Proc</button>
	<button type="submite" name='TestMysqliObj' >Test mysqli Obj</button>
	<button type="submite" name='TestPDO' >Test PDO</button>
</form>
<pre>
<?php
		 if( isset($_POST['TestMysqliProc']) ) 	test_mysqli_proc('DatabaseFibo', 'TableFibo');
	else if( isset($_POST['TestMysqliObj']) ) 	test_mysqli_obj('DatabaseFibo', 'TableFibo');
	else if( isset($_POST['TestPDO']) ) 		test_PDO('DatabaseFibo', 'TableFibo');
?>
</pre>
<?php include( "../Common/HTMLEnd.php" ); ?>