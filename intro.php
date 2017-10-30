<?php 
  session_start();

  $isBlack = false;
  if (isset($_SESSION['question'])) {
    unset($_SESSION['question']);
  }
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Welcome</title>
  <meta name="description" content="Welcome">
  <meta name="author" content="Oliver Haynes">

  <link href="https://fonts.googleapis.com/css?family=Dosis:700|PT+Sans|Lato" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/intro.css?v=1.0">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body id="intro">
	<div class="banner">
		<h1>What's Your Biggest Relationship Mistake?</h1>
		<h3>Learn about what relationships mistakes you may or may not be making! Gain valuable insight into the quality of your relationship.</h3>
		<button onclick="displayOverlay();">TAKE THE QUIZ NOW!</button>
	</div>

	<div id="prompt-container" style="display: none; position: absolute; top: 0; left: 0; right: 0; bottom: 0;">
		<!-- Dynamic Javascript lives here. -->
	</div>

	<?php include('templates/footer.php'); ?>

  <script src="assets/js/intro.js"></script>
</body>
</html>