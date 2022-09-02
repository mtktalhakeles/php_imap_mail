<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href=
"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css">


</head>

<body>
<h1><span class="blue"></span>In<span class="blue"></span><span class="yellow">Box</pan></h1>


	<div id="dataDivID" class="form-container">
		<?php
			$host = '{outlook.office365.com:993/ssl}INBOX'; //Your host
			$user = 'asdasdasd@outlook.com';//Your mail
			$password = 'xxxxx';//Your password

			
			$conn = imap_open($host, $user, $password)
				or die('unable to connect mail: ' . imap_last_error());

			
			$mails = imap_search($conn, 'UNSEEN'); //for all -> ALL

			
			if ($mails) {

				
				$mailOutput = '';
				$mailOutput.= '<table class="container">
				<thead>
				  <tr>
					<th><h1>Date</h1></th>
					<th><h1>From</h1></th>
					<th><h1>Subject</h1></th>
					<th><h1>Content</h1></th>
				  </tr>
				</thead>
				<tbody>';

				
				rsort($mails);

				foreach ($mails as $email_number) {
	
					$headers = imap_fetch_overview($conn, $email_number, 0);
					$message = imap_fetchbody($conn, $email_number, '1');
					$subMessage = substr($message,0,300);
					$finalMessage = trim(quoted_printable_decode($subMessage));


			$mailOutput.= '<td><span class="columnClass">' .
			$headers[0]->date . '</span></td>';                 
			$mailOutput.= '<td><span class="columnClass">' .
			$headers[0]->from . '</span></td> ';
			$mailOutput.= '<td><span class="columnClass">' . 
			$headers[0]->subject . '</span></td>';
			$mailOutput.= '</div>';
			/* Mail body is returned */
			$mailOutput.= '<td><span class="column">' . 
				$finalMessage . '</span></td></tr></div>';
			
				}// End foreach
				$mailOutput.= '</table>';


				echo $mailOutput;
			}//endif
			/* imap connection is closed */
			imap_close($conn);			
			?>
	</div>
</body>

</html>

