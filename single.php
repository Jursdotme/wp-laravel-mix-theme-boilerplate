<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package _s
 */

get_header();
?>

<main id="primary" class="site-main">

  <?php
  while (have_posts()) :
    the_post();

    get_template_part('templates/partials/content', get_post_type()); ?>


    <div class="prose lg:prose-lg mx-auto mt-6">

      <?php the_post_navigation(
        array(
          'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', '_s') . '</span> <span class="nav-title">%title</span>',
          'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', '_s') . '</span> <span class="nav-title">%title</span>',
        )
      ); ?>
    </div>

  <?php endwhile; // End of the loop.
  ?>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
