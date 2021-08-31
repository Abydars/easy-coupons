<?php
$type    = ! empty( $_GET['type'] ) ? $_GET['type'] : "not_found";
$reports = get_option( "coupons_{$type}", [] );
?>
<div class="wrap">
    <h2>Coupon Reports&nbsp;<a href="<?= add_query_arg( [
		                                                    'ec-nonce'  => wp_create_nonce( 'clear-logs' ),
		                                                    'ec-action' => 'clear-logs'
	                                                    ] ) ?>">Clear logs</a></h2>
    <ul class="subsubsub">
        <li class="all">
            <a href="<?= add_query_arg( 'type', 'not_found' ) ?>" class="<?= $type == 'not_found' ? 'current' : '' ?>"
               aria-current="page">Not Found</a>&nbsp;|&nbsp;<a
                    href="<?= add_query_arg( 'type', 'used' ) ?>" class="<?= $type == 'used' ? 'current' : '' ?>"
                    aria-current="page">Already Used</a>&nbsp;|&nbsp;<a
                    href="<?= add_query_arg( 'type', 'expired' ) ?>" class="<?= $type == 'expired' ? 'current' : '' ?>"
                    aria-current="page">Expired</a>
        </li>
    </ul>
    <table class="widefat">
        <tr>
            <th>Code</th>
            <th>Timestamp</th>
        </tr>
		<?php foreach ( $reports as $r ) : ?>
            <tr>
                <td><?= $r['code'] ?></td>
                <td><?= date( 'F j Y h:i a', $r['t'] ) ?></td>
            </tr>
		<?php endforeach; ?>
    </table>
</div>
