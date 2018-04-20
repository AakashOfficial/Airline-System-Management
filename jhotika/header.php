<?php
    ob_start();

?>

<html>

<head>
	<title>Jhotika Box</title>
	
	<style>
		body {
			background-color: whitesmoke;
		}
        
        #title{
            background-image: url("img/site/common/tile.jpg");
            background-image-width:100%; 
            background-color: whitesmoke;
            border: solid;
            border-width: medium;
            border-color: rgb(255,154,104);
            margin-left: 5px;
            margin-bottom: 5px;
            padding-left: 5px;
            color: rgb(255,154,104);
            height: 15%;
            font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
        }
        span {
            display: inline-block;
            vertical-align: middle;
            line-height: normal;      
        }
        #nav{
            margin-left: 5px;
            background-color: rgb(255,154,104);
            border-color: rgb(255,154,104);
            border-style: solid;
            padding-top: 5px;
            width: 12%;
            height: 113%;
            float: left;
            font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
        }
        
        input[type=submit]{
                width: 150px;
                margin-top: 5px;
                align-content: center;
                border: none;
                background-color:rgb(255,154,104);
                color: white;
                text-decoration-color: black;
                padding: 5px;
            }
        input:hover[type=submit]{
                border-radius: 5px;
                border-style: solid;
                border-color: rgb(255,154,104);
                background-color:white;
                color: rgb(171,171,171);
            }
        #button_a{
            margin-bottom: 30px;
        }
        #main_section{
            padding-top: 10px;
            padding-left: 10px;
            background-color: white;
            border: solid;
            border-width: medium;
            border-color:rgb(255,154,104);
            height: 100%;
            width: 86%;
            float: right;
            font-family: font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
            color:rgb(93,49,46);
            
        }

        .warning {
            margin: 0;
            padding: 0;
            font-size: 15px;
            font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
            color: red; 
            display: inline;  
        }

        #page_heading {
            padding-top: 0px;
            padding-left: 10px;
            background-color: lemonchiffon;
            border: solid;
            border-width: medium;
            border-color:rgb(255,154,104);
            border-bottom: none;
            height: 12%;
            width: 86%;
            float: right;
            font-size: 25px;
            color: rgb(255,154,104);
            font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
        }
        
          #intro{
              
            padding-right: 20px;
            font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
            font-size: 25px;
            color: rgb(255,154,104);
            float: right;
        }
        
        input[type=submit]#log{
                color: darkred;
            }
        
        input[type=submit]#okay{
                width: 150px;
                margin-top: 30px;
                border: none;
                border-radius: 10px;
                background-color: rgb(255,154,104);
                color: white;
                text-decoration-color: black;
                padding: 15px;
            }
       
        table {
                width: 100%;
                height: 60px;
				border-top: 2px solid black;
                border-collapse:collapse;
                border-spacing: 1px solid black;
                text-align: center;
                font-family: font-family: 'Century Gothic', CenturyGothic, AppleGothic, sans-serif;
                color: rgb(93,49,46);
                
			}
            
            table tr{
                border-bottom: 2px solid black;
                background-color: lightgoldenrodyellow;
            }
            table th{
                border-bottom: 2px solid black;
                background-color: lightgrey;
                
            }
        
         input[type=text]{
                border-radius: 10px;
                border-style: solid;
                border-color: rgb(93,49,46);
                color:  rgb(93,49,46);
                font-style: italic;
                padding:8px;
                width: 200px;
                height: 30px;
         }


	</style>
</head>


<body>
	
    <div id="title">
        <img id="hugeLogo" src="img/site/common/logo.png" height="100%" align="right">
        <span><h1>Jhotika Box</h1></span>
    </div>
	
    <div id="nav" >
        <center><form name="form2" method="post">
            <input type="submit" id="button_a" name="compose" value="Compose Mail"><br>
            <?php
                if(isset($_POST['compose']))
                    {
                        header('location: compose_mail.php?serial_no=0');
                    }
            ?>
            <input type="submit" name="inbox" value="Inbox"><br>
            <?php
                if(isset($_POST['inbox']))
                    {
                        header('location: inbox.php');
                    }
            ?>
            <input type="submit" name="draft" value="Draft"><br>
            <?php
                if(isset($_POST['draft']))
                    {
                        header('location: draft.php');
                    }
            ?>
            <input type="submit" name="sent" value="Sent Mail"><br>
            <?php
                if(isset($_POST['sent']))
                    {
                        header('location: sent_mail.php');
                    }
            ?>
            <input type="submit" name="spam" value="Spam"><br><br><br><br><br><br>
            <?php
                if(isset($_POST['spam']))
                    {
                        header('location: spam.php');
                    }
            ?>
          

            </form>
            <form method="POST">
		          <input type="submit" id ="log" name="log_out" value="Log Out"><br>
		          <?php
                if(isset($_POST['log_out']))
                {
                    unset($_SESSION['user']);
                    header('Location: index.php');
                }
         ?>
	   </form>
	
    
        
        </center>

	</div>

</body>

</html>