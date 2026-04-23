<?php
if (!defined('ABSPATH') || sportshealing_bool_field('sportshealing_hide_search', $layout['post_id'])) {
    return;
}
?>
<div class="header-search">
    <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
        <div class="form-group mb-0">
            <div class="form-floating field-inner">
                <input id="search" name="s" class="form-control white-field" placeholder="<?php esc_attr_e('Keywords here...', 'sportshealing'); ?>" type="text" autocomplete="off">
                <label for="search"><?php esc_html_e('Search', 'sportshealing'); ?></label>
                <button type="submit" aria-label="<?php esc_attr_e('submit', 'sportshealing'); ?>"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
    </form>
</div>
