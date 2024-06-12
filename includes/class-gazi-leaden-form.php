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
        wp_enqueue_script('jquery');
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
            <?php wp_nonce_field('gazi_leaden_form_action', 'gazi_leaden_form_nonce'); ?>
            <p>
                <input type="submit" name="gazi_leaden_submit" value="Submit">
            </p>
        </form>
        <?php
        self::handle_form_submission();
        return ob_get_clean();
    }

    private static function handle_form_submission() {
        if (isset($_POST['gazi_leaden_submit']) && wp_verify_nonce($_POST['gazi_leaden_form_nonce'], 'gazi_leaden_form_action')) {
            $name = sanitize_text_field($_POST['gazi_name']);
            $email = sanitize_email($_POST['gazi_email']);
            $whatsapp = sanitize_text_field($_POST['gazi_whatsapp']);
            $website = esc_url_raw($_POST['gazi_website']);

            $errors = [];

            if (empty($name)) {
                $errors[] = 'Name is required.';
            }

            if (!is_email($email)) {
                $errors[] = 'Invalid email address.';
            }

            if (empty($whatsapp) || !is_numeric($whatsapp) || strlen($whatsapp) < 10) {
                $errors[] = 'Invalid WhatsApp number.';
            }

            if (empty($website) || !filter_var($website, FILTER_VALIDATE_URL)) {
                $errors[] = 'Invalid website URL.';
            }

            if (empty($errors)) {
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'whatsapp' => $whatsapp,
                    'website' => $website,
                );
                GaziLeaden_DB::insert_data($data);
            } else {
                foreach ($errors as $error) {
                    echo '<div style="color:red;">' . esc_html($error) . '</div>';
                }
            }
        }
    }
}
?>
