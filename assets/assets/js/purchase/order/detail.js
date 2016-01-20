$(document).ready(function() {

});

function approve()
	{
	    $('#btnApp').text('saving...'); //change button text
	    $('#btnApp').attr('disabled',true); //set button disable 
	    var url = "../approve";
	    // ajax adding data to database
	    $.ajax({
	        url : url,
	        type: "POST",
	        data: $('#formApp').serialize(),
	        dataType: "JSON",
	        success: function(data)
	        {
	            if(data) //if success close modal and reload ajax table
	            {
	                $('#formApp').modal('hide');
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