<?php
/**
 * Plugin Name:       Posts Pr Rmu
 * Description:       Example block scaffolded with Create Block tool.
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       posts-pr-rmu
 *
 * @package CreateBlock
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
/**
 * Registers the block using a `blocks-manifest.php` file, which improves the performance of block type registration.
 * Behind the scenes, it also registers all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
 */
function create_block_posts_pr_rmu_block_init()
{
	/**
	 * Registers the block(s) metadata from the `blocks-manifest.php` and registers the block type(s)
	 * based on the registered block metadata.
	 * Added in WordPress 6.8 to simplify the block metadata registration process added in WordPress 6.7.
	 *
	 * @see https://make.wordpress.org/core/2025/03/13/more-efficient-block-type-registration-in-6-8/
	 */
	if (function_exists('wp_register_block_types_from_metadata_collection')) {
		wp_register_block_types_from_metadata_collection(__DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php');
		return;
	}

	/**
	 * Registers the block(s) metadata from the `blocks-manifest.php` file.
	 * Added to WordPress 6.7 to improve the performance of block type registration.
	 *
	 * @see https://make.wordpress.org/core/2024/10/17/new-block-type-registration-apis-to-improve-performance-in-wordpress-6-7/
	 */
	if (function_exists('wp_register_block_metadata_collection')) {
		wp_register_block_metadata_collection(__DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php');
	}
	/**
	 * Registers the block type(s) in the `blocks-manifest.php` file.
	 *
	 * @see https://developer.wordpress.org/reference/functions/register_block_type/
	 */
	$manifest_data = require __DIR__ . '/build/blocks-manifest.php';
	foreach (array_keys($manifest_data) as $block_type) {
		register_block_type(__DIR__ . "/build/{$block_type}");
	}
}
add_action('init', 'create_block_posts_pr_rmu_block_init');

function posts_pr_rmu_enqueue_assets()
{
	if (is_singular() && has_shortcode(get_post()->post_content, 'posts_pr_rmu')) {
		wp_enqueue_style(
			'posts-pr-rmu-style',
			plugins_url('build/posts-pr-rmu/style-index.css', __FILE__),
			array(),
			'1.0'
		);
		wp_enqueue_script(
			'posts-pr-rmu-view',
			plugins_url('build/posts-pr-rmu/view.js', __FILE__),
			array(),
			'1.0',
			true
		);
	}
}
add_action('wp_enqueue_scripts', 'posts_pr_rmu_enqueue_assets');


/**
 * Shortcode สำหรับแสดงผล block
 */
function posts_pr_rmu_shortcode($atts)
{
	ob_start();
	$render_file = plugin_dir_path(__FILE__) . 'build/posts-pr-rmu/render.php';
	if (file_exists($render_file)) {
		include $render_file;
	} else {
		echo '<!-- posts-pr-rmu render.php not found -->';
	}
	return ob_get_clean();
}
add_shortcode('posts_pr_rmu', 'posts_pr_rmu_shortcode');

add_action('admin_menu', function () {
	add_options_page(
		'Posts PR-RMU Settings',
		'PostsPR-RMU',
		'manage_options',
		'posts_pr_rmu_settings',
		'posts_pr_rmu_settings_page'
	);
});

function posts_pr_rmu_settings_page()
{
	// ตรวจสอบการกดปุ่ม Reset
	if (isset($_POST['posts_pr_rmu_reset_defaults'])) {
		update_option('posts_pr_rmu_tab_active_color', '#e0ecff');
		update_option('posts_pr_rmu_tab_text_color', '#2874fc');
		update_option('posts_pr_rmu_pagination_bg', '#2874fc');
		update_option('posts_pr_rmu_pagination_hover', '#d0e2ff');
		update_option('posts_pr_rmu_pagination_active', '#e0ecff');
		update_option('posts_pr_rmu_pagination_active_text', '#2874fc');
		echo '<div class="notice notice-success is-dismissible"><p>รีเซ็ตค่าสำเร็จ</p></div>';
	}
	?>
	<div class="wrap">
		<h1>Posts RP RMU Settings</h1>
		<form method="post" action="options.php">
			<?php
			settings_fields('posts_pr_rmu_options');
			do_settings_sections('posts_pr_rmu_settings');
			?>
			<table class="form-table">
				<tr>
					<th scope="row">ซ่อนช่องค้นหา (Hide Input Search)</th>
					<td>
						<input type="checkbox" name="posts_pr_rmu_hide_input" value="1" <?php checked(get_option('posts_pr_rmu_hide_input', false)); ?>>
					</td>
				</tr>
				<tr>
					<th scope="row">Tab Active Color</th>
					<td>
						<input type="color" name="posts_pr_rmu_tab_active_color"
							value="<?php echo esc_attr(get_option('posts_pr_rmu_tab_active_color', '#e0ecff')); ?>">
					</td>
				</tr>
				<tr>
					<th scope="row">Tab Text Color</th>
					<td>
						<input type="color" name="posts_pr_rmu_tab_text_color"
							value="<?php echo esc_attr(get_option('posts_pr_rmu_tab_text_color', '#2874fc')); ?>">
					</td>
				</tr>
				<tr>
					<th scope="row">Pagination Background</th>
					<td>
						<input type="color" name="posts_pr_rmu_pagination_bg"
							value="<?php echo esc_attr(get_option('posts_pr_rmu_pagination_bg', '#eee')); ?>">
					</td>
				</tr>
				<tr>
					<th scope="row">Pagination Hover</th>
					<td>
						<input type="color" name="posts_pr_rmu_pagination_hover"
							value="<?php echo esc_attr(get_option('posts_pr_rmu_pagination_hover', '#d0e2ff')); ?>">
					</td>
				</tr>
				<tr>
					<th scope="row">Pagination Active</th>
					<td>
						<input type="color" name="posts_pr_rmu_pagination_active"
							value="<?php echo esc_attr(get_option('posts_pr_rmu_pagination_active', '#e0ecff')); ?>">
					</td>
				</tr>
				<tr>
					<th scope="row">Pagination Active Text</th>
					<td>
						<input type="color" name="posts_pr_rmu_pagination_active_text"
							value="<?php echo esc_attr(get_option('posts_pr_rmu_pagination_active_text', '#2874fc')); ?>">
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
		</form>
		<form method="post" style="margin-top:1em;">
			<input type="hidden" name="posts_pr_rmu_reset_defaults" value="1">
			<button type="submit" class="button button-secondary"
				onclick="return confirm('ต้องการรีเซ็ตค่ากลับเป็นค่าเริ่มต้นหรือไม่?')">Reset Default</button>
		</form>
		<hr>
		<h2>วิธีใช้งาน Shortcode</h2>
		<p>
			คัดลอก <code>[posts_pr_rmu]</code> ไปวางในหน้า/โพสต์ หรือใน Elementor (ผ่าน Shortcode Widget)
			เพื่อแสดงฟอร์มค้นหาโพสต์
		</p>
	</div>
	<?php
}

add_action('admin_init', function () {
	register_setting('posts_pr_rmu_options', 'posts_pr_rmu_tab_active_color');
	register_setting('posts_pr_rmu_options', 'posts_pr_rmu_tab_text_color');
	register_setting('posts_pr_rmu_options', 'posts_pr_rmu_pagination_bg');
	register_setting('posts_pr_rmu_options', 'posts_pr_rmu_pagination_hover');
	register_setting('posts_pr_rmu_options', 'posts_pr_rmu_pagination_active');
	register_setting('posts_pr_rmu_options', 'posts_pr_rmu_pagination_active_text');
	register_setting('posts_pr_rmu_options', 'posts_pr_rmu_hide_input');
});
add_action('wp_head', function () {
	$active_tab = esc_attr(get_option('posts_pr_rmu_tab_active_color', '#e0ecff'));
	$text_tab = esc_attr(get_option('posts_pr_rmu_tab_text_color', '#2874fc'));
	$bg_pagination = esc_attr(get_option('posts_pr_rmu_pagination_bg', '#e0ecff'));
	$hover_pagination = esc_attr(get_option('posts_pr_rmu_pagination_hover', '#d0e2ff'));
	$active_pagination = esc_attr(get_option('posts_pr_rmu_pagination_active', '#fff'));
	$active_text_pagination = esc_attr(get_option('posts_pr_rmu_pagination_active_text', '#2874fc'));
	echo "<style>
	.our-search .tab {
			background-color: {$bg_pagination};
		}
        .our-search .tab.active,
        .our-search .tab:hover,
        .our-search .tab:focus  {
            background-color: {$active_tab} !important;
            color: {$text_tab} !important;
        }
        .our-search #pagination .pagination-btn {
            background: {$bg_pagination};
        }
        .our-search #pagination .pagination-btn:hover {
            background-color: {$hover_pagination};
        }
        .our-search #pagination .pagination-btn.active {
            background-color: {$active_pagination};
            color: {$active_text_pagination};
        }
    </style>";
});