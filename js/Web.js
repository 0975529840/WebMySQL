// viết hàm javascript => phục vụ sự kiện xảy ra khi mình tương , nhận dữ liệu 

var dateJson="";
function SendValue()
{
	var DataSend = 1; 
	$.ajax({
		type: "POST",
		url: 'WEBControl.php',
		dataType: 'json',
		data: {
			BTcheck: DataSend,
		},
	});
}
function UpdateData()
{
	var xhttp = new XMLHttpRequest();

	xhttp.onreadystatechange = function ()
	{
		if(this.readyState == 4 && this.status == 200)
		{

			var DataVDK  = xhttp.responseText;
			console.log("Database MYSQL:" + DataVDK);	 

			HienThi(DataVDK);
		}         
	};



	xhttp.open('GET','WEBReadDB.php',true);
	xhttp.send(); 
	setTimeout(function(){ UpdateData() }, 5000);
}

function  HienThi(DataVDK)
{

	var DataJson = JSON.parse(DataVDK);		

	if(DataJson.ND != null)
	{
		document.getElementById("nhietdo").value = DataJson.ND;
	}

	if(DataJson.DA != null)
	{
		document.getElementById("mucnuoc").value = DataJson.DA;
	}

	if(DataJson.BTcheck != null)
	{
		document.getElementById("BTcheck").value = DataJson.BTcheck;
	}
	if(DataJson.date != null)
	{
		document.getElementById("DateUpdate").innerHTML = DataJson.date;
		dateJson=DataJson.date;
	}
	myFunction();
}
$(function () {
	$('#empcontainerMN').highcharts({
		chart: {
			type: 'line'
		},
		title: {
			text: 'Lượng nước(ml)'
		},
		xAxis: {
			categories: categories
		},
		yAxis: {
			title: {
				text: 'Lượng nước(ml)'
			}
		},
		credits:{
			enabled: false
		},
		series: [{
			name: 'Lượng nước',
			data: dataMN
		}],
	});
});
$(function () {
	$('#empcontainerND').highcharts({
		chart: {
			type: 'line'
		},
		title: {
			text: 'Nhiệt độ(C)'
		},
		xAxis: {
			categories: categories
		},
		yAxis: {
			title: {
				text: 'Nhiệt độ(C)'
			}
		},
		credits:{
			enabled: false
		},
		series: [{
			name: 'Nhiệt độ',
			data: dataND
		}],
	});
});
var dataND=[0, 0, 0, 0, 0];

var dataMN=[0, 0, 0, 0, 0];

var categories=['0h', '1h', '2h','3h','4h'];

function myFunction(){
	var time=new Date();
	dataND.shift();
	dataMN.shift();
	categories.shift();
	dataND.push(parseInt(document.getElementById("nhietdo").value));
	dataMN.push(parseInt(document.getElementById("mucnuoc").value));
	categories.push(dateJson);
	console.log(dataMN);
	console.log(dataND);
	console.log(categories);
	$(function () {
		$('#empcontainerMN').highcharts({
			chart: {
				type: 'line'
			},
			title: {
				text: 'Lượng nước(ml)'
			},
			xAxis: {
				categories: categories
			},
			yAxis: {
				title: {
					text: 'Lượng nước(ml)'
				}
			},
			credits:{
				enabled: false
			},
			series: [{
				name: 'Lượng nước',
				data: dataMN
			}],
		});
	});
	$(function () {
		$('#empcontainerND').highcharts({
			chart: {
				type: 'line'
			},
			title: {
				text: 'Nhiệt độ(C)'
			},
			xAxis: {
				categories: categories
			},
			yAxis: {
				title: {
					text: 'Nhiệt độ(C)'
				}
			},
			credits:{
				enabled: false
			},
			series: [{
				name: 'Nhiệt độ',
				data: dataND
			}],
		});
	});    
}

