<table>
<tr>
<td style="vertical-align:top;">
<?php
if($_REQUEST['pid']!='100'){
include("../../db_connect.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
echo "<select name=\"unit[]\" id=\"unit\" multiple>";
$id=$_REQUEST['pid'];
$sql=mysql_query("select * from units where department_id='$id'");
echo '<option selected="selected" value="">--ALL--</option>';
while($row=mysql_fetch_array($sql))
{
$id=$row['unit_id'];
$data=$row['unit_name'];
echo '<option value="'.$id.'">'.$data.'</option>';
}
echo "</select>";
}
else {
echo "<select name=\"unit[]\" id=\"unit\">";
echo '<option selected="selected" value="">--ALL--</option>';
echo "</select>";
}
?>
</td>
<td style="vertical-align:top;">
<?php
if($_REQUEST['pid']!='100'){
include("../../db_connect.php");
mysql_connect("$dbhost","$dbuser","$dbpass");
mysql_select_db("$dbdatabase");
echo "<select name=\"area[]\" id=\"area\"  multiple >";
$id=$_REQUEST['pid'];
$sql=mysql_query("select * from areas where department_id='$id'");
echo '<option selected="selected" value="">--ALL--</option>';
while($row=mysql_fetch_array($sql))
{
$id=$row['area_id'];
$data=$row['area_name'];
echo '<option value="'.$id.'">'.$data.'</option>';
}
echo "</select>";
}
else {
echo "<select name=\"area[]\" id=\"area\">";
echo '<option selected="selected" value="">--ALL--</option>';
echo "</select>";
}
?>
</td>
</tr>
</table>