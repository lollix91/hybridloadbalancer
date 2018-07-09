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
	
	//when loading the page, call the health check always to be sure which service is the freest
	$(document).ready(function() {
		
		$.doHealthCheck();
		
	});



	(function ($) {
		$.getLoadBalanced = function () {

			//implement load balancing algorithm (round robin or health check), better call directly and the health check made before or after
			//better after, because now i know in which service i'm interested so i can call healthcheck and, in case false, remove temporary
			//the server from settings
			
			//and name matching with serviceName and add the operation in the end function(serviceName, operation, params?)
			//but not needed for initial state
			$.get(multiService[0].urls[0].baseUrl+"/"+multiService[0].serviceName+"/"+"text", function(data, status){			
				if(status == "success") {
					var values = jQuery.parseJSON(data);
					alert(data);
				}
			});
		}
	})(jQuery);
	
	(function ($) {
		$.doHealthCheck = function () {

			//the healthcheck contains health parameters, server response time, data that with an algorithm can be used to improve the system
			//i need to pass the service name to retrieve the number of times the service is called (reqs)
			for(var i=0; i<multiService[0].urls.length; i++) {
				$.doExternalLoadHealth(multiService[0].urls[i].healthCheckUrl, i, multiService[0].serviceName);
			}
		}
	})(jQuery);
	
	
	(function ($) {
		$.doExternalLoadHealth = function (url, iValue, serviceName) {

			$.get(url, serviceName, function(data, status){			
				if(status == "success") {
					var values = jQuery.parseJSON(data);
					
					//now i assign scores
					multiService[0].urls[iValue].requestLast1Minute = values['last_minute'];
					multiService[0].urls[iValue].requestLast10Minute = values['last_ten_minutes'];
					multiService[0].urls[iValue].requestLast1MinuteLoad = values['server_load_last_minute'];
					multiService[0].urls[iValue].requestLast10MinuteLoad = values['server_load_last_ten_minutes'];
		
					//the score from 0 to other, infinity is perfect, 0 is worse
					//naturally it can be changed the algorithm here above
					
					//if the number is 1 the server is stable, if is <1 the number of requests is increasing, else is decreasing
					reqScore = multiService[0].urls[iValue].requestLast10Minute / 10; 
					reqScore = reqScore / multiService[0].urls[iValue].requestLast1Minute;
					loadScore = multiService[0].urls[iValue].requestLast10MinuteLoad / multiService[0].urls[iValue].requestLast1MinuteLoad;
					
					score = (reqScore + loadScore) / 2;

					alert(score+"score");
					
					multiService[0].urls[iValue].requestScore = reqScore;
					multiService[0].urls[iValue].loadScore = loadScore;
					multiService[0].urls[iValue].score = score;
					
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
	