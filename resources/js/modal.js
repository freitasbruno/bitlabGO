function openModal(type) {
	$('.itemTools').hide();
	$('#' + type + 'Modal').fadeIn(200);

	$(document).on('click', '#' + type + 'Modal', function(e) {
		
		if (!$(e.target).closest('.modal-dialog').length) {
			closeModal(type);
			$(document).off('click.modal-dialog');
		}
		if (!$(e.target).closest('.modal-menu-container').length) {
			$('.itemTools').hide();
		}
	});
}

function closeModal(type = null) {
	if (type) {
		$('#' + type + 'Modal').fadeOut(200);
	} else {
		$('.modal').fadeOut(200);
	}
	$('.modal-title').html('');	
}

function renderModal (response) {
	
	let type = response.type;
	if (type == "group") {
		$("#groupModalContent").html('');
		$(response.modalHtml).appendTo($("#groupModalContent"));
		openModal('group');
	} else if (type == "groupSelect") {

		console.log(response);
		let actionObjectType = response.actionObjectType;
		let actionObjectId = response.actionObjectId;

		$("#groupSelectModalContent").html('');
		$(response.html).appendTo($("#groupSelectModalContent"));

		$("#groupSelectModalContent").attr('data-type', actionObjectType);
		$("#groupSelectModalContent").attr('data-id', actionObjectId);

		$("#groupSelectModalContent").find(".nestedGroup").hide();
		$("#groupSelectModalContent").find(".nestedGroup").first().show();
		openModal('groupSelect');
	} else {
		$("#itemModalContent").html('');
		$(response.modalHtml).appendTo($("#itemModalContent"));
		openModal('item');
	}
}

function newGroup () {		
	return $.ajax({
		url: "/groups/create",
		method: "GET",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed getting group form");
		}
	});
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

function moveItem (type, id) {		
	console.log("Move " + type + " with ID: " + id);
}

function deleteItem (type, id) {		
	return $.ajax({
		url: "/" + type + "/" + id,
		method: "DELETE",
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

function storeGroup () {	
	return $.ajax({
		url: "/groups",
		method: "POST",
		dataType: 'json',
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		data: $("#newGroupForm").serialize(),
		success: function(response) {
			console.log(response);
		},
		error: function(error) {
			console.log("failed getting item");
			console.log(error);
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

function getFieldForm (type, id, field) {		
	return $.ajax({
		url: "/" + type + "/getForm/" + id,
		method: "POST",
		dataType: 'json',
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		data: {
			field : field
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed getting field form");
		}
	});
}

function submitFieldForm (type, id) {		
	return $.ajax({
		url: "/" + type + "/" + id,
		method: "PUT",
		dataType: 'json',
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		data: $(".fieldForm").serialize(),
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed submitting field form");
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
			renderModal(response);
		}); 		       
		
	});

	// GET ITEM FORM
    $(document).on('click', '.newItemBtn', function() {		
		let type = $(this).attr('data-type');
		let formType = type === 'cash' ? 'cashForm' : type.substring(0, type.length - 1) + "Form";
		console.log(type + " - " + formType); 
		if($('.itemForm').length && $('.itemForm').hasClass(formType)) {
			$('#itemModal').fadeIn(200); 
		} else {
			newItem(type).done(function(response) {				
				$("#itemModalTitle").children("p").html("New " + response.type);
				renderModal(response);
			}); 		       
		}
		
	});

	// GET GROUP FORM
    $(document).on('click', '.newGroupBtn', function() {
		if($('.groupForm').length) {	
			$('#groupModal').fadeIn(200); 
		} else {
			newGroup().done(function(response) {				
				$("#groupModalTitle").children("p").html("New group");
				renderModal(response);
			}); 		       
		}		
	});

	// GET LOGIN FORM
    $(document).on('click', '#loginBtn', function() {
		openModal('login'); 		       
	});

	// CLOSE MODAL
    $(document).on('click', '.closeModalBtn', function() {
		let type = $(this).closest('.modal').attr('data-type');
		closeModal(type);		
	});
	
	// SUBMIT GROUP FORM
    $(document).on('submit', '#newGroupForm', function() {
		storeGroup().done(function(group) {			
			closeModal('group');
			getGroups(group.id_parent).done(function(response) {
				render(response);		
			});
		});
		return false;
	});
	
	// SUBMIT ITEM FORM
    $(document).on('submit', '#newItemForm', function() {
		let type = $(this).find('[name="itemType"]').val();

		storeItem(type).done(function(item) {
			// Reload modal with the created item
			$("#itemModalTitle").children("p").html("");

			$(".item-filter-link.selected").trigger("click");
			getItem(type, item.id).done(function(response) {
				renderModal(response);
			});
		});

		return false;
	});
	
	// GET FIELD FORM
    $(document).on('click', '.editable', function() {

		let element = $(this);
		let container = element.closest('.container');
		let field = element.attr('data-field');		
		let type = container.attr('data-type');
		let id = container.attr('data-id');

		getFieldForm(type, id, field).done(function(response) {
			element.replaceWith(response.html);
			let input = container.find(".form-field-control");
			let content = input.val();
			input.focus();
			input.val('');
			input.val(content);
		});
		console.log("Edit " + field + " of " + type + " with id " + id);
	});
	
	// SUBMIT FIELD FORM
    $(document).on('focusout', '.form-field-control', function() {
		let element = $(this);
		let container = element.closest('.container');
		let field = element.attr('data-field');		
		let type = container.attr('data-type');
		let id = container.attr('data-id');

		submitFieldForm(type, id).done(function(response) {
			if (response.type == 'group') {
				getGroups().done(function(response) {
					render(response);		
				});
			} else {
				getItems (type);
			}
			renderModal(response);
		});
		console.log("Submit " + field + " of " + type + " with id " + id);
	});
		
	// SHOW MODAL TOOLS
    $(document).on('click', '.itemToolsBtn', function() {
		$(this).parent().children('.itemTools').toggle();
	});
		
	// MODAL TOOLS ACTIONS
    $(document).on('click', '.item-card-action', function() {
		let container = $(this).closest("#itemModal").find('.container');
		let type = container.attr('data-type');
		let id = container.attr('data-id');
		let action = $(this).attr('data-action');

		switch (action) {
			case 'move':
				moveItem (type, id);
				break;
			case 'delete':
				deleteItem (type, id).done( function(response) {
					console.log(response);
					getItems (type);
					closeModal('item');
				});
				break;		
			default:
				break;
		}
	});
});
