/*
 * Upload Ftp
 * Copyright 2021 Diego Martin
 * Compares the files on the development server with the production server via ftp connection and modifies them.
 * Dep: Font Awesome, jQuery
 * Files:
 *      - ftp-upload.scss
 *      - ftp-upload.js
 *      - ftp-upload.php
 *      - ftp-upload-view.php
 *      - ftp-upload-ajax.php
 */

$(window).ready(function() {
    ftp_upload_events();
});

function ftp_upload_events() {
    if($('body#ftp-upload-page').length != 0) {
        ftp_upload_get_dir('');
        $('#btn-upload-all').on('click', function() {
            var self = this;
            if(!$(this).hasClass('disabled')) {
                $(this).addClass('disabled');
                var files = [];
                var id_files = [];
                $('.upload-ftp-dir-content .ftp-file.warning').each(function() {
                    files.push($(this).find('.name').attr('name'));
                    id_files.push($(this).attr('id-file'));
                });
                if(files.length != 0) {
                    $('.ftp-dir').addClass('disabled');
                    $('.ftp-file').addClass('disabled');
                    var obj = {
                        folder: $('.folder').attr('folder'),
                        files: files
                    }
                    $.ajax({
                        url: ADMIN_PATH + '/ftpu-upload-all',
                        data: obj,
                        success: function(data) {
                            if(data.result.response == 'ok') {
                                for(i = 0; i < id_files.length; i++) {
                                    $('.upload-ftp-dir-content').find('.ftp-file[id-file="' + id_files[i] + '"]').removeClass('warning no-existe');
                                }
                                ftp_upload_show_info('Completo', data.result.mensaje);
                            } else {
                                ftp_upload_show_info('Uups', data.result.mensaje);
                            }
                            $(self).removeClass('disabled');
                            $('.ftp-dir').removeClass('disabled');
                            $('.ftp-file').removeClass('disabled');
                        }
                    });
                } else {
                    $(this).removeClass('disabled');
                }
            }
        });
        $('#btn-upload-ftp').on('click', function() {
            var self = this;
            var obj = {
                folder: $('#popup-upload-ftp-folder').html(),
                file: $('#popup-upload-ftp-name').html()
            }
            if(!$(this).hasClass('disabled')) {
                $(this).addClass('disabled');
                $.ajax({
                    url: ADMIN_PATH + '/ftpu-upload',
                    data: obj,
                    success: function(data) {
                        if(data.upload.response == 'ok') {
                            var id_file = $('#popup-upload-ftp-id-file').val();
                            $('.upload-ftp-dir-content').find('.ftp-file[id-file="' + id_file + '"]').removeClass('warning no-existe');
                            $('#popup-upload-ftp').removeClass('active');
                            show_info('Completo', data.upload.mensaje);
                        } else {
                            show_info('Uups', data.upload.mensaje);
                        }
                        $(self).removeClass('disabled');
                    }
                });
            }
        });
        $('#btn-upload-ftp-create').on('click', function() {
            var self = this;
            var obj = {
                folder: $('#popup-upload-ftp-create-folder').html(),
                name: $('#popup-upload-ftp-create-name').html()
            }
            if(!$(this).hasClass('disabled')) {
                $(this).addClass('disabled');
                $.ajax({
                    url: ADMIN_PATH + '/ftpu-create-folder',
                    data: obj,
                    success: function(data) {
                        if(data.folder.response == 'ok') {
                            var id_folder = $('#popup-upload-ftp-create-id-folder').val();
                            $('.upload-ftp-dir-content').find('.ftp-dir[id-folder="' + id_folder + '"]').removeClass('no-existe');
                            $('#popup-upload-ftp-create').removeClass('active');
                            show_info('Completo', data.folder.mensaje);
                        } else {
                            show_info('Uups', data.folder.mensaje);
                        }
                        $(self).removeClass('disabled');
                    }
                });
            }
        });
        $('#btn-upload-ftp-comparar').on('click', function() {
            var self = this;
            var obj = {
                folder: $('#popup-upload-ftp-folder').html(),
                file: $('#popup-upload-ftp-name').html()
            }
            if(!$(this).hasClass('disabled')) {
                $(this).addClass('disabled');
                $.ajax({
                    url: ADMIN_PATH + '/ftpu-compare',
                    data: obj,
                    success: function(data) {
                        if(data.compare.response == 'ok') {
                            var height = $('#popup-upload-ftp-comparar .content').height() - 150;
                            $('#popup-upload-ftp-comparar').find('textarea').css('height', height);
                            $('#popup-upload-ftp-comparar-code-server').val(data.compare.code_server);
                            $('#popup-upload-ftp-comparar-code-ftp').val(data.compare.code_ftp);
                            $('#popup-upload-ftp').removeClass('active');
                            $('#popup-upload-ftp-comparar').addClass('active');
                        } else {
                            show_info('Uups', data.compare.mensaje);
                        }
                        $(self).removeClass('disabled');
                    }
                });     
            }
        });
        $('#btn-upload-ftp-close').on('click', function() {
            $('#popup-upload-ftp').removeClass('active');
        });
        $('#btn-upload-ftp-create-close').on('click', function() {
            $('#popup-upload-ftp-create').removeClass('active');
        });
        $('#btn-upload-ftp-comparar-close').on('click', function() {
            $('#popup-upload-ftp-comparar').removeClass('active');
            $('#popup-upload-ftp').addClass('active');
        });        
    }    
}

function ftp_upload_get_dir(get_dir) {
    var obj = {
        dir: get_dir
    }
    $.ajax({
        url: ADMIN_PATH + '/ftpu-get-dir',
        data: obj,
        success: function(data) {
            if(data.get_dir.response == 'ok') {
                $('.upload-ftp-dir-content').html(data.get_dir.html)
                $('.ftp-dir').on('click', function() {
                    if(!$(this).hasClass('disabled')) {
                        var folder = $('.folder').attr('folder');
                        var name = $(this).attr('name');
                        if(!$(this).hasClass('no-existe')) {
                            var dir = folder + '/' + name;
                            $('.ftp-dir').addClass('disabled');
                            $('.ftp-file').addClass('disabled');
                            ftp_upload_get_dir(dir);
                        } else {
                            var id_folder = $(this).attr('id-folder');
                            $('#popup-upload-ftp-create-id-folder').val(id_folder);
                            $('#popup-upload-ftp-create-folder').html(folder);
                            $('#popup-upload-ftp-create-name').html(name);
                            $('#popup-upload-ftp-create').addClass('active');
                        }
                    }
                });
                $('.ftp-file').on('click', function() {
                    if(!$(this).hasClass('disabled')) {
                        var id_file = $(this).attr('id-file');
                        var folder = $('.folder').attr('folder');
                        var name = $(this).find('.name').attr('name');
                        var size = $(this).find('.size').attr('size');
                        var ftp_size = $(this).find('.size').attr('ftp_size');
                        var dir = folder + '/' + name;
                        $('#popup-upload-ftp-id-file').val(id_file);
                        $('#popup-upload-ftp-folder').html(folder);
                        $('#popup-upload-ftp-name').html(name);
                        $('#popup-upload-ftp-size').html(size + ' bytes');
                        if(ftp_size == -1) {
                            $('#popup-upload-ftp-ftp-size').html('No existe');
                            $('#btn-upload-ftp-comparar').addClass('hidden');
                        } else {
                            $('#popup-upload-ftp-ftp-size').html(ftp_size + ' bytes');                            
                            $('#btn-upload-ftp-comparar').removeClass('hidden');
                        }
                        $('#popup-upload-ftp').addClass('active');
                    }
                });
            } else {
                $('.ftp-dir').removeClass('disabled active');
                $('.ftp-file').removeClass('disabled');
                show_info('Uups', data.get_dir.mensaje);
            }
        }
    });
}