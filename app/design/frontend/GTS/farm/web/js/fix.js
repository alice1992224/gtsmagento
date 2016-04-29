require(['jquery'],function($) {
    $(function () {
        var device_width = $(window).width();
        var curr_uri = location.pathname.split('/').pop();
        console.log(device_width);
        console.log(curr_uri);

        switch(curr_uri){
            case "product.html":

                $('.products').css('max-width', device_width);
                $(window).resize(function () {
                    $('.products').css('max-width', $(window).width());
                });
                $('.column1 .product-qty-controller .plus').on('click', function () {
                    // add product number
                    var cur_num = parseInt($(this).parents('.product-item-inner').find('.column3 .product-qty > span').text());
                    var new_num = cur_num + 1;

                    $(this).parents('.product-item-inner').find('.column3 .product-qty > span').text(new_num.toString());

                    // change price
                    /*
                    var unit_price = parseInt($(this).parents('.product-item-inner').find('.column4 .product-price-block .unit').text());
                    var new_price = (unit_price * new_num).toString();
                    $(this).parents('.product-item-inner').find('.column4 .product-price-block .price').text(new_price);
                    */

                    // change real num
                    $(this).parents('.product-item-inner').find('.column3 .actions-primary input[name="qty"]').val(new_num.toString());

                    var add_to_cart_button = $(this).parents('.product-item-inner').find('.action.tocart.primary');
                    if(add_to_cart_button.prop('disabled')){
                        add_to_cart_button.prop('disabled', false);
                    }

                });
                $('.column1 .product-qty-controller .minus').on('click', function () {
                    // add product number
                    var cur_num = parseInt($(this).parents('.product-item-inner').find('.column3 .product-qty > span').text());
                    if (cur_num >= 0) {
                        var new_num = cur_num - 1;
                        $(this).parents('.product-item-inner').find('.column3 .product-qty > span').text(new_num.toString());

                        // change price
                        /*
                        var unit_price = parseInt($(this).parents('.product-item-inner').find('.column4 .product-price-block .unit').text());
                        console.log(unit_price);
                        var new_price = (unit_price * new_num).toString();
                        $(this).parents('.product-item-inner').find('.column4 .product-price-block .price').text(new_price);
                        */

                        // change real num
                        $(this).parents('.product-item-inner').find('.column3 .actions-primary input[name="qty"]').val(new_num.toString());

                        if(new_num == 0){
                            $(this).parents('.product-item-inner').find('.action.tocart.primary').prop('disabled', true);
                        }
                    }
                });
                break;
            case "landowner":
                console.log('in!!!! landowner');

                $('.what-landowner').click(function(){
                    $('.question-block').css('display','block');
                });

                $('.info-container img.mode').click(function(){
                    $(".landowner-text").attr('src', 'pub/media/wysiwyg/landowner/landowner-mode.png');
                });

                $('.info-container img.member').click(function(){
                    $(".landowner-text").attr('src', 'pub/media/wysiwyg/landowner/landowner-member.png');
                });

                $('.info-container img.buy').click(function(){
                    $(".landowner-text").attr('src', 'pub/media/wysiwyg/landowner/landowner-buy.png');
                });

                $('.info-container img.sale').click(function(){
                    $(".landowner-text").attr('src', 'pub/media/wysiwyg/landowner/landowner-sale.png');
                });
                break;
            default:
                break;
        }
    });
});