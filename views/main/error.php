<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ошибка <?= $code ?></title>

	<!-- Styles -->
    <link href="/css/common.css" rel="stylesheet">
    
    <!-- Favicon  -->
    <link rel="icon" href="/images/favicon.png">
</head>
<body>
	<center>
		<div style="padding: 50px 0 0 0;">
			<div>
				<img onclick="window.location = '/';" class="copy-effect" style="width: 15rem;" alt="brand-logo" src="/images/logo.png">
				<h1 class="display-1 mt-3"><?= $code ?></h1>
			</div>
			<p class="display-4"><?= $message ?></p>
			<a href="#" onclick="goBack()">Назад</a>
		</div>
	</center>
	<style type="text/css">
		* {
			font-weight: 200;
			font-family: monospace, sans-serif;
			text-decoration: none;
			font-size: 1.3rem;
		}
		body {
			background: #D9EEDD;
		}
		a {
			transition: .3s;
			display: block;
			text-align: center;
		}
		a:hover {
			transform: scale(0.7);
		}
		h1 {
			font-family: fantasy;
			color: #414649;
		}
	</style>
	<button onclick="topFunction()" id="myBtn">
        <img src="/images/up-arrow.png" alt="alternative">
    </button>
</body>
</html>