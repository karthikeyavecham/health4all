<?php
/*
This file will generate our CSV table. There is nothing to display on this page,
it is simply used to generate our CSV file for download in our browser and then
exit. That way we won't be re-directed after pressing the export to CSV button
on the previous page.
*/
 
//First we'll initialize an output variable for the content of our CSV file.
$out = '';
 
//Next we'll initialize a variable for our filename prefix (optional).
$filename_prefix = 'csv';
 
//Next we append our POST header data from table.php and append it to out.
if (isset($_POST['csv_hdr'])) {
$out .= $_POST['csv_hdr'];
$out .= "\n";
}
 
//Then we grab the table data from table.php and append it to out.
if (isset($_POST['csv_output'])) {
$out .= $_POST['csv_output'];
}
 
//Now our out has nearly all the parts of a file, we just gotta create/name it.
$filename = $filename_prefix."_".date("Y-m-d_H-i",time());
 
//Generate the CSV file header
header("Content-type: application/vnd.ms-excel");
header("Content-Encoding: UTF-8"); //Added to deal with UTF character support
header("Content-type: text/csv; charset=UTF-8");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header("Content-disposition: filename=".$filename.".csv");
echo "\xEF\xBB\xBF"; // UTF-8 BOM added for UTF character support
 
//Print the contents of out to the generated file.
print $out;
 
//Exit the script
exit;
?>
