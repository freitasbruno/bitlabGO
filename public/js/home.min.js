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
