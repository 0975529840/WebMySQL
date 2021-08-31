<?php
	session_start();//cho phép dùng session ở trang này
    if(isset($_SESSION['username']) || isset($_COOKIE['username'])){
        
    }else{
        echo "<meta http-equiv='refresh' content='0.1;url=login.php'>";
    }
	require 'database/database.php'
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>DoAnThietKe</title>
	<link rel="icon" type="image/x-icon" href="img/II&IL.ico">
	<link rel="stylesheet" href="style/Web.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="js/Web.js" type="text/javascript"></script>
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
</head>

<body onload="UpdateData()">
	
	<div class="container">
		<img src="img/II&IL.png" alt="">
		<h2>Đồ án Thiết kế</h2>
		<h3>Sensor</h3>
		<div id="">
			<form name="myfrom"  accept-charset="utf-8">
				<span>Mức nước(ml): </span>
				<input type="text" class="inputcss" name="mucnuoc" id="mucnuoc" readonly>	
				<span>Nhiệt độ(C):</span>
				<input type="text" class="inputcss" name="nhietdo" id="nhietdo" readonly>	
				<input type="button" name="" onclick="SendValue()"value="Update">
				<input type="hidden" name="BTcheck" id="BTcheck">
				<p>Date Update: <span id="DateUpdate"></span></p>	
			</form>
		</div>	
		<div id="empcontainerMN" class ="empcontainer"></div>	
		<div id="empcontainerND" class ="empcontainer"></div>	
	</div>	
</body>
<script>
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
</script>
</html>