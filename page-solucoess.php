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
<?php
	$args_mkt = array( 'post_type' => 'servicos', 'solucao_category' =>  'marketing-digital', 'posts_per_page' =>20);
	$query_mkt = new WP_Query( $args_mkt );
?>
<?php
	$args_com = array( 'post_type' => 'servicos', 'solucao_category' =>  'midias-sociais', 'posts_per_page' =>20);
	$query_com = new WP_Query( $args_com );
?>
<div class="container-fluid">
  <div class="container">
    <div class="row">
			<div class="solucoes-geral">
	      <div class="listagem-solucoes">
					<div class="divisor-t">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h1>
								<span>Mídias Sociais</span>
							</h1>
						</div>
					</div>
					<div class="cat-mkt">
						<?php if ( $query_com->have_posts() ) :?>
							<?php while ( $query_com->have_posts() ) : $query_com->the_post(); ?>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		              <div class="solucao">
		                <div class="img-solucao">
											<a href="<?php the_permalink(); ?>">
		                  <?php the_post_thumbnail(); ?>
											</a>
		                </div>
		                <div class="titulo-solucao">
		                  <?php the_title(); ?>
		                </div>
										<div class="botao-solucoes hvr-grow">
											<a href="<?php the_permalink(); ?>">
											<span class="botao">
												Saiba mais
											</span>
											</a>
										</div>
		              </div>
		            </div>
							<?php endwhile;  ?>
						<?php endif; ?>
					</div>
					<div class="divisor-t" id="mkt">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h1>
								<span>Marketing Digital</span>
							</h1>
						</div>
					</div>
					<div class="cat-com">
						<?php if ( $query_mkt->have_posts() ) :?>
							<?php while ( $query_mkt->have_posts() ) : $query_mkt->the_post(); ?>
								<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
									<div class="solucao">
										<div class="img-solucao">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail(); ?>
										</a>
										</div>
										<div class="titulo-solucao">
											<?php the_title(); ?>
										</div>
										<div class="botao-solucoes hvr-grow">
											<a href="<?php the_permalink(); ?>">
											<span class="botao">
												Saiba mais
											</span>
											</a>
										</div>
									</div>
								</div>
								<?php wp_reset_postdata(); ?>
							<?php endwhile;  ?>
						<?php endif; ?>
					</div>
	      </div>
			</div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
