<?php get_header(); ?>

<article class="page">
  <div class="content">
    <div class="page-back"><a href="/projects/">Back</a></div>
    <?php while (have_posts()): the_post(); ?>
      <div class="post">
        <h2 class="page-title post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="page-content post-content text">
          <?php the_content(); ?>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</article>

<?php get_footer(); ?>
