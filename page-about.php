<?php
/**
 * Template Name: About
 */
?>
<?php get_header(); ?>

<?php while (have_posts()): the_post(); ?>
  <article class="page">
    <div class="content">
      <div class="page-back"><a href="/projects/">Back</a></div>
      <h2 class="page-title"><?php the_title(); ?></h2>
      <h3 class="page-subtitle">Katja Bruhin + <span class="condensed">Sonja Editionen</span></h3>
      <div class="page-content text">
        <?php the_content(); ?>
      </div>
    </div>
  </article>
<?php endwhile; ?>

<?php get_footer(); ?>
