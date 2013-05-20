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
<?php 
 include("../db_connect.php");
 mysql_connect("$dbhost","$dbuser","$dbpass");
 mysql_select_db("$dbdatabase");
 $query_dept= "SELECT * 
		FROM departments";
 $result_dept = mysql_query($query_dept);
 	echo "<select name=\"department\" onchange=\"return onchangeajax(this.value);\">";
	echo "<option value=\"\" select=\"selected\">--ALL--</option>";
	while ($record_dept = mysql_fetch_array($result_dept)){
	if($record_dept['department_id']!="0"){
    echo "<option value=\"" . $record_dept['department_id'] . "\">" . $record_dept['department'] . "</option>";
	 }}
	echo "</select>";
?>
</td>
<td colspan="2" style="vertical-align:top;">
<div id="statediv"></div>
</td>
<td style="vertical-align:top;">
<select name="gender">
<option value='' select="selected">--ALL--</option>
<option value='M'>Male</option>
<option value='F'>Female</option>
</tr>
<tr>
<td></td>
</tr>
</table>
<input type="submit" name="submit">


<script>
function weight() {
if(document.getElementById("by_weight").checked)
{document.getElementById("by_weight_view").style.display="block";}
else {document.getElementById("by_weight_view").style.display="none";}
}

function age() {
if(document.getElementById("by_age").checked)
{document.getElementById("by_age_view").style.display="block";}
else {document.getElementById("by_age_view").style.display="none";}
}

window.onload = onchangeajax(100);

function onchangeajax(pid)
 {
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }

 var url="report_classes/changestate.php"
 url=url+"?pid="+pid
 url=url+"&sid="+Math.random()
 document.getElementById("statediv").innerHTML='Please wait..<img border="0" src="ajax-loader.gif">'
 if(xmlHttp.onreadystatechange=stateChanged)
 {
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 return true;
 }
 else
 {
 xmlHttp.open("GET",url,true)
 xmlHttp.send(null)
 return false;
 }
 }

 function stateChanged()
 {
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 {
 document.getElementById("statediv").innerHTML=xmlHttp.responseText
 return true;
 }
 }

 function GetXmlHttpObject()
 {
 var objXMLHttp=null
 if (window.XMLHttpRequest)
 {
 objXMLHttp=new XMLHttpRequest()
 }
 else if (window.ActiveXObject)
 {
 objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
 }
 return objXMLHttp;
 }
</script>

