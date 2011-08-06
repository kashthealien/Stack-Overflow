<?php	
	
	function connectDB()
	{
	// Database details
	$dbhost = 'localhost';
	$dbname = 'stackMathematics';
	$dbuser = 'kashyap';
	$dbpass = 'Al13\\/\\KKJR19';

	// Connect to the database
	$link = mysql_connect($dbhost, $dbuser, $dbpass);
		if (!$link) {
		die('Could not connect: '.mysql_error());
	}
	mysql_select_db($dbname);
	return $link;    
	}
	
	function getPost($num)
	{
		$link = connectDB();
		$query = sprintf("SELECT * FROM posts WHERE id='%s'",
		mysql_real_escape_string($num));
		$result = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_array($result);
		$row['Tags'] = str_replace("<", "[", $row['Tags']);
		$row['Tags'] = str_replace(">", "]", $row['Tags']);
		mysql_close($link);
		return $row;
	}


	function getReplies($num)
	{
		$link = connectDB();
		$query = sprintf("SELECT id FROM posts WHERE ParentId='%s'",
		mysql_real_escape_string($num));
		$result = mysql_query($query) or die(mysql_error());
		
		$i = 0;
		$replies = array();		
		while($row = mysql_fetch_array($result))
		{
			$replies[$i] = $row['id'];
			$i ++;
		}
		mysql_close($link);
		return $replies;		
	}

	function getComments($num)
	{
		$link = connectDB();
		$query = sprintf("SELECT * FROM comments WHERE Postid='%s'",
		mysql_real_escape_string($num));
		$result = mysql_query($query) or die(mysql_error());
		$i = 0;
		$comments = array();
		while($row = mysql_fetch_array($result))
		{
			$comments[$i] = $row;
			if ($comments[$i]['Score'] == NULL)
				$comments[$i]['Score'] = 0;
			$i ++;
		}
		mysql_close($link);
		return $comments;
	}	
	
	function getUser($uid)
	{
		$link = connectDB();
		$query = sprintf("SELECT * FROM users WHERE Id='%s'",
		mysql_real_escape_string($uid));
		$result = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_array($result);
		mysql_close($link);
		return $row;
	}

?>
