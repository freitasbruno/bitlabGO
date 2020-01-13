function request (url, method, data = null) {	

	return $.ajax({
		url: url,
		method: method,
		headers: {
			"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
		},
		data: data,
		success: function(response) {
			//
		},
		error: function(errorThrown) {
			console.log("failed @" + url + " - method: " + method);
		}
	});

}

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
	console.log('render done');
}

function index (type, viewType = null) {
	console.log("Index " + type);
	let url = "/" + type;
	let data = {"viewType" : viewType};		
	return request (url, 'GET', data);
}

function get (type, id) {	
	console.log("Show " + type + " - id: " + id);
	let url = "/" + type + "/" + id;	
	return request (url, 'GET');
}

function destroy (id, type) {
	console.log("Destroy " + type + " - id: " + id);	
	let url = "/" + type + "/" + id;
	return request (url, 'DELETE');
}

function create (type) {
	let url = "/" + type + "/create";	
	return request (url, 'GET');
}

function move (type, id, targetId) {
	console.log("Move " + type + " - id: " + id + " to parent with id: " + targetId);
	let url = "/" + type + "/move/" + id;
	let data = {"targetId" : targetId};	
	return request (url, 'POST', data);		
}

document.addEventListener("DOMContentLoaded", function(event) {

	index('groups', 'cardPanel').done(function(response) {
		render(response);		
	});
	index('cash').done(function(response) {
		render(response);		
	});
	console.log('home done');
});

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
	$(document).on('click', '.newFilterBtn', function() {
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
			get(type, model.id).done(function(response) {
				renderModal(response);
			});
			index(type, 'cardPanel').done(function(response) {
				render(response);		
			});
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
				index('groups', 'cardPanel').done(function(response) {
					render(response);		
				});
			} else if (response.type == 'accounts') {
				index('accounts', 'cardPanel').done(function(response) {
					render(response);		
				});
			} else {
				index (type);
			}
			renderModal(response);
		});
		console.log("Submit " + field + " of " + type + " with id " + id);
	});
	
});
function updateCurrentGroup (id) {	
	console.log("Update current group - id: " + id);
	let url = "/groups/current";
	let data = {"id" : id};	
	return request (url, 'POST', data);
}

document.addEventListener("DOMContentLoaded", function(event) {
	
	var pressTimer;
	var selectMode = false;

	// GET GROUP
    $(document).on('click', '.filter-card', function(e) {

		if ($(e.target).closest(".filter-card-action").length) { return };
		
		let id = $(this).attr('data-id');
		let type = $(this).attr('data-type');
		let filterCard = $(this);
		console.log("Filter " + type + ": " + id);

		updateCurrentGroup(id).done(function(response) {
			if (selectMode) {
				filterCard.addClass("selected highlight");
			} else {
				$(".filter-card").removeClass("selected");
				filterCard.addClass("selected");
			}
			
			let selected = $(".item-filter-link.selected");
			
			if (selected.length) {
				let itemType = $(selected).attr('data-type');	
				index(itemType).done(function(response) {
					render(response);		
				});
			}
		});

	});
	
	// FILTER ACTIONS
    $(document).on('click', '.filter-card-action', function(e) {
		let actionBtn = $(this);
		let action = $(this).attr('data-action');
		let filterCard = $(this).closest(".filter-card");
		let filterType = filterCard.attr('data-type');
		let filterId = filterCard.attr('data-id');
		let type = filterCard.closest('.modal').attr('data-type');
		let target = type == 'groupSelect' ? '#nestedListGroup-' : '#nestedGroup-';

		switch (action) {
			case 'expand':
				$(target + filterId).show();
				actionBtn.html('arrow_drop_up');	       
				actionBtn.attr('data-action', 'collapse');	       
				break;
			
			case 'collapse':
				$(target + filterId).hide();
				actionBtn.html('arrow_right');	       
				actionBtn.attr('data-action', 'expand');	       
				break;

			case 'open':
				get(filterType, filterId).done(function(response) {
					console.log(response);
					renderModal(response);
				});	       
				break;

			case 'delete':
				destroy(filterId, filterType).done(function(response) {
					filterCard.remove();
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
		index('groups', 'groupSelect').done(function(response) {
			response.actionObjectType = type;
			response.actionObjectId = id;
			renderModal(response);		
		});
		console.log("Move " + type + ": " + id);
	});

    $(document).on('click', '.filter-list-card', function(e) {

		if (!$(e.target).closest('.filter-card-action').length) {

			let type = $(this).closest('.container').attr('data-type');
			let id = $(this).closest('.container').attr('data-id');
			let targetId = $(this).attr('data-id');

			switch (type) {
				case 'groups':
					move(type, id, targetId).done(function(response) {
						let group = JSON.parse(response.group);	
						closeModal('group');
						index('groups', 'cardPanel').done(function(response) {
							render(response);		
						});
						get('groups', group.id).done(function(response) {
							renderModal(response);
						});
					});
					break;					
				default:
					move(type, id, targetId).done(function(response) {	
						closeModal('group');
						closeModal('item');
						//index(type);
					});
					break;
			}
		}
	});
	
	// MULTIPLE SELECT
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
				index('tasks');
			}	
			console.log($(this));	
		});
	});

});

function updateTimer (itemId, action) {
	return $.ajax({
		url: "/timers/" + action,
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

	// Start Timer
	$(document).on('click', ".timerStartBtn" , function() {
		var itemId = $(this).attr('data-id');
		// updateTimer(itemId, 'start');
		// index('timers');		
		var minutesLabel = document.getElementById("minutes");
		var secondsLabel = document.getElementById("seconds");
		var totalSeconds = 0;
		setInterval(setTime, 1000);

		function setTime() {
			++totalSeconds;
			secondsLabel.innerHTML = pad(totalSeconds % 60);
			minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));
		}

		function pad(val) {
			var valString = val + "";
			if (valString.length < 2) {
				return "0" + valString;
			} else {
				return valString;
			}
		}
	});

	// Stop Timer
	$(document).on('click', ".timerStopBtn" , function() {
		var itemId = $(this).attr('data-id');
		updateTimer(itemId, 'stop');
		index('timers').done(function(response) {
			render(response);		
		});
	});

});

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