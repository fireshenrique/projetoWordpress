<?php
/**
 * The template for displaying Home
 *
 * This is the template that display Home.
 *
 * @package WordPress
 * @subpackage Theme_Luapp
 * @author Descubra
 * @since Theme Luapp 1.0
 */

get_header();?>
<div class="container-fluid">
	<div class="row">
		<div class="box-video">
			<video muted autoplay loop poster="<?php bloginfo('template_directory'); ?>/public/img/bg-banner-foto.jpg" class="bg_video">
				<?php $video = get_field('video_destaque');
				if( $video ): ?>
					<source src="<?php echo $video['url']; ?>" type="video/mp4">
				<?php endif; ?>
			</video>
		</div>
	</div>
</div>


<?php include 'footer-home.php'; ?>
