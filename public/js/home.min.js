function render (response) {	
	
	if (response.groups || response.accounts) {
		$("#filter-container").html('');
		$(response.html).hide().appendTo($("#filter-container")).fadeIn(200);
		$(".nestedGroup").hide();
	} else if (response.items) {
		$("#item-container").html('');
		$(response.html).hide().appendTo($("#item-container")).fadeIn(200);
	}
		
	console.log(response);
}

function getCash () {		
	return $.ajax({
		url: "/cash",
		method: "GET",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		error: function(errorThrown) {
			console.log("failed getting cash items");
		}
	});
}

function getTasks () {		
	return $.ajax({
		url: "/tasks",
		method: "GET",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		error: function(errorThrown) {
			console.log("failed getting tasks");
		}
	});
}

function getTimers () {		
	return $.ajax({
		url: "/timers",
		method: "GET",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		error: function(errorThrown) {
			console.log("failed getting timers");
		}
	});
}
	
function getBookmarks () {		
	return $.ajax({
		url: "/bookmarks",
		method: "GET",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		error: function(errorThrown) {
			console.log("failed getting bookmarks");
		}
	});
}

function getItems (type) {
	switch (type) {
		case 'cash':				
			getCash().done(function(response) {
				render(response);
			}); 
			break;
	
		case 'tasks':
			getTasks().done(function(response) {
				render(response);
			}); 
			break;
	
		case 'timers':
			getTimers().done(function(response) {
				render(response);
			}); 
			break;
	
		case 'bookmarks':
			getBookmarks().done(function(response) {
				render(response);
			}); 
			break;
	
		default:
			break;
	}
}

function getGroups (viewType = 'cardPanel') {		
	return $.ajax({
		url: "/groups",
		method: "GET",
		data: {
			viewType : viewType,
		},
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed getting groups");
		}
	});
}

function getAccounts (viewType = 'cardPanel') {		
	return $.ajax({
		url: "/accounts",
		method: "GET",
		data: {
			viewType : viewType,
		},
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed getting accounts");
		}
	});
}

document.addEventListener("DOMContentLoaded", function(event) {

	getGroups('cardPanel').done(function(response) {
		render(response);		
	});
	getItems('cash');
});

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
	} else if (type == "account") {
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

document.addEventListener("DOMContentLoaded", function(event) {

	// GET ITEM MODAL
    $(document).on('click', '.item-card', function(e) {
		if ($(e.target).closest(".checkboxLabel").length) { return };
		if ($(e.target).closest(".timerStopBtn").length) { return };
		if ($(e.target).closest(".total-card").length) { return };
		let type = $(this).attr('data-type');
		let itemId = $(this).attr('data-id');
		console.log(type + " item: " + itemId);
		
		getItem(type, itemId).done(function(response) {
			renderModal(response);
		}); 		       
		
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

function getGroup (id) {		
	return $.ajax({
		url: "/groups/" + id,
		method: "GET",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed getting group");
		}
	});
}

function deleteGroup (id) {		
	return $.ajax({
		url: "/groups/" + id,
		method: "DELETE",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed deleting group");
		}
	});
}

function updateCurrentGroup (id) {		
	return $.ajax({
		url: "/groups/current",
		method: "POST",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		data: {
			id : id
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed updating current group");
		}
	});
}

function moveGroup (groupId, targetId) {		
	return $.ajax({
		url: "/groups/move/" + groupId,
		method: "POST",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		data: {
			targetId : targetId
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed updating current group");
		}
	});
}

function moveItem (type, id, targetId) {		
	return $.ajax({
		url: "/" + type + "/move/" + id,
		method: "POST",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		data: {
			targetId : targetId
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed updating current group");
		}
	});
}

document.addEventListener("DOMContentLoaded", function(event) {
	
	var pressTimer;
	var selectMode = false;

	// GET GROUP
    $(document).on('click', '.group-card', function(e) {

		if ($(e.target).closest(".group-card-action").length) { return };
		
		let id = $(this).attr('data-id');
		let groupCard = $(this);
		console.log("group: " + id);

		updateCurrentGroup(id).done(function(response) {
			if (selectMode) {
				groupCard.addClass("selected highlight");
			} else {
				$(".group-card").removeClass("selected");
				groupCard.addClass("selected");
			}
			
			let selected = $(".item-filter-link.selected");
			
			if (selected.length) {
				let itemType = $(selected).attr('data-type');
				console.log('itemType = ' + itemType);
	
				getItems (itemType);
			}
		});

	});
	
	// GROUP ACTIONS
    $(document).on('click', '.group-card-action', function(e) {
		let actionBtn = $(this);
		let action = $(this).attr('data-action');
		let groupCard = $(this).closest(".group-card");
		let groupId = groupCard.attr('data-id');
		let type = groupCard.closest('.modal').attr('data-type');
		let target = type == 'groupSelect' ? '#nestedListGroup-' : '#nestedGroup-';

		switch (action) {
			case 'expand':
				$(target + groupId).show();
				actionBtn.html('arrow_drop_up');	       
				actionBtn.attr('data-action', 'collapse');	       
				break;
			
			case 'collapse':
				$(target + groupId).hide();
				actionBtn.html('arrow_right');	       
				actionBtn.attr('data-action', 'expand');	       
				break;

			case 'open':
				getGroup(groupId).done(function(response) {
					console.log(JSON.parse(response.group));
					renderModal(response);
				});	       
				break;

			case 'delete':
				deleteGroup(groupId).done(function(response) {
					groupCard.remove();
				}); 		       
				break;
		
			default:
				break;
		}
	});
	
	// MOVE GROUP
    $(document).on('click', '.selectGroupBtn', function(e) {

		let container = $(this).closest('.modal').find('.container');
		let id = container.attr('data-id');
		let type = container.attr('data-type');
		getGroups('groupSelect').done(function(response) {
			response.actionObjectType = type;
			response.actionObjectId = id;
			renderModal(response);		
		});
		console.log("Move " + type + ": " + id);
	});

    $(document).on('click', '.group-list-card', function(e) {

		if (!$(e.target).closest('.group-card-action').length) {

			let type = $(this).closest('.container').attr('data-type');
			let id = $(this).closest('.container').attr('data-id');
			let targetId = $(this).attr('data-id');

			switch (type) {
				case 'groups':
					moveGroup(id, targetId).done(function(response) {
						let group = JSON.parse(response.group);	
						closeModal('groupSelect');
						getGroups('cardPanel').done(function(response) {
							render(response);		
						});
						getGroup(group.id).done(function(response) {
							renderModal(response);
						});
					});
					break;					
				default:
					moveItem(type, id, targetId).done(function(response) {	
						closeModal('groupSelect');
						closeModal('item');
						//getItems(type);
					});
					break;
			}
		}
	});
	
	$(document).on('mouseup', '.group-card', function(){		
		clearTimeout(pressTimer);
		return false;
	});
	$(document).on('mousedown', '.group-card', function() {
		pressTimer = window.setTimeout(function() {
			// selectMode = true;
		},1000);
	 	return false; 
	});
});

function getAccount (id) {		
	return $.ajax({
		url: "/accounts/" + id,
		method: "GET",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed getting account");
		}
	});
}

function deleteAccount (id) {		
	return $.ajax({
		url: "/accounts/" + id,
		method: "DELETE",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed deleting account");
		}
	});
}

document.addEventListener("DOMContentLoaded", function(event) {

	// GROUP ACTIONS
    $(document).on('click', '.account-card-action', function(e) {
		let actionBtn = $(this);
		let action = $(this).attr('data-action');
		let accountCard = $(this).closest(".account-card");
		let accountId = accountCard.attr('data-id');
		let type = accountCard.closest('.modal').attr('data-type');

		switch (action) {
			case 'open':
				getAccount(accountId).done(function(response) {
					console.log(JSON.parse(response.account));
					renderModal(response);
				});	       
				break;

			case 'delete':
				deleteAccount(accountId).done(function(response) {
					accountCard.remove();
				}); 		       
				break;
		
			default:
				break;
		}
	});
});


function toggleTask (taskId) {		
	return $.ajax({
		url: "/tasks/toggleComplete/",
		method: "POST",
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		data: {
			taskId: taskId
		}
	});
}

document.addEventListener("DOMContentLoaded", function(event) {

    // Toggle Task
    $(document).on('change', ".taskCheckbox" , function() {
		let element = $(this);
		let taskId = $(this).attr('data-id');	
		toggleTask(taskId).done(function(response) {
			element.closest(".task-card").toggleClass('complete');
			if (!element.closest(".task-card").length) {
				getItems('tasks');
			}	
			console.log($(this));	
		});
	});

});

function stopTimer (itemId) {
	return $.ajax({
		url: "/timers/stop/",
		method: "POST",
		dataType: 'json',
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		data: {
			itemId: itemId
		},
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

	// Stop Timer
	$(document).on('click', ".timerStopBtn" , function() {
		var itemId = $(this).attr('data-id');
		stopTimer(itemId);
		$(".item-filter-link.selected").trigger("click");
	});

});
