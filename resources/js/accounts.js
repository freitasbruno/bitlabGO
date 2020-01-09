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
