const websiteRoot = "https://www.bhcargo.com/";

function baseUrl(uri){ return websiteRoot+uri; }

$(document).ready(function(){
    $("#basic-main-menu-activator").click(function(){
        $("#basic-main-menu").slideToggle();
    });
    $("#profile-main-menu-activator").click(function(){
        $("#profile-main-menu").slideToggle();
    });
});