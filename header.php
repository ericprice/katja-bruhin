<!doctype html>
<html <?php language_attributes(); ?> class="loading">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <div class="site-container">
    <header class="site-header" id="site-header" data-turbolinks-permanent>
      <h1 class="site-header-title"><a href="/about/"><?php bloginfo('name'); ?></a></h1>
      <ul class="site-header-meta">
        <li>New York City</li>
        <li><a href="mailto:info@katjabruhin.com">info@katjabruhin.com</a></li>
      </ul>
      <nav class="site-header-nav">
        <ul>
          <li class="site-header-nav-projects"><a href="/projects/">Projects</a></li>
          <li class="site-header-nav-link"><a href=""><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/link.png"></a></li>
        </ul>
      </nav>
      <div class="site-header-filter-container">
        <button class="site-header-filter-toggle">Filter</button>
        <nav class="site-header-filter">
          <?php if (is_category()): ?>
            <a class="clear-filter" data-turbolinks="false" href="/projects/"><?php the_archive_title(); ?> <span class="close regular">&nbsp;x</span></a>
          <?php else: ?>
            <ul>
              <?php
                $categories = get_categories();
                foreach ($categories as $category) {
                  $category_link = get_category_link($category->term_id);
                  echo '<li><a data-turbolinks="false" href="' . esc_url($category_link) . '">' . $category->name . '</a></li>';
                }
              ?>
            </ul>
          <?php endif; ?>
        </nav>
      </div>
      <?php
        if (is_category() && !is_home()) {
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
        <nav class="projects">
          <ul>
            <?php while ($projects->have_posts()): $projects->the_post(); ?>
              <li class="project-thumb" data-project-id="<?php echo get_the_ID(); ?>">
                <a href="<?php the_permalink(); ?>">
                  <?php $post_thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'katja_s'); ?>
                  <?php if ($post_thumbnail_url != null): ?>
                    <img src="<?php echo esc_url($post_thumbnail_url); ?>" alt="<?php the_title(); ?>">
                  <?php endif; ?>
                </a>
              </li>
            <?php endwhile; wp_reset_postdata(); ?>
          </ul>
        </nav>
      <?php endif; ?>
    </header>
    <main id="main">
