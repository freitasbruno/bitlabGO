document.addEventListener("DOMContentLoaded", function(event) {
    $(".taskCheckbox").change(function() {
        var taskId = this.value;
        //this.form.submit();
        $.ajax({
            url: '/tasks/toggleComplete/',
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
});
