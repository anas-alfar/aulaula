function showsrch(id, id2) {
	$("div#" + id).show();
	$("div#" + id2).hide();
	}

function showmore(id) {
	$("ul#" + id).slideToggle('fast');
	}

/*table hover over tr*/
$(function(){
	$("table.srch-rsult tr.hasover").mouseover(function(){
	//$("table.srch-rsult tr").addClass('mouseover');
	$(this).addClass('mouseover');
	$(this).next().removeClass('mouseover');
	$(this).prev().removeClass('mouseover');
	});
	$("table.srch-rsult tr.hasover").mouseout(function(){
	$(this).removeClass('mouseover');
   });
});
