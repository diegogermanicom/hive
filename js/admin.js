/*
* Author: Diego Martin
* Copyright: Hive®
* Version: 1.0
* Last Update: 2023
*/   

var _loading = false;

$(window).ready(function() {
    init();
    events();
    events_login();
});

function init() {
    $.ajaxSetup({
    	type: 'POST',
    	dataType: "json",
    	error: function() {
    	    show_info('Error', 'An unexpected error has occurred.<br>Reload the page to try again.');
            _loading = false;
    	}
    });
}

function events() {
    $('#btn-hide-menu-left').on('click', function() {
        $(this).removeClass('active');
        $('#btn-show-menu-left').addClass('active');
        $('#menu-left').removeClass('active');
        $('#container-admin').addClass('expand');
    });
    $('#btn-show-menu-left').on('click', function() {
        $(this).removeClass('active');
        $('#btn-hide-menu-left').addClass('active');
        $('#menu-left').addClass('active');
        $('#container-admin').removeClass('expand');
    });
}

function events_login() {
    if($('body#admin-login-page').length != 0) {
        $("#btn-send-login").on("click", function() {
            var self = this;
            var obj = {
                email: $('#input-email').val().trim(),
                pass: $('#input-pass').val().trim()
            }
            $('.login-content *').removeClass('error');
            if(obj.email == '') {
                $('#input-email').addClass('error');
            }
            if(obj.pass == '') {
                $('#input-pass').addClass('error');
            }
            if(!$(this).hasClass('disabled') && $('.login-content .error').length == 0) {
                $(this).addClass('disabled');
                _loading = true;
                $.ajax({
                    url: ADMIN_PATH + '/send-login',
                    data: obj,
                    success: function(data) {
                        if(data.login.response == 'ok') {
                            $(self).addClass('btn-ok');
                            window.location.href = ADMIN_PATH + '/home?login';
                        } else {
                            $(self).removeClass('disabled');
                            show_info('Uups', data.login.mensaje);
                            _loading = false;    
                        }
                    }
                });
            }
        });
    }
}