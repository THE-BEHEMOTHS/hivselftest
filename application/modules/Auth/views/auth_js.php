<script type="text/javascript">
	$(document).ready(function(){
		$('#resetPassword').validate({
			rules: {
				new_password: {
					required: true,
					minlength: 5
				},
				confirm_password: {
					equalTo: "#new_password"
				}
			}
		});
	});
</script>