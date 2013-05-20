
<table>
<form name="myform1" method="post" action="icd_update.php">
<tr>
<th>From Date</th>
<th>To Date</th>
<th>Department</th>
<th>Unit</th>
<th>Area</th>
<th>Category</th>
</tr>
<tr>
<td><input type="text" name="from_date" id="vdatepicker" style="max-width:80px;" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y/m/d"); ?>'></td>
<td><input type="text" name="to_date" id="datepicker" style="max-width:80px;" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y/m/d"); ?>'></td>
<td>
<select name="department" id="department" style="max-width:90px;">
<option selected="selected" value="">--Select--</option>
<?php
include("../db_connect.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
$sql=mysql_query("select * from departments");
while($row=mysql_fetch_array($sql))
{
echo '<option value="'.$row['department_id'].'">'.$row['department'].'</option>';
 } ?>
</select>
</td>
<td>
<select name="unit" id="unit" style="max-width:90px; min-width:90px;">
<option selected="selected" value="">--Select--</option>
<?php
$sql=mysql_query("select * from units");
while($row=mysql_fetch_array($sql))
{
$id=$row['unit_id'];
$data=$row['unit_name'];
$dept_id=$row['department_id'];
echo '<option value="'.$id.'" name="'.$dept_id.'" hidden>'.$data.'</option>';
}
?>
</select>
</td>
<td>
<select name="area" id="area" style="max-width:90px; min-width:90px;">
<option selected="selected" value="">--Select--</option>
<?php
$sql=mysql_query("select * from areas");
while($row=mysql_fetch_array($sql))
{
$id=$row['area_id'];
$data=$row['area_name'];
$dept_id=$row['department_id'];
echo '<option value="'.$id.'" name="'.$dept_id.'" hidden>'.$data.'</option>';
}
?>
</select>
</td><td>
<select name="category" style="max-width:90px; min-width:90px;">
<option value="unfilled">Unfilled</option>
<option value="filled">Filled</option>
<option value="all">All</option>
</select>
</td></tr> 
<tr><td colspan="6" align="center">
<input type="submit" name="icd10" align="right" style="width:150px;" value="Submit" > 
</td></tr>

</form></table><hr>
