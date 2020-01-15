document.addEventListener("DOMContentLoaded", function(event) {

	// FILTER NAV SELECTION
    $(document).on('click', '.filter-link', function() {
		$(".filter-link").removeClass("selected");
		$(this).addClass("selected");

		let type = $(this).attr('data-type');
		index(type, 'cardPanel').done(function(response) {
			render(response);		
		});
	});

	// ITEM NAV SELECTION
    $(document).on('click', '.item-filter-link', function() {
		$(".item-filter-link").removeClass("selected");
		$(this).addClass("selected");

		let itemType = $(this).attr('data-type');
		console.log(itemType);
		
		if (itemType == 'tasks' || itemType == 'timers' || itemType == 'bookmarks') {
			$(".cash-filter").hide();
			if($(".filter-link.selected").attr('data-type') !== "groups") {
				$(".filter-link").removeClass('selected');
				$(".filter-link[data-type='groups']").click();
			}
		} else if (itemType == 'cash') {
			$(".cash-filter").show();
		}

		index (itemType).done(function(response) {
			render(response);		
		});
	});
	
	// TOGGLE FILTERS/ITEMS
	$(document).on('click', '.toggleDisplayBtn', function() {
		
		$(".toggleDisplayBtn").toggle();
		$("#filter-container").toggle();
		$("#item-container").toggle();

	});
});