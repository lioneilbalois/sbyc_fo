const tables = ["#table_cash", "#table_dp", "#table_ck", "#table_cc", "#table_pr"];
const tables_sql = ["cash_trans", "depslip_trans", "check_trans", "credit_trans", "pr_trans", "bill_trans"];

// gets Date then adds period(days)
const addDays = (dt, period) => {
	dt.setDate(dt.getDate() + period);
};

// apply datepick triggerred by onmouseover event: WORKING PERO PALAGI NYA IRRUN
function datepick_apply(){
	$(function(){
		$("#datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
	});
}

// for detecting if date is PAST
// $('#datepicker').datepicker().change(evt => {
// 	var selectedDate = $('#datepicker').datepicker('getDate');
// 	var now = new Date();
// 	now.setHours(0,0,0,0);
// 	if (selectedDate < now) {
// 	alert("Selected date is in the past");
// 	} else {
// 	  alert("Selected date is NOT in the past");
// 	}
// });

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

// for loading the print_page.php into the iframe with dates
function print_me(){
	var type = $('#sortType').val();
	var date_start, date_end, src;

	src = `php/print_page.php?type='${type}'&date=`;
	
	if(type == "daily") {
		date_start = $('#datepicker').val();
		src += `'${date_start}'`;
	} else {
		date_start = $('#date_begin').val();
		date_end = $('#date_end').val();
		src += `'${date_start}'&date_end='${date_end}'`;
	}
	
	//document.head.insertAdjacentHTML( 'beforeend', '<link rel="stylesheet" href="../css/print_styles.css"/>' );
	// iframe set src based from the print_page.php with given dates
	document.getElementById('iframe').setAttribute('src', src);

	// print the iframe content
	$('#iframe').bind('load', 
		function() { 
			window.frames['iframe'].focus(); 
			window.frames['iframe'].print(); 
		}
	);
}