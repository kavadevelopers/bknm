	function ifsc_to_branch(ifsc)
    {
    	ifsc = ifsc.value;
    	if(ifsc != '')
    	{	
    		var array = ifsc.split(' - ');
    		$('#branch').val(array[1]);
    	}
    	else{
    		$('#branch').val('');
    	}
        
    }



    



    