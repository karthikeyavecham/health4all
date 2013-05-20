<script src="../scripts/datepicker.js"></script>
<script type="text/javascript" src="scripts/jquery.timeentry.min.js"></script>
<script type="text/javascript">
	function reveal_gyn(div,button){
		var e=document.getElementById(div);
		var b=document.getElementById(button);
		if(e.style.display=="none"){
			for(var i=1;i<=4;i++){
				var m="div_gyn_"+i;
				var k=document.getElementById(m)
				k.style.display="none"
				var n="button_gyn_"+i;
				var j=document.getElementById(n)
				j.style.background="#eee"
				}
			e.style.display="block";
			b.style.background="#febbbb";
		} else {
			for(var i=1;i<=4;i++){
				var m="div_gyn_"+i;
				var k=document.getElementById(m)
				k.style.display="none"
				}
				b.style.background="#eee";
		}
		 return true;
		}
</script>
<table width="100%">
	<tr>
		<td>
			<table>
			<tr>
			<td><input type="button" id="button_gyn_1" value="Marital Info" onclick="reveal_gyn('div_gyn_1','button_gyn_1');" style="width:100%;background:#febbbb"></td>
			<td><input type="button" id="button_gyn_2" value="Obstetric History" onclick="reveal_gyn('div_gyn_2','button_gyn_2');" style="width:100%;"></td>
			<td><input type="button" id="button_gyn_3" value="Menstrual History" onclick="reveal_gyn('div_gyn_3','button_gyn_3');" style="width:100%;"></td>
			<td><input type="button" id="button_gyn_4" value="Antenatal Visit" onclick="reveal_gyn('div_gyn_4','button_gyn_4');" style="width:100%;"></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
		<div style="border: 1px solid #B0B0B0; width:100%; height:100%; overflow:auto;">
			<div id="div_gyn_1" style="display:block; ">
			<?php $record_gyn=mysql_fetch_array(mysql_query("SELECT * FROM marital_info")); ?>
			<table id="table-tab">
					<tr>
						<td>Marital Status <b style="color:red">*</b></td>
						<td><select name="marital_status" value="<?php echo $record_gyn['marital_status']; ?>">
							<option value="" selected>---SELECT---</option>
							<option value="married">Married</option>
							<option value="unmaried">Unmarried</option>
							<option value="seperated">Seperated</option>
						</select></td>
					</tr>
					<tr>
						<td>Marital Life(yrs)</td>
						<td><input type="text" size="3" maxlength="3" name="marital_life" value="<?php echo $record_gyn['marital_life']; ?>"></td>
					</tr>
					<tr>
						<td>Consanguinous</td>
						<td><input type="radio" name="consanguinous" value="<?php echo $record_gyn['consanguinous']; ?>">Yes
						<input type="radio" name="consanguinous" value="<?php echo $record_gyn['consanguinous']; ?>">No</td>
					</tr>
			</table>
			</div>
			<div id="div_gyn_2" style="display:none; ">
			<script type="text/javascript" src="tabs/gynic/gynic.js"></script>
				<table id="table-tab">
					<tr>
						<td>Gestation</td>
						<td><input type="text" id="baby_gestation" size="3" maxlength="3"></td>
						<td>LMP</td>
						<td><input type="text" id="lmp"></td>
					</tr>
					<tr>
						<td>EDD</td>
						<td><input type="text" id="edd"></td>
						<td>AFI</td>
						<td><input type="text" id="afi"></td>
					</tr>
					<tr>
						<td>Anesthesia Type</td>
						<td><input type="text" id="anesthesia_type"></td>
						<td>Placenta</td>
						<td><input type="text" id="placenta"></td>
					</tr>
					<tr>
						<td>Outcome</td>
						<td><select id="baby_outcome">
							<option value="" selected>---SELECT---</option>
							<option value="aborted">Aborted</option>
							<option value="term">Term</option>
							<option value="preterm">Pre-Term</option>
						</select></td>
						<td>Delivery Mode</td>
						<td>
							<select id="baby_delivery_mode">
								<option value="" selected>---SELECT---</option>
								<option value="SPVD">SPVD</option>
								<option value="EL-LSCS">EL-LSCS</option>
								<option value="EM-LSCS">EM-LSCS</option>
								<option value="Assisted Breech Delivery">Assisted Breech Delivery</option>
								<option value="Forcepts">Forcepts</option>
								<option value="Vaccuum Extraction">Vaccuum Extraction</option>
								<option value="Episiotomy">Episiotomy</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Sex <b style="color:red">*</b></td>
						<td>
							<input type="radio" id="sex1" name="sex_baby" value="M"> Male </input>
							<input type="radio" id="sex2" name="sex_baby" value="F"> Female </input>
						</td>
						<td>Birth Weight</td>
						<td><input type="text" id="baby_birth_weight" size="3" maxlength="3"></td>
					</tr>
					<tr>
						<td>Date Of Birth</td>
						<td><input type="text" id="baby_dob"></td>
						<td>APGAR</td>
						<td><input type="text" id="apgar"></td>
					</tr>
					<tr>
						<td>Suture Removal Date</td>
						<td><input type="text" id="suture_removal_date"></td>
						<td>Booking Status</td>
						<td><select id="booking_status">
								<option value="" selected>---SELECT---</option>
								<option value="booked">Booked</option>
								<option value="unbooked">Unbooked</option>
						</select></td>
					</tr>
					<tr>
						<td>Nicu Admission</td>
						<td><input type="text" id="nicu_admission"></td>
						<td>Nicu Admission Reason</td>
						<td><input type="text" id="nicu_admission_reason"></td>
					</tr>
					<tr>
						<td>Cause of Death</td>
						<td><input type="text" id="cause_of_death"></td>
						<td>Date of discharge</td>
						<td><input type="text" id="dod"></td>
					</tr>
					
					<tr>
						<td colspan="4" align="center"><INPUT type="button" value="Add This To List" onclick="addRow_gynic('dataTable1')" />    <INPUT type="button" value="Delete From the List" onclick="deleteRow_gynic('dataTable1')" /></td>
					</tr>	
				</table>
					
				<div style="border:1px; overflow:auto;">
				<table id="dataTable1">
					<tr id="dataTablehead1" hidden>
						<th></th>
						<th>Gestation</th>
						<th>Lmp</th>
						<th>Edd</th>
						<th>AFI</th>
						<th>Anesthesia Type</th>
						<th>Placenta</th>
						<th>Outcome</th>
						<th>Delivery Mode</th>
						<th>Sex</th>
						<th>Birth Weight</th>
						<th>Date Of Birth</th>
						<th>Apgar</th>
						<th>Suture Removal Date</th>
						<th>Booking Status</th>
						<th>Nicu Admission</th>
						<th>Nicu Admission Reason</th>
						<th>Cause of Death</th>
						<th>Date of discharge</th>
					</tr>
					<tr hidden>
						<td><input type="checkbox" name="chk"/></td>
						<td><input type="text" name="baby_gestation[]" ></td>
						<td><input type="text" name="lmp[]" ></td>
						<td><input type="text" name="edd[]" ></td>
						<td><input type="text" name="afi[]" ></td>
						<td><input type="text" name="anesthesia_type[]" ></td>
						<td><input type="text" name="placenta[]" ></td>
						<td><input type="text" name="baby_outcome[]" ></td>
						<td><input type="text" name="baby_delivery_mode[]" ></td>
						<td><input type="text" name="sex[]" ></td>
						<td><input type="text" name="baby_birth_weight[]" ></td>
						<td><input type="text" name="baby_dob[]" ></td>
						<td><input type="text" name="apgar[]" ></td>
						<td><input type="text" name="suture_removal_date[]" ></td>
						<td><input type="text" name="booking_status[]" ></td>
						<td><input type="text" name="nicu_admission[]" ></td>
						<td><input type="text" name="nicu_admission_reason[]" ></td>
						<td><input type="text" name="cause_of_death[]" ></td>
						<td><input type="text" name="dod[]" ></td>
					</tr>
				</table>
				<table>
				<?php
					$query_obstetric= "SELECT * 
							FROM obstetric_history 
							WHERE patient_id='".$record_gyn['patient_id']."'";
					
					$result_obstetric = mysql_query($query_obstetric);
					if(mysql_num_rows($result_obstetric)!= 0) { ?>
					<tr>
						<th>Gestation</th>
						<th>Lmp</th>
						<th>Edd</th>
						<th>AFI</th>
						<th>Anesthesia Type</th>
						<th>Placenta</th>
						<th>Outcome</th>
						<th>Delivery Mode</th>
						<th>Sex</th>
						<th>Birth Weight</th>
						<th>Date Of Birth</th>
						<th>Apgar</th>
						<th>Suture Removal Date</th>
						<th>Booking Status</th>
						<th>Nicu Admission</th>
						<th>Nicu Admission Reason</th>
						<th>Cause of Death</th>
						<th>Date of discharge</th>
					</tr>
				<?php	
					while($record_obstetric = mysql_fetch_array($result_obstetric)){
				?>
					<tr>
						<td><input type="text" name="baby_gestation[]" value="<?php echo $record_obstetric['gestation']; ?>"></td>
						<td><input type="text" name="lmp[]" value="<?php echo $record_obstetric['lmp']; ?>"></td>
						<td><input type="text" name="edd[]" value="<?php echo $record_obstetric['edd']; ?>"></td>
						<td><input type="text" name="afi[]" value="<?php echo $record_obstetric['afi']; ?>"></td>
						<td><input type="text" name="anesthesia_type[]" value="<?php echo $record_obstetric['anesthesia_type']; ?>"></td>
						<td><input type="text" name="placenta[]" value="<?php echo $record_obstetric['placenta']; ?>"></td>
						<td><input type="text" name="baby_outcome[]" value="<?php echo $record_obstetric['outcome']; ?>"></td>
						<td><input type="text" name="baby_delivery_mode[]" value="<?php echo $record_obstetric['delivery_mode']; ?>"></td>
						<td><input type="text" name="sex[]" value="<?php echo $record_obstetric['sex']; ?>"></td>
						<td><input type="text" name="baby_birth_weight[]" value="<?php echo $record_obstetric['birth_weight']; ?>"></td>
						<td><input type="text" name="baby_dob[]" value="<?php echo $record_obstetric['dob']; ?>"></td>
						<td><input type="text" name="apgar[]" value="<?php echo $record_obstetric['apgar']; ?>"></td>
						<td><input type="text" name="suture_removal_date[]" value="<?php echo $record_obstetric['suture_removal_date']; ?>"></td>
						<td><input type="text" name="booking_status[]" value="<?php echo $record_obstetric['booking_status']; ?>"></td>
						<td><input type="text" name="nicu_admission[]" value="<?php echo $record_obstetric['nicu_admission']; ?>"></td>
						<td><input type="text" name="nicu_admission_reason[]" value="<?php echo $record_obstetric['nicu_admission_reason']; ?>"></td>
						<td><input type="text" name="cause_of_death[]" value="<?php echo $record_obstetric['cause_of_death']; ?>"></td>
						<td><input type="text" name="dod[]" value="<?php echo $record_obstetric['dod']; ?>"></td>
					</tr>
				<?php } 
				}?>
				</table>
				</div>
			</div>
			<div id="div_gyn_3" style="display:none; ">
			<?php    
				$query_menstrual= "SELECT * 
						FROM menstrual_history 
						WHERE visit_id='".$record_gyn['patient_id']."'";
				
				$result_menstrual = mysql_query($query_menstrual);
				$count_menstrual= mysql_num_rows($result_menstrual);
				if($count_menstrual==1){
				$record_menstrual = mysql_fetch_array($result_menstrual);}
			?>
				<table id="table-tab">
					<tr>
						<td>Regularity <b style="color:red">*</b></td>
						<td><select name="regularity">
								<option value="" <?php if($count_menstrual==1){if($record_menstrual['regularity']==""){echo "selected";}}?> >---SELECT---</option>
								<option value="regular" <?php if($count_menstrual==1){if($record_menstrual['regularity']=="regular"){echo "selected";}}?> >Regular</option>
								<option value="irregular" <?php if($count_menstrual==1){if($record_menstrual['regularity']=="irregular"){echo "selected";}}?> >Irregular</option>
						</select></td>
						<td>Cycle</td>
						<td><input type="text" name="cycle" <?php if($count_menstrual==1){echo "value=\"".$record_menstrual['cycle']."\"";}?> ></td>
					</tr>
					<tr>
						<td>Flow Amount</td>
						<td><select name="flow_amount">
								<option value="" <?php if($count_menstrual==1){if($record_menstrual['flow_amount']==""){echo "selected";}}?>>---SELECT---</option>
								<option value="normal" <?php if($count_menstrual==1){if($record_menstrual['flow_amount']=="normal"){echo "selected";}}?> >Normal</option>
								<option value="heavy" <?php if($count_menstrual==1){if($record_menstrual['flow_amount']=="heavy"){echo "selected";}}?> >Heavy</option>
						</select></td>
						<td>Dysmenorrhea</td>
						<td><input type="text" size="3" maxlength="3" name="dysmenorrhea" <?php if($count_menstrual==1){echo "value=\"".$record_menstrual['dysmenorrhea']."\"";}?> ></td>
					</tr>
				</table>
		
			</div>
			<div id="div_gyn_4" style="display:none; ">
			<?php    
				$query_antenatal= "SELECT * 
						FROM antenatal_visit 
						WHERE visit_id='".$record_gyn['patient_id']."'";
				
				$result_antenatal = mysql_query($query_antenatal);
				$count_antenatal= mysql_num_rows($result_antenatal);
				if($count_antenatal==1){
				$record_antenatal = mysql_fetch_array($result_antenatal);}
			?>
				<table id="table-tab">
					<tr>
						<td>Fundal Height</td>
						<td><input type="text" name="fundal_height" <?php if($count_antenatal==1){echo "value=\"".$record_antenatal['fundal_height']."\"";}?>></td>
						<td>Presentation <b style="color:red">*</b></td>
						<td><input type="text" name="presentation" <?php if($count_antenatal==1){echo "value=\"".$record_antenatal['presentation']."\"";}?>></td>
					</tr>
					<tr>
						<td>Fetal Heart Rate</td>
						<td><input type="text" name="fetal_heart_rate" <?php if($count_antenatal==1){echo "value=\"".$record_antenatal['fetal_heart_rate']."\"";}?>></td>
						<td>liquor</td>
						<td><input type="text" name="liquor" <?php if($count_antenatal==1){echo "value=\"".$record_antenatal['liquor']."\"";}?>></td>
					</tr>
					<tr>
						<td>Scan Finding</td>
						<td><input type="text" name="scan_finding" <?php if($count_antenatal==1){echo "value=\"".$record_antenatal['scan_finding']."\"";}?>></td>
						<td>Advice</td>
						<td><input type="text" name="advice" <?php if($count_antenatal==1){echo "value=\"".$record_antenatal['advice']."\"";}?>></td>
					</tr>	
				</table>
			</div>
		</div>
		</td>
	</tr>
</table>
<?php
/*
VERSION TRACK
1 - 16May2013 - Yashasvi - BUG RESOLVED - repeat display of Marital Info
*/
?>
