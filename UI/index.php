<?php
	session_start();
?>
	
<html>
<head>
<title> Stack offline</title>
</head>
<body>
<b>Stack Overflow || Mathematics</b><br/><br/>

<?php
	require_once('./soLib.php');
	require_once('./sql.php');
	
	// Get the post ID
	$pid = $_GET["pid"];
	
	// Print the post and all its comments
	$post = getPost($pid);
	printPost($post);
	$comments = getComments($pid);
	printComments($comments);
	
	// Get the accepted answer
	$acc = $post['AcceptedAnswerId'];
	if ($acc == NULL) $acc = 0;
	
	// Get all the replies
	$replies = getReplies($pid);	
	
	// Print all the reply posts along with their comments
	for ($i = 0 ; $i < count($replies); $i ++ ) {
		
		if ($replies[$i] == $acc)
			echo '<b>ACCEPTED</b> <br/>' ;
		$row = getPost($replies[$i]);
		printPost($row);		
		$comments= getComments($replies[$i]);
		printComments($comments);
	}

    
?>
</body>
</html>
