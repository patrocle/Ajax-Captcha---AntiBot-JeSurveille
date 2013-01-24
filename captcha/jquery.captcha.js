;(function($) {
	$.fn.captcha = function(options) {
		var defaults = {
			url : "captcha/captcha.php",
			formId : "form",
		};
		var options = $.extend(defaults, options);
		$(this).html($.ajax({
			type : "POST",
			url : options.url,
			data : "type=txt&key_picto=" + options.key_picto,
			async : false
		}).responseText);
		$('#captcha-reload-img').on("click", function(event) {
			var url = options.url;
			$.ajax({
				type : "POST",
				url : url,
				data : "type=refreshKey",
				cache : false,
				success : function(json) {
					$(".captcha-container").captcha({
						key_picto : json.picto
					});
				}
			});
		});
		for ( var i = 0; i < 5; i++) {
			$(".captcha-" + i).draggable({
				containment : '#captcha-content'
			});
			$(".captcha-" + i).addClass('captcha-highlighted');
		}
		$("#captcha-right").droppable({
			drop : function(event, ui) {
				var num = ui.draggable.children().first().attr('id');
				var nom = ui.draggable.attr('id');
				var nomLi = "";
				for ( var i = 0; i < 5; i++) {
					nomLi = "captcha-" + i;
					if (nomLi != nom)
					$(".captcha-" + i).attr('style','left: 0px;position: relative;top: 0px;');
				}
				$("#captcha-task").append("<input type=\"hidden\" style=\"display: none;\" name=\"captcha\" value=\""+ num + "\">");
				var rand2 = $.ajax({
					url : options.url,
					data : "type=2&pass=" + num,
					async : false
				}).responseText;
				$("#captcha-task").append("<input type=\"hidden\" style=\"display: none;\" name=\"coucou\" value=\""+ rand2 + "\">");
				$("#captcha-task").append("<input type=\"checkbox\" style=\"display: none;\" name=\"coucou2\" checked=\"checked\" value=\"I2\">");
			},
			tolerance : 'touch'
		});
	};

})(jQuery);