const websiteRoot = "https://www.bhcargo.com/";

function baseUrl(uri){ return websiteRoot+uri; }

$(document).ready(function(){
    $("#basic-main-menu-activator").click(function(){
        $("#basic-main-menu").slideToggle();
    });
    $("#profile-main-menu-activator").click(function(){
        $("#profile-main-menu").slideToggle();
    });
    $("#cookie-agreement").click(function(){
        var acceptedCookies = [];
        $(".cookie-content input[type=checkbox]:checked").each(function(){
            acceptedCookies.push($(this).val());
        });

        $.get(baseUrl('welcome/set_cookie'), {
            'cookie_arr' : acceptedCookies
        }, function(response){
            var r = JSON.parse(response);
            if(r.basic_cookie_status){
                $(".cookie-box").remove();
            }
        });

    });
});