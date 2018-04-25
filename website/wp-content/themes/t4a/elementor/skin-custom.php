<?php
namespace ElementorPro\Modules\Posts\Skins;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Skin_Base as Elementor_Skin_Base;
use Elementor\Widget_Base;
use ElementorPro\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Custom extends Skin_Base {

	public function get_id() {
		return 'custom';
	}

	public function get_title() {
		return __( 'T4A', 'elementor-pro' );
	}

	protected function render_post() {
		$this->render_post_header();
		$this->render_thumbnail();
		$this->render_text_header();
		$this->render_meta_data();
		$this->render_title();
		$this->render_excerpt();
		$this->render_read_more();
		$this->render_text_footer();
		$this->render_post_footer();
	}

	protected function render_thumbnail() {
		$thumbnail = $this->get_instance_value( 'thumbnail' );

		if ( 'none' === $thumbnail && ! Plugin::elementor()->editor->is_edit_mode() ) {
			return;
		}

		$settings                 = $this->parent->get_settings();
		$setting_key              = $this->get_control_id( 'thumbnail_size' );
		$settings[ $setting_key ] = [
			'id' => get_post_thumbnail_id(),
		];
		$thumbnail_html           = Group_Control_Image_Size::get_attachment_image_html( $settings, $setting_key );

		$thumbId       = get_post_thumbnail_id();
		$thumbSrcLarge = wp_get_attachment_image_src( $thumbId, 'large', false );

		if ( empty( $thumbnail_html ) || empty( $thumbSrcLarge ) ) {
			return;
		}

		global $post; ?>
		<?php $myPdf = get_field( "pdflink" ); ?>

		<?php	if ( $myPdf ) : ?>
			<a class="elementor-post__thumbnail__link" target="_blank" href="<?php	echo get_field('pdflink'); ?>">
				<div class="elementor-post__thumbnail elementor-fit-height"><?php echo $thumbnail_html; ?></div>
		 </a>
		<?php else: ?>
				<?php if ( ! empty( get_field( 'gallery' ) ) && is_array( get_field( 'gallery' ) ) ) : ?>
		        <a class="elementor-post__thumbnail__link" href="<?php echo $thumbSrcLarge[0]; ?>"
		           data-elementor-open-lightbox="default" data-elementor-lightbox-slideshow="gallery_<?php echo $post->post_name; ?>" data-elementor-lightbox-index="0"
		           data-caption="<?php echo get_the_title( $thumbId ); ?>">
				<?php else: ?>
						<div class="elementor-post__thumbnail__link">
				<?php endif; ?>
		            <div class="elementor-post__thumbnail elementor-fit-height"><?php echo $thumbnail_html; ?></div>
				<?php if ( ! empty( get_field( 'gallery' ) ) && is_array( get_field( 'gallery' ) ) ) : ?>
		        </a>
				<?php else: ?>
						</div>
				<?php endif; ?>
		<?php endif; ?>

		<?php // var_dump(get_field('pdflink'));
			if ( ! empty( get_field( 'gallery' ) ) && is_array( get_field( 'gallery' ) ) ) : ?>
        <div class="gallery" style="display: none">
					<?php foreach ( get_field( 'gallery' ) as $index => $image ) : ?>
            <a href="<?php echo $image['url']; ?>" data-elementor-open-lightbox="default" data-elementor-lightbox-slideshow="gallery_<?php echo $post->post_name; ?>" data-elementor-lightbox-index="0"
                       data-caption="<?php echo $image['title']; ?>">
              <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>"/>
            </a>
					<?php endforeach; ?>
        </div>
			<?php
			endif;
			}
}
