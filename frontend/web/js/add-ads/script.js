
$(document).on("click", ".category-item", function () {
    var id_category = $(this).attr("data-item");
    removeBlocks(this);
    var children_block = $(this).parent("ul").parent("div").parent("div");
    setChildren(id_category, children_block);
    var parent_ul = $(this).parent("ul");
    $(parent_ul).children("li").removeClass('active-item');
    $(this).addClass('active-item');
});

function setChildren(id_category, children_block) {
    $.ajax({
        url: "/ads/get-children",
        method: "POST",
        data: {
            id_category: id_category
        },
        success: function (html) {
            if (html != 'true')
                setChildrenHtml(html, children_block);
            else
                changeCategory(id_category);
        }
    });
}

function setChildrenHtml(html, block) {
    lenhgt = $(".category-block").length;
    lenhgt = lenhgt + 1;

    if (!$('.category-block').is('[data-item = "none"]'))
    {
        txt = "<div class='category-block' data-item='none'></div>";
        $(block).append(txt);
    }
    else
        lenhgt = lenhgt - 1;

    $('.category-block[data-item = "none"]').html(html);
    $('.category-block[data-item="none"]').attr('data-item', lenhgt);
}

function removeBlocks(block) {
    block_item = Number($(block).parent("ul").parent("div").attr("data-item"));

    $(".category-block").each(function (index, el) {
        var data_item = $(el).attr('data-item');



        if (data_item > (block_item + 1)) {
            $(el).remove();
        }

        if (data_item == (block_item + 1)) {

            $(el).attr('data-item', 'none');
        }
    });
}

function changeCategory(id_category) {
    $('#id_category').val(id_category);
    $('#add-form').submit();
    $('#category-modal').modal("toggle");
}

