<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<main id="main" class="m-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
						<div id="logo-header"><a href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php the_field('opt_logo_header', 'options'); ?>" alt="Time4Africa"></a></div>

						<article id="post-not-found" class="hentry cf" style="text-align:center;">

							<header class="article-header">

								<h1><?php _e( '404 - Article Not Found', 'bonestheme' ); ?></h1>

							</header>

							<section class="entry-content">

								<p>The article you were looking for was not found, click <a href="<?php echo home_url(); ?>" rel="nofollow">here</a>.</p>

							</section>

							<section class="search">

									<p><?php // get_search_form(); ?></p>

							</section>
						</article>

					</main>

				</div>

			</div>

<?php get_footer(); ?>
