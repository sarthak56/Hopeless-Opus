<?php
	include("session.php");
	include("config.php");

	$uid=$_SESSION["regno"];
	$status_query="SELECT ststatus FROM login WHERE regno='$uid'";
	$status_result=mysqli_query($conn,$status_query);
	$status_row=mysqli_fetch_assoc($status_result);

	$answer=$_GET["choice"];
	$state=$status_row["ststatus"];

	$option_query="SELECT option_story from story_answer where pid='$state' and sid='$answer'";
	$option_result=mysqli_query($conn,$option_query);
	$option_row=mysqli_fetch_assoc($option_result);
	echo $option_row['option_story'];
	switch ($option_row['option_story']) {
		case 'good':
			$update_query="UPDATE login SET qstatus1=0 where regno='$uid'";
			$_SESSION['limit']=1;
			break;
		
		case 'medium':
			$update_query="UPDATE login SET qstatus2=0 where regno='$uid'";
			$_SESSION['limit']=2;
			break;

		case 'bad':
			$update_query="UPDATE login SET qstatus3=0 where regno='$uid'";
			$_SESSION['limit']=3;
			break;
	}
	$update_result=mysqli_query($conn,$update_query);
	$_SESSION['qcount']=1;
	header("Location: question.php");



	// $answer_query="SELECT id FROM answers WHERE id='$state' AND answer='$answer'";
	// $answer_result=mysqli_query($connection,$answer_query);
	// $answer_row=mysqli_fetch_assoc($answer_result);
	// $number=mysqli_num_rows($answer_result);
	// if($number==1)
	// {
	// 	$state=$state+1;
	// 	$update_query="UPDATE login SET status='$state',timelast='NOW()' WHERE UID='$uid'";
	// 	$update_result=mysqli_query($connection,$update_query);
	// 	$score=$state-1;
	// 	$update_query="UPDATE login SET score='$score' WHERE UID='$uid'";
	// 	$update_result=mysqli_query($connection,$update_query);
	// 	header("Location: question.php?ans=2");
	// }
	// else
	// {
	// 	header("Location: question.php?ans=0");
	// }

?>