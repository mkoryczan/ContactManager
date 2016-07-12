function validForm(id) {
    var submit = 1;
    $('#' + id + ' input').each(function () {
        $(this).css('border', 'none');

        var classes = $(this).attr('class').split(' ');
        var idInp = $(this).attr('id');

        $.each(classes, function (index, value) {
            if (value == 'required') {

                if ($('#' + idInp).val().length <= 0) {

                    $('#' + idInp).css('border', '1px solid red');
                    submit = 0;
                    alert($('#' + idInp).attr('title'));

                }
            }
        });
    });
    if (submit == 1) {

        $('#' + id).submit();

    }
}

$('.form-input').on('focus', function () {

    $(this).css('border', 'none');

})