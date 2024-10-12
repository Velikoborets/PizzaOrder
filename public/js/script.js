$(document).ready(function() {
    $("#pizzaForm").on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "ajaxHandler.php",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.check) {
                    $("#check").html("Ваш заказ: " + response.check);
                } else {
                    $("#check").html("Ошибка: " + response.error);
                }
            },
            error: function(xhr, status, error) {
                $("#check").html("Ошибка: " + error + "<br> Полный ответ сервера: " + xhr.responseText);
            }
        });
    });
});