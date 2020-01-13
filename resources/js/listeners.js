document.addEventListener("DOMContentLoaded", function(event) {

	// FILTER NAV SELECTION
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

	// ITEM NAV SELECTION
    $(document).on('click', '.item-filter-link', function() {
		$(".item-filter-link").removeClass("selected");
		$(this).addClass("selected");

		let itemType = $(this).attr('data-type');
		console.log(itemType);
		
		getItems (itemType);
	});
	
});