<?php get_header(); ?>

<?php
  if (is_archive() && !is_home()) {
    $term = get_queried_object();
    $args = array(
      'category_name' => $term->slug,
      'posts_per_page' => -1,
      'post_type' => 'katja_projects',
      'orderby' => 'menu_order',
      'order' => 'ASC'
    );
  } else {
    $args = array(
      'posts_per_page' => -1,
      'post_type' => 'katja_projects',
      'orderby' => 'menu_order',
      'order' => 'ASC'
    );
  }
  
  $projects = new WP_Query($args);
?>
<?php if ($projects->have_posts()): ?>
  <nav class="projects-preview">
    <ul>
      <?php while ($projects->have_posts()): $projects->the_post(); ?>
        <li class="project-preview" id="project-preview-item-<?php echo get_the_ID(); ?>">
          <h2 class="project-preview-title"><?php the_title(); ?></h2>
          <?php $post_thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'katja_l'); ?>
          <?php if ($post_thumbnail_url != null): ?>
            <img src="<?php echo esc_url($post_thumbnail_url); ?>" alt="<?php the_title(); ?>" loading="lazy">
          <?php endif; ?>
        </li>
      <?php endwhile; wp_reset_postdata(); ?>
    </ul>
  </nav>
<?php endif; ?>

<?php get_footer(); ?>
