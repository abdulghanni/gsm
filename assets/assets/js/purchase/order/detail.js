$(document).ready(function() {

});
	function approve1()
	{
	    $('#btnApp').text('saving...'); //change button text
	    $('#btnApp').attr('disabled',true); //set button disable 
	    var url = "../approve";
	    // ajax adding data to database
	    $.ajax({
	        url : url,
	        type: "POST",
	        data: $('#formApp1').serialize(),
	        dataType: "JSON",
	        success: function(data)
	        {
	            if(data) //if success close modal and reload ajax table
	            {
	                $('#formApp1').modal('hide');
	                location.reload();
	            }
	            else
	            {
	                for (var i = 0; i < data.inputerror.length; i++) 
	                {
	                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
	                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
	                }
	            }
	            $('#btnApp').text('save'); //change button text
	            $('#btnApp').attr('disabled',false); //set button enable 


	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data');
	            $('#btnApp').text('save'); //change button text
	            $('#btnApp').attr('disabled',false); //set button enable 

	        }
	    });
	}

	function approve2()
	{
	    $('#btnApp').text('saving...'); //change button text
	    $('#btnApp').attr('disabled',true); //set button disable 
	    var url = "../approve";
	    // ajax adding data to database
	    $.ajax({
	        url : url,
	        type: "POST",
	        data: $('#formApp2').serialize(),
	        dataType: "JSON",
	        success: function(data)
	        {
	            if(data) //if success close modal and reload ajax table
	            {
	                $('#formApp2').modal('hide');
	                location.reload();
	            }
	            else
	            {
	                for (var i = 0; i < data.inputerror.length; i++) 
	                {
	                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
	                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
	                }
	            }
	            $('#btnApp').text('save'); //change button text
	            $('#btnApp').attr('disabled',false); //set button enable 


	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data');
	            $('#btnApp').text('save'); //change button text
	            $('#btnApp').attr('disabled',false); //set button enable 

	        }
	    });
	}

	function approve3()
	{
	    $('#btnApp').text('saving...'); //change button text
	    $('#btnApp').attr('disabled',true); //set button disable 
	    var url = "../approve";
	    // ajax adding data to database
	    $.ajax({
	        url : url,
	        type: "POST",
	        data: $('#formApp3').serialize(),
	        dataType: "JSON",
	        success: function(data)
	        {
	            if(data) //if success close modal and reload ajax table
	            {
	                $('#formApp3').modal('hide');
	                location.reload();
	            }
	            else
	            {
	                for (var i = 0; i < data.inputerror.length; i++) 
	                {
	                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
	                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
	                }
	            }
	            $('#btnApp').text('save'); //change button text
	            $('#btnApp').attr('disabled',false); //set button enable 


	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data');
	            $('#btnApp').text('save'); //change button text
	            $('#btnApp').attr('disabled',false); //set button enable 

	        }
	    });
	}

	function approve4()
	{
	    $('#btnApp').text('saving...'); //change button text
	    $('#btnApp').attr('disabled',true); //set button disable 
	    var url = "../approve";
	    // ajax adding data to database
	    $.ajax({
	        url : url,
	        type: "POST",
	        data: $('#formApp4').serialize(),
	        dataType: "JSON",
	        success: function(data)
	        {
	            if(data) //if success close modal and reload ajax table
	            {
	                $('#formApp4').modal('hide');
	                location.reload();
	            }
	            else
	            {
	                for (var i = 0; i < data.inputerror.length; i++) 
	                {
	                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
	                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
	                }
	            }
	            $('#btnApp').text('save'); //change button text
	            $('#btnApp').attr('disabled',false); //set button enable 


	        },
	        error: function (jqXHR, textStatus, errorThrown)
	        {
	            alert('Error adding / update data');
	            $('#btnApp').text('save'); //change button text
	            $('#btnApp').attr('disabled',false); //set button enable 

	        }
	    });
	}