document.addEventListener("DOMContentLoaded", function(event) {

	// Listen to Btn click
    $(document).on('click', '.item-filter-link', function() {
		$(".item-filter-link").removeClass("selected");
		$(this).addClass("selected");

		let itemType = $(this).attr('data-type');
		console.log(itemType);
		
		getItems (itemType);
	});

	// Listen to Btn click
    $(document).on('click', '.filter-link', function() {
		$(".filter-link").removeClass("selected");
		$(this).addClass("selected");

		let type = $(this).attr('data-type');
		if (type == 'groups') {
			getGroups('cardPanel').done(function(response) {
				render(response);		
			});
		} else if (type == 'accounts') {
			getAccounts().done(function(response) {
				render(response);		
			});
		}
	});
	
});
