<script type="text/javascript">
	var uTable = $("#user_table");
	var addUserForm = $('#add-user-form');
	var profileImageHolder = $('#image-holder');
	$(document).ready(function(){
		if (uTable[0]) {
			$.fn.editable.defaults.mode = 'inline';
			var aoColumnDefs = [
			{
				"aTargets": [0, 1, 5, 6,7],
				"bSortable": false
			}];
			usertableoptions = {
				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
				dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>rtp",
				buttons: [
					{extend: 'csv',title: 'Be Sure User Listing', className: 'btn-sm'},
					{extend: 'pdf', title: 'Be Sure User Listing', className: 'btn-sm'},
					{extend: 'print',className: 'btn-sm'}
				],
				"aoColumnDefs": aoColumnDefs,
				aaSorting: [[2, 'asc']],
				serverSide: true,
				processing: true,
				ajax: {
					url: "<?= @base_url('Dashboard/API/getUsers'); ?>",
					type: "POST",
					error: function(){
						console.log("There was an error pulling in your data");
					}
				},
				fnRowCallback: function( nRow, mData, iDisplayIndex){
					$('span[class^="user_"]', nRow).editable({
						source: [
							{value: "superadmin", text: 'Super Admin'},
							{value: "admin", text: "Admin"}
						]
					});
					return nRow;
				}
			};

			var oTable = uTable.DataTable(usertableoptions);
		}

		if(addUserForm[0]){
			addUserForm.validate({
				rules: {
					email: {
						required: true,
						email: true,
						remote: {
							url: "<?= @base_url('Dashboard/API/checkEmailExists'); ?>",
							type: "POST"
						}
					}
				},
				messages: {
					email: {
						required: "Please enter your email address.",
						email: "Please enter a valid email address.",
						remote: "Email already in use!"
					}
				}
			});
		}

		if(profileImageHolder[0]){
			profileImageHolder.hover(function(){
				$('#image-backdrop').show();
			}, function(){
				$('#image-backdrop').hide();
			});

			$('#image-backdrop').click(function(){
				$('input[name="user_avatar"]')[0].click();
			});

			$('input[name="user_avatar"]').change(function(){
				readURL(this);
				$('#save-changes').show();
			});

			toastr.options = {
				"debug": false,
				"newestOnTop": false,
				"positionClass": "toast-top-center",
				"closeButton": true,
				"toastClass": "animated fadeInDown",
			};
			var savechanges = $('#save-changes');
			var ladda_save = savechanges.ladda();

			$('#inputForm').submit(function(e){
				e.preventDefault();
				formdata = new FormData(this);
				$.ajax({
					url: "<?= @base_url('Dashboard/API/uploadUserImage'); ?>",
					type: "POST",
					data: formdata,
					processData: false,
					contentType: false,
					beforeSend: function(){
						ladda_save.ladda('start');
					},
					success: function(res){
						ladda_save.ladda('stop');
						toastr.success(res.message);
					},
					error: function(jqXHR, textStatus, error){
						ladda_save.ladda('stop');
						response = jqXHR.responseJSON;
						toastr.error(response.message);
					}
				});
			});

			$('#userdetailsForm').validate({
				rules: {
					user_firstname: {
						required: true
					},
					user_lastname: {
						required: true
					},
					user_username: {
						minlength: 5,
						remote: {
							url: "<?= @base_url('Dashboard/API/checkUsernameExists'); ?>",
							type: "POST"
						}
					},
					user_email: {
						required: true,
						email: true,
						remote: {
							url: "<?= @base_url('Dashboard/API/checkEmailExists'); ?>",
							type: "POST"
						}
					}
				},
				messages: {
					user_username: {
						remote: "This username is already in use"
					},
					user_email: {
						remote: "This email address is already in use"
					}
				}
			});

			$('#reset_password').click(function(){
				swal({
					title: "Confirmation!",
					text: "By requesting for a reset, your session will be closed and you will be required to go to your email and complete the process. Continue?",
					type: "info",
					showCancelButton: true,
					closeOnConfirm: false,
					showLoaderOnConfirm: false,
				}, function(){
					window.location = "<?php echo base_url('Dashboard/User/resetpass/' . $this->session->userdata('user_id')) ?>";
				});
			});
		}
	});

	function readURL(input) {

		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				document.getElementById('image-holder').style.backgroundImage = "url(" + e.target.result + ")"; 
			}

			reader.readAsDataURL(input.files[0]);
		}
	}
</script>