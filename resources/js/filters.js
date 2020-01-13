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
