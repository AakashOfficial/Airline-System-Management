.<!DOCTYPE html>
<?php
	ob_start();
	session_start();
?>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		include("header.php");
		require "jhotika_db_connection.php";
	?>
	
	
	<div id="page_heading" >
        <h2>Your Message</h2>
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
			$ref=$_GET['ref'];
			$serial_no=$_GET['serial_no'];

			if($ref==1)
			{
				$query="
                select * from mails where to_id='".$_SESSION['user']."' and from_id not in (select spam_id from spam where user_id='".$_SESSION['user']."')
            	";
            	$result=mysql_query($query);
            	$row=mysql_fetch_assoc($result);
            	echo"From: ".$row['from_id']."<br>";
            	echo"Date: ".$row['mail_date']."<br>";
            	echo"Time: ".$row['mail_time']."<br>";
            	echo"Subject: ".$row['subject']."<br>";
           		echo"Message: ".$row['mail_text']."<br>";

           		$update="
               		Update mails SET read_status=1 where serial_no='".$serial_no."'
            	";
            	$r=mysql_query($update);
            	
			}

			else if($ref==2)
			{
				$query="
                select * from mails where from_id='".$_SESSION['user']."' and to_id IS NOT NULL
            	";
            	$result=mysql_query($query);
            	$row=mysql_fetch_assoc($result);
            	echo"To: ".$row['to_id']."<br>";
            	echo"Date: ".$row['mail_date']."<br>";
            	echo"Time: ".$row['mail_time']."<br>";
            	echo"Subject: ".$row['subject']."<br>";
           		echo"Message: ".$row['mail_text']."<br>";
            
			}

			else if($ref==3)
			{
				$query="
                select * from mails where to_id='".$_SESSION['user']."' and from_id in (select spam_id from spam where user_id='".$_SESSION['user']."')
            	";
            	$result=mysql_query($query);
            	$row=mysql_fetch_assoc($result);
            	echo"To: ".$row['to_id']."<br>";
            	echo"Date: ".$row['mail_date']."<br>";
            	echo"Time: ".$row['mail_time']."<br>";
            	echo"Subject: ".$row['subject']."<br>";
           		echo"Message: ".$row['mail_text']."<br>";
            
			}
				
            
		?>

		<div>
		<?php
			if($ref==1)
				{
					echo '<form method="POST" >
						<input type="submit" name="to_spam" value="Send to Spam">
						</form>';
					if(isset($_POST['to_spam']))
					{
						$query="
								insert into spam(spam_id,user_id) 
								values('".$row['from_id']."', '".$_SESSION['user']."')
						";
						mysql_query($query);

						header('Location: inbox.php');
					}

				}

			elseif($ref==3)
				{

					echo '<form method="POST">
						<input type="submit" name="to_inbox" value="Send to Inbox">
						</form>';
					if(isset($_POST['to_inbox']))
					{
						$query="
								Delete from spam where  spam_id='".$row['from_id']."' and user_id='".$_SESSION['user']."'
						";
						mysql_query($query);
						header('Location: inbox.php');
					}

				}
		?>
	</div>
	</div>

	

            
</body>
</html>