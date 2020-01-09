function submitForm (type, form) {	
	return $.ajax({
		url: "/" + type,
		method: "POST",
		dataType: 'json',
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		data: form.serialize(),
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

	// GET GROUP FORM
	$(document).on('click', '.newGroupBtn', function() {
		$('#filter-container').find('.form-card').show();	
	});

	// GET ITEM FORM
	$(document).on('click', '.newItemBtn', function() {	
		$('#item-container').find('.form-card').show();	
	});

	// SUBMIT NEW GROUP/ITEM FORM
	$(document).on('submit', '.form', function() {
		let type = $(this).closest('.form-card').attr('data-type');
		let form = $(this);

		submitForm(type, form).done(function(model) {
			if (type === 'groups') {
				getGroup(model.id).done(function(response) {
					renderModal(response);
				});
				getGroups().done(function(response) {
					render(response);		
				});
			}else if (type === 'accounts') {
				getAccount(model.id).done(function(response) {
					renderModal(response);
				});
				getAccounts().done(function(response) {
					render(response);		
				});
			} else {
				getItem(type, model.id).done(function(response) {
					renderModal(response);
				});
				getItems(type);
			}
		});
		return false;
	});

	// CLOSE FORM
	$(document).mouseup(function(e) {
		var container = $(".form-card");
		if (!container.is(e.target) && container.has(e.target).length === 0) { 
			container.hide();
		}
	});

	$(document).on('click', '.closeFormBtn', function(e) {
		console.log('click');
		if ($(e.target).closest(".form-card").length) { 
			$('.form-card').hide(200);
		};
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
	
});