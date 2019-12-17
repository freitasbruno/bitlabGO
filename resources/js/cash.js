function openModal() {
	$('#itemModal').fadeIn(500);
	$(document).on('click.modal-dialog', function(e) {
		
		if (!$(e.target).closest('.modal-dialog').length) {
			$('#itemModal').hide();
			$(document).off('click.modal-dialog');
		}
	});
}

function renderModal (response) {		

	$("#itemModalContent").html('');
	$(response.html).appendTo($("#itemModalContent"));
	openModal();
	
	console.log(JSON.parse(response.item));
}

document.addEventListener("DOMContentLoaded", function(event) {


	function getItem (type, itemId) {		
        return $.ajax({
            url: "/" + type + "/getItem/",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            data: {
                itemId: itemId
			},
			success: function(response) {
				//
			},
			error: function(errorThrown) {
                console.log("failed getting item");
            }
		});
	}

	// Get Cash item

    $(document).on('click', '.cash-card', function() {
		let type = $(this).attr('data-type');
		let itemId = $(this).attr('data-id');
		console.log(type + " item: " + itemId);
		
		getItem(type, itemId).done(function(response) {
			renderModal(response);
		}); 		       
		
	});

});
