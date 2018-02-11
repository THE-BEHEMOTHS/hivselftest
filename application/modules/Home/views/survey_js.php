<script> 
   $(document).ready(function(){
		var survey = localStorage.getItem('survey') || -1;
		if(survey === -1){
	    	$('#myModal').on('shown.bs.modal', function () {
			  $('#myInput').focus()
			});
			$('#myModal').modal('show');
	    }

		$('#survey-form').validate({
			rules: {
				age: {
					required: true
				},
				gender: {
					required: true
				},
				kit: {
					required: true
				}
			},
			messages : {
				age: {
					required: "Please enter your Age"
				},
				gender: {
					required: "Please select your Gender"
				},
				kit: {
					required: "Please select at least one kit"
				}
			},
			submitHandler: function(form){
				var formData = $('#survey-form').serialize();

				surveySubmit(formData);
			}
		});


	function surveySubmit(formData){
	  // alert(formData);
		$.ajax({
		   	type: "POST",
		   	url: "<?= @base_url('Home/Survey'); ?>",
		   	dataType: 'json',
			data: formData,
		   success: function(response){   
		   		if(response){
					swal({title: response.title,text: response.message,timer: 3000,showConfirmButton: true, type:response.type});
					localStorage.setItem('survey', 1);
					$('#myModal').modal('toggle');
                }
		   },
		   beforeSend:function()
		   {
			// swal({title: "Loading",text: "Sending your data",showConfirmButton: true});
		   }
	  	});
	}



    });
</script>