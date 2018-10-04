<?php
$servername="localhost";
$username="root";
$password="a97tulsani";
$dbname="new_question_hope";


session_start();

if(isset($_POST['submit'])){
    // include_once 'dbh.inc.php';
    $answer= mysqli_real_escape_string($conn, $_POST['answer']);

    if(empty($answer)){
        header("Location: ../Quiz/processing.php?answer=empty");
        exit();
    } else{
        $sql = "SELECT * FROM quest WHERE answer='$answer' ";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck < 1){
            header("Location: ../Quiz/processing.php?answer=wrong");
          // echo "wrong";
            exit();
        }else{
            if($row = mysqli_fetch_assoc($result)){
                $hashedAnsCheck= answer_verify($answer, $row['answer']);
                if($hashedAnsCheck == false){
                    header("Location: ../processing.php?answer=wrong");
                  //  echo "wrong";
                    exit();
                }elseif($hashedAnsCheck == true){
                    header("Location: ../Quiz/processing.php?answer=correct");
                    exit();
                }
            }
        }

}
}else{
    header("Location: ../Quiz/add.php?answer=wrong");
  //  echo "Wrong Answer";
    exit();
}
