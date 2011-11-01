$(function(){
	var handleSubmitAction = function(){
		var errorDialog = "div.center_content div.new_computer p.error_dialog";

		var ipField = "div.center_content div.new_computer form#new #ip";
		var ipFieldContainer = "div.center_content div.new_computer form#new .field_container.ip";

		var macField = "div.center_content div.new_computer form#new #mac";
		var macFieldContainer = "div.center_content div.new_computer form#new .field_container.mac";

		var userField = "div.center_content div.new_computer form#new #user";
		var userFieldContainer = "div.center_content div.new_computer form#new .field_container.user";

		var formData = $("div.center_content div.new_computer form#new").serialize();
		var url = "add";

		$.ajax({
 			 type: "GET",
 			 url: url,
 			 data: formData,
 			 cache: false,
 			 dataType: "json"
		}).done(function( data ) {
  			console.log( data );
		});

		/*if($(ipField).val() == ""){
			$(errorDialog).css("display", "block");
			$(ipFieldContainer).addClass("error");
		}
		if($(macField).val() == ""){
			$(errorDialog).css("display", "block");
			$(macFieldContainer).addClass("error");
		}
		if($(userField).val() == ""){
			$(errorDialog).css("display", "block");
			$(userFieldContainer).addClass("error");
		}*/
	}
	$("div.left_menu_list ul li").click(function(){

		$("div.left_menu_list ul li").removeClass("active");
		$(this).addClass("active");
				
		document.location.href = $(this).find("a").attr("href");
		$("div.center_content").html("<p>loading...</p>");

		switch($(this).find("a").attr("href")){
			case "#lista": $("div.center_content").load("site/structure/list.php");
			break;
			case "#novo": $("div.center_content").load("site/structure/novo.php", function(){
				$("div.center_content div.new_computer form#new").submit(function(){
					handleSubmitAction();
					return false;
				});
			});
			break;
		}
	});
	$("div.left_menu_list ul li.new").click();
});