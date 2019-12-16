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

	function render (response) {		
        $("#main-container").html('');
		$(response.html).hide().appendTo($("#main-container")).fadeIn("slow");
		
		console.log(JSON.parse(response.items));
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
