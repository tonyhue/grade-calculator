// @codekit-prepend "../bower_components/jquery/dist/jquery.js";
// @codekit-prepend "functions.js";
// @codekit-prepend "../bower_components/bootstrap/js/alert.js"

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
	$('tbody').append('<tr><td><label name="s' + scoreCount + '" class="sr-only"></label><input class="form-control" type="number" name="s' + scoreCount + '" id="s' + scoreCount + '" step="0.01" min="0"></td><td><label name="w' + scoreCount + '" class="sr-only"></label><input class="form-control" type="number" name="w' + scoreCount + '" id="w' + scoreCount + '" step="0.01" min="0"></td></tr>');
	return false;
});

//=========================================================
// Calculate grades when user clicks calculate button
//=========================================================
// Formula: [(Score received x Weight (convert to decimal)) + (...)] / [Total weight]

$('#gradeActions').on('click', '.calculate', function(){

	var cumulativePoints = 0;
	var cumulativeWeight = 0;
	var currentGrade = 0;

	// determine the number of grades submitted.
	// BUG: how to grab # of filled rows?
	var scoreCount = $('#scores tbody tr').length;

	// loop through each entry, multiplying each score with
	// its corresponding weight. add value to running point total
	for(var i = 1; i <= scoreCount; i++)
	{
		// Retrieve entry values
		// note: val() always seems to return a string. why not a number?
		var scoreVal  = $('input[name="s' + i + '"]').val();
		var weightVal = $('input[name="w' + i + '"]').val();

		// debugging
		// var checkScore  = typeof scoreVal;
		// var checkWeight = typeof weightVal;
		console.log(i + " " + scoreVal + " " + weightVal);
		
		var scoreType = typeof scoreVal;
		var weightType = typeof weightVal;

		console.log("type of scoreVal: " + scoreType);
		console.log("type of weightVal: " + weightType);

		// if both a score and weight provided for a given row
		if(scoreVal && weightVal)
		{
			// convert to integer
			scoreVal  = parseFloat(scoreVal, 10);
			weightVal = parseFloat(weightVal, 10) / 100; // save the need to convert later on
			console.log(i + " (inside) " + scoreVal + " " + weightVal);
			
			scoreType = typeof scoreVal;
			weightType = typeof weightVal;

			console.log("type of scoreVal: " + scoreType);
			console.log("type of weightVal: " + weightType);
		
			// Report error if non-number found
			if(isNaN(scoreVal) || isNaN(weightVal))
			{
				console.log("problem sir");
				$('.alert-danger').remove();
				$('#results, #performance').empty().removeClass();
				$("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Please enter either a whole number or decimal number value.</div>").insertBefore('#results');
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
	} // finished going through grade entries

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
