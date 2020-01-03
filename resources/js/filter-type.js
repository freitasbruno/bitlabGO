document.addEventListener("DOMContentLoaded", function(event) {

	// Listen to Btn click
    $(".filter-link").click(function() {
		$(".filter-link").removeClass("selected");
		$(this).addClass("selected");

		let itemType = $(this).attr('data-url');
		console.log(itemType);
		
		getItems (itemType);
	});
	
});
