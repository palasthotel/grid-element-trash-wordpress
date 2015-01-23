(function( $ ) {
	'use strict';

	$(".grid-element-trash-wrapper").on("click", ".trash-check", function(e){
		var $item = $(e.target);
		$.ajax({
			url: ajaxurl,
			data: {
				action: "change_option",
				element: $item.data("element"),
				type: $item.attr("name"),
				value: $item.is(":checked"),
			}, 
			success: function(data){
				console.log(data);
			}
		});
	});

})( jQuery );
