
/**
 @author Diego Martín
 @copyright Hive®
 @version 1.0.1
 @since 1.0.0
 @see https://github.com/diegogermanicom/hive
 @license MIT
 
 DISCLAIMER:
 Modifying or altering any part of the original code is not recommended,
 as it could compromise the stability, security or operation of the system.
 Any changes made will be the sole responsibility of the person who makes them.
 You can add custom code to add new features.
*/

var ADMIN = {
    // Init
    init: function() {
        this.menuLeftEvents();
        this.sendLoginEvent();
        this.sitemapEvent();
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
                    pass: $('#input-pass').val().trim(),
                    remember: ($('#checkbox-admin-remember:checked').val() == undefined) ? 0 : 1
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
                                UTILS.showInfo('Uups', data.login.message);
                            }
                        }
                    });
                }
            });
        }    
    },
    sitemapEvent: function() {
        if($('body#admin-sitemap').length != 0) {
            $("#btn-create-sitemap").off().on("click", function() {
                var btn = $(this);
                if(!btn.hasClass('disabled')) {
                    btn.addClass('disabled');
                    $.ajax({
                        url: ADMIN_PATH + '/create-new-sitemap',
                        data: {},
                        success: function(data) {
                            if(data.sitemap.response == 'ok') {
                                btn.addClass('btn-ok');
                                UTILS.showInfo(data.sitemap.title, data.sitemap.message);
                            } else {
                                btn.removeClass('disabled');
                                UTILS.showInfo('Uups', data.sitemap.message);
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