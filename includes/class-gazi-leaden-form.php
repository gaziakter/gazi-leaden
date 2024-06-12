<?php
if (!defined('ABSPATH')) {
    exit;
}

class GaziLeaden_Form {
    public static function register_shortcode() {
        add_shortcode('gazi_leaden_form', array(__CLASS__, 'render_form'));
        add_action('wp_enqueue_scripts', array(__CLASS__, 'enqueue_form_script'));

    }

    public static function enqueue_form_script() {
        wp_enqueue_script('gazi-leaden-form-js', GAZI_LEADEN_PLUGIN_URL . 'assets/js/gazi-leaden-form.js', array('jquery'), GAZI_LEADEN_VERSION, true);
    }

    public static function render_form() {
        ob_start();
        ?>
        <form method="post" action="">
            <p>
                <label for="gazi_name">Name</label>
                <input type="text" id="gazi_name" name="gazi_name" required>
            </p>
            <p>
                <label for="gazi_email">Email</label>
                <input type="email" id="gazi_email" name="gazi_email" required>
            </p>
            <p>
                <label for="gazi_whatsapp">What's App Number</label>
                <input type="text" id="gazi_whatsapp" name="gazi_whatsapp" required>
            </p>
            <p>
                <label for="gazi_website">Website</label>
                <input type="text" id="gazi_website" name="gazi_website" required>
            </p>
            <p>
                <input type="submit" name="gazi_leaden_submit" value="Submit">
            </p>
        </form>
        <?php
        self::handle_form_submission();
        return ob_get_clean();
    }

    private static function handle_form_submission() {
        if (isset($_POST['gazi_leaden_submit'])) {
            $data = array(
                'name' => sanitize_text_field($_POST['gazi_name']),
                'email' => sanitize_email($_POST['gazi_email']),
                'whatsapp' => sanitize_text_field($_POST['gazi_whatsapp']),
                'website' => sanitize_text_field($_POST['gazi_website']),
            );
            GaziLeaden_DB::insert_data($data);
        }
    }
}
?>
