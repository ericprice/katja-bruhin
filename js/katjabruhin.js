var hasNavigated = false,
    filterActive = false;

var hasTouch = function() {
  return (('ontouchstart' in window) || (navigator.maxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0));
}

var backNav = function() {
  $('.site-header-title a, .site-header-nav-about a').click(function(e) {
    if ($('body').hasClass('page')) {
      e.preventDefault();
      Turbolinks.visit('/');
    }
  });
}

var projectPreview = function() {
  $('.project-thumb a').hover(function(e) {
    var projectId = $(this).closest('.project-thumb').data('project-id');
    $('#project-preview-item-' + projectId).addClass('project-preview-active');
  }, function() {
    $('.project-preview-active').removeClass('project-preview-active');
  });
}

var projectFilter = function() {
  $('.site-header-filter-toggle').click(function() {
    $('html').addClass('filter-active');
    filterActive = true;
  });

  $('.clear-filter').click(function() {
    $('html').removeClass('filter-active');
    filterActive = false;
  });
}

var videoControl = function() {
  if (sessionStorage.getItem('videoActivated') !== 'true' && $('body').hasClass('home')) {
    $('body').addClass('video-active');
  }
  sessionStorage.setItem('videoActivated', 'true');

  $('.video-active button, .video-active a').click(function() {
    $('body').removeClass('video-active');
    $('.overlay').remove();
  });
}

document.addEventListener('turbolinks:load', function() {
  $('html').removeClass('loading');
  backNav();
  projectFilter();
  videoControl();

  if (!hasTouch()) {
    projectPreview();
  }

  if (filterActive || $('body').hasClass('category')) {
    filterActive = true;
    $('html').addClass('filter-active');
  }
});

document.addEventListener('turbolinks:click', function() {
  $('html').addClass('loading');
  hasNavigated = true;
});