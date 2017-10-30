<?php
	session_start();
	$isBlack = true;

	if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
		if (!isset($_SESSION['question'])) {
			session_unset();
			$_SESSION['question'] = 1;
			$_SESSION['fname'] = $_POST['firstname'];
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['num_questions'] = 13;
		}
	}

	function calcPercent($normalizer) {
		$current = $_SESSION['question'];
		$total = $_SESSION['num_questions'];
		return round($current / $total * $normalizer);
	}
?>
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Quiz</title>
  <meta name="description" content="Quiz">
  <meta name="author" content="Oliver Haynes">

  <link href="https://fonts.googleapis.com/css?family=Dosis:700|PT+Sans|Lato:400,400i" rel="stylesheet">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="assets/css/quiz.css?v=1.0">

  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>
<body>
	<?php include('templates/header.php'); ?>
	<div id="quiz-content" class="quiz-container">

		<?php include('templates/prog_bar.php'); ?>
		
		<div class="quiz-header">
			<h1>IMPORTANT: PLEASE READ THESE INSTRUCTIONS CAREFULLY:</h1>
		</div>
		<div class="quiz-header-list">
			<ul>
				<li>Think back to a 3-month stretch of time in your life whenever you contemplated your identity.</li><br>
				<li>Answer these questions about your identity DURING THAT TIME PERIOD.</li>
			</ul>
		</div>
		<form class="quiz-form" onsubmit="return validateForm();" method="post" action="process.php">
			<?php
				switch ($_SESSION['question']) {
					case 1:
						include('questions/question1.php');
						break;
					case 2:
						include('questions/question2.php');
						break;
					case 3:
						include('questions/question3.php');
						break;
					case 4:
						include('questions/question4.php');
						break;
					case 5:
						include('questions/question5.php');
						break;
					case 6:
						include('questions/question6.php');
						break;
					case 7:
						include('questions/question7.php');
						break;
					case 8:
						include('questions/question8.php');
						break;
					case 9:
						include('questions/question9.php');
						break;
					case 10:
						include('questions/question10.php');
						break;
					case 11:
						include('questions/question11.php');
						break;
					case 12:
						include('questions/question12.php');
						break;
					case 13:
						include('questions/question13.php');
						break;
					default:
						header('Location: intro.php');
						break;
				}

				$selection = "";
				if(isset($_SESSION['ans' . $_SESSION['question']])) {
					$selection = $_SESSION['ans' . $_SESSION['question']];
					echo 
						'<script>
							var form = document.forms[0];
							var labels = form.getElementsByTagName("label");
							var inputs = form.getElementsByTagName("input");

							var i;
							var isChoice = false;
							for (i = 0; i < labels.length; i++) {
								if (labels[i].innerText.trim() == "' . $selection . '") {
									inputs[i].checked = true;
									isChoice = true;
								}
							}

							if (!isChoice) {
								var textArea = document.getElementById("formTextArea");
								textArea.value = "' . $selection . '";
							}
						</script>';
				}
			?>
			<div id="submit" style="text-align: center;">
				<?php
					$question = $_SESSION['question'];
					if ($question > 1) echo '<input style="opacity:0.4" name="previous" class="btn-next" type="submit" value="PREVIOUS">';
					if ($question < 13) echo '<input name="next" class="btn-next" type="submit" value="NEXT">';
					if ($question == 13) echo '<input name="score" class="btn-next" type="submit" value="GET YOUR SCORE!">';
				?>
			</div>
		</form>
	</div>

	<?php include('templates/footer.php'); ?>

  <script src="assets/js/quiz.js"></script>
</body>
</html>