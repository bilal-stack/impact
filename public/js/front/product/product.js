$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//trigger variation event
function triggerVariationEvent(image, productId, variationId) {
    toggleTick(image);
    getSizesWithStyle(productId, variationId);
}

//running on variation click
function getSizesWithStyle(productId, variationId) {
    $.ajax({
        method: "GET",
        url: baseUrl + 'ajax/get-product-variation-sizes-styles/' + productId + '/' + variationId,
        error: function (error) {
            alert(error);
        },
        beforeSend: function () {
            loader('start');
        },
        complete: function () {
            loader('close');
        }
    }).done(function (data) {
        $('#sizes-row').empty();

        $('#product-image').attr("src", data.image);
        $('#click-enlarge').attr("href", data.image);
        $('#product-price').text('$' +data.price);
        $('#price_input').val(data.price);

        $.each(data.sizes, function (i, item) {
            $('#sizes-row').append($("<div class=\"col-md-3 mb-2 size\">\n" +
                "                                                    <div class=\"border-sizes size_div\" onclick=\"triggerSizeEvent(this, '"+ productId +"', "+ item.id +")\">\n" +
                "                                                        <label data-info=\"" + item.id + "\">" + item.title+ "</label>\n" +
                "                                                    </div>\n" +
                "                                                </div>"));
        });

        zoom();
        readyWindow('variation');
    });
}

//trigger size event
function triggerSizeEvent(element, productId, sizeId) {
    updateSelectedSize(element);
    getStyles(productId, sizeId);
}

//running on size click
function getStyles(productId, sizeId) {

    $.ajax({
        method: "GET",
        url: baseUrl + 'ajax/get-product-variation-styles/' + productId + '/' + selectedVariation + '/' + sizeId,
        error: function (error) {
            alert(error);
        },
        beforeSend: function () {
            loader('start');
        },
        complete: function () {
            loader('close');
        }
    }).done(function (data) {
        $('#styles-row').empty();

        $('#product-image').attr("src", data.image);
        $('#click-enlarge').attr("href", data.image);
        $('#product-price').text('$' +data.price);
        $('#price_input').val(data.price);

        $.each(data.styles, function (i, item) {
            $('#styles-row').append($("<div class=\"col-md-3 style_div\">\n" +
                "                                                <div class=\"border-img\" onclick=\"triggerStyleEvent(this, '"+ productId +"', "+ item.id +")\">\n" +
                "                                                    <img src=\""+ styleImagePath + "/" + item.option_image +"\" alt=\"\" onclick=\"toggleTickStyle(this)\">\n" +
                "                                                    <span class=\"style-tick\"></span>\n" +
                "                                                    <h6><small>" + item.title+ "</small></h6>\n" +
                "                                                    <label class=\"variation-style-info d-none\">" + item.id+ "</label>\n" +
                "                                                </div>\n" +
                "                                            </div>"));
        });

        zoom();
        readyWindow('variation', 'sizes');
    });
}

//trigger variation event
function triggerStyleEvent(element, productId, styleId) {
    updateSelectedStyle(element);
    getStylesData(productId, styleId);
}

//running on size click
function getStylesData(productId, styleId) {

    $.ajax({
        method: "GET",
        url: baseUrl + 'ajax/get-product-variation-styles-data/' + productId + '/' + selectedVariation + '/' + selectedSize + '/' + styleId,
        error: function (error) {
            alert(error);
        },
        beforeSend: function () {
            loader('start');
        },
        complete: function () {
            loader('close');
        }
    }).done(function (data) {
        $('#product-image').attr("src", data.image);
        $('#click-enlarge').attr("href", data.image);
        $('#product-price').text('$' +data.price);
        $('#price_input').val(data.price);

        zoom();
        //readyWindow('variation', 'sizes', 'style');
    });
}
