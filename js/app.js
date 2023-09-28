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
    scroll();
});

$(window).scroll(function() {
    scroll();
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
    $('#hive-slider-example').slick({
        dots: true,
        autoplay: true,
        autoplaySpeed: 2000,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
}

function events() {
    $("#btn-change-color-mode > input").on("click", function() {
        var self = this;
        if(!$(this).hasClass('disabled')) {
            $(this).addClass('disabled');
            $(this).prop('disabled', true);
            _loading = true;
            var obj = {
                mode: ''
            }
            if($('#btn-change-color-mode > input:checked').val() != undefined) {
                $('body').addClass('dark-mode');
                obj.mode = 'dark-mode';
            } else {
                $('body').removeClass('dark-mode');
                obj.mode = 'light-mode';
            }
            $.ajax({
                url: PUBLIC_PATH + '/choose-color-mode',
                data: obj,
                success: function(data) {
                    $(self).prop('disabled', false);
                    $(self).removeClass('disabled');
                    _loading = false;
                }
            });    
        }
    });
    
    $("#btn-acepta-cookies").on("click", function() {
        var self = this;
        var obj = {
            dato: true
        }
        if(!$(this).hasClass('disabled')) {
            $(this).addClass('disabled');
            _loading = true;
            $.ajax({
                url: PUBLIC_PATH + '/set-cookies',
                data: obj,
                success: function(data) {
                    if(data.cookie.response == 'ok') {
                        $('#popup-cookies').removeClass('active');
                    } else {
                        $(self).removeClass('disabled');
                    }
                    _loading = false;
                }
            });
        }
    });

    $("#btn-send-newsletter").on("click", function() {
        var self = this;
        var obj = {
            email: $('#input-send-newsletter').val().trim()
        }
        $('.newsletter-content *').removeClass('error');
        if(!validar('email', obj.email)) {
            $('#input-send-newsletter').addClass('error');
        }
        if($('#checkbox-send-newsletter:checked').val() == undefined) {
            $('#checkbox-send-newsletter').addClass('error');
        }
        if(!$(this).hasClass('disabled') && $('.newsletter-content .error').length == 0) {
            $(this).addClass('disabled');
            _loading = true;
            $.ajax({
                url: PUBLIC_PATH + '/save-newsletter',
                data: obj,
                success: function(data) {
                    if(data.newsletter.response == 'ok') {
                        show_info(data.newsletter.title, data.newsletter.description);
                    } else {
                        $(self).removeClass('disabled');
                    }
                    _loading = false;
                }
            });    
        }
    });

    $("#btn-send-login").on("click", function() {
        var self = this;
        var obj = {
            email: $('#input-login-email').val().trim(),
            pass: $('#input-login-pass').val().trim(),
            remember: ($('#checkbox-login-remember:checked').val() == undefined) ? 0 : 1
        }
        $('.login-content *').removeClass('error');
        if(!validar('email', obj.email)) {
            $('#input-login-email').addClass('error');
        }
        if(obj.pass == '' || obj.pass.length < 8) {
            $('#input-login-pass').addClass('error');
        }
        if(!$(this).hasClass('disabled') && $('.login-content .error').length == 0) {
            $(this).addClass('disabled');
            _loading = true;
            $.ajax({
                url: PUBLIC_PATH + '/login-send',
                data: obj,
                success: function(data) {
                    if(data.login.response == 'ok') {
                        window.location.href = data.login.url;
                    } else {
                        show_info('Uups', data.login.mensaje);
                        $(self).removeClass('disabled');
                        _loading = false;
                    }
                }
            });    
        }
    });

    $("#btn-send-register").on("click", function() {
        var self = this;
        var obj = {
            email: $('#input-register-email').val().trim(),
            name: $('#input-register-name').val().trim(),
            lastname: $('#input-register-lastname').val().trim(),
            pass1: $('#input-register-pass-1').val().trim(),
            pass2: $('#input-register-pass-2').val().trim(),
            newsletter: ($('#checkbox-register-newsletter:checked').val() == undefined) ? 0 : 1
        }
        $('.register-content *').removeClass('error');
        if(!validar('email', obj.email)) {
            $('#input-register-email').addClass('error');
        }
        if(!validar('nombre', obj.name)) {
            $('#input-register-name').addClass('error');
        }
        if(!validar('nombre', obj.lastname)) {
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
        if(!$(this).hasClass('disabled') && $('.register-content .error').length == 0) {
            $(this).addClass('disabled');
            _loading = true;
            $.ajax({
                url: PUBLIC_PATH + '/register-send',
                data: obj,
                success: function(data) {
                    if(data.register.response == 'ok') {
                        window.location.href = data.register.url;
                    } else {
                        show_info('Uups', data.register.mensaje);
                        $(self).removeClass('disabled');
                        _loading = false;
                    }
                }
            });    
        }
    });
    
    $("#select-choose-language").on("change", function() {
        var self = this;
        var obj = {
            language: $(this).val(),
            route: ROUTE,
            language_route: $("option:selected", this).attr("route")
        }
        if(!$(this).hasClass('disabled')) {
            $(this).addClass('disabled');
            $(this).prop('disabled', true);
            _loading = true;
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
                        $(self).prop('disabled', false);
                        $(self).removeClass('disabled');
                        _loading = false;
                    }
                }
            });    
        }
    });
}

function scroll() {
    var scroll = $(window).scrollTop();
    var alto = $("#popup-loading").height();
	if((alto + scroll) >= alto + 350) {
		$("header").addClass("float");
	} else {
		$("header").removeClass("float");
	}
    if(scroll > (alto / 2)) {
		$("#back-top").fadeIn();
	} else {
		$("#back-top").fadeOut();
	}
	$('.animate').each(function() {
	    var active = false;
        if(($(this).offset().top + $(this).height()) <= (alto + scroll) && ($(this).offset().top + $(this).height()) >= scroll && !$(this).hasClass('active')) {
            active = true;
        }
        if(($(this).offset().top + 10) <= (alto + scroll) && ($(this).offset().top + 10) >= scroll && !$(this).hasClass('active')) {
            active = true;
        }
        if(($(this).offset().top + $(this).height()) > (alto + scroll) && $(this).offset().top < scroll) {
            active = true;
        }
        if(active) {
            $(this).addClass("active");
        }
	});
}