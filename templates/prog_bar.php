<div class="w3-border">
	<?php 
		$completion = calcPercent(80);
		$completionDisplay = calcPercent(100);
	?>
	<div class="w3-container w3-amber w3-center" style="width:<?php echo $completion; ?>%;">
		<p id="percent"><?php echo $completionDisplay . '%'; ?></p>
	</div>
	<span id="pointer"></span>
	<div class="scoring-label">
		<p id="percent" style="color: orange;">YOUR SCORE</p>
	</div>
	<?php
		echo 
			"<script>
				var point = document.getElementById('pointer');
				point.style.left = '" . $completion . "%';
			</script>";
	?>
</div>