<?php
	$DOCUMENT_ROOT = $_SERVER[ 'DOCUMENT_ROOT' ];
	session_start();
	
	if( empty( $_POST ) || empty( $_SESSION ) )
	{
		unset( $_SESSION[ 'left' ] );
		unset( $_SESSION[ 'right' ] );
		session_destroy();
	}
	elseif( !empty( $_SESSION ) )
	{	
		$voteString = each( $_POST );
		$voteArray = explode( '_', $voteString[ 'key' ] );
		
		if( $voteArray[ 0 ] == 'l' )
			file_put_contents( "$DOCUMENT_ROOT/../data/votes.txt", $_SESSION[ 'left' ]."\n", FILE_APPEND );
		else
			file_put_contents( "$DOCUMENT_ROOT/../data/votes.txt", $_SESSION[ 'right' ]."\n", FILE_APPEND );
		
		unset( $_SESSION[ 'left' ] );
		unset( $_SESSION[ 'right' ] );
		session_destroy();
	}
	else
	{
		unset( $_SESSION[ 'left' ] );
		unset( $_SESSION[ 'right' ] );
		session_destroy();
	}	
?>
<html>
<head><title>Delicióóósina</title></head>
<body>
<center>
<img src="headerBig.png">
<hr>
<br /><br /><br />
<?php
    ini_set("display_errors", 1);
    error_reporting(E_ALL);
	$imgFolder = opendir("$DOCUMENT_ROOT/../photos/");
	
	while( $fileName = readdir( $imgFolder ) )
	{
		if( preg_match( "/.PNG$/i", $fileName ) )
			$imgArray[] = $fileName;
	}
	
	if( empty( $imgArray )  || count( $imgArray ) < 2 )
	{
		echo '$imgArray empty';
		echo '</center></body></html>';
		exit;
	}
	

	shuffle( $imgArray );	
	echo '<p>chegou aqui</p>';
	$imgLeft = ImageCreateFromPNG( $DOCUMENT_ROOT.'/../photos/'.$imgArray[0] );
	ImagePNG( $imgLeft, "imgLeft.png" );
	$imgRight = ImageCreateFromPNG( $DOCUMENT_ROOT.'/../photos/'.$imgArray[1] );
	ImagePNG( $imgRight, "imgRight.png" );
	
	ImageDestroy( $imgLeft );
	ImageDestroy( $imgRight );
	
	session_start();
	$_SESSION[ 'left' ] = $imgArray[0];
	$_SESSION[ 'right' ] = $imgArray[1];
	
?>
<table border=0>
<tr>
<form action="index.php" method=post>
<?php
	echo '<td><input type = "image" src = "imgLeft.png" name = "l" /></td>'."\n";
	echo '<td><input type = "image" src = "imgRight.png" name = "r" /></td>'."\n";
?>
</form>
</tr>
</table>
</center>
</body>
</html>
