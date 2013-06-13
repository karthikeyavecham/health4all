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

<table>
	<tr>
	<td width="350px"><input type="checkbox" id="by_age" onclick="age();">Filter By Age</td>
	<td width="200px"><input type="checkbox" id="by_weight" onclick="weight();">Filter By Weight</td>
	<td width="200px"><input type="checkbox" id="gest_weeks" onclick="gestation();">Gestation</td>
	<td width="200px"><input type="checkbox" id="in_out" onclick="inborn_outborn();">Delivery Location Type</td>
	</tr>
	<tr>
		<td>
			<div id="by_age_view" style="display:none">
			<table>
			<tr><td colspan="2"><b><u>Age At Admission:</u></b></td></tr>
			<tr><td><b>From :</b></td><td><input type="text" name="from_age_yrs" maxlength="3" size="2">Yrs <input type="text" name="from_age_mts" size="2" maxlength="2">Mths <input type="text" name="from_age_days" maxlength="2" size="2">days</td></tr>
			<tr><td><b>To :</b></td><td><input type="text" name="to_age_yrs" maxlength="3" size="2">Yrs <input type="text" name="to_age_mts" size="2" maxlength="2">Mths <input type="text" name="to_age_days" maxlength="2" size="2">days</td></tr>
			</table>
			</div>
		</td>
		<td>
			<div id="by_weight_view" style="display:none">
			<table>
			<tr><td colspan="2"><b><u>Weight At Admission:</u></b></td></tr>
			<tr><td><b>From :</td></b><td><input type="text" name="from_wt_kgs" size="2" maxlength="3">kgs <input type="text" name="from_wt_gms" size="2" maxlength="3">gms</td></tr>
			<tr><td><b>To :</b></td><td><input type="text" name="to_wt_kgs" size="2" maxlength="3">kgs <input type="text" name="to_wt_gms" size="2" maxlength="3">gms</td></tr>
			</table>
			</div>
		</td>
		<td>
			<div id="gestation" style="display:none">
			<table>
			<tr><td colspan="2"><b><u>No. of weeks</u></b></td></tr>
			<tr><td><b>>37</td></b><td><input type="radio" name="gest_weeks" value=">37"></td></tr>
			<tr><td><b>34-37</td></b><td><input type="radio" name="gest_weeks" value="34-37"></td></tr>
			<tr><td><b><34</td></b><td><input type="radio" name="gest_weeks" value="<34"></td></tr>
			</table>
			</div>
		</td>
		<td>
			<div id="inborn-outborn" style="display:none">
			<table>
			<td><b>Inborn</td></b><td><input type="radio" name="delivery_location_type" value="IN"></td>
			<td><b>Outborn</td></b><td><input type="radio" name="delivery_location_type" value="OUT"></td>
			</table>
			</div>
		</td>
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

function gestation() {
if(document.getElementById("gest_weeks").checked)
{document.getElementById("gestation").style.display="block";}
else {document.getElementById("gestation").style.display="none";}
}

function inborn_outborn() {
if(document.getElementById("in_out").checked)
{document.getElementById("inborn-outborn").style.display="block";}
else {document.getElementById("inborn-outborn").style.display="none";}
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

