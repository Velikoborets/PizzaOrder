$(document).ready(function() {
    $("#pizzaForm").on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "ajaxHandler.php",
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {
                $("#check").html("Ваш заказ: " + data.check);
            },
            error: function(xhr, status, error) {
                $("#check").html("Error: " + error);
            }
        });
    });
});