<?php get_header(); ?>

<?php while (have_posts()): the_post(); ?>
  <article class="page">
    <div class="content">
      <div class="page-back"><a href="<?php echo home_url(); ?>">Back</a></div>
      <h2 class="page-title"><?php the_title(); ?></h2>
      <div class="page-content text">
        <?php the_content(); ?>
      </div>
    </div>
  </article>
<?php endwhile; ?>

<?php get_footer(); ?>
