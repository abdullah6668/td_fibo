<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PWD',  '');

// test mysqli procédural
function test_mysqli_proc(?string $DbName, ?string $Table) : bool
{
	$ret = true;
	
	$link = mysqli_connect(HOST, USER, PWD, $DbName);
	if( $err = mysqli_connect_errno() )
	{
		echo "impossible de se connecter a la base $DbName via mysqli procédural : $err";
		return false;
	}
	
	$res = mysqli_query($link, "SELECT * FROM $Table");	// return un result à clore ou un bool si CREATE / INSERT / UPDATE / DELETE
	if( !$res )
	{
		echo "echec mysqli_query !!";
		$ret = false;
	}
	else
	{
		echo "La table $Table contiens ".mysqli_num_rows($res)." ligne(s) (mysqli procédural)<br/>";
		
		while( $row = mysqli_fetch_assoc($res) )
			print_r( $row );
		
		mysqli_free_result( $res );		// fermer le result Query !!
	}
	
	mysqli_close( $link );				// fermer le lien BDD !!
	
	return $ret;
}

// mysqli POO
function test_mysqli_obj(?string $DbName, ?string $Table) : bool
{
	$ret = true;
	
	$mysqliObj = new mysqli(HOST, USER, PWD, $DbName);
	if( $err = $mysqliObj->connect_errno )
	{
		echo "impossible de se connecter a la base $DbName via mysqli POO : $err";
		return false;
	}
	
	$res = $mysqliObj->query("SELECT * FROM $Table");	// return un result à clore ou un bool si CREATE / INSERT / UPDATE / DELETE
	if( !$res )	
	{
		echo "echec mysqli_query POO !!";
		$ret = false;
	}
	else
	{
		echo "La table $Table contiens ".$res->num_rows." ligne(s) (mysqli POO)<br/>";
		
		while( $row = $res->fetch_assoc() )
		{
			print_r( $row );
		}
		
		$res->close();				// fermer le result Query !!
	}
	
	$mysqliObj->close();			// fermer le lien BDD !!
	
	return $ret;
}

// PDO
function test_PDO(?string $DbName, ?string $Table) : bool
{
	$ret = true;
	
	try
	{
		$user = "root";
		$pwd = "";
		$pdo = new PDO('mysql:host='.HOST.';dbname='.$DbName, USER, PWD	);
	}
	catch( PDOException $Exception )
	{
		echo "impossible de se connecter a la base $DbName via PDO : ".$Exception->getMessage();
		return false;
	}
	$Statement = $pdo->query("SELECT * FROM $Table");
	if( !$Statement )
	{
		echo "echec query PDO !!<br/>";
		print_r( $statement->errorInfo() );
		$ret = false;
	}
	else
	{
		echo "La table $Table contiens ".$Statement->rowCount()." ligne(s) (PDO)<br/>";
		
		while( $row = $Statement->fetch(PDO::FETCH_ASSOC) )
			print_r( $row );
	}
	
	return $ret;
}
?>