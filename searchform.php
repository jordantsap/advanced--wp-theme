

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'wp-theme' ); ?>" />
		<input type="submit" class="btn btn-outline-primary submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'wp-theme' ); ?>" placeholder="<?php echo the_search_query(); ?>"/>
	</form>
