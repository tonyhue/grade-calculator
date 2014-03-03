<?php

include("functions.php");

/*

//============================================
// Description
//============================================
This is a tool for calculating the grade you have
in a class. It requires manually entering each
assignment/quiz/presentation/test that contributed 
to a class's overall grade. Two values are needed:
the score received for the item and the percentage
value of it. 

*/

//============================================
// Variables
//============================================

$self 	= htmlentities($_SERVER['PHP_SELF']);
$grades = array("A" => 90, "B" => 80, "C" => 70);

//============================================
// Main Script
//============================================

if($_POST)
{
	$total 		 = 0;
	$totalWeight = 0;

	//debugbox($_POST);

	//==============================
	// Multiply each score/weight pair 
	// and add to running total
	//==============================

	for($i = 1; $i <= 7; $i++)
	{

		$s = "s" . $i;
		$w = "w" . $i;

		$score 	= htmlentities(trim($_POST[$s]));
		$weight	= htmlentities(trim($_POST[$w])) / 100; // convert to decimal equivalent

		// both score and weight must be provided in a row
		if($score && $weight)
		{
			$totalWeight += htmlentities($_POST[$w]);

			// multiply and add to total
			$points    = $score * $weight;
			$totalPts += $points; 	
		}

	} // END for()

	//=====================================
	// If class is still in progress, 
	// determine current grade
	//=====================================

	if($totalWeight < 100)
	{
		// divide total by current weight
		$warning 	 = "Your current grades account for $totalWeight% of your final average.";
		$totalScore  =  round((($totalPts / $totalWeight) * 100), 0);

		// determine how many pts. needed to get a particular grade
		
		$aoran = "a";

		foreach($grades as $letter => $score)
		{
			$ptsNeeded    = $score - $totalPts; 
			$pctRemaining = 100 - $totalWeight;
			$ptsRemaining = round((($ptsNeeded / $pctRemaining) * 100), 0);

			if($letter == "A")
			{
				$aoran = "an";
			}

			if($ptsRemaining >= 0)
			{
				$message .= "<p>You need to score at least <strong>$ptsRemaining</strong> to get $aoran <strong>$letter</strong></p>";
			}
		}
	}
	elseif($totalWeight > 100)
	{
		unset($totalScore);
		$error 	 .= "Total weighted grades cannot exceed 100.";
	} 
	else
	{
		$totalScore = round($totalPts, 2);
	} // END if()


} // END if($_POST)


	

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>MyGrades - Grade Calculator</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="description" content="MyGrades lets you calculate your grade in a class based on your scores from homework, projects, quizzes, and exams.">

	<!--Facebook tags-->
  <meta property="og:title" content="MyGrades - Grade Calculator" />
  <meta property="og:url" content="http://labs.tonyhue.com/grade-calculator" />
  <meta property="og:description" content="MyGrades lets you calculate your current or final grade in a class based on your scores from homework, quizzes, and exams." />		
  <meta property="og:image" content="http://labs.tonyhue.com/grade-calculator/img/calculator.png" />
  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />
  <meta property="og:site_name" content="MyGrades" />

  <link rel="stylesheet" href="css/style.css">

 <?php 
 	$serverCheck = htmlentities($_SERVER['SERVER_NAME']);
 	if($serverCheck !== "localhost")
 	{
 		include("../includes/analytics.php"); 
 	}
 ?>
 
</head>
<body>
	
	<div class="container">
			
		<header>
			<h1>My<span class="app-name">Grades</span></h1>
			<p>Calculate your current or final grade in a class. Perfect for both students and teachers!</p>
		</header>
		
		<div class="row">
			
				<div class="col-md-4">
					<h2>Step 1:</h2>
					<p>Enter the score you received for a graded assignment, project, presentation, or exam.</p>
					<p><em>Example: If you scored 80% on an assignment, you enter 80.</em></p>
				</div>
				<div class="col-md-4">
					<h2>Step 2:</h2>
					<p>Enter the total weight of the grade. The total cumulative weight should not exceed 100%.</p>
					<p><em>Example: If a project is worth 25% of your final grade, you enter 25.</em></p>
				</div>
				<div class="col-md-4">
					<h2>Step 3:</h2>
					<p>Click "Calculate" and the tool will determine your grade. If your class has not ended yet, it will also report the required performance to achieve a desired grade.</p>
				</div>

		</div>

		<div class="row">

		<div class="col-md-8">

		<form action="<?php echo $self; ?>" method="POST">
			
		<table id="scores" class="table table-hover">
			<thead>
				<tr>
					<th>Score</th>
					<th>% of Overall Grade</th>
				</tr>
			</thead>
			<tbody>				

			<?php 
				
				//============================================
				// Output score entry row
				//============================================
				
				$defaultMaxGradeEntries = 4;
				$i = 1;
				while($defaultMaxGradeEntries >= $i)
				{
					echo "<tr>
							<td>
								<input class='form-control' type='number' name='s". $i ."' value=''>
							</td>
							<td>
								<input class='form-control' type='number' name='w". $i ."' value=''>
							</td>
						  </tr>";

					$i++;
				}

			?>
				
			</tbody>
		</table>
				<div id="gradeActions">
					<button class="btn btn-primary calculate">Calculate</button>
					<button class="btn btn-link clear-score">Clear</button>
					<button class="btn btn-sm add-score pull-right"><span class="glyphicon glyphicon-plus"></span></button>
				</div>
		</form>
		
		</div><!--END .col-md-8-->
		<div class="col-md-4">

		<div id="results"></div>
		<div id="performance"></div>
			
		</div>
		</div>
	</div><!--END .container-->

	<script type="text/javascript" src="js/app.min.js"></script>

</body>
</html>