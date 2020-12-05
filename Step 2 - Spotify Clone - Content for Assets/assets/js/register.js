$(document).ready(function() {

    $("#hideLogin").click(function() {
        $("#loginForm").hide();
        $('#resetForm').hide();
        $("#registerForm").show();
    });

    $("#hideRegister").click(function() {
        $("#registerForm").hide();
        $('#resetForm').hide();
        $("#loginForm").show();
    });

    $("#hideReset").click(function() {
        $('#resetForm').show();
        $("#registerForm").hide();
        $("#loginForm").hide();
    });
    $("#back").click(function() {
        $('#resetForm').hide();
        $("#registerForm").hide();
        $("#loginForm").show();
    });

    $("#back").click(function() {
        $('#resetForm').hide();
        $("#registerForm").hide();
        $("#loginForm").show();
    });

    $("#resetForm").click(function() {
        $('#resetForm').show();
        $("#passwordNoSuccess").hide();
        $("#passwordSuccess").hide();
    });

    $("#passwordReseted").click(function() {
        $('#resetForm').hide();
        $("#passwordNoSuccess").hide();
        $("#passwordSuccess").show();
    });

    $("#notReseted").click(function() {
        $('#resetForm').hide();
        $("#passwordNoSuccess").show();
        $("#passwordSuccess").hide();
    });
});