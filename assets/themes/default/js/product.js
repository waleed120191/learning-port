/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    $('.productMoreInfo').click(function () {
        title = $(this).data('title');
        content = $(this).data('content');
        modalId = "#info_modal";
        footer = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
        showModal(modalId, title, content, footer);
    });
});


function showModal(modalId, title, content, footer) {
    $(modalId).find('.modal-title').html(title);
    $(modalId).find('.modal-body').html(content);
    $(modalId).find('.modal-footer').html(footer);
    $(modalId).modal('show');
}

function addProduct(ele) {
    var id = $(ele).data('id');

    $.ajax({
        method: "POST",
        url: base_url + 'product/add',
        data: {id: id}
    })
            .done(function (data) {
                data = $.parseJSON(data);
                if (data.success) {
                    var cartUrl = base_url + 'cart/index';
                    title = 'Info';
                    content = 'Product added successfully!!!';
                    modalId = "#info_modal";
                    footer = '<button type="button" class="btn btn-default" onClick="window.location.replace(\''+cartUrl+'\')" >Move to Cart</button><button type="button" class="btn btn-primary" data-dismiss="modal">Continue shopping</button>';
                    showModal(modalId, title, content, footer);
                }
            });

    updateProductNotification();
}

function updateProductNotification() {
    $('#cartNotification').html('');

    $.ajax({
        method: "POST",
        url: base_url + 'product/get_total_products'
    })
            .done(function (data) {
                data = $.parseJSON(data);
                if (data.success) {
                    $('#cartNotification').html(data.count);
                }
            });
}