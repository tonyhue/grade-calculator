# MyGrades - Grade Calculator

[MyGrades](http://labs.tonyhue.com/grade-calculator/) lets you easily calculate the grade you have in a class. Simply enter the scores you received on assignments, projects, presentations, and exams in a class and MyGrades will determine your current or final grade.

## Formula

Two values are needed for each grade entry: 

* score
* weight percentage

[(Score-1 x Weight-1) + (Score-2 x Weight-2) + (...)] / Total weight

### Example:
* Project: 85%, 10% weight
* Homework: 100%, 10% weight
* Midterm 1: 70%, 25% weight

[(85 x 0.10) + (100 x 0.10) + (70 x 0.25)] / 45
	= (8.5 + 10 + 17.5) / 45
	= 36 / 45
	= 0.80 or 80%

## Features

* Error handling
	* check sum of percent total
	* scores cannot exceed 100
	* score/weight must go in pairs
* Preserve score/weight input upon form submission
	* clear form button
* Support for current grade in class
	* assumption: some grades recorded, class not complete yet
	* determine score required in remainder of class to secure certain grade
	* if total weight is less than 100, adjust score 
* Show example
	* Clickable link/button which prefills form and shows the correct input type
* support for extra credit, eg. scores above 100

## Screenshot
![ScreenShot](/img/screenshot.png)

## Notes

* app.min.js is compiled and minified using Codekit. It prepends jquery.js and functions.js to app.js.

## Changelog

### 1.1
* Added ability to add as many scores to your class

### 1.2
* Popup alert when submitting non-integer values (highlight offending fields)
* Added notice saying what the cumulative weight of their current grade thus far
* Added notice if total weight exceeds 100
* Eliminated "Bootstrap" look and feel
* Added <meta> tags
* Added facebook meta tags

### 1.3
* Clicking clear button now doesn't reload page.
	* Clear removes entered input fields and results/performance boxes
* Migrated to Bootstrap 3
	* importing framework via Codekit
	* @import in style.scss
	* // @codekit-append/prepend in app.js
	* updated grid and button classes to newer version
* Changed custom.js to app.js
	* Concatenating jquery, tooltip.js, popover.js to app.js
	* Bootstrap requires jQuery
	* Minifying to app.min.js
* Using Glyphicon for "add new score" button
	* Moved font files to project folder since Codekit does not import font files via frameworks.
* Design refinements	
	* input fields scale better at smaller dimensions now. no more horizontal scrolling!
* Replaced pop-up error alert with inline alert box
	* Current limitation: reports only first instance of error it finds and stops validating rest of form. Might need to use a plugin.

### 1.3.1
* Bug fixes with form validation handling. val() doesn't grab the value of input type number. Reverted back to type text for the time being.

### 1.3.2
* jQuery selector optimization

## TODO

* Allow user to adjust grading scale. Example: Anything greater than 88 is an A.
* Support browsers with JS disabled.
* Explore the possibility of using jQuery 2.x which allows you to load parts of the entire library.

## Colophon:

* [Bootstrap 3](http://getbootstrap.com/)
* [jQuery 1.11](http://jquery.com/)
* [Sass](http://sass-lang.com/)
* [Codekit](http://incident57.com/codekit/)



