<?php

/**
 * The template for displaying archive pages
 */

get_header();
?>

<main id="primary" class="site-main">

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="prose lg:prose-xl mx-auto">
      <h1>Home Page template</h1>
      <?= get_the_content(); ?>
    </div>
  </div>

</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
