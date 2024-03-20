/*
* Author: Diego Martin
* Copyright: Hive®
* Version: 1.0
* Last Update: 2023
*/   

var ADMIN = {
    // Init
    init: function() {
        this.menuLeftEvents();
        this.sendLoginEvent();
    },
    // Events
    menuLeftEvents: function() {
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
    },
    sendLoginEvent: function() {
        if($('body#admin-login-page').length != 0) {
            $("#btn-send-login").off().on("click", function() {
                var btn = $(this);
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
                if(!btn.hasClass('disabled') && $('.login-content .error').length == 0) {
                    btn.addClass('disabled');
                    $.ajax({
                        url: ADMIN_PATH + '/send-login',
                        data: obj,
                        success: function(data) {
                            if(data.login.response == 'ok') {
                                btn.addClass('btn-ok');
                                window.location.href = ADMIN_PATH + '/home?login';
                            } else {
                                btn.removeClass('disabled');
                                HIVE.showInfo('Uups', data.login.mensaje);
                            }
                        }
                    });
                }
            });
        }    
    }
}

$(window).ready(function() {
    ADMIN.init();
});