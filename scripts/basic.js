function htGio(){
	var d = new Date();
	var gio = d.getHours();
	var phut = d.getMinutes();
	var giay = d.getSeconds();
	
	
	
	var ngay = d.getDate();
	var thang = d.getMonth() + 1;
	var nam = d.getFullYear();

	var thu = d.getDay();

	switch(thu)
	{
		case 0: thu = "Chủ Nhật"; break;
		case 1: thu = "Thứ Hai"; break;
		case 2: thu = "Thứ Ba"; break;
		case 3: thu = "Thứ Tư"; break;
		case 4: thu = "Thứ Năm"; break;
		case 5: thu = "Thứ Sáu"; break;
		case 6: thu = "Thứ Bảy"; break;
	}
	var s = "Hôm nay: "+thu+", ";
	s += ((ngay<10) ? '0' : '') + ngay+ '/';
	s += ((thang<10) ? '0' : '') + thang+'/';
	s += nam + ' - ';
	s += (gio>12) ? (gio-12) : gio;
	s += ((phut<10) ? ':0' : ':') + phut;
	s += ((giay<10) ? ':0' : ':') + giay;
	s += (gio>12) ? ' Chiều' : ' Sáng';
	
	document.getElementById('time').innerHTML= s;
	
	var t = setTimeout('htGio()',1000);
}

function openTabDonHang(evt, id){
	var i, tabcontent, tabs;

	tabcontent = document.getElementsByClassName("tabcontent");
	for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	}

	tabs = document.getElementsByClassName("tab");
	for (i = 0; i < tabs.length; i++) {
		tabs[i].className = tabs[i].className.replace(" active", "");
	}

	document.getElementById(id).style.display = "block";
	evt.currentTarget.className += " active";
}