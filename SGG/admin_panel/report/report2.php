<?php

# Copyright (c) Bouncing Ltd 2003-2016
# Author Philip Clarke nod@bouncing.org
# Released under the CC Attribution 4.0 licence https://creativecommons.org/licenses/by/4.0/
# You may do with it as you please just keep the credits. If you change something note it down for your own good
# This Version released 12/11/2016 (keep in as helps with bug fixes)

# mysql_report is now mysqli_report PHP 5+ compatible
# General Principle for setting up.
# Get the mysql_report and fpdf libraries loaded
# Set the page side (although pdf's tend to scale well)
# add database connection details
# add report title
# Add SQL statement (it is sanitized in mysql_report but take precautions with any user input)
# Output PDF (lots of people forget this and then wonder why the page is blank).

// you may need to change mysql_report.php to find the fpdf libraries
require('mysql_report.php');

// the PDF is defined as normal, in this case a Landscape, measurements in points, A3 page.
$pdf = new PDF('L','pt','A3');
$pdf->SetFont('Arial','',10);


// change the below to establish the database connection.
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'sgg1';

// should not need changing, change above instead.
$pdf->connect($host, $username, $password, $database);


// attributes for the page titles
$attr = array('titleFontSize'=>18, 'titleText'=>'First Example Title.');

# Example SQL Statements
# 
# Normally one would have 1 SQL statement and generate the report, e.g. a weekly sales breakdown
# mysql_report can now produce more than one SQL statement in the report, so one could do a 
# more complex set of tables like monthly reports using differing SQL
# Examples are from the mysql table. The tables are generated and then outputted.

/* Multiple SQL tables will merge into 1 numbered PDF */


/* Example 1: multiple page table full width table */
// SQL statement
$sql_statement = "SHOW VARIABLES" ;

// Generate report
$pdf->mysql_report($sql_statement, false, $attr );


/* Example 2: single page small non-full width table, mysql_report chooses not to spread table out */
// SQL statement
$sql_statement = 'SHOW TABLES';

// Generate report
$pdf->mysqli_report($sql_statement, false, $attr );


/* Example 3: Changing Title mid-report. Single page table more columns, at A3 page size still does not spread out */
/* if titles are same font size you can change them per table */
// SQL statement
$attr = array('titleFontSize'=>18, 'titleText'=>'Second Example Title.');
$sql_statement = 'DESCRIBE user';

// Generate report
$pdf->mysqli_report($sql_statement, false, $attr );


/* Example 4: Using SQL to change column headings */
#!!! Careful what you publish ;-0 !!!#
// SQL statement
$sql_statement = "SELECT Area_name as Area Name`, Pincode as `Pincode` FROM user ";

// Generate report
$pdf->mysqli_report($sql_statement, false, $attr );

/* Example 5: Showing what happens when no rows are returned, column headers are still printed */
// SQL statement


// Generate report

/* Example 6: Same report as above but set up to output rows using a LEFT JOIN and SQL to improve the layout */
// SQL statne all the work of 
   
$pdf->Output();


/* ADVICE do not use a PHP closing tag like  ?> */
