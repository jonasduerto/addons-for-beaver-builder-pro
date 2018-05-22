<?php
/**
 * Plugin Name: Addons for Beaver Builder Pro
 * Plugin URI: https://www.livemeshthemes.com/beaver-builder-addons
 * Description: A collection of premium quality addons or modules for use in Beaver Builder page builder. Beaver Builder must be installed and activated.
 * Author: Livemesh
 * Author URI: https://www.livemeshthemes.com/beaver-builder-addons
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 * Version: 1.8.2
 * Text Domain: livemesh-bb-addons
 * Domain Path: languages
 *
 * Addons for Beaver Builder Pro is distributed under the terms of the GNU
 * General Public License as published by the Free Software Foundation,
 * either version 2 of the License, or any later version.
 *
 * Addons for Beaver Builder Pro is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Addons for Beaver Builder Pro. If not, see <http://www.gnu.org/licenses/>.
 *
 */

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

if (!class_exists('Livemesh_BB_Addons_Pro')) :

    /**
     * Main Livemesh_BB_Addons_Pro Class
     *
     */
    final class Livemesh_BB_Addons_Pro {

        /** Singleton *************************************************************/

        private static $instance;

        /**
         * Main Livemesh_BB_Addons_Pro Instance
         *
         * Insures that only one instance of Livemesh_BB_Addons_Pro exists in memory at any one
         * time. Also prevents needing to define globals all over the place.
         */
        public static function instance() {

            if (self::check_for_lite_version())
                return null;

            if (!isset(self::$instance) && !(self::$instance instanceof Livemesh_BB_Addons_Pro)) {

                self::$instance = new Livemesh_BB_Addons_Pro;

                self::$instance->setup_constants();

                self::$instance->includes();

                self::$instance->hooks();

            }
            return self::$instance;
        }

        private static function check_for_lite_version() {

            if (!function_exists('is_plugin_active')) {
                include_once ABSPATH . 'wp-admin/includes/plugin.php';
            }

            $lite_dirname = 'addons-for-beaver-builder';

            $lite_active = is_plugin_active($lite_dirname . '/livemesh-bb-addons.php');

            if (class_exists('Livemesh_BB_Addons') || $lite_active) {

                add_action('admin_notices', __CLASS__ . '::double_install_admin_notice');

                add_action('network_admin_notices', __CLASS__ . '::double_install_admin_notice');

                return true;
            }

            return false;
        }

        /**
         * Shows an admin notice if another version of the addons plugin
         * has already been loaded before this one.
         */
        public static function double_install_admin_notice() {

            $message = __('You currently have two versions of Addons for Beaver Builder active on this site. Please <a href="%s">deactivate free version</a> to enable PRO version.', 'livemesh-bb-addons');

            self::render_admin_notice(sprintf($message, admin_url('plugins.php')), 'error');
        }

        /**
         * Renders an admin notice.
         */
        private static function render_admin_notice($message, $type = 'update') {

            if (!is_admin()) {
                return;
            }
            elseif (!is_user_logged_in()) {
                return;
            }
            elseif (!current_user_can('update_plugins')) {
                return;
            }

            echo '<div class="' . $type . '">';
            echo '<p>' . $message . '</p>';
            echo '</div>';
        }

        /**
         * Throw error on object clone
         *
         * The whole idea of the singleton design pattern is that there is a single
         * object therefore, we don't want the object to be cloned.
         */
        public function __clone() {
            // Cloning instances of the class is forbidden
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'livemesh-bb-addons'), '1.8.2');
        }

        /**
         * Disable unserializing of the class
         *
         */
        public function __wakeup() {
            // Unserializing instances of the class is forbidden
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'livemesh-bb-addons'), '1.8.2');
        }

        /**
         * Setup plugin constants
         *
         */
        private function setup_constants() {

            // Plugin version
            if (!defined('LABB_VERSION')) {
                define('LABB_VERSION', '1.8.2');
            }

            // Plugin Folder Path
            if (!defined('LABB_PLUGIN_DIR')) {
                define('LABB_PLUGIN_DIR', plugin_dir_path(__FILE__));
            }

            // Plugin Folder URL
            if (!defined('LABB_PLUGIN_URL')) {
                define('LABB_PLUGIN_URL', plugin_dir_url(__FILE__));
            }

            // Plugin Folder Path
            if (!defined('LABB_ADDONS_DIR')) {
                define('LABB_ADDONS_DIR', plugin_dir_path(__FILE__) . 'includes/modules/');
            }

            // Plugin Folder Path
            if (!defined('LABB_ADDONS_URL')) {
                define('LABB_ADDONS_URL', plugin_dir_url(__FILE__) . 'includes/modules/');
            }

            // Admin Folder Path
            if (!defined('LABB_ADMIN_DIR')) {
                define('LABB_ADMIN_DIR', plugin_dir_path(__FILE__) . 'admin/');
            }

            // Admin Folder URL
            if (!defined('LABB_ADMIN_URL')) {
                define('LABB_ADMIN_URL', plugin_dir_url(__FILE__) . 'admin/');
            }

            // Plugin Root File
            if (!defined('LABB_PLUGIN_FILE')) {
                define('LABB_PLUGIN_FILE', __FILE__);
            }

            // Plugin Help Page URL
            if (!defined('LABB_PLUGIN_HELP_URL')) {
                define('LABB_PLUGIN_HELP_URL', admin_url() . 'admin.php?page=livemesh_bb_addons_documentation');
            }

            $this->setup_debug_constants();
        }

        private function setup_debug_constants() {

            $enable_debug = false;

            $settings = get_option('labb_settings');

            if ($settings && isset($settings['labb_enable_debug']) && $settings['labb_enable_debug'] == "true")
                $enable_debug = true;

            // Enable script debugging
            if (!defined('LABB_SCRIPT_DEBUG')) {
                define('LABB_SCRIPT_DEBUG', $enable_debug);
            }

            // Minified JS file name suffix
            if (!defined('LABB_JS_SUFFIX')) {
                if ($enable_debug)
                    define('LABB_JS_SUFFIX', '');
                else
                    define('LABB_JS_SUFFIX', '.min');
            }
        }

        /**
         * Include required files
         *
         */
        private function includes() {

            require_once LABB_PLUGIN_DIR . 'includes/helper-functions.php';

            require_once LABB_PLUGIN_DIR . 'includes/blocks/blocks-init.php';

            require_once LABB_PLUGIN_DIR . 'includes/gallery/common.php';
            require_once LABB_PLUGIN_DIR . 'includes/gallery/video.php';
            require_once LABB_PLUGIN_DIR . 'includes/gallery/vimeo-api.php';

            if (is_admin()) {
                require_once LABB_PLUGIN_DIR . 'admin/admin-init.php';
            }

            /* Load Custom Field Types */
            require_once LABB_PLUGIN_DIR . 'includes/fields/labb-number/labb-number.php';
            require_once LABB_PLUGIN_DIR . 'includes/fields/labb-toggle-button/labb-toggle-button.php';

        }

        /**
         * Include required files
         *
         */
        public function include_modules() {

            if (!class_exists('FLBuilder')) {
                return;
            }

            /* Load Beaver Builder Addon Elements */

            require_once LABB_ADDONS_DIR . 'labb-accordion/labb-accordion.php';

            require_once LABB_ADDONS_DIR . 'labb-carousel/labb-carousel.php';

            require_once LABB_ADDONS_DIR . 'labb-clients/labb-clients.php';

            require_once LABB_ADDONS_DIR . 'labb-heading/labb-heading.php';

            require_once LABB_ADDONS_DIR . 'labb-odometers/labb-odometers.php';

            require_once LABB_ADDONS_DIR . 'labb-piecharts/labb-piecharts.php';

            require_once LABB_ADDONS_DIR . 'labb-portfolio/labb-portfolio.php';

            require_once LABB_ADDONS_DIR . 'labb-posts-block/labb-posts-block.php';

            require_once LABB_ADDONS_DIR . 'labb-posts-carousel/labb-posts-carousel.php';

            require_once LABB_ADDONS_DIR . 'labb-pricing-table/labb-pricing-table.php';

            require_once LABB_ADDONS_DIR . 'labb-services/labb-services.php';

            require_once LABB_ADDONS_DIR . 'labb-stats-bar/labb-stats-bar.php';

            require_once LABB_ADDONS_DIR . 'labb-tabs/labb-tabs.php';


            require_once LABB_ADDONS_DIR . 'labb-team-members/labb-team-members.php';

            require_once LABB_ADDONS_DIR . 'labb-testimonials/labb-testimonials.php';

            require_once LABB_ADDONS_DIR . 'labb-testimonials-slider/labb-testimonials-slider.php';

            /* --------------- Pro Elements ------------------ */


            require_once LABB_ADDONS_DIR . 'labb-faq/labb-faq.php';

            require_once LABB_ADDONS_DIR . 'labb-features/labb-features.php';

            require_once LABB_ADDONS_DIR . 'labb-button/labb-button.php';

            require_once LABB_ADDONS_DIR . 'labb-gallery-carousel/labb-gallery-carousel.php';

            require_once LABB_ADDONS_DIR . 'labb-gallery/labb-gallery.php';

            require_once LABB_ADDONS_DIR . 'labb-icon-list/labb-icon-list.php';

            require_once LABB_ADDONS_DIR . 'labb-image-slider/labb-image-slider.php';

            require_once LABB_ADDONS_DIR . 'labb-slider/labb-slider.php';

        }

        /**
         * Load Plugin Text Domain
         *
         * Looks for the plugin translation files in certain directories and loads
         * them to allow the plugin to be localised
         */
        public function load_plugin_textdomain() {

            $lang_dir = apply_filters('labb_bb_addons_lang_dir', trailingslashit(LABB_PLUGIN_DIR . 'languages'));

            // Traditional WordPress plugin locale filter
            $locale = apply_filters('plugin_locale', get_locale(), 'livemesh-bb-addons');
            $mofile = sprintf('%1$s-%2$s.mo', 'livemesh-bb-addons', $locale);

            // Setup paths to current locale file
            $mofile_local = $lang_dir . $mofile;

            if (file_exists($mofile_local)) {
                // Look in the /wp-content/plugins/livemesh-bb-addons/languages/ folder
                load_textdomain('livemesh-bb-addons', $mofile_local);
            }
            else {
                // Load the default language files
                load_plugin_textdomain('livemesh-bb-addons', false, $lang_dir);
            }

            return false;
        }

        /**
         * Setup the default hooks and actions
         */
        private function hooks() {

            add_action('plugins_loaded', array(self::$instance, 'load_plugin_textdomain'));

            // fire a little later until post type and taxonomy registrations are complete
            add_action('init', array(self::$instance, 'include_modules'), 11);

            add_action('wp_enqueue_scripts', array($this, 'enqueue_common_scripts'), 10);

            add_action('wp_enqueue_scripts', array($this, 'register_frontend_scripts'), 10);

            add_action('wp_enqueue_scripts', array($this, 'register_frontend_styles'), 10);

            add_action('wp_enqueue_scripts', array($this, 'localize_scripts'), 999999);
        }

        /**
         * Load Frontend Scripts/Styles
         *
         */
        public function enqueue_common_scripts() {

            // Use minified libraries if LABB_SCRIPT_DEBUG is turned off
            $suffix = (defined('LABB_SCRIPT_DEBUG') && LABB_SCRIPT_DEBUG) ? '' : '.min';

            wp_register_style('labb-frontend-styles', LABB_PLUGIN_URL . 'assets/css/labb-frontend.css', array(), LABB_VERSION);
            wp_enqueue_style('labb-frontend-styles');

            wp_register_style('labb-layout-styles', LABB_PLUGIN_URL . 'assets/css/labb-layouts.css', array(), LABB_VERSION);
            wp_enqueue_style('labb-layout-styles');

            wp_register_style('labb-icomoon-styles', LABB_PLUGIN_URL . 'assets/css/icomoon.css', array(), LABB_VERSION);
            wp_enqueue_style('labb-icomoon-styles');

            wp_register_script('labb-frontend-scripts', LABB_PLUGIN_URL . 'assets/js/labb-frontend' . $suffix . '.js', array('jquery'), LABB_VERSION, true);
            wp_enqueue_script('labb-frontend-scripts');

        }


        /**
         * Load Frontend Scripts
         *
         */
        public function register_frontend_scripts() {

            // Use minified libraries if LABB_SCRIPT_DEBUG is turned off
            $suffix = (defined('LABB_SCRIPT_DEBUG') && LABB_SCRIPT_DEBUG) ? '' : '.min';

            wp_register_script('labb-modernizr', LABB_PLUGIN_URL . 'assets/js/modernizr-custom' . $suffix . '.js', array(), LABB_VERSION, true);

            wp_register_script('jquery-waypoints', LABB_PLUGIN_URL . 'assets/js/jquery.waypoints' . $suffix . '.js', array('jquery'), LABB_VERSION, true);

            wp_register_script('jquery-fancybox', LABB_PLUGIN_URL . 'assets/js/jquery.fancybox' . $suffix . '.js', array('jquery'), LABB_VERSION, true);

            wp_register_script('isotope.pkgd', LABB_PLUGIN_URL . 'assets/js/isotope.pkgd' . $suffix . '.js', array('jquery'), LABB_VERSION, true);

            wp_register_script('imagesloaded.pkgd', LABB_PLUGIN_URL . 'assets/js/imagesloaded.pkgd' . $suffix . '.js', array('jquery'), LABB_VERSION, true);

            wp_register_script('jquery-stats', LABB_PLUGIN_URL . 'assets/js/jquery.stats' . $suffix . '.js', array('jquery'), LABB_VERSION, true);

            wp_register_script('jquery-nivo', LABB_PLUGIN_URL . 'assets/js/jquery.nivo.slider' . $suffix . '.js', array('jquery'), LABB_VERSION, true);

            wp_register_script('slick', LABB_PLUGIN_URL . 'assets/js/slick' . $suffix . '.js', array('jquery'), LABB_VERSION, true);

            wp_register_script('responsiveslides', LABB_PLUGIN_URL . 'assets/js/responsiveslides' . $suffix . '.js', array('jquery'), LABB_VERSION, true);

            wp_register_script('jquery-flexslider', LABB_PLUGIN_URL . 'assets/js/jquery.flexslider' . $suffix . '.js', array('jquery'), LABB_VERSION, true);

            wp_register_script('jquery-powertip', LABB_PLUGIN_URL . 'assets/js/jquery.powertip' . $suffix . '.js', array('jquery'), LABB_VERSION, true);

            wp_register_script('jquery-countdown', LABB_PLUGIN_URL . 'assets/js/jquery.countdown' . $suffix . '.js', array('jquery'), LABB_VERSION, true);

            wp_register_script('labb-blocks-scripts', LABB_PLUGIN_URL . 'assets/js/labb-blocks' . $suffix . '.js', array('jquery'), LABB_VERSION, true);


        }

        public function localize_scripts() {

            $custom_css = labb_get_option('labb_custom_css', '');

            wp_localize_script('labb-frontend-scripts', 'labb_settings', array('custom_css' => $custom_css));

        }


        /**
         * Load Frontend Styles
         *
         */
        public function register_frontend_styles() {

            wp_register_style('animate', LABB_PLUGIN_URL . 'assets/css/animate.css', array(), LABB_VERSION);

            wp_register_style('fancybox', LABB_PLUGIN_URL . 'assets/css/jquery.fancybox.css', array(), LABB_VERSION);

            wp_register_style('nivo-slider', LABB_PLUGIN_URL . 'assets/css/nivo-slider.css', array(), LABB_VERSION);

            wp_register_style('slick', LABB_PLUGIN_URL . 'assets/css/slick.css', array(), LABB_VERSION);

            wp_register_style('responsiveslides', LABB_PLUGIN_URL . 'assets/css/responsiveslides.css', array(), LABB_VERSION);

            wp_register_style('flexslider', LABB_PLUGIN_URL . 'assets/css/flexslider.css', array(), LABB_VERSION);

            wp_register_style('labb-blocks-styles', LABB_PLUGIN_URL . 'assets/css/labb-blocks.css', array(), LABB_VERSION);

        }

    }

endif; // End if class_exists check


/**
 * The main function responsible for returning the one true Livemesh_BB_Addons_Pro
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $labb = LABB(); ?>
 */
function LABB_PRO() {
    return Livemesh_BB_Addons_Pro::instance();
}

// Get LABB Running
LABB_PRO();