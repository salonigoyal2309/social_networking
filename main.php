<!DOCTYPE html>
<html>
    <head>
        <title>GUFTAGOO</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-responsive.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>

            body{
                overflow-x: hidden; 
                background-color: #e6ffff;
            }

            #tog{
                border: 1px solid white;
            }

            #home_image{
                border: 1px solid #e6ffff;
                border-radius:5px;
            }

            #about{
                transition: all 1s;
            }

        </style>
    </head>
    <body>
        <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-info">
            <div class="container">
                <a class="navbar-brand" href="#">
                <i class="fa fa-pencil" style="color:white;font-size:24px"></i> GUFTAGOO</a>
                <button id="tog" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item"><a class="nav-link" href="Signin.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="signup.php">Sign up</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="container" style="margin-top:150px;">
            <div class="row">
                <div class="col-12 col-md-6">
                    <img src="home.gif" width="500px" height="400px" class="img-fluid"/>
                </div>
                <div class="col-12 col-md-6" style="text-align:center;padding-top:50px;">
                    <h3 id="about">PRESENTING YOU GUFTAGOO</h3>
                    <br>
                    <br>
                    <div id="home_message">
                        <h5>Connect with people worldwide<br>
                        Make friends<br>
                        Save your own poetries<br>
                        Share posts and images<br>
                        ENJOY!<br></h5>
                    </div>
            </div> 
        </div>
        <script>
            let c = ['red' , 'blue' , 'green'];
            let i=0;

            setInterval(function(){
                document.getElementById('about').style.color=c[i];
                i = (i+1)%3;
            }, 1000);

        </script>

    </body>
</html>