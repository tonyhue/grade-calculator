function calculateTargetGrade(score, letter, cumulativePoints, cumulativeWeight) {
	var ptsNeeded = score - cumulativePoints;
	var weightRemaining = 100 - (cumulativeWeight * 100);
	// alert("cumulative points " + cumulativePoints);
	// alert("cumulativeWeight " + cumulativeWeight);
	// alert("targetPerformance " + ptsNeeded + " / " + weightRemaining);
	var targetPerformance = (ptsNeeded / weightRemaining) * 100;
	// alert(targetPerformance);

	// round to nearest two decimals
	targetPerformance = Math.round(targetPerformance * 100) / 100;

	if( targetPerformance >= 0 ){
		$('#performance').append('<p>You need to score at least <strong>' + targetPerformance + '</strong> to get an ' + letter + '</p>');
	}
}