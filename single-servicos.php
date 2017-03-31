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
    <div class="post">
      <div class="container">
            <?php while ( have_posts() ) : the_post(); ?>
              <div class="thumb">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <?php the_post_thumbnail(); ?>
                </div>
              </div>
              <div class="infos">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <div class="titulo-infos">
                    <?php the_title(); ?>
                  </div>
                  <div class="conteudo-infos">
                    <?php the_content(); ?>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
        </div>
      </div>
    </div>
</div>
<?php get_footer();?>
