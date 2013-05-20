<table><tr><td>Chapter</td><td>
<?php 
 include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 $query_chp= "SELECT * 
		FROM icd_chapter";
 $result_chp = mysql_query($query_chp);
 	echo "<select name=\"chapter\" id=\"chapter\" style=\"width:265px\">";
	echo "<option value=\"\" select=\"selected\">--Select--</option>";
	while ($record_chp = mysql_fetch_array($result_chp)){
	echo "<option value=\"" . $record_chp['chapter_id'] . "\">" . $record_chp['chapter_id'] ." : ". $record_chp['chapter_title'] . "</option>";
	}
	echo "</select>";
?>
</td></tr><tr><td>Block</td><td>
<?php	
echo "<select name=\"block\" id=\"block\" style=\"width:265px\">";
$sql=mysql_query("select * from icd_block");
echo '<option selected="selected" value="" disabled>--Select--</option>';
while($row=mysql_fetch_array($sql))
{
$id=$row['block_id'];
$data=$row['block_title'];
$chapter=$row['chapter_id'];
echo '<option value="'.$id.'" name="'.$chapter.'" hidden>'.$id." : ".$data.'</option>';
}
echo "</select>";
?>
</td></tr><tr><td>Code</td><td>
<?php
echo "<select name=\"code\" style=\"width:265px\" id=\"code\" onchange=\"return icd_fill(this.value);\">";

$sql_1=mysql_query("select * from icd_code");
echo '<option selected="selected" value=" disabled">--Select--</option>';

while($row_1=mysql_fetch_array($sql_1))
{
$data=$row_1['code_title'];
$icd=$row_1['icd_10'];
$icd_ext=$row_1['icd_10_ext'];
$id=$icd.".".$icd_ext;
$block=$row_1['block_id'];
echo '<option value="'.$id.'" name="'.$block.'" hidden>'.$id." : ".$data.'</option>';
}
echo "</select>";
?>
</td></tr><tr><td colspan="2" align="center">
<?php
echo "<input type=\"button\" name=\"submit\" value=\"Fill\" style=\"width:60px\" onclick=\"icd();\">";
?>
</td></tr></table>