/*
* Author: Diego Martin
* Copyright: Hive®
* Version: 1.0
* Last Update: 2024
*/   

var APP = {
    // Init
    init: function() {
        this.acceptCookiesEvent();
        this.sendNewsletterEvent();
        this.sendLoginEvent();
        this.sendRegisterEvent();
        this.chooseLanguageEvent();
    },
    // Events
    acceptCookiesEvent: function() {
        $("#btn-acepta-cookies").off().on("click", function() {
            var btn = $(this);
            var obj = {
                dato: true
            }
            if(!btn.hasClass('disabled')) {
                btn.addClass('disabled');
                $.ajax({
                    url: PUBLIC_PATH + '/set-cookies',
                    data: obj,
                    success: function(data) {
                        if(data.cookie.response == 'ok') {
                            btn.addClass('btn-ok');
                            $('#popup-cookies').removeClass('active');
                        } else {
                            HIVE.showInfo('Error', 'An unexpected error has occurred.<br>Reload the page to try again.');
                            btn.removeClass('disabled');
                        }
                    }
                });
            }
        });
    },
    sendNewsletterEvent: function() {
        $("#btn-send-newsletter").off().on("click", function() {
            var btn = $(this);
            var obj = {
                email: $('#input-send-newsletter').val().trim()
            }
            $('.newsletter-content *').removeClass('error');
            if(!HIVE.validate('email', obj.email)) {
                $('#input-send-newsletter').addClass('error');
            }
            if($('#checkbox-send-newsletter:checked').val() == undefined) {
                $('#checkbox-send-newsletter').addClass('error');
            }
            if(!btn.hasClass('disabled') && $('.newsletter-content .error').length == 0) {
                btn.addClass('disabled');
                $.ajax({
                    url: PUBLIC_PATH + '/save-newsletter',
                    data: obj,
                    success: function(data) {
                        if(data.newsletter.response == 'ok') {
                            btn.addClass('btn-ok');
                            HIVE.showInfo(data.newsletter.title, data.newsletter.description);
                        } else {
                            HIVE.showInfo('Error', 'An unexpected error has occurred.<br>Reload the page to try again.');
                            btn.removeClass('disabled');
                        }
                    }
                });    
            }
        });    
    },
    sendLoginEvent: function() {
        $("#btn-send-login").on("click", function() {
            var btn = $(this);
            var obj = {
                email: $('#input-login-email').val().trim(),
                pass: $('#input-login-pass').val().trim(),
                remember: ($('#checkbox-login-remember:checked').val() == undefined) ? 0 : 1
            }
            $('.login-content *').removeClass('error');
            if(!HIVE.validate('email', obj.email)) {
                $('#input-login-email').addClass('error');
            }
            if(obj.pass == '' || obj.pass.length < 8) {
                $('#input-login-pass').addClass('error');
            }
            if(!btn.hasClass('disabled') && $('.login-content .error').length == 0) {
                btn.addClass('disabled');
                $.ajax({
                    url: PUBLIC_PATH + '/login-send',
                    data: obj,
                    success: function(data) {
                        if(data.login.response == 'ok') {
                            btn.addClass('btn-ok');
                            window.location.href = data.login.url;
                        } else {
                            HIVE.showInfo('Uups', data.login.mensaje);
                            btn.removeClass('disabled');
                        }
                    }
                });    
            }
        });    
    },
    sendRegisterEvent: function() {
        $("#btn-send-register").on("click", function() {
            var btn = $(this);
            var obj = {
                email: $('#input-register-email').val().trim(),
                name: $('#input-register-name').val().trim(),
                lastname: $('#input-register-lastname').val().trim(),
                pass1: $('#input-register-pass-1').val().trim(),
                pass2: $('#input-register-pass-2').val().trim(),
                newsletter: ($('#checkbox-register-newsletter:checked').val() == undefined) ? 0 : 1
            }
            $('.register-content *').removeClass('error');
            if(!HIVE.validate('email', obj.email)) {
                $('#input-register-email').addClass('error');
            }
            if(!HIVE.validate('nombre', obj.name)) {
                $('#input-register-name').addClass('error');
            }
            if(!HIVE.validate('nombre', obj.lastname)) {
                $('#input-register-lastname').addClass('error');
            }
            if(obj.pass1 == '' || obj.pass1.length < 8) {
                $('#input-register-pass-1').addClass('error');
            }
            if(obj.pass2 == '' || obj.pass2.length < 8) {
                $('#input-register-pass-2').addClass('error');
            }
            if(obj.pass1 != obj.pass2) {
                $('#input-register-pass-2').addClass('error');
            }
            if($('#checkbox-register-accept:checked').val() == undefined) {
                $('#checkbox-register-accept').addClass('error');
            }
            if(!btn.hasClass('disabled') && $('.register-content .error').length == 0) {
                btn.addClass('disabled');
                $.ajax({
                    url: PUBLIC_PATH + '/register-send',
                    data: obj,
                    success: function(data) {
                        if(data.register.response == 'ok') {
                            btn.addClass('btn-ok');
                            window.location.href = data.register.url;
                        } else {
                            HIVE.showInfo('Uups', data.register.mensaje);
                            btn.removeClass('disabled');
                        }
                    }
                });    
            }
        });    
    },
    chooseLanguageEvent: function() {
        $("#select-choose-language").on("change", function() {
            var select = $(this);
            var obj = {
                language: $(this).val(),
                route: ROUTE,
                language_route: $("option:selected", this).attr("route")
            }
            if(!select.hasClass('disabled')) {
                select.addClass('disabled');
                select.prop('disabled', true);
                $.ajax({
                    url: PUBLIC_PATH + '/choose-language',
                    data: obj,
                    success: function(data) {
                        if(data.language.response == 'ok') {
                            if(obj.language_route == '') {
                                window.location.href = data.language.route;
                            } else {
                                window.location.href = data.language.language_route;
                            }
                        } else {
                            select.prop('disabled', false);
                            select.removeClass('disabled');
                        }
                    }
                });    
            }
        });    
    }
}

$(window).ready(function() {
    APP.init();
});