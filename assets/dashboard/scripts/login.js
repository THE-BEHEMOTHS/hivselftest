var login_buton = $('#login');
var ladda_login = login_buton.ladda();

toastr.options = {
	"debug": false,
	"newestOnTop": false,
	"positionClass": "toast-top-center",
	"closeButton": true,
	"toastClass": "animated fadeInDown",
};

ladda_login.click(function(){
	var url = $('#loginForm').attr('action');
	$.ajax({
		url: url,
		type: "POST",
		data: $('#loginForm').serialize(),
		beforeSend: function(){
			ladda_login.ladda('start');
		},
		error: function(jqXHR, textStatus, error){
			ladda_login.ladda('stop');
			response = jqXHR.responseJSON;
			toastr.error(response.message);
		}
	})
	.done(function(res){
		ladda_login.ladda('stop');
		toastr.success(res.message);
		window.setTimeout(function(){
			window.location = base_url + "Dashboard/";
		},2000)
	});
});