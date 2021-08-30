jQuery(function ($) {
    var $coupon_form = $('#ec-check-coupon-form');
    var $video = $('#ec-video');
    var video_id = $video.data('id');
    var video_coupon = localStorage.getItem('coupon_' + video_id);

    if (video_coupon)
        checkCoupon(video_coupon);
    else
        $coupon_form.show();

    function saveOrUpdateCoupon(code, video_id) {
        localStorage.setItem('coupon_' + video_id, code);
    }

    function checkCoupon(code, callback) {
        $.ajax({
            url: ec_ajax.ajax_url,
            data: {
                action: 'check_coupon',
                code: code,
                video_id: video_id
            },
            dataType: 'JSON',
            type: 'POST',
            success: function (res) {
                if (res.status) {
                    $coupon_form.hide();
                    $video.attr('src', res.source).show();

                    saveOrUpdateCoupon(res.code, res.video_id);
                } else {
                    $coupon_form.show();
                    $video.attr('src', '').hide();
                }

                if (callback)
                    callback(res);
            }
        });
    }

    $('#ec-check-coupon-form').submit(function () {
        var code = $(this).find('input[name="coupon"]').val();

        checkCoupon(code, function (res) {
            if (!res.status) {
                alert(res.error != false ? res.error : 'Invalid coupon');
            }
        });

        return false;
    });

    $('.ec-video').on('click', function () {
        var id = $(this).data('id');
        var href = window.location.href;

        window.location.href = href + (href.indexOf('?') > 0 ? '&' : '?') + 'ec-video=' + id;
    });
});
