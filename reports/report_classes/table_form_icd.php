<table>
<tr>
<th>From Admit Date</th>
<th>To Admit Date</th>
<th>Department</th>
<th>Unit</th>
<th>Area</th>
<th>Gender</th>
</tr>
<tr>
<td style="vertical-align:top;"><input type="text" name="from_date" id="vdatepicker" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y/m/d"); ?>'></td>
<td style="vertical-align:top;"><input type="text" name="to_date" id="datepicker" value='<?php date_default_timezone_set('Asia/Kolkata'); echo date("Y/m/d"); ?>'></td>
<td style="vertical-align:top;">
<select name="department" id="department" style="max-width:100px;">
<option selected="selected">--Select--</option>
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
<td rowspan="2" style="vertical-align:top;">
<select name="unit[]" id="unit" style="max-width:100px; min-width:100px;">
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
<td rowspan="2" style="vertical-align:top;">
<select name="area[]" id="area" style="max-width:100px; min-width:100px;">
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
</td>
<td style="vertical-align:top;">
<select name="gender">
<option value='' select="selected">--ALL--</option>
<option value='M'>Male</option>
<option value='F'>Female</option>
</select></td>
</tr>
<tr>
<td colspan ="3"><?php include("icd_selection.php"); ?></td>
</tr>
</table>
<input type="submit" name="submit">


<script>

// window.onload = onchangeajax(100);

// function onchangeajax(pid)
 // {
 // xmlHttp=GetXmlHttpObject()
 // if (xmlHttp==null)
 // {
 // alert ("Browser does not support HTTP Request")
 // return
 // }

 // var url="report_classes/changestate.php"
 // url=url+"?pid="+pid
 // url=url+"&sid="+Math.random()
 // document.getElementById("statediv").innerHTML='Please wait..<img border="0" src="ajax-loader.gif">'
 // if(xmlHttp.onreadystatechange=stateChanged)
 // {
 // xmlHttp.open("GET",url,true)
 // xmlHttp.send(null)
 // return true;
 // }
 // else
 // {
 // xmlHttp.open("GET",url,true)
 // xmlHttp.send(null)
 // return false;
 // }
 // }

 // function stateChanged()
 // {
 // if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 // {
 // document.getElementById("statediv").innerHTML=xmlHttp.responseText
 // return true;
 // }
 // }

 // function GetXmlHttpObject()
 // {
 // var objXMLHttp=null
 // if (window.XMLHttpRequest)
 // {
 // objXMLHttp=new XMLHttpRequest()
 // }
 // else if (window.ActiveXObject)
 // {
 // objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
 // }
 // return objXMLHttp;
 // }
</script>

