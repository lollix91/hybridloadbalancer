	/*
	
	START CONFIG
	
	*/

	
	
	//default settings:
    var multiService = 
	[
	{
		serviceName : "easyservice",
        urls : [
			{ baseUrl : "http://localhost/hybridloadbalancer/serverT1", healthCheckUrl : "http://localhost/hybridloadbalancer/serverT1/health"},
			{ baseUrl : "http://localhost/hybridloadbalancer/serverT2", healthCheckUrl : "http://localhost/hybridloadbalancer/serverT2/health"}
		],
		
    }
	];
	
	
	
	/*
	
	END CONFIG
	
	*/
	




	(function ($) {
		$.getLoadBalanced = function () {

			//implement load balancing algorithm (round robin or health check), better call directly and the health check made before or after
			//better after, because now i know in which service i'm interested so i can call healthcheck and, in case false, remove temporary
			//the server from settings
			
			//and name matching with serviceName and add the operation in the end function(serviceName, operation, params?)
			$.get(multiService[0].urls[0].baseUrl+"/"+multiService[0].serviceName+"/"+"text", function(data, status){			
				if(status == "success") {
					var values = jQuery.parseJSON(data);
					alert(data);
				}
			});
		}
	})(jQuery);
	
	
	
	/*$.ajaxSetup({
    beforeSend: function (xhr,settings) {
		alert(multiService[0].urls[0].baseUrl);
        alert(settings.data);
        alert(settings.url);
    }
	});*/
	