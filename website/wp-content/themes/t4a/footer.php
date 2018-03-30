			<footer class="footer" id="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div id="inner-footer" class="wrap cf">
                    <nav role="navigation" class="d-1of3">
                        <?php $location = 'footer-links';
                            if (has_nav_menu($location)) {
	                            $menuObj = get_menu_by_location($location);
                                wp_nav_menu( array(
                                    'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
                                    'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
                                    'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
                                    'menu_class' => 'nav footer-nav cf',            // adding custom nav class
                                    'theme_location'  => $location,
                                    'before' => '',                                 // before the menu
                                    'after' => '',                                  // after the menu
                                    'link_before' => '',                            // before each link
                                    'link_after' => '',                             // after each link
                                    'depth' => 0,                                   // limit the depth of the nav
                                    'fallback_cb' => 'bones_footer_links_fallback', // fallback function
                                    'items_wrap'=> '<span class="menu-title">'.esc_html($menuObj->name).'</span><ul id="%1$s" class="%2$s">%3$s</ul>'
                                ));
                            } ?>
					</nav>

                    <nav role="navigation" class="d-1of3">
						<?php $location = 'footer-mitte';
						    if (has_nav_menu($location)) {
                                $menuObj = get_menu_by_location($location);
                                wp_nav_menu( array(
                                    'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-mitte in _base.scss isn't wrapping)
                                    'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
                                    'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
                                    'menu_class' => 'nav footer-nav cf',            // adding custom nav class
                                    'theme_location'  => $location,
                                    'before' => '',                                 // before the menu
                                    'after' => '',                                  // after the menu
                                    'link_before' => '',                            // before each link
                                    'link_after' => '',                             // after each link
                                    'depth' => 0,                                   // limit the depth of the nav
                                    'fallback_cb' => 'bones_footer_links_fallback', // fallback function
                                    'items_wrap'=> '<span class="menu-title">'.esc_html($menuObj->name).'</span><ul id="%1$s" class="%2$s">%3$s</ul>'
                                ));
						    } ?>

                        <?php $socialIcons = get_field('opt_social_icons', 'options'); if ($socialIcons) : ?>
                        <ul class="social-icons">
                            <?php foreach($socialIcons as $socialIcon) {
	                            if (empty($socialIcon['link'])) continue;
	                            echo '<li><a href="' . $socialIcon['link'] . '" target="_blank" title="' . $socialIcon['link_title'] . '"><img src="' . $socialIcon['icon'] .'" /></a></li>';
                            } ?>
                        </ul>
                        <?php endif; ?>

                    </nav>

                    <div class="d-1of3">
                        <span class="menu-title">Newsletter Signup</span>

                        <form action="/" method="post">
                            <input type="email" name="frm_email" placeholder="Enter Email Address" />
                            <input type="radio" id="female" name="frm_sex" value="f"/><label for="female">Female</label>
                            <input type="radio" id="male" name="frm_sex" value="m"/><label for="male">Male</label>
                        </form>
                    </div>
				</div>

			</footer>

		</div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

	</body>

</html> <!-- end of site. what a ride! -->
