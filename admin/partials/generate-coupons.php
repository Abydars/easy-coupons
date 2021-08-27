<div class="wrap">
    <h2>Generate Coupons</h2>
    <form method="POST">
        <div class="ec-box">
            <div class="ec-field-half">
                <div class="ec-field">
                    <label>Quantity</label>
                    <input type="number" name="quantity" min="1"/>
                </div>
                <div class="ec-field">
                    <label>Expiry Date</label>
                    <input type="date" name="expiry" required/>
                </div>
            </div>
			<?php wp_nonce_field( 'ec-generate-coupons', '_ec_nonce' ) ?>
            <input type="submit" value="Generate" class="button button-primary ec-input-submit"/>
        </div>
    </form>
</div>
