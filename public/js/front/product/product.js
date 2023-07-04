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
        url: '/ajax/get-product-variation-sizes-styles/' + productId + '/' + variationId,
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


        $.each(data.sizes, function (i, item) {
            $('#sizes-row').append($("<div class=\"col-md-3 mb-2 size\">\n" +
                "                                                    <div class=\"border-sizes size_div\" onclick=\"triggerSizeEvent(this, '"+ productId +"', "+ item.id +")\">\n" +
                "                                                        <label>" + item.title+ "</label>\n" +
                "                                                    </div>\n" +
                "                                                </div>"));
        });

        zoom();
        readyWindow('variation');
    });
}


//trigger variation event
function triggerSizeEvent(element, productId, sizeId) {
    updateSelectedSize(element);
    getStyles(productId, sizeId);
}

//running on size click
function getStyles(productId, sizeId) {

    $.ajax({
        method: "GET",
        url: '/ajax/get-product-variation-styles/' + productId + '/' + selectedVariation + '/' + sizeId,
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
        console.log(data);
        $('#sizes-row').empty();

        $('#product-image').attr("src", data.image);
        $('#click-enlarge').attr("href", data.image);
        $('#product-price').text('$' +data.price);


        $.each(data.sizes, function (i, item) {
            $('#sizes-row').append($("<div class=\"col-md-3 mb-2 size\">\n" +
                "                                                    <div class=\"border-sizes size_div\" onclick=\"updateSelectedSize(this, " + item.id +")\">\n" +
                "                                                        <label>" + item.title+ "</label>\n" +
                "                                                    </div>\n" +
                "                                                </div>"));
        });

        zoom();
        readyWindow('variation');
    });
}