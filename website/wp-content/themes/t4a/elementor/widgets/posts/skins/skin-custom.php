<?php
namespace ElementorPro\Modules\Posts\Skins;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Custom extends Skin_Base {

	public function get_id() {
		return 'custom';
	}

	public function get_title() {
		return __( 'Custom', 'elementor-pro' );
	}

	protected function register_title_controls() {
		parent::register_title_controls();
		$this->add_control(
			'title_link',
			[
				'label' => __( 'Title Link', 'elementor-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'elementor-pro' ),
				'label_off' => __( 'Off', 'elementor-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					$this->get_control_id( 'show_title' ) => 'yes',
				],
			]
		);
	}

	protected function render_title() {
		if ( ! $this->get_instance_value( 'show_title' ) ) {
			return;
		}

		$tag = $this->get_instance_value( 'title_tag' );
		?>
		<<?php echo $tag; ?> class="elementor-post__title">
			<?php if ( $this->get_instance_value( 'title_link' ) ) { ?>
				<a href="<?php echo get_permalink(); ?>">
			<?php } ?>
				<?php the_title(); ?>
			<?php if ( $this->get_instance_value( 'title_link' ) ) { ?>
				</a>
			<?php } ?>
		</<?php echo $tag; ?>>
		<?php
	}

	protected function render_excerpt() {
		if ( ! $this->get_instance_value( 'show_excerpt' ) ) {
			return;
		}
		?>
		<div class="elementor-post__excerpt">
			<?php if ( $this->get_instance_value( 'excerpt_length' ) === -1 ) {
				the_content();
			} else {
				the_excerpt();
			} ?>
		</div>
		<?php
	}

	public function render_amp() {

	}
}