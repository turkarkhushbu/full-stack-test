function changeSlider(sliderId) {
    $.ajax({
        url: 'read.php',
        type: 'GET',
        data: { id: sliderId },
        success: function(data) {
            $('#carousel-inner').html(data.carousel);
            $('#image-display').css('background-image', 'url(' + data.image + ')');
            $('#slider').carousel();
        },
        dataType: 'json'
    });
}