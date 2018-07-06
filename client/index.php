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
</form>



<script type="text/javascript" >

	
	$("#submitapi").click(function () {		
		$.getLoadBalanced();
	});

	
	

</script>






</body>
</html>