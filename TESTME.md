# Test Cases
Run these series of tests before pushing to production

## Test 1:
Input:
	10, 90
Result:
	Success

## Test 2:
Input:
	90, 10
	70, 10
	80, 15
	85, 15
	(Add row)
	90, 15
Result:
	Success

## Test 3:
Input:
	10, 90
	Calculate (success)
	50, 20
Result:
	Error (weight)

## Test 4:
Input:
	10, 90
	Calculate (success)
	abc, 20
Result:
	Error (NaN)

## Test 5:
Input:
	10, 90
	Calculate (success)
	(move cursor to line 1)
	change to abc, 90
Result:
	Error (NaN)

## Test 5:
Input:
	10d, 90
Result:
	Success (parseInt converts 10d to 10, but returns NaN for d10)

## Test 5:
Input:
	10, 90
	Calculate (success)
	(move cursor to line 1)
	change to 10d, 90
Result:
	Error (NaN)

## Test 5:
Input:
	10, 90
	Calculate (success)
	Clear (empty form)
	repeat steps 1-2
Result:
	Success

## Test 6:
Input:
	10, 90
	Calculate (success)
	50, 20
	Error (weight)
	Fix weight
Result:
	Success

