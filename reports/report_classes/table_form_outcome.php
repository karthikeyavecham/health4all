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
	<td width="200px"><input type="checkbox" id="gest_weeks" onclick="outcomeView();">Outcome Type</td>	
	<td width="200px"><input type="checkbox" id="duration_days" onclick="durationView();">Duration</td>
	<td width="200px"><input type="checkbox" id="death_weight" onclick="deathWeightView();">Weight at Death</td>
	<td width="200px"><input type="checkbox" id="age_death" onclick="ageDeathView();">Age at Death</td>

	</tr>
	<tr>
		<td>
			<div id="outcome" style="display:none">
			<table>
			<tr><td><b>Transfer</td></b><td><input type="radio" name="outcome" value="transfer"></td></tr>
			<tr><td><b>Discharge</td></b><td><input type="radio" name="outcome" value="discharge"></td></tr>
			<tr><td><b>LAMA</td></b><td><input type="radio" name="outcome" value="lama"></td></tr>
			<tr><td><b>Absconded</td></b><td><input type="radio" name="outcome" value="absconded"></td></tr>
			<tr><td><b>Death</td></b><td><input type="radio" name="outcome" value="death"></td></tr>
			</table>
			</div>
		</td>

		<td>
			<div id="duration" style="display:none">
			<table>
			<tr><td><b> <1 day </td></b><td><input type="radio" name="duration_days" value="<1"></td></tr>
			<tr><td><b> 1-3 days </td></b><td><input type="radio" name="duration_days" value="1-3"></td></tr>
			<tr><td><b> 4-7 days </td></b><td><input type="radio" name="duration_days" value="4-7"></td></tr>
			<tr><td><b> >7days </td></b><td><input type="radio" name="duration_days" value=">7"></td></tr>
			</table>
			</div>
		</td>

		<td>
			<div id="deathweight" style="display:none">
			<table>
			<tr><td><b> >2500 gm </td></b><td><input type="radio" name="weight_death" value=">2500"></td></tr>
			<tr><td><b> 1500-2499 gm </td></b><td><input type="radio" name="weight_death" value="1500-2499"></td></tr>
			<tr><td><b> 1000-1499 gm </td></b><td><input type="radio" name="weight_death" value="1000-1499"></td></tr>
			<tr><td><b> <1000 gm </td></b><td><input type="radio" name="weight_death" value="<1000"></td></tr>
			</table>
			</div>
		</td>

		<td>
			<div id="agedeath" style="display:none">
			<table>
			<tr><td><b> <1day </td></b><td><input type="radio" name="death_age" value="<1"></td></tr>
			<tr><td><b> 1-6 days </td></b><td><input type="radio" name="death_age" value="1-6"></td></tr>
			<tr><td><b> >=7days </td></b><td><input type="radio" name="death_age" value=">=7"></td></tr>
			</table>
			</div>
		</td>

	</tr>
</table>

<input type="submit" name="submit">


<script>

function outcomeView()
 {
	if(document.getElementById("gest_weeks").checked)
	{
		document.getElementById("outcome").style.display="block";
	}
	else
 	{
		document.getElementById("outcome").style.display="none";
	}
}

function durationView()
{
	if(document.getElementById("duration_days").checked)
	{
		document.getElementById("duration").style.display="block";
	}
	else 
	{
		document.getElementById("duration").style.display="none";
	}
}

function deathWeightView()
{
	if(document.getElementById("death_weight").checked)
	{
		document.getElementById("deathweight").style.display="block";
	}
	else 
	{
		document.getElementById("deathweight").style.display="none";
	}
}

function ageDeathView()
{
	if(document.getElementById("age_death").checked)
	{
		document.getElementById("agedeath").style.display="block";
	}
	else 
	{
		document.getElementById("agedeath").style.display="none";
	}
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

