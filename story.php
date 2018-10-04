<?php
  include("session.php");
  var_dump($_SESSION);
  $uid=$_SESSION['regno'];
  $status_query="SELECT ststatus from login where regno='$uid'";
  $status_result=mysqli_query($conn,$status_query);
  $status_row=mysqli_fetch_assoc($status_result);

  $state=$status_row['ststatus'];
  $story_query="SELECT story,choice1,choice2,choice3 from story_question where id='$state'";
  $story_result=mysqli_query($conn,$story_query);
  $story_row=mysqli_fetch_assoc($story_result);
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <title>Hopeless Opus-ACUMEN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="story.css">
    
</head>

<body>
<div class="nav navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">HOPELESS OPUS</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
<div class="collapse navbar-collapse" id="collapsibleNavbar" style="float:right;">
      <ul class="nav navbar-nav navbar-left">
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#Modalrules" >RULES</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#Modalleaderboard" >LEADERBOARD</a>
      </li>
      </ul>
       <ul class="nav navbar-nav navbar-right">
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-toggle="modal" data-target="#Modallogout" >LOGOUT</a>
      </li> 
    </ul>
</div>
</div>
<div id="Modalrules" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header text-center">
           
              <h3 class="modal-title">Rules</h3>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            
          </div>
          <div class="modal-body">
          </div>
        </div>
      </div>
</div>
<div id="Modallogout" class="modal fade" role="dialog" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h3 class="modal-title">Do you really want to leave this page?</h3>
            <br />
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left logy" >Yes</button>
            <button type="button" class="btn btn-default pull-right logn" data-dismiss="modal">No</button>
          </div>
        </div>
      </div>
</div>  
<div id="Modalleaderboard" class="modal fade" role="dialog"  data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h3 class="modal-title">Leaderboard</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <br>
          </div>
          <div class="modal-body">
            <center>
                    <br />
                    <br />
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered table-condensed">
                        <thead>
                          <tr>
                            <td>RANK</td>
                            <td>USER ID</td>
                            <td>SCORE</td>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $rank=1;
                            $leader_query="SELECT name,regno,score FROM login ORDER BY SCORE DESC,timelast ASC";
                            $leader_result=mysqli_query($conn,$leader_query);
                            $leader_count=mysqli_num_rows($leader_result);
                            while($leader_count>0)
                            {
                              $leader_row=mysqli_fetch_assoc($leader_result);
                              echo "<tr>";
                              echo "<td>{$rank}</td>";
                              echo "<td>{$leader_row['regno']}</td>";
                                echo "<td>{$leader_row['score']}</td>";
                              echo "</tr>";
                              $rank++;
                              if($rank==6)
                                break;
                              $leader_count-=1;
                            }
                            
                          ?>
                        </tbody>
                      </table>
                    </div>  
                  </center>
          </div>
        </div>
      </div>
</div>
<div id="story">
    <div id="particles-js"></div>
    <div class=container>
        <div class="row container-fluid">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding">
                    <div class="box">
                           <p style="text-align:center; font-size: 20px; color: white;" id="margin_given"> <?php echo $story_row['story']; ?></p>
                    </div>
                </div>
        </div>
    </div>
</div>
<div id="options">
    <div class=container>
        <div class="row row2">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="box">
                        <a href="story_process.php?choice=1" style="z-index:1000; color:white; text-decoration:none;"><p style="font-size: 18px;"><?php echo $story_row['choice1']; ?></p></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="box">
                        <a href="story_process.php?choice=2" style="z-index:1000; color:white; text-decoration:none;"><p style="font-size: 18px;"><?php echo $story_row['choice2']; ?></p></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="box">
                          <a href="story_process.php?choice=3" style="z-index:1000; color:white; text-decoration:none;"><p style="font-size: 18px;"><?php echo $story_row['choice3']; ?></p></a>
                    </div>
                </div>
        </div>
    </div>
</div>
</body>
</html>

<!--##############-->


    <!-- particles.js container --> 

<!-- particles.js lib - https://github.com/VincentGarreau/particles.js --> 
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <style>
        body {
  margin: 0;
  background-color: #17182f;
            overflow: hidden;
}

canvas {
  display: block;
  vertical-align: bottom;
}


/* ---- particles.js container ---- */

#particles-js {
  position: absolute;
  width: 100%;
  height: 100%;
}
h1{
 color:white;
  text-align:center;
}
    #margin_given{
    margin-left:40%;
}
@media screen and (max-width: 700px){
    #margin_given{
        margin-left:0%;}
}
    </style>

    <script>
        particlesJS("particles-js", {
            "particles": {
                "number": {
                    "value": 555,
                    "density": {
                        "enable": true,
                        "value_area": 789.1476416322727
                    }
                },
                "color": {
                    "value": "#ffffff"
                },
                "shape": {
                    "type": "circle",
                    "stroke": {
                        "width": 0,
                        "color": "#000fff"
                    },
                    "polygon": {
                        "nb_sides": 10
                    },
                    "image": {
                        "src": "img/github.svg",
                        "width": 20,
                        "height": 10
                    }
                },
                "opacity": {
                    "value": 0.48927153781200905,
                    "random": false,
                    "anim": {
                        "enable": true,
                        "speed": 2,
                        "opacity_min": 0,
                        "sync": false
                    }
                },
                "size": {
                    "value": 2,
                    "random": true,
                    "anim": {
                        "enable": true,
                        "speed": 8,
                        "size_min": 0,
                        "sync": false
                    }
                },
                "line_linked": {
                    "enable": false,
                    "distance": 150,
                    "color": "#ffffff",
                    "opacity": 0.4,
                    "width": 1
                },
                "move": {
                    "enable": true,
                    "speed": 1.2,
                    "direction": "none",
                    "random": true,
                    "straight": false,
                    "out_mode": "out",
                    "bounce": false,
                    "attract": {
                        "enable": false,
                        "rotateX": 900,
                        "rotateY": 1200
                    }
                }
            },
            "interactivity": {
                "detect_on": "canvas",
                "events": {
                    "onhover": {
                        "enable": true,
                        "mode": "bubble"
                    },
                    "onclick": {
                        "enable": true,
                        "mode": "push"
                    },
                    "resize": true
                },
                "modes": {
                    "grab": {
                        "distance": 400,
                        "line_linked": {
                            "opacity": 1
                        }
                    },
                    "bubble": {
                        "distance": 83.91608391608392,
                        "size": 5,
                        "duration": 3,
                        "opacity": 1,
                        "speed": 3
                    },
                    "repulse": {
                        "distance": 200,
                        "duration": 0.4
                    },
                    "push": {
                        "particles_nb": 4
                    },
                    "remove": {
                        "particles_nb": 2
                    }
                }
            },
            "retina_detect": true
        });
    </script>

