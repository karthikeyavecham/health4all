      $(document).ready(function(){
        $("#search_engine").submit(function(event) {

            /* stop form from submitting normally */
            event.preventDefault(); 
            $("#result_display").empty();
            $.post( 'search_result.php', $("#search_engine").serialize(),
              function( data ) {
                  $("#result_display").append(data);
              }
            );
          });
      });

    $(function() {
	$("#chapter").change(function() {

		$('#block option').show();
		if($(this).data('blockoptions') == undefined){
		/*Taking an array of all options-2 and kind of embedding it on the select1*/
		$(this).data('blockoptions',$('#block option').clone());
		} 
		var id = $(this).val();
		var blockoptions = $(this).data('blockoptions').filter('[name=' + id + ']');
		$('#block').html(blockoptions);
		$('#block').prepend('<option value="" selected="selected" >--Select--</option>');
		$('#code option').hide();
		$('#code').prepend('<option value="" selected="selected" >--Select--</option>');
		var fill = $("input#fill");
		fill.val("");
		});
		
	$("#block").change(function() { 
		$('#code option').show();
		if($(this).data('codeoptions') == undefined){
		/*Taking an array of all options-2 and kind of embedding it on the select1*/
		$(this).data('codeoptions',$('#code option').clone());
		} 
		var id = $(this).val();
		var codeoptions = $(this).data('codeoptions').filter('[name=' + id + ']');
		$('#code').html(codeoptions);
		$('#code').prepend('<option value="" selected="selected" >--Select--</option>');
		var fill = $("input#fill");
		fill.val("");
		});
    });

	$(document).ready(function () {
	var $unique = $('input.checkbox');
	$unique.click(function() {
    $unique.filter(':checked').not(this).removeAttr('checked');
	});
	});

function icd_fill(sid){        
		var fill = document.getElementById('fill');
		fill.value=sid;
}
function icd(){
		var sid = document.getElementById('fill').value;
		var parts = sid.split('.');
		var p1 = parts.slice(0,1).join('.');
		var p2 = parts.slice(1).join('.');
		var ckbx_arr=document.getElementsByName('checkbox');
		var ckbx_arr_ln=ckbx_arr.length; 
		for(var i=0;i<ckbx_arr_ln;i++){ 
		if(ckbx_arr[i].checked){
		var icd_10 = document.getElementsByName('icd_10[]');
		icd_10[i].value=p1;
		var icd_10_ext = document.getElementsByName('icd_10_ext[]');
		icd_10_ext[i].value=p2;
		ckbx_arr[i].checked = false; 
		}
		} 
}
function icd_1(sid){
		var parts = sid.split('.');
		var p1 = parts.slice(0,1).join('.');
		var p2 = parts.slice(1).join('.');
		var ckbx_arr=document.getElementsByName('checkbox');
		var ckbx_arr_ln=ckbx_arr.length; 
		for(var i=0;i<ckbx_arr_ln;i++){ 
		if(ckbx_arr[i].checked){
		var icd_10 = document.getElementsByName('icd_10[]');
		icd_10[i].value=p1;
		var icd_10_ext = document.getElementsByName('icd_10_ext[]');
		icd_10_ext[i].value=p2;
		ckbx_arr[i].checked = false;
		}
		} 
}
