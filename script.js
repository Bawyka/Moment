$(document).ready(function(){
	
	var user_id;
	
	$.ajaxSetup({ cache: true });
	
	$.getScript('//connect.facebook.net/en_UK/all.js', function(){
		
		FB.init({
		  appId: {app id}, // your application id like this mask 444444056807411
		  status: true,
		  cookie: true,
		  xfbml: true
		});
		
		FB.login(function(response){ 

			if (response.authResponse) {
			
				FB.api("/me",function(me){
			
					user_id = me.id;
										
					// if this user is not in the base yet, we should add him to.
					$.post('contra.php', { userid: user_id, func: 'userexists', username: me.name });
							
					// then we should to get a tagged moments
					$.post('contra.php', { userid: user_id, func: 'getmoments' }, function(data){
					
						$('#moments').html(data);
					
					});
				
				});
				
			}
		
		});
		
	});
		
	// getting a people
	$('#parse').click(function(){
	
		var current_moment = $('#moments li.label a').text();
		
		if (current_moment!='') {
	
		$.post('contra.php', { func: 'parse', userid: user_id, labels: $('#labels').tagsinput('items'), moment: current_moment }, function(data){ $('#peoples').empty().append(data);  } );
		
		}
	
		return false;
	
	});
	
	// Getting a Labels
	$('#moments').on('click','li a',function(){
		
		var metka = $(this).text();
		
		$('#peoples').empty();
	
		$('#moments li').removeClass('label');
		$('#moments li').removeClass('label-info');
		
		$('#labels').tagsinput('removeAll');
		
		$.post('contra.php', { func: 'getlabels', metka: metka, userid: user_id } ,
		
			function(data){
								
				var metki = $.parseJSON(data);
				
				for (var j = 0; j <= metki.length; j++)
				{
					$('#labels').tagsinput('add',metki[j]);
				}
				
			});
	
		$(this).parent().addClass('label');
		$(this).parent().addClass('label-info');
		
		$('#moments li').css('border-bottom','1px solid #c2c2c2');
		
		$(this).parent().prev('li').css('border','0px');
				
		return false;
	
	});
	
	
	// New Moment
	$('.downblock').on('click','#new_moment',function(){
	
		if ($(this).text()=="save" && $('input[name="newmoment"]').val()!='') {
		
			// send to server a Moment Name
			$.post('contra.php', { userid: user_id, func: 'addmoment', moment: $('input[name="newmoment"]').val() }, function(data){
			
				$('#moments').append('<li>'+data+'</li>');
			
			});
			
			$(this).text('new');
			
			$('input[name="newmoment"]').hide();
			$('input[name="newmoment"]').val('');
		
		} else {
		
			$('input[name="newmoment"]').show();
			
			$(this).text('save');
		}
	
	});
	
	// removing moment
	$('#moments').on('click','.glyphicon-remove',function(){
	
		var moment = $(this).parent().find('a').text();
		
		element = $(this).parent();
		
		$.post('contra.php',{ func: 'remoment', userid: user_id, moment: moment },
		
			function(data){

				if (data=='1' || data==1) {
				
					element.hide();
					
				}
		
		});
	
	});

});