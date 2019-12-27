function openModal() {
	$('#itemModal').fadeIn(500);

	$(document).on('click', '#itemModal', function(e) {
		if (!$(e.target).closest('.modal-dialog').length) {
			closeModal();
			$(document).off('click.modal-dialog');
		}
	});
}

function closeModal() {
	$('#itemModal').fadeOut(500); 
}

function renderModal (response) {		
	$("#itemModalContent").html('');
	$(response.modalHtml).appendTo($("#itemModalContent"));
	openModal();
}

function newItem (type) {		
	return $.ajax({
		url: "/" + type + "/create",
		method: "GET",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed getting item form");
		}
	});
}

function getItem (type, itemId) {		
	return $.ajax({
		url: "/" + type + "/" + itemId,
		method: "GET",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed getting item");
		}
	});
}

function storeItem (type) {	
	return $.ajax({
		url: "/" + type,
		method: "POST",
		dataType: 'json',
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		data: $("#newItemForm").serialize(),
		success: function(response) {
			console.log(response);
		},
		error: function(error) {
			console.log("failed getting item");
			console.log(error);
		}
	});
}

document.addEventListener("DOMContentLoaded", function(event) {

	// GET ITEM MODAL
    $(document).on('click', '.item-card', function(e) {
		if ($(e.target).closest(".checkboxLabel").length) { return };
		if ($(e.target).closest(".timerStopBtn").length) { return };
		let type = $(this).attr('data-type');
		let itemId = $(this).attr('data-id');
		console.log(type + " item: " + itemId);
		
		getItem(type, itemId).done(function(response) {
			let item = JSON.parse(response.item);
			renderModal(response);
		}); 		       
		
	});

	// GET ITEM FORM
    $(document).on('click', '.newItemBtn', function() {		
		let type = $(this).attr('data-type');
		let formType = type === 'cash' ? 'cashForm' : type.substring(0, type.length - 1) + "Form";
		console.log(type + " - " + formType); 
		if($('.itemForm').length && $('.itemForm').hasClass(formType)) {
			$('#itemModal').fadeIn(500); 
		} else {
			newItem(type).done(function(response) {				
				$("#itemModalTitle").children("p").html("New " + response.type);
				renderModal(response);
			}); 		       
		}
		
	});

	// CLOSE MODAL
    $(document).on('click', '.closeModalBtn', function() {
		closeModal();		
	});
	
	// SUBMIT FORM
    $(document).on('submit', '#newItemForm', function() {

		let type = $(this).find('[name="itemType"]').val();

		storeItem(type).done(function(item) {
			// Reload modal with the created item
			$("#itemModalTitle").children("p").html("");

			$(".filter-link.selected").trigger("click");
			getItem(type, item.id).done(function(response) {
				renderModal(response);
			});
		});

		return false;
	});

});
