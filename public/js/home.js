document.addEventListener("DOMContentLoaded", function(event) {

    // Toggle Task
    $(".taskCheckbox").change(function() {
        var taskId = this.value;
        //this.form.submit();
        $.ajax({
            url: "/tasks/toggleComplete/",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            data: {
                taskId: taskId
            }
        })
            .done(function(response) {
                $(this).toggleClass("taskComplete");
                console.log("success");
            })
            .fail(function(errorThrown) {
                console.log("failed");
            });
    });

    // Stop Timer
    $(".timerStopBtn").click(function() {
        var itemId = this.value;
        //this.form.submit();
        $.ajax({
            url: "/timers/stop/",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            data: {
                itemId: itemId
            }
        })
            .done(function(response) {
                console.log("success");
                console.log(response);
            })
            .fail(function(errorThrown) {
                console.log("failed");
            });
    });

    // Create new Item - modal form
    $(".newItemBtn").click(function() {
        var itemType = $(this).attr("data-value");

        $("#itemModalTitle").html("New " + itemType);

        if (itemType === "cash") {
            $("#itemForm").attr("action", "/" + itemType);
        } else {
            $("#itemForm").attr("action", "/" + itemType + "s");
        }

        $("#itemModal")
            .find(".itemForm")
            .hide();
        $("#itemModal")
            .find("." + itemType + "Form")
            .show();

        /*
		$('#itemForm').find(':submit').click(function() {
			$('#itemForm').submit();
		});
		*/
    });

    $("#itemForm").submit(function() {
        // validate the form fields
        return true;
	});
	
	$(".itemTools").click(function() {
        $(this).parent().find('form').submit();
	});
	
	$(".bottom-nav").find('li').click(function() {
		$("#cash-container-" + $(this).attr('data-item')).siblings('.card-deck').hide();
		$("#cash-container-" + $(this).attr('data-item')).fadeIn(1000);
        console.log($(this).attr('data-item'));
    });
});

function render (response) {		
	$("#main-container").html('');
	$(response.html).hide().appendTo($("#main-container")).fadeIn("slow");
	
	console.log(JSON.parse(response.items));
}

document.addEventListener("DOMContentLoaded", function(event) {
	
	let accountContainer = $("#account-container");
	let accountId = 1;

	function getAccount (accountId) {		
        return $.ajax({
            url: "/accounts/getAccount/",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            data: {
        		accountId: accountId
			},
			success: function(response) {
				//
			},
			error: function(errorThrown) {
                console.log("failed getting account");
            }
		});
	}
	
	function getTasks () {		
        return $.ajax({
            url: "/tasks/getTasks/",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            data: {
        		//
			},
			success: function(response) {
				//
			},
			error: function(errorThrown) {
                console.log("failed getting tasks");
            }
		});
	}
		
	function getTimers () {		
        return $.ajax({
            url: "/timers/getTimers/",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            data: {
        		//
			},
			success: function(response) {
				//
			},
			error: function(errorThrown) {
                console.log("failed getting timers");
            }
		});
	}
		
	function getBookmarks () {		
        return $.ajax({
            url: "/bookmarks/getBookmarks/",
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            data: {
        		//
			},
			success: function(response) {
				//
			},
			error: function(errorThrown) {
                console.log("failed getting bookmarks");
            }
		});
	}

	// Listen to Btn click
    $(".filter-link").click(function() {
		let itemType = $(this).attr('data-url');
		console.log(itemType);
		
		switch (itemType) {
			case 'cash':				
				getAccount(accountId).done(function(response) {
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
	});
});

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
