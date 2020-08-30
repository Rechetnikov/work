// $(function() {
//     $("#dialog").dialog({
//         autoOpen: false,
//     });

//     $("#message").dialog({
//         autoOpen: false,
//     });

//     $("#new_task").on("click", function() {
//         $("#dialog").dialog("open");
//     });
// });

$(document).ready(function()
{
    $('#authorization').on('click', '#edit_fio', function () {
        var $fio = $("#authorization").find("#fio").val();
        var $id = $(this).attr('rel');
        if($id == ""){
            alert("Не найден ID");
        }else{
            if($fio == ""){
                alert("Поле ФИО не должно быть пустым");
            }else{
                update_fio($id, $fio)
                console.log("Данные успешно обновлены!");
            }
        }
    });

    function update_fio($id, $fio) {
        $.ajax({
            type: "POST",
            dataType: "text",
            url: "/",
            data:{
                action: "editfio",
                id: $id,
                fio: $fio
            }
        });
    }
});

