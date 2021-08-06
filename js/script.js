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

	// when sort control is changed
	$('#sortType').on('change', function () {
		$('#showSort').load("loadSorting.php", { kind: $(this).val() });

		if ($(this).val() == "daily") {
			$(function(){
				$('#wholeContent').load("loaders/table_content_daily.php");
				$('#table_summary').load("loaders/table_content_summary.php");

				//BOSS DITONG PART UN, di nya maapply tong datepicker
				$(function(){
					$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
				});
			});

		} 
		else {
			$('#wholeContent').load("loaders/table_content_weekly.php");
			// to load summary table
			$('#table_summary').load("loaders/table_content_summary.php");
		}
	});

	// when daily datepicker change
	$("#datepicker").on('change', function() {
		var date = $(this).datepicker({ dateFormat: 'dd-mm-yy' }).val();
		
		for(let i = 0; i < tables.length; i++) {
			$(tables[i]).load("table_content.php", {
				datepicker : date,
				table_sql : tables_sql[i]
			});
		}

		// to load summary table
		$('#table_summary').load("loaders/table_content_summary.php", { date } );
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

// when datepickerS at weekly change: EITHER start or end 
function date_begin_change(accessByEndDate) {
	
	var start = document.getElementById('date_begin').value;
	var origDate = new Date(start), end; 
	
	//if end date has been edited
	if(accessByEndDate == "true") {
		end = document.getElementById('date_end').value;
		
		for (let i = 0; i < tables.length; i++) {
			// load the content while giving the 2 dates
			$(tables[i]).load('loaders/tbody_content_weekly.php', { 
				start, end, table: tables_sql[i]
			});
		}
		//load summary table
		$('#table_summary').load("loaders/table_content_summary.php",
			 { date_begin: start, date_end: end } 
		);
	} 
	// else it is a starting date change
	else {
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

		for (let i = 0; i < tables.length; i++) {
			// load the content while giving the 2 dates
			$(tables[i]).load('loaders/tbody_content_weekly.php', { 
				start, end, table: tables_sql[i]
			});
		}
		
		//load summary table
		$('#table_summary').load("loaders/table_content_summary.php", 
			{ date_begin: start, date_end: end } 
		);
	}	
}

