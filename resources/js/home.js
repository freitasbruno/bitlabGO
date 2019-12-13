document.addEventListener("DOMContentLoaded", function(event) {
	
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

	function renderAccount(element, account) {
		console.log($(element).find(".deck-title").first().children().first());
		$(element).find(".deck-title").first().children().first().html(account.group.name);

		let cardContainer = $(element).find(".card-container").first();
		// account.cash.forEach(cash => {
		// 	let html = '';
		// 	html += 	'<div class="cash-card" data-id="' + cash.id + '" data-type="cash">';
		// 	html += 		'<a href="#cash-modal-' + cash.id + '" uk-toggle>';
		// 	html += 			'<div class="uk-grid-small" uk-grid>';
		// 	html += 				'<div class="uk-width-auto">';
		// 	if (cash.type == 'expense') {
		// 		html += 				'<span class="icon-expense" uk-icon="icon: arrow-down; ratio: 2"></span>';	
		// 	} else {
		// 		html += 				'<span class="icon-income" uk-icon="icon: arrow-up; ratio: 2"></span>';
		// 	}			
		// 	html += 				'</div>';
		// 	html += 				'<div class="uk-width-expand uk-flex-middle">';
		// 	html += 					'<p class="card-text-xl">€' + cash.amount + '</p>';
		// 	html += 					'<p class="card-text-m">' + cash.item.name + '</p>';
		// 	html += 					'<p class="card-text-s"><time datetime="2016-04-01T19:00">' + cash.created_at + '</time></p>';
		// 	html += '</div></div></a></div>';
		
		// 	$(cardContainer).append(html);
		// });

		$(element).show(1000);
	}

	let accountContainer = $("#account-container");
	let accountId = 1;

	getAccount(accountId).done(function(response) {
		// let account = JSON.parse(response);
		// console.log(account);
		$(response.html).hide().appendTo($("#main-container")).fadeIn("slow");
		// renderAccount(accountContainer, account);
	}); 

	// Get Cash item

    // $(".cash-card").click(function() {
		
	// 	let type = $(this).attr('data-type');
	// 	let itemId = $(this).attr('data-id');
		
	// 	getItem(type, itemId).done(function(response) {
	// 		console.log(response);
	// 		$(response.html).hide().prependTo($(".card-container").first()).fadeIn("slow");
	// 	}); 		       
		
	// });

    // $(".cash-card").click(function() {
		
	// 	let type = $(this).attr('data-type');
	// 	let itemId = $(this).attr('data-id');
		
	// 	getItem(type, itemId).done(function(item) {
	// 		console.log(JSON.parse(item));
	// 	}); 		       
		
	// });

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
