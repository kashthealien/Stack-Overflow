<?php
	
	function printPost($row) {
		// Print the post
		echo '<hr>';
		echo $row['Title'];
		if ($row['PostTypeId'] == 1)
			echo ' ('. $row['Tags'] . ') ';
		echo $row['Body'];
		echo ' Score '. $row['Score']. 
		 ' | Viewed '. $row['ViewCount'].' times <br/>';
		printUser($row['OwnerUserId']);
	}
	
	function printComments($comments) {
		//print all the comments comments
		echo '<ul>';
		for ($i = 0 ; $i < count($comments) ; $i ++ ) {
			
			echo '<li>'.$comments[$i]['Text']. 
			  ' | Score '. $comments[$i]['Score'].'<br/>';
			printUser($comments[$i]['UserId']);
			echo '</li>';				
		}
		echo '</ul>'; 
	}

	function printUser($uid) {
		$user = getUser($uid);
		echo $user['DisplayName'].
			' [Reputation '.$user['Reputation'].']'.
			' [Upvotes '.$user['UpVotes'].']' ;
	}
?>
