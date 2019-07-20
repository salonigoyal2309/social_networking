<!DOCTYPE html>
<html>
    <head>
        <title>Sign up</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="signup.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-responsive.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>

            #main{
                margin-left:20vw;
                margin-right:20vw;
                margin-top:70px;
                margin-bottom:100px;
                padding-top:50px;
                padding-bottom:50px;
                padding-left:100px;
                padding-right:100px;
                border:1px solid black;

            }

            @media(max-width:900px){
                #main{
                    margin-left:10vw;
                    margin-right:10vw;
                    padding-left:10vw;
                    padding-right:10vw;
                }
                h3{
                    font-size:20px;
                }
            }

            #message {
                display:none;
                background: #e6ffff;
                color: #111;
                position: relative;
                padding: 20px;
                margin-top: 10px;
            }

            #present{
                display:none;
                color: red;
                position: relative;
                margin-top: 5px; 
            }

            #available{
                display:none;
                color: green;
                position: relative;
                margin-top: 5px; 
            }

            .valid{
                color:green;
            }

            .valid:before{
                position:relative;
                content: "✔";
                left:-10px;
            }

            .invalid{
                color:red;
            }

            .invalid:before{
                position:relative;
                content:"✖";
                left:-10px;
            }

        </style>
        
    </head>

    <body>

        <nav class="navbar fixed-top navbar-expand-md navbar-dark bg-info">
            <div class="container">
                <a class="navbar-brand" href="main.php">
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

        <div id="main">
        
        <div class="row bg-info" style="height:55px;padding-top:10px" id="main2">
            <div class="col-12 col-md-12">
                <div class="main-content">
                    <div class="header" style="top:5px;">
                        <h3 style="text-align:center;"><strong>JOIN GUFTAGOO</strong></h3>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <?php // form ?>
        
        <form action="" method="POST">
            <div class="form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-user"></i>
                    </span>
                    <input required type="text" class="form-control" placeholder="User Name" id="user_name" name="user_name" onblur="checkAvailability()">
                </div>
                <div>
                    <p id="present">* Already present *</p>
                    <p id="available">* Username Available *</p>
                </div>
                <script>

                    function checkAvailability() {
                       // alert($("#user_name").val());
                        jQuery.ajax({
                        url: "check_availability.php",
                        data:'username='+$("#user_name").val(),
                        type: "POST",
                        success:function(data){
                        //alert(data);
                        if(data=="not_taken"){
                            $("#present").css('display','none');
                            $("#available").css('display','block');
                            document.getElementById("sign_up").disabled=false;
                        }
                        else if(data=="taken"){
                            $("#present").css('display','block');
                            $("#available").css('display','none');
                            document.getElementById("sign_up").disabled=true;
                        }
                        }
                        })
                }
                </script>
            </div>
            <div class="form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-user"></i>
                    </span>
                    <input required type="text" class="form-control" placeholder="First name" name="first_name">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-user"></i>
                    </span>
                    <input type="text" class="form-control" placeholder="Last name" name="last_name">
                </div>
            </div> 
            <div class="form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-key"></i>
                    </span>
                    <input required type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                     title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                     class="form-control" placeholder="Password" name="password" id="password">
                </div>

                <div id="message">
                    <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                    <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
                    <p id="number" class="invalid">A <b>number</b></p>
                    <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                </div>

                <script>
                    var myInput = document.getElementById("password");
                    var letter = document.getElementById("letter");
                    var capital = document.getElementById("capital");
                    var number = document.getElementById("number");
                    var length = document.getElementById("length");

                // When the user clicks on the password field, show the message box
                    myInput.onfocus = function() {
                    document.getElementById("message").style.display = "block";
                }
                // When the user clicks outside of the password field, hide the message box
                    myInput.onblur = function() {
                        document.getElementById("message").style.display = "none";
                }

                myInput.onkeyup = function() {
                // Validate lowercase letters
                var lowerCaseLetters = /[a-z]/g;
                if(myInput.value.match(lowerCaseLetters)) {  
                    letter.classList.remove("invalid");
                    letter.classList.add("valid");
                } else {
                    letter.classList.remove("valid");
                    letter.classList.add("invalid");
                }
  
                // Validate capital letters
                var upperCaseLetters = /[A-Z]/g;
                if(myInput.value.match(upperCaseLetters)) {  
                    capital.classList.remove("invalid");
                    capital.classList.add("valid");
                } else {
                    capital.classList.remove("valid");
                    capital.classList.add("invalid");
                }

                // Validate numbers
                var numbers = /[0-9]/g;
                if(myInput.value.match(numbers)) {  
                     number.classList.remove("invalid");
                    number.classList.add("valid");
                } else {
                    number.classList.remove("valid");
                    number.classList.add("invalid");
                }
  
                // Validate length
                if(myInput.value.length >= 8) {
                    length.classList.remove("invalid");
                    length.classList.add("valid");
                } else {
                    length.classList.remove("valid");
                    length.classList.add("invalid");
                }
            }
                </script>

            </div> 
            <div class="form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-envelope"></i>
                    </span>
                    <input required type="email" class="form-control" placeholder="Email" name="email">
                </div>
            </div> 
            <div class="form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-chevron-down"></i>
                    </span>
                    <select required style="width:100%" name="country">
                        <option value="" disabled selected>Select Country</option>
                        <option value='Ascension Island'>Ascension Island</option>
                        <option value='Andorra'>Andorra</option>
                        <option value='United Arab Emirates'>United Arab Emirates</option>
                        <option value='Afghanistan'>Afghanistan</option>
                        <option value='Antigua And Barbuda'>Antigua And Barbuda</option>
                        <option value='Anguilla'>Anguilla</option>
                        <option value='Albania'>Albania</option>
                        <option value='Armenia'>Armenia</option>
                        <option value='Angola'>Angola</option>
                        <option value='Antarctica'>Antarctica</option>
                        <option value='Argentina'>Argentina</option>
                        <option value='American Samoa'>American Samoa</option>
                        <option value='Austria'>Austria</option>
                        <option value='Australia'>Australia</option>
                        <option value='Aruba'>Aruba</option>
                        <option value='Åland Islands'>Åland Islands</option>
                        <option value='Azerbaijan'>Azerbaijan</option>
                        <option value='Bosnia & Herzegovina'>Bosnia & Herzegovina</option>
                        <option value='Barbados'>Barbados</option>
                        <option value='Bangladesh'>Bangladesh</option>
                        <option value='Belgium'>Belgium</option>
                        <option value='Burkina Faso'>Burkina Faso</option>
                        <option value='Bulgaria'>Bulgaria</option>
                        <option value='Bahrain'>Bahrain</option>
                        <option value='Burundi'>Burundi</option>
                        <option value='Benin'>Benin</option>
                        <option value='Saint Barthélemy'>Saint Barthélemy</option>
                        <option value='Bermuda'>Bermuda</option>
                        <option value='Brunei Darussalam'>Brunei Darussalam</option>
                        <option value='Bolivia, Plurinational State Of'>Bolivia, Plurinational State Of</option>
                        <option value='Bonaire, Saint Eustatius And Saba'>Bonaire, Saint Eustatius And Saba</option>
                        <option value='Brazil'>Brazil</option>
                        <option value='Bahamas'>Bahamas</option>
                        <option value='Bhutan'>Bhutan</option>
                        <option value='Bouvet Island'>Bouvet Island</option>
                        <option value='Botswana'>Botswana</option>
                        <option value='Belarus'>Belarus</option>
                        <option value='Belize'>Belize</option>
                        <option value='Canada'>Canada</option>
                        <option value='Cocos (Keeling) Islands'>Cocos (Keeling) Islands</option>
                        <option value='Democratic Republic Of Congo'>Democratic Republic Of Congo</option>
                        <option value='Central African Republic'>Central African Republic</option>
                        <option value='Republic Of Congo'>Republic Of Congo</option>
                        <option value='Switzerland'>Switzerland</option>
                        <option value='Cote d'Ivoire'>Cote d'Ivoire</option>
                        <option value='Cook Islands'>Cook Islands</option>
                        <option value='Chile'>Chile</option>
                        <option value='Cameroon'>Cameroon</option>
                        <option value='China'>China</option>
                        <option value='Colombia'>Colombia</option>
                        <option value='Clipperton Island'>Clipperton Island</option>
                        <option value='Costa Rica'>Costa Rica</option>
                        <option value='Cuba'>Cuba</option>
                        <option value='Cabo Verde'>Cabo Verde</option>
                        <option value='Curacao'>Curacao</option>
                        <option value='Christmas Island'>Christmas Island</option>
                        <option value='Cyprus'>Cyprus</option>
                        <option value='Czech Republic'>Czech Republic</option>
                        <option value='Germany'>Germany</option>
                        <option value='Diego Garcia'>Diego Garcia</option>
                        <option value='Djibouti'>Djibouti</option>
                        <option value='Denmark'>Denmark</option>
                        <option value='Dominica'>Dominica</option>
                        <option value='Dominican Republic'>Dominican Republic</option>
                        <option value='Algeria'>Algeria</option>
                        <option value='Ceuta, Mulilla'>Ceuta, Mulilla</option>
                        <option value='Ecuador'>Ecuador</option>
                        <option value='Estonia'>Estonia</option>
                        <option value='Egypt'>Egypt</option>
                        <option value='Western Sahara'>Western Sahara</option>
                        <option value='Eritrea'>Eritrea</option>
                        <option value='Spain'>Spain</option>
                        <option value='Ethiopia'>Ethiopia</option>
                        <option value='European Union'>European Union</option>
                        <option value='Finland'>Finland</option>
                        <option value='Fiji'>Fiji</option>
                        <option value='Falkland Islands'>Falkland Islands</option>
                        <option value='Micronesia, Federated States Of'>Micronesia, Federated States Of</option>
                        <option value='Faroe Islands'>Faroe Islands</option>
                        <option value='France'>France</option>
                        <option value='France, Metropolitan'>France, Metropolitan</option>
                        <option value='Gabon'>Gabon</option>
                        <option value='United Kingdom'>United Kingdom</option>
                        <option value='Grenada'>Grenada</option>
                        <option value='Georgia'>Georgia</option>
                        <option value='French Guiana'>French Guiana</option>
                        <option value='Guernsey'>Guernsey</option>
                        <option value='Ghana'>Ghana</option>
                        <option value='Gibraltar'>Gibraltar</option>
                        <option value='Greenland'>Greenland</option>
                        <option value='Gambia'>Gambia</option>
                        <option value='Guinea'>Guinea</option>
                        <option value='Guadeloupe'>Guadeloupe</option>
                        <option value='Equatorial Guinea'>Equatorial Guinea</option>
                        <option value='India'>India</option>
                    </select>
                </div>
            </div> 
            <div class="form-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-chevron-down"></i>
                    </span>
                    <select required name="gender" style="width:100%">
                        <option selected disabled value="">Select gender</option>
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div> 
            <div class="form-group">
                <div class="input-group-prepend md-form">
                    <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                    </span>
                    <input required type="date" class="form-control datepicker" placeholder="Select birthdate" name="birthdate">
                </div>
            </div> 
            <a href="Signin.php" title="Signin" class="text-info" style="text-decoration:none;float:right;">Already have an account?</a>
            <br><br>
            <center><button class="btn btn-info" type="submit" id="sign_up" name="sign_up">Sign up</button><center>
            <?php
            include('insert_user.php');
            ?>
        </form>
        </div>
    </body>
</html>