<?php
	$DOCUMENT_ROOT = $_SERVER[ 'DOCUMENT_ROOT' ];
	session_start();
	
	if( empty( $_POST ) || empty( $_SESSION ) )
	{
		unset( $_SESSION[ 'left' ] );
		unset( $_SESSION[ 'right' ] );
		session_destroy();
		header("location:index.php");

	}
	
	$voteString = each( $_POST );
	$voteArray = explode( '_', $voteString[ 'key' ] );
	
	if( $voteArray[ 0 ] == 'l' )
		file_put_contents( "$DOCUMENT_ROOT/../data/votes.txt", $_SESSION[ 'left' ]."\n", FILE_APPEND );
	else
		file_put_contents( "$DOCUMENT_ROOT/../data/votes.txt", $_SESSION[ 'right' ]."\n", FILE_APPEND );
	
	unset( $_SESSION[ 'left' ] );
	unset( $_SESSION[ 'right' ] );
	session_destroy();
	
	header("location:index.php");

?>
