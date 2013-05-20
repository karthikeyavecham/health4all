
function aarogya_td() {
		if(document.getElementById("aarogya_yes").checked){
		document.getElementById("aarogya_number").removeAttribute('readonly');}
		if(document.getElementById("aarogya_no").checked){
		document.getElementById("aarogya_number").value='';
		document.getElementById("aarogya_number").setAttribute('readonly');}
		}

function validateForm()
	{
		var x=document.forms["reg"]["admit_date"].value;
		var y=document.forms["reg"]["admit_time"].value;
		var ocd=document.forms["reg"]["outcm_date"].value;
		var oct=document.forms["reg"]["outcm_time"].value;
		var pname=document.forms["reg"]["pname"].value;
		var mname=document.forms["reg"]["mother_name"].value;
		var fname=document.forms["reg"]["father_name"].value;
		if((pname==null || pname=="") && (mname==null || mname=="") && (fname==null || fname=="")){ alert("Please enter one of the following : Patient's name / Mother's name / Father's name.");return false;}
		if (x==null || x=="")
		{
			alert("Visit / Admit Date must be filled out");
			return false;
		}
		if (y==null || y=="")
		{
			alert("Visit / Admit Time must be filled out");
			return false;
		}
		if(document.getElementById("out_death").checked || document.getElementById("out_discharge").checked || document.getElementById("out_lama").checked || document.getElementById("out_abscond").checked || document.getElementById("out_transfer").checked)
		{
			if(ocd==null || ocd=="")
			{
				alert("Outcome Date must be filled out");return false;
			}
			if(oct==null || oct=="")
			{
				alert("Outcome Time must be filled out");return false;
			}
			
		}
	}

function validateForm_ip()
	{
		var x=document.forms["reg"]["admit_date"].value;
		var y=document.forms["reg"]["admit_time"].value;
		var ocd=document.forms["reg"]["outcm_date"].value;
		var oct=document.forms["reg"]["outcm_time"].value;
		if (x==null || x=="")
		{
			alert("Visit / Admit Date must be filled out");
			return false;
		}
		if (y==null || y=="")
		{
			alert("Visit / Admit Time must be filled out");
			return false;
		}
		if(document.getElementById("out_death").checked || document.getElementById("out_discharge").checked || document.getElementById("out_lama").checked || document.getElementById("out_abscond").checked || document.getElementById("out_transfer").checked)
		{
			if(ocd==null || ocd=="")
			{
				alert("Outcome Date must be filled out");return false;
			}
			if(oct==null || oct=="")
			{
				alert("Outcome Time must be filled out");return false;
			}
			
		}
	}

	
function validateForm_op()
	{
		var vt=document.forms["reg"]["visit_type"].value;
		var x=document.forms["reg"]["admit_date"].value;
		var y=document.forms["reg"]["admit_time"].value;
		var ocd=document.forms["reg"]["outcm_date"].value;
		var oct=document.forms["reg"]["outcm_time"].value;
		if (x==null || x=="")
		{
			alert("Visit / Admit Date must be filled out");
			return false;
		}
		if (y==null || y=="")
		{
			alert("Visit / Admit Time must be filled out");
			return false;
		}
		if(vt=="IP"){
		if (y==null || y=="")
		{
			alert("Admit Time must be filled out");
			return false;
		}}
		if(document.getElementById("out_death").checked || document.getElementById("out_discharge").checked || document.getElementById("out_lama").checked || document.getElementById("out_abscond").checked || document.getElementById("out_transfer").checked)
		{
			if(ocd==null || ocd=="")
			{
				alert("Outcome Date must be filled out");return false;
			}
			if(oct==null || oct=="")
			{
				alert("Outcome Time must be filled out");return false;
			}
			
		}
	}
function validateForm_opreg()
	{
		var opname=document.forms["opreg"]["name"].value;
		if(opname==null || opname=="") { alert("Please enter the Patient's Name."); return false;}
		var opgend = $("input[name='gender']:checked").val();
		if(opgend!="F" && opgend!="M") { alert("Gender to be filled"); return false;}
	}
	function validateForm_opregr()
	{
		var oprname=document.forms["opreg"]["pname"].value;
		if(oprname==null || oprname=="") { alert("Please enter the Patient's Name."); return false;}
	}

