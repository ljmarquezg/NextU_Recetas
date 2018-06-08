<?php
/**
 * default search form
 */
?>
<form role="search" method="get" id="search-form" class="cyan darken-3" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="file-field input-field">
      <div class="search-submit btn">
        <span><i class="material-icons">search</i></span>
      </div>
      <input type="search" placeholder="<?php echo esc_attr( 'Search…', 'presentation' ); ?>" name="s" id="search-input" value="<?php echo esc_attr( get_search_query() ); ?>" />
    </div>
  </form>