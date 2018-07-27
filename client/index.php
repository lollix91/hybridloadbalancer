<html>
<head>
<title>Client</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="../library/hybridlb.js"></script>

<style>

</style>


</head>
<body>


<form>
<input type="button" id="submitapi" value="Send Data"></input>

<div id="scores">
</div>

</form>



<script type="text/javascript" >

	var initialTime = 0;
	var curit = -2;
	
	$.ajaxSetup({
    complete: function (xhr,settings) {
		var datetime = new Date();
		$("#scores").html($("#scores").html()+(curit + " - " + (datetime.getTime()-initialTime)/1000)+"<br>");
		curit++;
    }
	});
	
	$("#submitapi").click(function () {		

		var datetime = new Date();
		initialTime = datetime.getTime();
	
		for(var i = 0; i<100; i++)
			$.getLoadBalanced();
	
	});

	
	

</script>






</body>
</html>