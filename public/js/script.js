// $(document).ready(function() {
//     console.log("JavaScript загружен и выполняется.");  // Проверка выполнения скрипта
//     $("#pizzaForm").on('submit', function(event) {
//         event.preventDefault();
//         $.ajax({
//             type: "POST",
//             url: "ajaxHandler.php",
//             data: $(this).serialize(),
//             dataType: "json",
//             success: function(response) {
//                 if (typeof response.check !== "undefined" && response.check !== null) {
//                     $("#check").html("Ваш заказ: " + response.check);
//                 } else if (typeof response.error !== "undefined" && response.error !== null) {
//                     $("#check").html("Ошибка: " + response.error);
//                 } else {
//                     $("#check").html("Неизвестная ошибка. Полный ответ сервера: " + JSON.stringify(response));
//                 }
//             },
//             error: function(xhr, status, error) {
//                 $("#check").html("Ошибка: " + error + "<br> Полный ответ сервера: " + xhr.responseText);
//             }
//         });
//     });
// });



$(document).ready(function() {
    console.log("JavaScript загружен и выполняется.");  // Проверка выполнения скрипта
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