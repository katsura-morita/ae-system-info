<div class="wrap">
    <h1><?php echo __('System Info', 'ae-system-info'); ?></h1>
    <table class="form-table">
        <tr>
            <th><?php echo __('PHP Version', 'ae-system-info'); ?></th>
            <td>
                <?php echo $php_version; ?><br>
                <span style="color: gray;"><?php echo __('Latest stable version', 'ae-system-info'); ?>: <?php echo $latest_php_version; ?></span>
            </td>
        </tr>
        <tr><th><?php echo __('MySQL Version', 'ae-system-info'); ?></th><td><?php echo $mysql_version; ?></td></tr>
        <tr><th><?php echo __('DB Name', 'ae-system-info'); ?></th><td><?php echo $db_name; ?></td></tr>
        <tr><th><?php echo __('WordPress Version', 'ae-system-info'); ?></th><td><?php echo $wp_version; ?></td></tr>
        <tr><th><?php echo __('Server Software', 'ae-system-info'); ?></th><td><?php echo $server_software; ?></td></tr>
        <tr><th><?php echo __('Document Root', 'ae-system-info'); ?></th><td><?php echo $document_root; ?></td></tr>
        <tr><th><?php echo __('Remote Address', 'ae-system-info'); ?></th><td><?php echo $remote_addr; ?></td></tr>
        <tr><th><?php echo __('User Agent', 'ae-system-info'); ?></th><td><?php echo $http_user_agent; ?></td></tr>
        <tr><th><?php echo __('Cookies', 'ae-system-info'); ?></th><td>
            <?php if (!empty($cookies)) : ?>
                <ul>
                    <?php foreach ($cookies as $key => $value) : ?>
                        <li><?php echo esc_html($key) . ': ' . esc_html($value); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <?php echo __('No cookies found', 'ae-system-info'); ?>
            <?php endif; ?>
        </td></tr>
        <tr><th><?php echo __('Session', 'ae-system-info'); ?></th><td>
            <?php if (!empty($session)) : ?>
                <ul>
                    <?php foreach ($session as $key => $value) : ?>
                        <li><?php echo esc_html($key) . ': ' . esc_html($value); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <?php echo __('No session data found', 'ae-system-info'); ?>
            <?php endif; ?>
        </td></tr>
    </table>
</div>

