<html>
<?php
	ob_start();
	session_start();
?>
<head>
	<title>Sign Up!</title>
	
	<style>
		body {
			background-image: url("img/site/common/tile.jpg");
			margin: 0;
			padding: 0;
		}

		#sign_up_form {
			margin: 0 auto; /*to float in center*/
			margin-top: 60px;
      margin-bottom: 60px;
			padding: 30px;
			
			border-radius: 10px;
            border-style: solid;
            border-color: rgb(255,154,104);

            width: 650px;
            /*height: 500px;*/

            background-color: white;

            color: rgb(255,154,104);
			font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
		}

    .warning {
                margin: 0;
                padding: 0;
                font-size: 15px;
                font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
                color: red; 
                display: inline;  
            }
    .alright {
                margin: 0;
                padding: 0;
                font-size: 15px;
                font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
                color: green;   
                display: inline;
            }

		h1 {
			color: rgb(255,154,104);
			font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
		}

		h3 {
			color: rgb(255,154,104);
			font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
		}

		input[type=text]{
                border-radius: 10px;
                border-style: solid;
                border-color: rgb(255,154,104);
                color: rgb(171,171,171);
                font-style: italic;
                padding:8px;

                width: 200px;
         }

    input[type=password]{
                border-radius: 10px;
                border-style: solid;
                border-color: rgb(255,154,104);
                color: rgb(171,171,171);
                font-style: italic;
                padding:8px;

                width: 200px;
         }

         input[type=submit]{
                width: 84px;
                margin-top: 30px;
                border: none;
                border-radius: 10px;
                background-color: rgb(255,154,104);
                color: white;
                text-decoration-color: black;
                padding: 15px;
                cursor: pointer;
            }

            input[type=submit]:hover{
                width: 84px;
                margin-top: 30px;
                border: none;
                border-radius: 10px;
                background-color: rgb(255,154,104);
                color: white;
                text-decoration-color: black;
                padding: 15px;
                cursor: pointer;
            } 
    
    /* Pulse effect */
    @-webkit-keyframes pulse {
  	 25% {
      -webkit-transform: scale(1.2);
      transform: scale(1.2);
      }
      75% {
      -webkit-transform: scale(0.8);
      transform: scale(0.8);
      }
    }
    @keyframes pulse {
      25% {
     -webkit-transform: scale(1.2);
     -ms-transform: scale(1.2);
     transform: scale(1.2);
     }
    75% {
    -webkit-transform: scale(0.8);
    -ms-transform: scale(0.8);
    transform: scale(0.8);
    }
  }
.pulse {
  display: inline-block;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
  box-shadow: 0 0 1px rgba(0, 0, 0, 0);
}
.pulse:hover {
  -webkit-animation-name: pulse;
  animation-name: pulse;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-timing-function: linear;
  animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
}             

	</style>
</head>

<body>
	<!-- Sign up form -->
	<div id="sign_up_form" >
  <form name="form_sign_up" method="POST" action="sign_up.php" >

		<h1>Sign up @ Jhotika Barta</h1>
		<h3>&#10004; It's free and always will be!</h3>
		<br><br><br>

    <?php
      ob_start();
      // database connection
      require 'jhotika_db_connection.php';
    ?>

		Your name: <br>
		<input type="text" name="first_name" placeholder="first name" required >
		<input type="text" name="last_name" placeholder="last name" required >
    <?php
      // checking if first name is entered
      $input_first_name = '';
      $input_last_name = '';
      if( isset($_POST['sign_up_button']) ) {
        $input_first_name = htmlentities($_POST['first_name']);
        $input_last_name = htmlentities($_POST['last_name']);

        if( empty($input_first_name) ) {
         echo '<p class="warning" >&#10008; First name required!</p>';  
        } else {
          echo '<p class="alright" >&#10004; </p>';  
        }
      }
    ?>
    <br>

		<br>

		Choose your user id: <br>
		<input type="text" name="user_id" placeholder="example" required > @ jhotika.com
    <?php
      $input_user_id = '';
      $user_id_taken = 0;
      if( isset($_POST['sign_up_button']) ) {
        $input_user_id = htmlentities($_POST[ 'user_id' ]);
        if( !empty($input_user_id) ) {
          //checking if user id is available
          // query
          $users_query_username="select * from users where user_id='".$input_user_id."'";
          $result_table = mysql_query($users_query_username);
          // checking if table has a row
          if( $row=mysql_fetch_assoc($result_table) ) {
            $user_id_taken = 1;
            echo '<p class="warning" >&#10008; User id already taken!</p>';    
          } else {
            echo '<p class="alright" >&#10004;</p>';  
          }
        } else {
          echo '<p class="warning" >&#10008; User id required!</p>';  
        }
      }
    ?>
    <br>

		<br>

    Enter your password: <br>
    <input type="password" name="password" placeholder="password" required ><br>
    <input style="margin-top:5px;" type="password" name="confirm_password" placeholder="confirm password" required >
    <?php
      $input_user_pass = '';
      $input_user_pass_confirm = '';
      $pass_dont_match = 0;
      if( isset($_POST['sign_up_button']) ) {
        $input_user_pass = htmlentities($_POST[ 'password' ]);
        $input_user_pass_confirm = htmlentities($_POST[ 'confirm_password' ]);

        if( !empty($input_user_pass) ) {
          if( $input_user_pass==$input_user_pass_confirm ) {
            echo '<p class="alright" >&#10004;</p>';  
          } else {
            echo "<p class='warning' >&#10008; Passwords don't match</p>";  
          }
        } else {
          echo "<p class='warning' >&#10008; Password required!</p>";   
        }
      }
    ?>
    <br>

    <br>

		<input type="checkbox" name="accept_terms"> I accept all the terms and agreements.
    <?php
      $terms_agree = 0;
      if( isset($_POST['sign_up_button']) ) {
        if(isset($_POST['accept_terms'])) {
          $terms_agree = 1;
        } else {
          echo "<p class='warning' >&#10008; Accept terms and conditions!</p>"; 
        }
      }
    ?>
    <br>

		<!-- Submit button at the center of the page -->
		<div style="text-align:center" >
            <form method="post"><input class="pulse" type="submit" name="sign_up_button" value="SIGN UP" ></formform>
      <?php
        if( isset($_POST['sign_up_button']) && $user_id_taken==0 && $pass_dont_match==0 && $terms_agree==1 ) {
          $query = "
            insert into users ( user_id, password, first_name, last_name )
            values ( '".$input_user_id."', '".$input_user_pass."', '".$input_first_name."', '".$input_last_name."' )
          ";
          mysql_query($query);
            $_SESSION['user']=$input_user_id;
          header("location: inbox.php");
        }
      ?>
		</div>

	</form>
  </div>
</body>

</html>