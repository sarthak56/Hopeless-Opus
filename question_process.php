<?php
	include("session.php");
	include("config.php");
	var_dump($_SESSION);
	$uid=$_SESSION["regno"];
	$qno=$_SESSION["qcount"];
	$status_query="SELECT ststatus,score FROM login WHERE regno='$uid'";
	$status_result=mysqli_query($conn,$status_query);
	$status_row=mysqli_fetch_assoc($status_result);
	$answer=mysqli_real_escape_string($conn,$_POST['ans']);
	$state=$status_row["ststatus"];
	$answer_query="SELECT * FROM answers WHERE pid='$state' AND sid='$qno' AND answer='$answer'";
	$answer_result=mysqli_query($conn,$answer_query);
	$answer_row=mysqli_fetch_assoc($answer_result);
	$number=mysqli_num_rows($answer_result);
	$score=$status_row['score'];
	if($number==1)
	{
		if($qno==$_SESSION['limit']) {
			switch ($_SESSION['limit']) {
				case '1':
					$scoreinc=8;
					break;

				case '2':
					$scoreinc=5;
					break;

				case '3':
					$scoreinc=3;
					break;
				
				}
			$state=$state+1;
			$score=$scoreinc+$score;
			$update_query="UPDATE login SET ststatus='$state',score='$score' where regno='$uid'";
			$update_result=mysqli_query($conn,$update_query);
			unset($_SESSION['limit']);
			unset($_SESSION['qcount']);
			header("Location: story.php");
		}
		else {
			$_SESSION['qcount']=$qno+1;
			header("Location: question.php");
		}
	}
	else
	{
		header("Location: question.php?ans=0");
	}
?>