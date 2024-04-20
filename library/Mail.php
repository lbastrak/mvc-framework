<?php

namespace library;

Class Mail {

	public static function Send($to, $subject, $message, $from = "") {

		if($from == '')
			$from = 'support@'.$_SERVER['SERVER_NAME'];

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf8' . "\r\n";
		$headers .= 'From: '.$from."\r\n".
		    'Reply-To: '.$from."\r\n" .
		    'X-Mailer: PHP/' . phpversion();
	 
		$message = Mail::create_template($message);
	 
		if(!mail($to, $subject, $message, $headers))
		    return false;
		return true;
	}

	public static function create_template($message) {

		ob_start();
		?>
			<!DOCTYPE html>
			<html lang="ru">
			<head>
				<meta charset="utf8">
				<title><?= $_SERVER['SERVER_NAME'] ?></title>
			</head>
			<body>
				<div style="color: white;background: #002a3b;
					    padding: 20px 0 20px 0;
					    font-family: monospace;">
					<h3 style="text-align: center;"><?= $_SERVER['SERVER_NAME'] ?></h3>
					<section style="background: #fff;
					color: black;
					    width: 83%;
					    padding: 3px;
					    margin: 0 auto;">
						<div style="
						font-size: 12px;
						padding: 3px;">
							<?= $message ?>
						</div>
					</section>
					<a href="http://<?= $_SERVER['SERVER_NAME'] ?>" style="display: block;
						color: white;
						width: 100%;
						text-align: center;
						font-size: 25px;">www.<?= $_SERVER['SERVER_NAME'] ?></a>
				</div>
			</body>
			</html>
			<?
		return ob_get_clean();
	}
}