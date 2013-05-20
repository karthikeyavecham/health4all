function validateForm()
	{
		var cdate=document.forms["issue_reg"]["call_date"].value;
		var ctime=document.forms["issue_reg"]["call_time"].value;
		var cft=document.forms["issue_reg"]["call_information_type"].value;
		var cf=document.forms["issue_reg"]["call_information"].value;
		
		if (cdate==null || cdate=="")
		{
			alert("\"Call Date\" must be filled out");
			return false;
		}
		if (ctime==null || ctime=="")
		{
			alert("\"Call Time\" must be filled out");
			return false;
		}
		if (cft==null || cft=="")
		{
			alert("\"Call Information Type\" must be filled out");
			return false;
		}
		if (cf==null || cf=="")
		{
			alert("\"Call Information\" must be filled out");
			return false;
		}
	}
	
		/*---------------------------------------------------------*/
	
function validate_equip()
	{
				
		var et=document.forms["equip_reg"]["equipment_type_id"].value;
		var sn=document.forms["equip_reg"]["serial_number"].value;
		var an=document.forms["equip_reg"]["asset_number"].value;
		var d=document.forms["equip_reg"]["department_id"].value;
		
		if (et==null || et=="")
		{
			alert("\"Equipment Type\" must be filled out");
			return false;
		}
		if ((sn==null || sn=="") & (an==null || an==""))
		{
			alert("Atleast \"Asset Number\" OR \"Serial Number\" must be filled");
			return false;
		}
		if (d==null || d=="")
		{
			alert("\"Department\" must be filled out");
			return false;
		}
		
		
	}
	
function validate_report_3(){
    
	if($("input[type=checkbox]:checked").length == 0)
    {
    alert('Please Select Equipment you Want to Update');
    return false;
    }
	
	var ri=document.forms["reg_issue_form"]["request_id_3"].value;
	if (ri!="")
		{
			var r = confirm("There exists an Issue for this Equipment! Do you want to Register new Request?");
				if (r)
				  {
				  return true;
				  }
				else
				  {
				  return false;
				  }
				  
			// var dialog = $('<p>Are you sure?</p>').dialog({
                    // buttons: {
                        // "Yes": function() {alert('you chose yes');},
                        // "No":  function() {alert('you chose no');},
                        // "Cancel":  function() {
                            // alert('you chose cancel');
                            // dialog.dialog('close');
                        // }
                    // }
					// })
			// if(dailog==true){}
		}
	
}
	
function validate_report_2(){
    
	if($("input[type=checkbox]:checked").length == 0)
    {
    alert('Please Select Equipment you Want to Update');
    return false;
    }
	var ri=document.forms["up_issue_form"]["request_id_2"].value;
	if (ri=="")
		{
			alert("There is no Issue Registered before for this Equipment");
			return false;
		}
	
}

function validate_report_1(){
    
	if($("input[type=checkbox]:checked").length == 0)
    {
    alert('Please Select Equipment you Want to Update');
    return false;
    }
}

	
$(document).ready(function () {
	var $unique = $('input.checkbox');
	$unique.click(function() {
    $unique.filter(':checked').not(this).removeAttr('checked');
	var $val=this.value;
	var parts = $val.split('.');
	var p1 = parts[0];
	var p2 = parts[1];
	$("#equipment_id_1").val(p1);
	$("#equipment_id_3").val(p1);
	$("#request_id_2").val(p2);
	$("#request_id_3").val(p2);
	});
	});