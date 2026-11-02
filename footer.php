<?php
/**
 * Footer du thème enfant SPPCM
 *
 * - Les 3 colonnes de liens sont des menus WordPress (Apparence > Menus).
 * - Le logo vient de Apparence > Personnaliser > Identité du site.
 * - Les liens des icônes et le texte du copyright viennent de
 *   Apparence > Personnaliser > Pied de page.
 */

$images   = get_stylesheet_directory_uri() . '/images/';
$facebook = get_theme_mod( 'sppcm_facebook', '' );
$courriel = get_theme_mod( 'sppcm_courriel', '' );
$csn      = get_theme_mod( 'sppcm_csn', 'https://www.csn.qc.ca/' );
$fneeq    = get_theme_mod( 'sppcm_fneeq', 'https://fneeq.qc.ca/' );
$droits   = get_theme_mod(
	'sppcm_copyright',
	'SPPCM - Le Syndicat des professeures et professeurs du Collège Maisonneuve. Tous droits réservés.'
);

$colonnes = array(
	'footer-liens-rapides' => 'Liens rapides',
	'footer-documentation' => 'Documentation',
	'footer-a-propos'      => 'À propos',
);
?>

<footer id="colophon" class="site-footer">

	<div class="footer-container">

		<!-- Colonnes de liens -->
		<div class="footer-colonnes">
			<?php foreach ( $colonnes as $emplacement => $titre ) : ?>
				<?php if ( has_nav_menu( $emplacement ) ) : ?>
					<nav class="footer-navigation" aria-label="<?php echo esc_attr( $titre ); ?>">
						<h2 class="footer-titre"><?php echo esc_html( $titre ); ?></h2>
						<?php
						wp_nav_menu( array(
							'theme_location' => $emplacement,
							'container'      => false,
							'menu_class'     => 'footer-menu',
							'depth'          => 1,
							'fallback_cb'    => false,
						) );
						?>
					</nav>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>

		<!-- Logo et icônes -->
		<div class="footer-branding">
			<?php the_custom_logo(); ?>

			<ul class="footer-icones">
				<?php if ( $facebook ) : ?>
					<li>
						<a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener">
							<img src="<?php echo esc_url( $images . 'icone-facebook.svg' ); ?>"
							     alt="Facebook du SPPCM (nouvel onglet)" width="38" height="38">
						</a>
					</li>
				<?php endif; ?>

				<?php if ( $courriel ) : ?>
					<li>
						<a href="mailto:<?php echo esc_attr( antispambot( $courriel ) ); ?>">
							<img src="<?php echo esc_url( $images . 'icone-courriel.svg' ); ?>"
							     alt="Écrire au SPPCM" width="38" height="38">
						</a>
					</li>
				<?php endif; ?>

				<?php if ( $csn ) : ?>
					<li>
						<a href="<?php echo esc_url( $csn ); ?>" target="_blank" rel="noopener">
							<img src="<?php echo esc_url( $images . 'logo-csn.svg' ); ?>"
							     alt="CSN (nouvel onglet)" width="38" height="38">
						</a>
					</li>
				<?php endif; ?>

				<?php if ( $fneeq ) : ?>
					<li>
						<a href="<?php echo esc_url( $fneeq ); ?>" target="_blank" rel="noopener">
							<img class="footer-icone-fneeq"
							     src="<?php echo esc_url( $images . 'logo-fneeq.svg' ); ?>"
							     alt="Fneeq (nouvel onglet)" width="92" height="38">
						</a>
					</li>
				<?php endif; ?>
			</ul>
		</div>

		<!-- Droits d'auteur -->
		<div class="footer-copyright">
			<p>Copyright &copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php echo esc_html( $droits ); ?></p>
			<p>Site par D.O.R.S.</p>
		</div>

	</div>

</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
