function openModal(type) {
	$('.dropdown').hide();
	$('#' + type + '-modal').fadeIn(200);
	console.log('#' + type + '-modal');
	$(document).on('click', '#' + type + '-modal', function(e) {
		
		if (!$(e.target).closest('.modal-dialog').length) {
			closeModal(type);
			$(document).off('click.modal-dialog');
		}
		if (!$(e.target).closest('.modal-menu-container').length) {
			$('.dropdown').hide();
		}
	});
}

function closeModal(type = null) {
	if (type) {
		$('#' + type + '-modal').fadeOut(200);
	} else {
		$('.modal').fadeOut(200);
	}
	$('.modal-title').html('');	
}

function renderModal (response) {
	
	let type = response.type;
	if (type == "group" || type == "account") {
		$("#filter-modal-content").html('');
		$(response.modalHtml).appendTo($("#filter-modal-content"));
		openModal('filter');
	} else if (type == "groupSelect") {

		console.log(response);
		let actionObjectType = response.actionObjectType;
		let actionObjectId = response.actionObjectId;

		$("#group-modal-content").html('');
		$(response.html).appendTo($("#group-modal-content"));

		$("#group-modal-content").attr('data-type', actionObjectType);
		$("#group-modal-content").attr('data-id', actionObjectId);

		$("#group-modal-content").find(".nestedGroup").hide();
		$("#group-modal-content").find(".nestedGroup").first().show();
		openModal('group');
	} else {
		$("#item-modal-content").html('');
		$(response.modalHtml).appendTo($("#item-modal-content"));
		openModal('item');
	}
}


document.addEventListener("DOMContentLoaded", function(event) {

	// GET ITEM MODAL
    $(document).on('click', '.item-card', function(e) {
		if ($(e.target).closest(".checkboxLabel").length) { return };
		if ($(e.target).closest(".timerStopBtn").length) { return };
		if ($(e.target).closest(".timerStartBtn").length) { return };
		if ($(e.target).closest(".total-card").length) { return };
		let type = $(this).attr('data-type');
		let itemId = $(this).attr('data-id');
		console.log(type + " item: " + itemId);
		
		get(type, itemId).done(function(response) {
			renderModal(response);
		}); 		       
		
	});

	// GET LOGIN FORM
    $(document).on('click', '#loginBtn', function() {
		openModal('login'); 		       
	});

	// CLOSE MODAL
    $(document).on('click', '.modal-close-btn', function() {
		let type = $(this).closest('.modal').attr('data-type');
		closeModal(type);		
	});
		
	// SHOW MODAL TOOLS
    $(document).on('click', '.modal-tools-btn', function() {
		$(this).parent().children('.dropdown').toggle();
	});
		
	// MODAL TOOLS ACTIONS
    $(document).on('click', '.item-card-action', function() {
		let container = $(this).closest("#item-modal").find('.container');
		let type = container.attr('data-type');
		let id = container.attr('data-id');
		let action = $(this).attr('data-action');

		switch (action) {
			case 'move':
				break;
			case 'delete':
				destroy (type, id).done( function(response) {
					console.log(response);
					index (type);
					closeModal('item');
				});
				break;		
			default:
				break;
		}
	});
	
});
