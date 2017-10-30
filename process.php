<?php
	session_start();

	if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
		if (!empty($_POST['next']) || !empty($_POST['score'])) {
			$_SESSION['ans' . $_SESSION['question']] = $_POST['answer'];
			$_SESSION['question'] += 1;
		} else if (!empty($_POST['previous'])) {
			$_SESSION['ans' . $_SESSION['question']] = $_POST['answer'];
			$_SESSION['question'] -= 1;
		}
	}

	if ($_SESSION['question'] <= 13) {
		header('Location: quiz.php#quiz-content');
	} else {
		header('Location: result.php');
	}
	
	die();
?>