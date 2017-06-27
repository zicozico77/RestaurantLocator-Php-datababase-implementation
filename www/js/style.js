$(document).ready(function() {
    $('#login-trigger').click(function(){
        $(this).next('#login-content').slideToggle();
        $(this).toggleClass('active');          
    
    if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
      else $(this).find('span').html('&#x25BC;')
    })
    
            $("#searchHideShow").on("click",function(){
                
                $("#advancedSearch").toggle()

            });
    
    
    
    $("#myTopnav").addClass("js").before('<div id="menu">&#9776;</div>');
	$("#menu").click(function(){
		$("#myTopnav").toggle();
	});
	$(window).resize(function(){
		if(window.innerWidth > 768) {
			$("#myTopnav").removeAttr("style");
		}
	});
    
    var x_timer;    
    $("#user_name").keyup(function (e){
        clearTimeout(x_timer);
        var user_name = $(this).val();
        x_timer = setTimeout(function(){
            check_username_ajax(user_name);
        }, 1000);
    }); 

function check_username_ajax(username){
    $("#user_result").html('<img src="images/ajax-loader.gif" />');
    $.post('usernamecheck.php', {'username':username}, function(data) {
      $("#user_result").html(data);
    });
}
    


        });
