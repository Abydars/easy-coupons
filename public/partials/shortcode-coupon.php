<form class="ec-form" method="POST" id="ec-check-coupon-form">
    <div><label>Enter Your Coupon Code</label></div>
    <div><input type="text" name="coupon"/></div>
    <input type="hidden" name="action" value="check_coupons"/>
	<?php wp_nonce_field( 'ec-coupon', 'ec-nonce' ) ?>
    <div><input type="submit"/></div>
</form>
<video data-id="<?= $_REQUEST['ec-video'] ?>" id="ec-video" controls/>
