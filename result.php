<?php 
	session_start();
	$isBlack = true;
	$isError = false;

	$email = '';
	$fname = '';
	$num_questions = 0;
	$questions = '';

	$answers = array();

	if (isset($_SESSION['email']) && isset($_SESSION['fname']) && isset($_SESSION['num_questions'])) {
		$email = $_SESSION['email'];
		$fname = $_SESSION['fname'];
		$num_questions = $_SESSION['num_questions'];

		for ($i = 1; $i <= $num_questions; $i++) {
			if (isset($_SESSION['ans' . $i])) {
				array_push($answers, $_SESSION['ans' . $i]);
			}
		}

		include('questionList.php');
		$questions = getAllQuestions();
	}

	// the message
	$msg = "<h1>Thank you for taking our relationship quiz";
	if ($fname == '') {
		$msg .= "!</h1><h3>We hope that it provided you with some valuable insight. Here are your results:</h3>";
	} else {
		$msg .= " " . $fname . "!</h1><h3>We hope that it provided you with some valuable insight. Here are your results:</h3>";
	}
	
	// Add Q + A
	if ($num_questions < count($answers)) {
		$isError = true;
	} else {
		for ($i = 0; $i < $num_questions; $i++) {
			$msg = appendToMessage($msg, $questions[$i], $answers[$i], $i);
		}
	}

	// send email
	if ($email == '') {
		$isError = true;
	} else {
		mail($email,"What's Your Biggest Relationship Mistake?",$msg, "From: awesome@logomania.com\r\nContent-type: text/html; charset=iso-8859-1");
	}

	function appendToMessage($message, $question, $answer, $number) {
		$message .= "\n<strong>" . $number . ": " . $question . "</strong>";
		$message .= "\n" . $answer . "<br><br>";
		return $message;
	}
?>
<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Result</title>
	<meta name="description" content="Result">
	<meta name="author" content="Oliver Haynes">

	<link href="https://fonts.googleapis.com/css?family=Dosis:700|PT+Sans|Lato" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/result.css?v=1.0">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
	<div class="result-container">
		<a href="intro.php">
		    <img src="assets/media/<?php if ($isBlack) { echo 'logo-black.png'; } else { echo 'logo.png'; } ?>" height="70" width="auto">
		</a>
		<h2 id="header-gray">Quiz: What's Your Biggest Relationship Mistake?</h2>
		<h1>Thank you! You're all set.</h1>
		<p>
			<?php if ($isError) { echo "Sorry, there was an error sending the email out :(."; } else { echo "Your quiz results and workbook are on their way to your inbox!"; } ?>
		</p>
		<iframe width="560" height="315" src="https://www.youtube.com/embed/Jp9b2Hf7QWg?rel=0&autoplay=1" frameborder="0"></iframe>
	</div>

	<?php $isBlack = false; include('templates/footer.php'); ?>

  <!-- <script src="assets/js/intro.js"></script> -->
</body>
</html>