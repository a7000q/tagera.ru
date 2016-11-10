$(document).on('click', '.del-image', function () {
    var id = $(this).attr('data-id');
    if (confirm("Вы уверены, что хотите удалить данную фотографию? "))
        deleteImage(id);
    return false;
});

function deleteImage(id) {
    $.ajax({
        url: "/category/del-image",
        method: "POST",
        data: {
            id: id
        }
    });

    $("#add-photo").submit();
}