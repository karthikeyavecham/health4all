       function addRow(tableID) {
			var val_treat = document.getElementById('treatment_date').value;
			if(val_treat == ""){ alert("Please Enter Treatment Date"); return false();}
			
			var val_treat = document.getElementById('treatment_type').value;
			if(val_treat == "0"){ alert("Please Select Treatment Type"); return false();}
			
			var table = document.getElementById(tableID);
 
            var rowCount1 = table.rows.length;
			if(rowCount1 > 1){
			$('#dataTablehead').show();
			}else{
			$('#dataTablehead').hide();
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
			var treatment_date = document.getElementById('treatment_date');
			var treatment_time = document.getElementById('treatment_time');
			var treatment_type = document.getElementById('treatment_type');
			var treatment = document.getElementById('treatment');
			var notes = document.getElementById('notes');
			var duration = document.getElementById('duration_days').value+","+document.getElementById('duration_hours').value+","+document.getElementById('duration_mins').value;
			
			var treatment_date_1 = document.getElementsByName('treatment_date[]');
			var treatment_time_1 = document.getElementsByName('treatment_time[]');
			var treatment_type_1 = document.getElementsByName('treatment_type[]');
			var treatment_1 = document.getElementsByName('treatment[]');
			var notes_1 = document.getElementsByName('notes[]');
			var duration_1 = document.getElementsByName('duration[]');
			
			treatment_date_1[rowCount].value=treatment_date.value;
			treatment_time_1[rowCount].value=treatment_time.value;
			treatment_type_1[rowCount].value=treatment_type.value;
			treatment_1[rowCount].value=treatment.value;
			notes_1[rowCount].value=notes.value;
			duration_1[rowCount].value=duration;
			
			treatment_date.value="";
			treatment_time.value="";
			treatment_type.value="0";
			treatment.value="";
			notes.value="";
			document.getElementById('duration_days').value="";
			document.getElementById('duration_hours').value="";
			document.getElementById('duration_mins').value="";
        }
 
        function deleteRow(tableID) {
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
			$('#dataTablehead').show();
			}else{
			$('#dataTablehead').hide();
			}
			
            }catch(e) {
                alert(e);
            }
        }
 