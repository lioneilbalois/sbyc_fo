const tables = ["#table_cash", "#table_dp", "#table_ck", "#table_cc", "#table_pr"];
const tables_sql = ["cash_trans", "depslip_trans", "check_trans", "credit_trans", "pr_trans"]

// gets Date then adds period(days)
const addDays = (dt, period) => {
	dt.setDate(dt.getDate() + period);
};

$(function(){
	$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
});

$(document).ready(function(){

	// $(document).bind('weeklySortSel', function(){
	// 	alert('weekly sort alert');
	// });

	$('#sortType').on('change', function () {
		$('#showSort').load("loadSorting.php", { kind: $(this).val() });

		if ($(this).val() == "daily") {
			$(function(){
				$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
				$('#wholeContent').load("loaders/table_content_daily.php");
			});

		} 
		else {
			$('#wholeContent').load("loaders/table_content_weekly.php");
			//$(document).trigger('weeklySortSel');
		}
	});

	$("#datepicker").on('change', function() {
		var date = $(this).datepicker({ dateFormat: 'dd-mm-yy' }).val();
		
		for(let i = 0; i < tables.length; i++) {
			$(tables[i]).load("table_content.php", {
				datepicker : date,
				table_sql : tables_sql[i]
			});
		}
	});

});

// for checking if amount tb has dot (decimal)
function hasDot(val){
	console.log(val);
	for(let i = 0; i < (val.length); i++){
		if((val[i]).charCodeAt(0) == 46) return true;
	} 
	return false;
}

function isNumber(evt, val) {
	evt = (evt) ? evt : window.event;	
	var charCode = (evt.which) ? evt.which : evt.keyCode;
	
	
	if (charCode < 48 || charCode > 57) {
		if (charCode == 46 && hasDot(val) == false) return true;
		
		return false;
	}
	return true;
}

function date_begin_change() {
	
	var start = document.getElementById('date_begin').value;
	var origDate = new Date(start), end; 
	
	// apply the adding of days to the startig date above
	addDays(origDate, 6);

	// chopped varibles of the date
	var date = origDate.getDate(), month = origDate.getMonth() + 1, year = origDate.getFullYear();

	//make all single-sigit dates and months has 0 (to fulfill the required format)
	if (month < 10) month = `0${month}`;
	if (date < 10) date = `0${date}`;

	end = `${year}-${month}-${date}`;
	// update ending date
	$('#date_end').val(end);		

	// load the content while giving the 2 dates
	$('#tbody_cash').load('loaders/tableContent.php', { 
		start, end
	});
}
