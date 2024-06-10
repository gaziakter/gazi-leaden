<?php
if (!defined('ABSPATH')) {
    exit;
}

class GaziLeaden_Admin {
    public static function register_menu() {
        add_menu_page(
            'Gazi Leaden',
            'Gazi Leaden',
            'manage_options',
            'gazi-leaden',
            array(__CLASS__, 'display_data'),
            'dashicons-forms'
        );
    }

    public static function display_data() {
        $data = GaziLeaden_DB::get_data();
        ?>
        <div class="wrap">
            <h1>Gazi Leaden Submissions</h1>
            <table class="widefat fixed" cellspacing="0">
                <thead>
                    <tr>
                        <th id="columnname" class="manage-column column-columnname" scope="col">Name</th>
                        <th id="columnname" class="manage-column column-columnname" scope="col">Email</th>
                        <th id="columnname" class="manage-column column-columnname" scope="col">What's App</th>
                        <th id="columnname" class="manage-column column-columnname" scope="col">Website</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $row) { ?>
                        <tr>
                            <td class="column-columnname"><?php echo esc_html($row['name']); ?></td>
                            <td class="column-columnname"><?php echo esc_html($row['email']); ?></td>
                            <td class="column-columnname"><?php echo esc_html($row['whatsapp']); ?></td>
                            <td class="column-columnname"><?php echo esc_html($row['website']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}
?>
