<?php get_header(); ?>

<article class="page">
  <div class="content">
    <div class="page-back"><a href="/projects/">Back</a></div>
    <h2 class="page-title">Spend the Night</h2>
    <?php while (have_posts()): the_post(); ?>
      <div class="post">
        <h3 class="page-subtitle post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> &middot; <span class="condensed"><?php echo get_the_date('F m, Y'); ?></span></h3>
        <div class="page-content post-content text">
          <?php the_content(); ?>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</article>

<?php get_footer(); ?>
