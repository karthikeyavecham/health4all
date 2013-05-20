       function addRow_gynic(tableID) {
	   
			var child_sex_check = $("input[name='sex_baby']:checked").val();
			if(child_sex_check=="M" || child_sex_check=="F"){}else{alert("Please Select the gender of the child"); return false;}
						
			var table = document.getElementById(tableID);
 
            var rowCount1 = table.rows.length;
			
			
				if(rowCount1 > 1){
				$('#dataTablehead1').show();
				}else{
				$('#dataTablehead1').hide();
				}
						
            var rowCount = table.rows.length-1;
            var row = table.insertRow(rowCount1);
 
            var colCount = table.rows[0].cells.length;
 
            for(var i=0; i<colCount; i++) {
 
                var newcell = row.insertCell(i);
 
                newcell.innerHTML = table.rows[1].cells[i].innerHTML;
                //alert(newcell.childNodes);
                switch(newcell.childNodes[0].type) {
                    case "text":
                            newcell.childNodes[0].value = "";
                            break;
                    case "checkbox":
                            newcell.childNodes[0].checked = false;
                            break;
                    case "select-one":
                            newcell.childNodes[0].selectedIndex = 0;
                            break;
                }
            }
			
			
			var array_gyn=['baby_gestation','lmp','edd','afi','anesthesia_type','placenta','baby_outcome','baby_delivery_mode','baby_birth_weight','baby_dob','apgar','suture_removal_date','booking_status','nicu_admission','nicu_admission_reason','cause_of_death','dod'];
			
						
			for(var g=0;g<array_gyn.length;g++){
			var gynic_1 = array_gyn[g];
			var gynic_2 = document.getElementById(gynic_1);
			
			var gynic_3 = array_gyn[g];			
			var gynic_4 = document.getElementsByName(gynic_3+"[]");
						
			gynic_4[rowCount].value=gynic_2.value;
			
			gynic_2.value="";
			}
			
			
			var sex = $("input[name='sex_baby']:checked").val();
			var sex1 = document.getElementsByName('sex[]');
			sex1[rowCount].value=sex;
			$("input[name='sex_baby']").removeAttr('checked');
			
			
			
        }
 
        function deleteRow_gynic(tableID) {
            try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
 
            for(var i=0; i<rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if(null != chkbox && true == chkbox.checked) {
                    if(rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }
             }
			var rowCount1 = table.rows.length;

			
				if(rowCount1 > 2){
				$('#dataTablehead1').show();
				}else{
				$('#dataTablehead1').hide();
				}
			
			
            }catch(e) {
                alert(e);
            }
        }
 