<?php get_header(); ?>

<?php while (have_posts()): the_post(); ?>
  <style type="text/css">
    :root {
      --project-bg: <?php the_field('background_color'); ?>;
    }
    
    body {
      background-color: var(--project-bg);
    }
  </style>
  <article class="project-detail" data-post-id="<?php echo get_the_ID(); ?>">
    <div class="content">
      <div class="project-detail-back"><a href="<?php echo home_url(); ?>">Back</a></div>
      <h3 class="project-detail-client"><?php the_field('client'); ?></h3>
      <header class="project-detail-header">
        <h2 class="project-detail-header-item project-detail-header-title"><span class="label">Project</span> <?php the_title(); ?></h2>
        
        <?php if (get_field('year')): ?>
          <p class="project-detail-header-item project-detail-header-year"><span class="label">Year</span> <?php the_field('year'); ?></p>
        <?php endif; ?>

        <?php if (get_field('link') && get_field('link_label')): ?>
          <p class="project-detail-header-item project-detail-header-link"><span class="label">Link</span> <a href="<?php the_field('link'); ?>" target="_blank"><?php the_field('link_label'); ?></a></p>
        <?php endif; ?>


        <?php $categories = get_the_category(); ?>
        <ul class="project-detail-header-item project-detail-header-type">
          <span class="label">Type</span>
          <?php foreach ($categories as $category): ?>
            <?php echo $category->cat_name; ?>
          <?php endforeach; ?>
        </ul>
      </header>
      <div class="project-detail-content text">
        <?php the_content(); ?>
      </div>
    </div>

    <?php $media = get_field('media'); if ($media): ?>
      <div class="gallery">
        <?php foreach ($media as $media_item): ?>
          <?php include get_theme_file_path('partials/media-item.php'); ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <nav class="project-detail-nav">
      <ul>
        <?php
          $prev_post = get_previous_post();
          $next_post = get_next_post();
        ?>
        <?php if ($prev_post): ?>
          <li class="project-detail-nav-item previous"><a href="<?php echo get_permalink($prev_post); ?>"><?php echo get_the_title($prev_post); ?></a></li>
        <?php endif; ?>
        <?php if ($next_post): ?>
          <li class="project-detail-nav-item next"><a href="<?php echo get_permalink($next_post); ?>"><?php echo get_the_title($next_post); ?></a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </article>
<?php endwhile; ?>

<?php get_footer(); ?>
