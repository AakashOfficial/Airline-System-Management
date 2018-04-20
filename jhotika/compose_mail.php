.<!DOCTYPE html>
<?php
	ob_start();
	session_start();
?>
<html>
<head>
	<title></title>
	<style >
		textarea{
			width: 95%;
    		height: 250px;
    		border-radius: 10px;
            border-style: solid;
            border-color: rgb(93,49,46);
		}
	</style>
</head>
<body>
	<?php
		include("header.php");
		require "jhotika_db_connection.php";
	?>
	
	
	<div id="page_heading" >
        <h2>Compose Message</h2>
	<?php
		if( isset($_SESSION['user']) ) {
			$query="
				select first_name from users where user_id='".$_SESSION['user']."'
			";
			$result=mysql_query($query);
			$row=mysql_fetch_assoc($result);
			echo "<p id='intro'>Hello ".$row['first_name']."</p>";
		} else {
			header('location: index.php');
		}
        
        ?>
    
	
        </div>
    <div id="main_section">

	<?php
		$serial_no=$_GET['serial_no'];
		$row="";
		if($serial_no>0){
			$query="
				select * from mails where serial_no='".$serial_no."'
			";
			$r=mysql_query($query);
			$row=mysql_fetch_assoc($r);
		}
	?>
	<form method="POST">
		To     :<input type="text" name="to"></input> @ jhotika.com <br><br>
		Subject :<input type="text" name="subject" value="<?php if($serial_no>0) { echo $row['subject']; }
				else{echo isset($_POST['subject'])?$_POST['subject']:"";}?>"></input><br><br>
		Message:<br>
		<textarea name="message"><?php 
				if($serial_no>0) { echo $row['mail_text']; }
				else{echo isset($_POST['message'])?$_POST['message']:"";}?>
				</textarea><br><br>
		<input type="submit" name="draft"  id="okay" value="Save as Draft"></input>
		<input type="submit" name="send"  id="okay" value="Send"></input>
	</form>

	<?php
		if(isset($_POST['send']))
		{
			$send_to='';
			if(isset($_POST['send']))
			{
				$send_to=htmlentities($_POST['to']);
				if(empty($send_to))
				{
					echo '<p class="warning" >&#10008;Please specify recipient!</p>';
				}
				else
				{
					$subject=$_POST['subject'];
					$mail_text=$_POST['message'];
					$from_mail=$_SESSION['user'];
					$date=date("y-m-d");
					$time=date("h:i:sa");
					$query = "

            		INSERT INTO mails (from_id, to_id, subject, mail_date, mail_time, mail_text)
            			VALUES ('".$from_mail."', '".$send_to."', '".$subject."', '".$date."', '".$time."', '".$mail_text."')
          			";

          			mysql_query($query);
                    
                    header("Location: inbox.php");
				}
			}
		}

		if(isset($_POST['draft']))
		{
			$subject=$_POST['subject'];
			$mail_text=$_POST['message'];
			$from_mail=$_SESSION['user'];
			$date=date("y-m-d");
			$time=date("h:i:sa");
			
			if($serial_no==0){
			$query = "
            	INSERT INTO mails (from_id, to_id, subject, mail_date, mail_time, mail_text)
           		VALUES ('".$from_mail."', , '".$subject."', '".$date."', '".$time."', '".$mail_text."')
          	";

          	mysql_query($query);
                header("Location: inbox.php");
         	}
          else{
          	$query ="
          		Update mails SET mail_text='".$mail_text."', subject='".$subject."' where serial_no='".$serial_no."'
          	";
          	mysql_query($query);
              header("Location: inbox.php");
     		}
		}
	?>
	</div>
            
</body>
</html>