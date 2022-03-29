$(document).ready(function () {
    $('#tombol-cari').hide();

    // event ketika keyword ditulis
    $('#keyword').on('keyup', function () {
        // munculkan loader
        $('.loader').show();

        // ajax menggunakan load
        // $('#container').load('ajax/mobil.php?keyword=' + $('#keyword').val());

        // $.get()
        $.get('ajax/mobil.php?keyword=' + $('#keyword').val(), function (data) {

            $('#container').html(data);
            $('.loader').hide();
        });
    });

});