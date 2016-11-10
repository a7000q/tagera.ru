$(document).on('click', '.del-image', function () {
    var id = $(this).attr('data-id');
    if (confirm("Вы уверены, что хотите удалить данную фотографию? "))
        deleteImage(id);
    return false;
});

function deleteImage(id) {
    $.ajax({
        url: "/ads/del-image",
        method: "POST",
        data: {
            id: id
        }
    });

    $("#update-form").submit();
}

$(document).ajaxStart(function () {
    $.blockUI({ message: $('#domMessage') });
});

$(document).ajaxStop($.unblockUI);