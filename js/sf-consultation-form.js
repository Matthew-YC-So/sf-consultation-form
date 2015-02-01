(function ($) {
    function checkDate(y, m, d) {
        var ok = true;
        if (!isNaN(y) && y > 0 && y < 999999 && !isNaN(m) && m > 0 && m < 13 && !isNaN(d) && d > 0 && d < 32) {
            var date = new Date(y, m - 1, d);
            ok = date.getFullYear() == y && date.getMonth() + 1 == m && date.getDate() == d;
        }
        return ok;
    }


    $(function () {

        $('.entry-form').on("submit", function () {
            $("input[type=text],input[type=email],input[type=url],textarea", $(this)).filter("[required]").each(function () {
                if (!$(this).val()) {
                    return false;
                }
            })
            if ($("input[name='ef-sex']:checked", $(this)).length == 0)
                return false;
        });


        $('#ef-submitted').click(function (event) {

            $('span.error', $(this).closest('form')).remove();

            var people = ['my', 'target', 'intruder'];
            for (p in people) {
                var y = parseInt($('#ef-' + people[p] + 'birthyear').val());
                var m = parseInt($('#ef-' + people[p] + 'birthmonth').val());
                var d = parseInt($('#ef-' + people[p] + 'birthday').val());

                if (!checkDate(y, m, d)) {
                    $('<span class="error">X</span>').insertBefore($('#ef-' + people[p] + 'birthyear'));
                    event.preventDefault();
                }
            }
        })
    })





})(jQuery);