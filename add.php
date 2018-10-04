<?php
$servername="localhost";
$username="root";
$password="a97tulsani";
$dbname="new_question_hope";


try{
  $conn=mysqli_connect($servername,$username,$password,$dbname);
  if(mysqli_connect_errno($conn)) {
    die("WTF");
  }
  // $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERROR_EXCEPTION);
  // echo "successfull";

  $query="SELECT * FROM quest";
  $res=mysqli_query($conn,$query);
  $row=mysqli_fetch_assoc($res);
  echo "<h1>" . $row['question'] . "</h1>";
}
catch(PDOException $e){
  echo "unsuccessful:".$e->getMessage();
}




//("<h1>Hello World</h1>") ?>

<html>
<body>
  <form action='processing.php' method='POST'>
  <input type=text placeholder='answer' name='answer'></input>
  <button type='submit' name='submit'>SUBMIT</button>
  </form>
</body>
</html>
