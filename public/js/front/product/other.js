$(document).ready(function () {
    $('.nav-button').click(function () {
        $('body').toggleClass('nav-open');
    });

    //ready window settings or texts
    readyWindow();
    zoom();
});

function loader(status) {
    if (status == 'start') {
        $('#loading').addClass('loading');
        $('#loading-content').addClass('loading-content');
    }
    if (status == 'close') {
        $('#loading').removeClass('loading');
        $('#loading-content').removeClass('loading-content');
    }
}

function zoom() {
    var sub_width = 0;
    var sub_height = 0;
    $(".large").css("background", "url('" + $(".small").attr("src") + "') no-repeat");

    $(".zoom-area").mousemove(function (e) {
        if (!sub_width && !sub_height) {
            var image_object = new Image();
            image_object.src = $(".small").attr("src");
            sub_width = image_object.width;
            sub_height = image_object.height;
        } else {
            var magnify_position = $(this).offset();

            var mx = e.pageX - magnify_position.left;
            var my = e.pageY - magnify_position.top;

            if (mx < $(this).width() && my < $(this).height() && mx > 0 && my > 0) {
                $(".large").fadeIn(100);
            } else {
                $(".large").fadeOut(100);
            }
            if ($(".large").is(":visible")) {
                var rx = Math.round(mx / $(".small").width() * sub_width - $(".large").width() / 2) * -1;
                var ry = Math.round(my / $(".small").height() * sub_height - $(".large").height() / 2) * -1;

                var bgp = rx + "px " + ry + "px";

                var px = mx - $(".large").width() / 2;
                var py = my - $(".large").height() / 2;

                $(".large").css({left: px, top: py, backgroundPosition: bgp});
            }
        }
    })
}

function toggleTick(image) {
    var tickIcons = document.querySelectorAll('.tick');

    // Hide all tick icons
    for (var i = 0; i < tickIcons.length; i++) {
        tickIcons[i].style.display = 'none';
    }

    // Show the tick icon for the clicked image
    var tickIcon = image.parentElement.querySelector('.tick');
    tickIcon.style.display = 'block';
}

function toggleTickStyle(image) {
    var tickIcons = document.querySelectorAll('.style-tick');

    // Hide all tick icons
    for (var i = 0; i < tickIcons.length; i++) {
        tickIcons[i].style.display = 'none';
    }

    // Show the tick icon for the clicked image
    var tickIcon = image.parentElement.querySelector('.style-tick');
    tickIcon.style.display = 'block';
}

//pass variable if you want to skip them
function readyWindow(variation = null, size = null, style = null) {
    //variation, size & style text update
    if (variation == null) {
        let element = document.getElementsByClassName('variation_div')[0];
        updateSelectedVariation(element);
        toggleTick(element.querySelector('img'));
    }

    if (size == null) {
        let elementSize = document.getElementsByClassName('size_div')[0];
        updateSelectedSize(elementSize);
        //$(elementSize).trigger( "click" );
    }

    if (style == null) {
        let elementStyle = document.getElementsByClassName('style_div')[0];
        updateSelectedStyle(elementStyle);
        toggleTickStyle(elementStyle.querySelector('img'));
    }
}

//variation, size & style text update
function updateSelectedVariation(element) {
    var name = element.querySelector('h6').innerText;
    var borderNameSpan = document.getElementById('selected-variation-title');
    borderNameSpan.innerText = name;

    selectedVariation = element.querySelector('label').innerText;
}

//variation, size & style text update
function updateSelectedSize(element) {
    var name = element.innerText;
    document.getElementById('selected-size-title').innerText = $.trim(name);

    $('.border-sizes').removeClass('clicked');
    $(element).addClass('clicked');

    selectedSize = element.querySelector('label').getAttribute('data-info');
}

//variation, size & style text update
function updateSelectedStyle(element) {
    var name = element.querySelector('h6').innerText;
    var borderNameSpan = document.getElementById('selected-style-title');
    borderNameSpan.innerText = name;

    selectedStyle = element.querySelector('label').innerText;
}