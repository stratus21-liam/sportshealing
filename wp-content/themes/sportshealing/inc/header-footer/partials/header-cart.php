<?php
if (!defined('ABSPATH') || sportshealing_bool_field('sportshealing_hide_cart', $layout['post_id'])) {
    return;
}
?>
<div class="header-cart">
    <a href="<?php echo esc_url(sportshealing_static_url('cart.html')); ?>">
        <?php esc_html_e('cart', 'sportshealing'); ?>
        <i class="fa-solid fa-cart-shopping"></i>
        <span>02</span>
    </a>
</div>
