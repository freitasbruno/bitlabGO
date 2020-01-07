document.addEventListener("DOMContentLoaded", function(event) {

	// Listen to Btn click
    $(document).on('click', '.item-filter-link', function() {
		$(".item-filter-link").removeClass("selected");
		$(this).addClass("selected");

		let itemType = $(this).attr('data-url');
		console.log(itemType);
		
		getItems (itemType);
	});
	
});
