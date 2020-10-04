$(document).ready(function() {
	
	$('.assignbook').click(function(e){
			e.preventDefault();
		
			$(document).ready(function() {
	
				$('.assignbook').click(function(e){
						e.preventDefault();
				   $.get('assign/assignbook',function(data){
						$('#assignbook').modal('show')
							 .find('#assignbookContent')
							 .html(data);
					});
				});

				$('.addauthor').click(function(e){
					e.preventDefault();
				   $.get('book/addauthor',function(data){
						$('#addauthor').modal('show')
							 .find('#addauthorContent')
						 .html(data);
				});
				$('.returnbook').click(function(e){
					e.preventDefault();
				   $.get('book/returnbook',function(data){
						$('#returnbook').modal('show')
							 .find('#returnbookContent')
						 .html(data);
				});
			});
			});
			
	});
	
});
});