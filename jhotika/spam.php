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
        <h2>Spam</h2>
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
			select * from mails where to_id='".$_SESSION['user']."' and from_id in (select spam_id from spam where user_id='".$_SESSION['user']."')
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
			$text_no = $inbox_result[ 'serial_no' ];
			echo "
				<tr>
					<td>".$inbox_row[ 'from_id' ]."</td>
					<td><a href='view_mail.php?serial_no=".$text_no."&ref=3' >".$inbox_row[ 'subject' ]."</a></td>
					<td>".$inbox_row[ 'mail_date' ]."</td>
					<td>".$inbox_row[ 'mail_time' ]."</td>
				</tr>
				";
				}
	?>
	 </div>
            
</body>
</html>