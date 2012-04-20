function showedit(id, id2) {
	$("ul#" + id).show();
	$("ul#" + id2).hide();
	}


function popUp(URL,w,h){
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width="+w+",height="+h+",left =20,top =20');")
}


var countRow = 2;

function addFriend(){
	if (countRow >= 11) {
 	return;
 	}
	oTable = document.getElementById('tellTable');
	oRow = oTable.insertRow(countRow);
	oRow.id = "row_" + countRow;
	oCell = oRow.insertCell(0);
	oCell.height = "30";
	oCell.align = "left";
	oCell.innerHTML = 'إسم صديقك:';
	oCell1 = oRow.insertCell(1);
	oCell1.innerHTML= '<input type="text" name="friendNames[]" class="inpt-txt" />';
	oCell2 = oRow.insertCell(2);
	oCell2.align = "left";
	oCell2.innerHTML= 'بريد صديقك اللإلكتروني:';
	oCell3 = oRow.insertCell(3);
//	oCell3.setAttribute("colspan" , "2" );
	oCell3.innerHTML= '<input type="text" size="30" name="friendEmails[]" class="inpt-txt" /> <a href="javascript:removeFriend('+countRow+')">حــذف</a>';
	countRow++;
}

function removeFriend(id) {
	var elem = document.getElementById("row_"+id);
	if(elem) {
	elem.parentNode.removeChild(elem);
	countRow--;
}
}