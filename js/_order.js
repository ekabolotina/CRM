$(document).ready(function(){

	$('#orderClientSelect').select2({
		ajax: {
			url: "/clients/all/getCientsList",
			dataType: 'json',
			type: 'POST',
			delay: 0,
			data: function(params){
				return {
					term: params.term
				};
			},			
			processResults: function(data){
				return { 
					results: $.map(data.data, function(it){
						return {
							id: it.id, 
							text: it.name
						}
					})
				}
			},	
			cache: true
		},
		minimumInputLength: 1,
		width: '100%',
		placeholder: 'Выберите клиента'
	});

	$('#orderCarSelect').select2({
		ajax: {
			url: "/auto/all/getAutoList",
			dataType: 'json',
			type: 'POST',
			delay: 0,
			data: function(params){
				return {
					term: params.term
				};
			},			
			processResults: function(data){
				return { 
					results: $.map(data.data, function(it){
						return {
							id: it.id, 
							text: it.name
						}
					})
				}
			},	
			cache: true
		},
		minimumInputLength: 1,
		width: '100%',
		placeholder: 'Выберите автомобиль'
	});

	$('input[name=date_from], input[name=date_till], input[name=client_birthday], input[name=client_passport_date]').datepicker({
	    todayBtn: 'linked',
	    language: 'ru',
	    multidate: false,
	    todayHighlight: true,
	    format: {
	        toDisplay: function(date, format, language){
	            var d = new Date(date),
	            	day = d.getDate(),
	            	month = d.getMonth()+1,
	            	year = d.getFullYear();
	            return day + '.' + ((month < 10) ? '0' : '') + month + '.' + year;
	        },
	        toValue: function (date, format, language){
	            var d = new Date(date);
	            return year + '-' + ((month < 10) ? '0' : '') + month + '-' + day;
	        }
	    },
	    autoclose: true	    		
	});	

});