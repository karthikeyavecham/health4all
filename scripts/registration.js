    $(function() {
	$("#department").change(function() {
	
	$('#unit option').show();
		$('#unit option').show();
		$('#area option').show();
		if($(this).data('unitoptions') == undefined){
		/*Taking an array of all options-2 and kind of embedding it on the select1*/
		$(this).data('unitoptions',$('#unit option').clone());
		$(this).data('areaoptions',$('#area option').clone());
		} 
		var id = $(this).val();
		var unitoptions = $(this).data('unitoptions').filter('[name=' + id + ']');
		var areaoptions = $(this).data('areaoptions').filter('[name=' + id + ']');
		$('#unit').html(unitoptions);
		$('#unit').prepend('<option value="" selected="selected" >--Select--</option>');
		$('#area').html(areaoptions);
		$('#area').prepend('<option value="" selected="selected" >--Select--</option>');
		
			if(id=="22"){
				$("#gynic_button").show();} 
			else {
				$("#gynic_button").hide();
			}
	});
	
	$('#name').blur(function() {
	if($('#name').val()=="") {$("strong").remove(); $('<strong style="color:red;">  Required!</strong>').appendTo('#namet'); }
	else {$("strong").remove();}
	});
	setInterval(function(){if(document.getElementById("datepicker").value!=0){getAge(document.getElementById("datepicker").value);}},100);

    $( "#tabs" ).tabs();
	$('#datepicker').datepicker();
	$('#lmp').datepicker();
	$('#edd').datepicker();
	$('#baby_dob').datepicker();
	$('#suture_removal_date').datepicker();
	$('#dod').datepicker();
	$( '#vdatepicker' ).datepicker();
	$( '#odatepicker' ).datepicker();
	$( '#rdatepicker' ).datepicker();
	$( '#ddatepicker' ).datepicker();
	$( '#treatment_date' ).datepicker();
	$( '#vtimepicker' ).timeEntry();
	$( '#otimepicker' ).timeEntry();
	$( '#dtimepicker' ).timeEntry();
	$( '#treatment_time' ).timeEntry();
	
	$("#del_loc").click(function(){
    	$("#del_type").show();
 	 });
	$("#del_home,#del_enroute").click(function(){
    	$("#del_type").hide();
  	});
	if(document.getElementById("del_loc").checked){document.getElementById("del_type").style.visibility="visible";}
	else document.getElementById("del_type").style.display="none";	
	$("#out_death,#out_transfer,#out_lama,#out_abscond,#out_discharge").click(function(){
    	$("#outcome_dt").show();
 	 });
	 if(document.getElementById("out_discharge").checked || document.getElementById("out_lama").checked || document.getElementById("out_death").checked || document.getElementById("out_abscond").checked || document.getElementById("out_transfer").checked){document.getElementById("outcome_dt").style.visibility="visible";}
	else document.getElementById("outcome_dt").style.display="none";
	$("#mlc_yes").click(function(){
    	$("#mlc_y").show();
 	 });
	$("#mlc_no").click(function(){
    	$("#mlc_y").hide();
  	});
	if(document.getElementById("mlc_yes").checked){document.getElementById("mlc_y").style.visibility="visible";}
	else document.getElementById("mlc_y").style.display="none";
	
	
	$("#nicu_adm_yes").click(function(){
    	$("#nicuadm1").show();
		$("#nicuadm2").show();
 	 });
	 
	$("#nicu_adm_no").click(function(){
    	$("#nicuadm1").hide();
		$("#nicuadm2").hide();
		$("#nicu_adm_cause").val("");
 	 });
	 
    });
	
	
		
	function DaysInMonth(Y, M) {
    	with (new Date(Y, M, 1, 12)) {
        setDate(0);
        return getDate();
   	} }	
	
	function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    var d = today.getDate() - birthDate.getDate();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--; m += 12;
	}
	if (d < 0) {
        m--;
        d += DaysInMonth(age, m);
    	}
   document.getElementById("age").value=age;
   document.getElementById("age_months").value=m;
   document.getElementById("age_days").value=d;

	}
	
