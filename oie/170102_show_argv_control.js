function show_argv_control(op,argv_split){

		if (typeof $.cookie(op+'_argv') === 'undefined'){
			$.cookie(op+'_argv',argv_split[0])		
		}	

		argv_control='<select id="argv_selector" onchange="send_ajax(\''+op+'\',this.value)">';
		a=Number(argv_split[0]);
		b=Number(argv_split[1]);
		c=Number(argv_split[2]);
		for (var i = a; i <= b; i=i+c) {
			argv_control+='<option value="'+i+'" >'+i+'</option>';
		}
		argv_control+='</select>';

		
		$('#argv_control').html(argv_control);
		$('#argv_selector').val($.cookie(op+'_argv')).attr('selected', true);
		//send_ajax(op,$.cookie(op+'_argv'));

		$('#argv_selector').change(function() {
			$.cookie(op+'_argv', $(this).val(), {expires: 365});
		})

	}
