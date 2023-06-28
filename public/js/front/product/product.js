$(document).ready(function () {
    $('.nav-button').click(function () {
        $('body').toggleClass('nav-open');
    });

    //ready window settings or texts
    readyWindow();
});

$('.border-sizes').click(function () {
    $('.border-sizes.clicked').removeClass('clicked');
    $(this).addClass('clicked');
});

function readyWindow()
{
    //variation, size & style text update
    updateSelectedVariation(document.getElementsByClassName('variation_div')[0]);
    updateSelectedSize(document.getElementsByClassName('size_div')[0]);
    updateSelectedStyle(document.getElementsByClassName('style_div')[0]);
}

//variation, size & style text update
function updateSelectedVariation(element) {
    var name = element.querySelector('h6').innerText;
    var borderNameSpan = document.getElementById('selected-variation-title');
    borderNameSpan.innerText = name;
}

//variation, size & style text update
function updateSelectedSize(element) {
    var name = element.innerText;
    document.getElementById('selected-size-title').innerText = $.trim(name);
}

//variation, size & style text update
function updateSelectedStyle(element) {
    var name = element.querySelector('h6').innerText;
    var borderNameSpan = document.getElementById('selected-style-title');
    borderNameSpan.innerText = name;
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

//trigger variation event
function triggerVariationEvent(image, productId, VariationId) {
    toggleTick(image);
}

