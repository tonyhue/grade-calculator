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
the score received for a graded item and its 
weighted percentage of the final grade. 

*/

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
 	// Include Google Analytics snippet for production
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

				<form role="form" name="MyGrades">

					<table id="scores" class="table table-hover">
						<thead>
							<tr>
								<th>Score</th>
								<th>% of Overall Grade</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<label for="s1" class="sr-only"></label>
									<input class="form-control" type="number" name="s1" id="s1" maxlength="3" step="0.01" min="0">
								</td>
								<td>
									<label for="w1" class="sr-only"></label>
									<input class="form-control" type="number" name="w1" id="w1" step="0.01" min="0">
								</td>
							</tr>
							<tr>
								<td>
									<label for="s2" class="sr-only"></label>
									<input class="form-control" type="number" name="s2" id="s2" step="0.01" min="0">
								</td>
								<td>
									<label for="w2" class="sr-only"></label>
									<input class="form-control" type="number" name="w2" id="w2" step="0.01" min="0">
								</td>
							</tr>
							<tr>
								<td>
									<label for="s3" class="sr-only"></label>
									<input class="form-control" type="number" name="s3" id="s3" step="0.01" min="0">
								</td>
								<td>
									<label for="w3" class="sr-only"></label>
									<input class="form-control" type="number" name="w3" id="w3" step="0.01" min="0">
								</td>
							</tr>
							<tr>
								<td>
									<label for="s4" class="sr-only"></label>
									<input class="form-control" type="number" name="s4" id="s4" step="0.01" min="0">
								</td>
								<td>
									<label for="w4" class="sr-only"></label>
									<input class="form-control" type="number" name="w4" id="s4" step="0.01" min="0">
								</td>
							</tr>
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
	<script>
	// (function(){

	// 	var calculator = $('#scores tbody'),
	// 	defaultMaxGradeEntries = 4,
	// 	gradeRow = "",
	// 	i = 1;

	// 	while(defaultMaxGradeEntries >= i) {
	// 		gradeRow += "<tr>";
	// 		gradeRow += "<td>";
	// 		gradeRow += "<input class=form-control type=number name=s" + i + " value>";
	// 		gradeRow += "</td>"
	// 		gradeRow += "<td>";
	// 		gradeRow += "<input class=form-control type=number name=w" + i + " value>";
	// 		gradeRow += "</td>";
	// 		gradeRow += "</tr>";
	// 		i++;
	// 	}	
	// 	console.log(gradeRow);

	// 	calculator.append(gradeRow);

	// })();
	</script>
</body>
</html>