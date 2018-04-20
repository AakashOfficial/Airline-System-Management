.<!DOCTYPE html>
<?php
	ob_start();
	session_start();
?>
<html>
<head>
	<title>Inbox</title>
	<style>
        
    </style>
</head>
<body>
	

	<?php
		include("header.php");
		require "jhotika_db_connection.php";
	?>
	
	
	<div id="page_heading" >
        <h2>Inbox</h2>
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
		$query="
			select * from mails where to_id='".$_SESSION['user']."' and from_id not in (select spam_id from spam where user_id='".$_SESSION['user']."')
		";
		$inbox_result=mysql_query($query);
		

		echo "<table id='inbox_table'>
			<tr>
				<th>From</th>
				<th>Subject</th>
				<th>Date</th>
				<th>Time</th>
			</tr>
			";

		while ( $inbox_row=mysql_fetch_assoc($inbox_result) )  {
			$serial_no = $inbox_row[ 'serial_no' ];
			$read_status = $inbox_row['read_status'];
			echo "
				<tr>
					<td>".$inbox_row[ 'from_id' ]."</td>";
					if($read_status)
						echo"<td><a href='view_mail.php?serial_no=".$serial_no."&ref=1' ><i>".$inbox_row[ 'subject' ]."</i></a></td>";
					else
						echo"<td><a href='view_mail.php?serial_no=".$serial_no."&ref=1' >".$inbox_row[ 'subject' ]."</a></td>";
			echo 
				"<td>".$inbox_row[ 'mail_date' ]."</td>
					<td>".$inbox_row[ 'mail_time' ]."</td>
				</tr>
				";
				}
	?>



	</div>
	  
            
</body>
</html>