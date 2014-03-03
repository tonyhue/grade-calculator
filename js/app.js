// @codekit-prepend "jquery.js";
// @codekit-prepend "alert.js";
// @codekit-prepend "functions.js";

//============================================
// Notes
//============================================
// returning false on buttons is necessary to prevent default page action of reloading


//====================================
// Clear scores from table
//====================================
// When clear button is clicked, clear the input fields and results/performance charts.
// FIXED: Calculate function doesn't work after clicking clear button.
// remove() removes the entire DOM element (the empty divs), which we need for targeting the results and performance chart outputs

$('#gradeActions').on('click', '.clear-score', function(){
	$(this).closest('form').find('input').val('');
	$('#results, #performance').empty().removeClass();
	$('.alert-danger').remove();
	return false;
});

//====================================
// Append new score row in table
//====================================
// Allow user to add as many scores for a class.

$('#gradeActions').on('click', '.add-score', function(){
	var scoreCount = $('#scores tr').length;
	$('tbody').append('<tr><td><input class="form-control" type="number" name="s' + scoreCount + '" value=""></td><td><input class="form-control" type="number" name="w' + scoreCount + '" value=""></td></tr>');
	return false;
});

//=========================================================
// Calculate grades when user clicks calculate button
//=========================================================
// Formula: [(Score received x Weight (convert to decimal)) + (...)] / [Total weight]

$('#gradeActions').on('click', '.calculate', function(){

	// determine the number of grades submitted.
	var scoreCount = $('#scores tr').length; // BUG: how to grab # of filled rows?
	// set vars
	var cumulativePoints = 0;
	var cumulativeWeight = 0;
	var currentGrade = 0;

	// loop through each entry, multiplying each score with
	// its corresponding weight. add value to running point total
	for(var i = 1; i < scoreCount; i++)
	{
		// Retrieve entry values
		// note: val() doesn't work with input of type number
		var scoreVal  = $('input[name="s' + i + '"]').val();
		var weightVal = $('input[name="w' + i + '"]').val();

		// debugging
		var checkScore  = typeof scoreVal;
		var checkWeight = typeof weightVal;

		// if both a score and weight provided for a given row
		if(scoreVal && weightVal)
		{
			// convert to integer
			// note: parseInt converts "10d" to 10, but returns NaN for "d10"
			scoreVal = parseInt(scoreVal, 10);
			weightVal = parseInt(weightVal, 10) / 100; // save the need to convert later on

			// Report error if non-number found
			if(isNaN(scoreVal) || isNaN(weightVal))
			{
				$('.alert-danger').remove();
				$('#results, #performance').empty().removeClass();
				$("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Please enter a number value.</div>").insertBefore('#results');
				return false;
			}
			else
			{
				// add grade entry to running point total
				var points = scoreVal * weightVal;
				cumulativePoints += points;
				cumulativeWeight += weightVal;

				// Report error if cumulative weight > 100%
				if(cumulativeWeight > 1)
				{
					$('.alert-danger').remove();
					$('#results, #performance').empty().removeClass();
					$("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Cumulative weight cannot exceed 100.</div>").insertBefore('#results');
					return false;
				}
				// convert point total to percentage grade
				currentGrade = cumulativePoints / cumulativeWeight;
			}
			// alert(currentGrade);
		}
	}
	// remove any pre-existing error message, if any
	$('.alert-danger').remove();

	// alert(cumulativeWeight * 100);

	// round grade percentage to two decimals
	currentGrade = Math.round(currentGrade * 100) / 100;
	// $('#results').append('<strong>Grade:</strong> ' + currentGrade + '%');
	$('#results').html('<strong>Grade:</strong> ' + currentGrade + '%');
	$('#results').addClass("alert alert-success");

	if(cumulativeWeight < 1)
	{
		var reportCumulativeWeight = cumulativeWeight * 100;
		reportCumulativeWeight = Math.round(reportCumulativeWeight * 100) / 100;
		$('#results').append('<p>Your current scores account for ' + reportCumulativeWeight + '% of your final grade.</p>');
	}
	// no need to calculate performance targets since total scores account for 100% of grade
	else if(cumulativeWeight === 1)
	{
		$('#performance').empty();
		$('#performance').removeClass();
		return false;
	}

	//============================================
	// Determine Target Grade Performance
	//============================================
	// How well does the student need to perform to achieve their target grade?

	$('#performance').empty();
	$('#performance').addClass('alert alert-info');

	calculateTargetGrade(90, 'A', cumulativePoints, cumulativeWeight);
	calculateTargetGrade(80, 'B', cumulativePoints, cumulativeWeight);
	calculateTargetGrade(70, 'C', cumulativePoints, cumulativeWeight);
	calculateTargetGrade(60, 'D', cumulativePoints, cumulativeWeight);

	return false;

});





