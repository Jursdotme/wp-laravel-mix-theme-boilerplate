<div class="max-width">

  <div class="prose lg:prose-lg">
    <h1 class="font-size">Blog</h1>
  </div>
  <?php

  if (have_posts()) : /* Start the Loop */ ?>

    <div class="grid grid-cols-2 gap-6 mt-6">

      <?php while (have_posts()) :  the_post(); ?>

        <div class="p-6 shadow bg-white">
          <a href="<?= get_the_permalink(); ?>">
            <h2><?= get_the_title(); ?></h2>
          </a>
        </div>
      <?php endwhile; ?>
    </div>
  <?php the_posts_navigation();

  else :

    get_template_part('templates/partials/content', 'none'); ?>


  <?php endif; ?>

</div>