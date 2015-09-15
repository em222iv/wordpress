		</div>
		<!-- /content -->

		<footer class="footer" role="contentinfo">

			<div class="copyright">
				<?php the_date( 'Y' ); ?>
				<?php bloginfo( 'name' ); ?>
			</div>

		</footer>
		<!-- /footer -->

		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<?php wtf_asset( '/assets/javascripts/vendor/jquery/dist/jquery.js' ); ?>')</script>
		<script src="<?php wtf_asset( '/assets/javascripts/plugins.js' ); ?>"></script>
		<script src="<?php wtf_asset( '/assets/javascripts/main.js' ); ?>"></script>

		<?php wp_footer(); ?>

	</body>
</html>
