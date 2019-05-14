<?php

$percent_array = null;
$score_array = null;
$total_score = null;
$final_grade_percentage = null;
$no_errors = TRUE;

// Gather name data - mostly for the user to enter
if(isset($_POST["name"]) && is_array($_POST["name"])){
    $name_array = implode(", ", $_POST["name"]);
}

// gather score data
if(isset($_POST["percent"]) && is_array($_POST["percent"])){
    //$percent_array = implode(", ", $_POST["percent"]);
    $percent_array = array_map('intval', $_POST["percent"]); // convert strings to integers
} else {
	echo("Error: Could not connect to percentage data");
	$no_errors = FALSE;
}

// gather percent data
if(isset($_POST["score"]) && is_array($_POST["score"])){
    //$score_array = implode(", ", $_POST["score"]);
    $score_array = array_map('intval', $_POST["score"]); // convert strings to integers

} else {
	echo("Error: could not connect to score data");
	$no_errors = FALSE;
}

if (!is_null($percent_array) && !is_null($score_array)) {
	$total_score=0;
	$final_grade_percentage=1;
	for ($i=0; $i<count($percent_array); $i++) {
		$final_grade_percentage -= ($percent_array[$i]/100);
		$total_score += ($score_array[$i] * ($percent_array[$i]/100));
	}
} else {
	echo("Error Reading Data");
	$no_errors = FALSE;
}

if(isset($_POST['desired_score']) && !is_null($total_score)) {
	$desired_score = (int) $_POST['desired_score'];
	$need_score = ($desired_score - $total_score)/$final_grade_percentage;
} else {
	echo("Error Calculating Required Score from given Data");
	$no_errors=FALSE;
}
?>

<!--Danny Perkins, dgp3sy@virginia.edu-->

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<link rel='stylesheet' href='gpa_style.css' type='text/css' />
	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
	
</head>
<body>
	<div class="form-center">
		<h1> Final Exam Grade Calculator</h1>
	  <div class="final-php">
	  	<?php
	  	if ($no_errors) { 
	  		echo("The score on your final exam you need for a " . $desired_score . "% is: ");?>
			<div class="result"><?php echo(round($need_score,2) . "% </br>"); ?></div>
			<?php
			if ($need_score < 50) { 
				echo("Easy Peasy!");
			}
			elseif ($need_score < 70) {
				echo("Seems Feasible!");
			}
			elseif ($need_score < 80) {
				echo("You can do this!");
			}
			elseif ($need_score < 90) {
				echo("Good Luck!");
			}
			elseif ($need_score < 100) {
				echo("Better start studying!");
			}
			elseif ($need_score < 120) {
				echo("I hope the final has bonus opportunity....");
			}
			else {
				echo("Better luck next time!");
			}
		}

	  	?>
	  <form class="fake-form" name="return" action="gpa_calc.html">
	  	<input class="submit-button" type="submit" value="Return" />
	  </form>


		</div>
	 </div>
</body>

	<footer class="primary-footer container">
      <small class="copyright">&copy; Daniel Perkins | 2019 | All Rights Reserved</small>
      <nav class="nav">
      </nav>
    </footer>
</html>