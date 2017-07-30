/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */




$(function() {
    $('.login-filler').click(function(){
        loginForm = $('#loginForm');
        email = $(this).data('email');
        password = $(this).data('password');
        loginForm.find('#email').val(email);
        loginForm.find('#password').val(password);
    });
});