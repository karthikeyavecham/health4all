<script src="../scripts/datepicker.js"></script>
<script src="../scripts/registration.js"></script>
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
			<td><input type="button" id="button_gyn_1" value="Audiology" onclick="reveal_gyn('div_gyn_1','button_gyn_1');" style="width:100%;background:#febbbb"></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
		<div style="border: 1px solid #B0B0B0; width:100%; height:100%; overflow:auto;">
			<div id="div_gyn_1" style="display:block; ">

					<?php 
						include("db_connect.php");
						mysql_connect("$dbhost","$dbuser","$dbpass");
						mysql_select_db("$dbdatabase");
						$retreive="SELECT * FROM audiology";
						$audiology=mysql_fetch_array(mysql_query($retreive));
					?>
				<table id="table-tab">
					<tr>
							<td>Date of Test*</td>
							<td><input type="text" name="date_of_test" id="rdatepicker" value="<?php echo $audiology['date_of_test'];?>" style='text-transform:capitalize'></td>
						
							<td>Type of test</td>
							<td><input type="text" name="type_of_test" value="<?php echo $audiology['type_of_test'];?>" style='text-transform:capitalize' value="OAE"></td>
							
						</tr>
						<tr>
							<td>Audiology Test No.</td>
							<td><input type="text" name="test_no" value="<?php echo $audiology['test_no'];?>" style='text-transform:capitalize'></td>
							<td>Test performed by</td>
							<td><select name="audiologist_id" id="audiologist_id" style="width:155px;">
									<option selected="selected" value="">--Select--</option>
									<?php
									include("db_connect.php");
									mysql_connect("$dbhost","$dbuser","$dbpass");
									mysql_select_db("$dbdatabase");
									$sql=mysql_query("select * from staff JOIN audiology ON audiology.audiologist_id=staff.staff_id WHERE staff_role='Audiologist'");
									while($row=mysql_fetch_array($sql))
									{
										$id=$row['staff_id'];
										$data=$row['name'];
										echo '<option value="'.$id.'" name="'.$data.'"';									if($row['audiologist_id']==$id){echo " selected ";}
									echo '>'.$data.'</option>';
									}
									?>
								</select>
							</td>
							
						</tr>
						<tr>
							<td>OAE-LE Outcome</td>
							<td>
								<?php
								$pos = ''; 
								$neg = ''; 
								if($audiology['oael_outcome']=="Positive")
								{
									$pos = 'checked="checked"';
								} 
								else if($audiology['oael_outcome']=="Negative") 
								{
									$neg = 'checked="checked"';
								} echo "<input type=\"radio\" id=\"positive\" name=\"oael_outcome\" ondblclick=\"this.checked=!this.checked\" value=\"Positive\"" . $pos . ">Positive</input>";
								echo "<input type=\"radio\" id=\"negative\" name=\"oael_outcome\" ondblclick=\"this.checked=!this.checked\" value=\"Negative\"" . $neg . ">Negative</input>"; ?>
							</td>
							<td>OAE-RE Outcome</td>
							<td>
								<?php
								$pos = ''; 
								$neg = ''; 
								if($audiology['oaer_outcome']=="Positive")
								{
									$pos = 'checked="checked"';
								} 
								else if($audiology['oaer_outcome']=="Negative") 
								{
									$neg = 'checked="checked"';
								} echo "<input type=\"radio\" id=\"positive\" name=\"oaer_outcome\" ondblclick=\"this.checked=!this.checked\" value=\"Positive\"" . $pos . ">Positive</input>";
								echo "<input type=\"radio\" id=\"negative\" name=\"oaer_outcome\" ondblclick=\"this.checked=!this.checked\" value=\"Negative\"" . $neg . ">Negative</input>"; ?>
							</td>
														
						</tr>
						<tr>
							<td>Remarks</td>
							<td>
							<textarea type="text" name="remarks" style='text-transform:capitalize'><?php echo $audiology['remarks'];?></textarea></td>
						</tr>
				</table>
			</div>			
		</div>
		</td>
	</tr>
</table>
