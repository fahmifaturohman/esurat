let baseUrl = "http://localhost/esurat/";



//REGEX
let regexNumber = /^\d*[.]?\d*$/;


//FILE
function readImage(input) 
{
	if(input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function(e) 
		{
			$('#previewImage').attr('src', e.target.result);
			$('#previewImage').hide();
			$('#previewImage').fadeIn(650);
		}

		reader.readAsDataURL(input.files[0]);
	}
}

function getfileNeme(e)
{
	var val = e.target.files[0].name;
	return val;
}

function getfileSize(e)
{
	var val = e.target.files[0].size;
	return val;
}

function getfileExt(e,filename)
{
	var val = filename.split('.').pop().toLowerCase();
	return val;
}


function validateAjax(val ="", myUrl ="", id ="") {
    $.ajax({
        type: "POST",
        url: myUrl,
        data: val,
        dataType: "json",
        success: function (res) {
            if(res['success'] == true) error(id, res['msg'])
            else success(id)
        }
    })
}

function validateAjaxGet(myUrl ="", id ="") {
    $.ajax({
        type: "GET",
        url: myUrl,
        dataType: "json",
        success: function (res) {
            if(res['success'] == true) error(id, res['msg'])
            else success(id)
        }
    })
}

function ajaxDelete(myUrl ="", go = 0) {
	loading()
    $.ajax({
        type: "GET",
        url: baseUrl+myUrl,
        dataType: "json",
        success: function (res) {
            if(res['success'] == true) {                        
				toastNotify(res['msg'])
				setTimeout(function () { history.go(go)}, 500)
			}
			else toastNotify(res['msg'],0)
			loadingClose()
        }
    })
}

function postAjax(myurl = "", id = "", param = "", go = -1) {
	//loading()
	if(param == "") var dataPost = $(id).serialize()
	else var dataPost = param
	$.ajax({
		type: "POST",
		url: baseUrl+myurl,
		data: dataPost,
		dataType: "json",
		success: function (res) {			
			if(res['success'] == true) {                        
				toastNotify(res['msg'])
				setTimeout(function () { history.go(go)}, 500)
			}
			else toastNotify(res['msg'],0)
			loadingClose()
		},
		error: function (res) {
			console.log(res['responseJSON'])
		},
		failure: function (res) {
			console.log("failure")
		}
	}) 
}

function postAjaxLogin(myurl = "", id = "", param = "") {
	loading()
	if(param == "") var dataPost = $(id).serialize()
	else var dataPost = param
	$.ajax({
		type: "POST",
		url: baseUrl+myurl,
		data: dataPost,
		dataType: "json",
		success: function (res) {			
			if(res['success'] == true) {                        
				toastNotify(res['msg'])
				window.location = baseUrl;
			}
			else toastNotify(res['msg'],0)
			loadingClose()
		},
		error: function (res) {
			console.log(res['responseJSON'])
		},
		failure: function (res) {
			console.log("failure")
		}
	}) 
}



//SHOW 
function error(id,msg){
	$(id).addClass('no-valid');
	$(id).parent().find('.text-danger').show();
	$(id).parent('.input-group').parent().find('.text-danger').text(msg);
	$(id).parent('.input-group').parent().find('.text-danger').show();
	$(id).parent().find('.text-danger').text(msg);			
	$(id).closest('input').removeClass('is-valid');
	$(id).closest('input').addClass('is-invalid');
	$(id).closest('select').removeClass('is-valid');
	$(id).closest('select').addClass('is-invalid');
	$(id).closest('textarea').removeClass('is-valid');
	$(id).closest('textarea').addClass('is-invalid');
	$(id).closest('div.form-group').removeClass('has-error');
	$(id).closest('div.form-group').addClass('has-error');
}

function success(id)
{	
	$(id).removeClass('no-valid');
	$(id).parent().find('.text-danger').hide();		
	$(id).parent('.input-group').parent().find('.text-danger').text('');
	$(id).parent('.input-group').parent().find('.text-danger').hide();
	$(id).closest('input').removeClass('is-invalid')
	$(id).closest('select').removeClass('is-invalid')
	$(id).closest('textarea').removeClass('is-invalid');
	$(id).closest('div.form-group').removeClass('has-error');
}

function file_error(id,msg) {
	$(id).parent().find('.text-danger').show();
	$(id).parent().find('.text-danger').text(msg);
	$(id).closest('input').addClass('is-invalid');
}

function file_success(id)
{
	$(id).parent().find('.text-danger').hide();
	$(id).closest('input').removeClass('is-invalid');
	$(id).closest('input').addClass('is-valid');
	$(id).closest('div.form-group').removeClass('has-error');
}

//jquery loading modal
function loading(text = "L o a d i n g . . ."){
	$('body').loadingModal({
			text 			: text, 
			positionc		: 'auto',
			backgroundColor	: 'rgb(0, 0, 0)',
			animation 		: 'wave'
	});
}

function loadingClose() {
	$('body').loadingModal('destroy');
}

function alertDanger(msg = "Notifikasi") {
	var txt = `
		<div class="alert alert-danger alert-dismissible" role="alert"> 
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<strong>Gagal !</strong> ${msg} 
		</div>
	`;
	return txt;
}

function alertSuccess(msg = "Notifikasi") {
	var txt ='';
	txt += "<div class='col-md-12 alert bg-green text-dark alert-dismissable'>";
	txt += " <a href='#' class='close' data-dismiss='alert' aria-label='close'> ×</a> "+msg;
	txt += "</div>";
	return txt;
}



//TOASTR
function toastNotify(msg = "Notification", type=1, time = 3000) {
	toastr.options.timeOut = time;
	if(type == 0 ) toastr.error(msg, 'Error');
	else if(type == 1) toastr.success(msg, 'Success')
	else if(type == 2) toastr.warning(msg, 'Warning')
	else toastr.info(msg, 'Info')
}


function myHash(str = "") {
	
}



