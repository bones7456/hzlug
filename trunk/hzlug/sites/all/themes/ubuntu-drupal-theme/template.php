<?php
// $Id: template.php,v 1.1.2.23 2008/07/27 18:05:04 andregriffin Exp $

/*
 * Initialize theme settings
 */

if (is_null(theme_get_setting('wrapper_width'))) {
  global $theme_key;

  $defaults = array(
    'wrapper_width' => 874,
    'banner_display' => 1,
    'banner_text' => 'We suggest downloading and installing <a href="http://www.mozilla.com/en-US/firefox/">Firefox</a> to secure your browsing experience and take full advantage of this site.',
    'custom_footer_left' => '&copy; 2007 Canonical Ltd. Ubuntu and Canonical are registered trademarks of Canonical Ltd.',
    'custom_footer_right' => 'Theme created by the <a href="https://launchpad.net/~ubuntu-drupal-themes">Ubuntu Drupal</a> team.',
  );

  // Get default theme settings.
  $settings = theme_get_settings($theme_key);

  // Don't save the toggle_node_info_ variables.
  if (module_exists('node')) {
    foreach (node_get_types() as $type => $name) {
      unset($settings['toggle_node_info_' . $type]);
    }
  }

  // Save default theme settings.
  variable_set(
    str_replace('/', '_', 'theme_'. $theme_key .'_settings'),
    array_merge($defaults, $settings)
  );

  // Force refresh of Drupal internals.
  theme_get_setting('', TRUE);
}

/**
 * Sets the body-tag class attribute.
 *
 * Adds 'sidebar-left', 'sidebar-right' or 'sidebars' classes as needed.
 */
function phptemplate_body_class($left, $right, $header = '', $footer = '', $var_show_blocks) {
 if ($var_show_blocks) {
   if ($left != '' && $right != '') {
     $class = 'sidebars';
   }
   else {
     if ($right == '' && $left == '' && ($header != '' || $footer != '')) {
       $class = 'sidebars';
     }
     if ($left != '') {
       if ($header != '' || $footer != '') {
        $class = 'sidebar-mix';
       }
       else {
        $class = 'sidebar-left';
       }
     }
    if ($right != '') {
       if ($header != '' || $footer != '') {
         $class = 'sidebar-mix';
       }
       else {
        $class = 'sidebar-right';
       }
     }
     if ($right == '' && $left == '' && $header == '' && $footer != '') {
       $class = 'sidebar-footer';
     }
   }
 }

  if (isset($class)) {
    return ' class="'. $class .'"';
  }
}

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function phptemplate_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
// uncomment the next line to enable current page in the breadcrumb trail
//    $breadcrumb[] = drupal_get_title();
    return '<div class="breadcrumb">'. implode(' > ', $breadcrumb) .'</div>';
  }
}

/**
 * Allow themable wrapping of all comments.
 */
function phptemplate_comment_wrapper($content, $node) {
  if (!$content || $node->type == 'forum') {
    return '<div id="comments">'. $content .'</div>';
  }
  else {
    return '<div id="comments"><h2 class="comments">'. t('Comments') .'</h2>'. $content .'</div>';
  }
}

/**
 * Override or insert PHPTemplate variables into the templates.
 */
function phptemplate_preprocess_page(&$vars) {
  $vars['tabs2'] = menu_secondary_local_tasks();

  // Hook into color.module
  if (module_exists('color')) {
    _color_page_alter($vars);
  }

  $vars[header]          = headertext($vars[header]);
  $vars[mission]         = mission($vars[mission]);
  $vars[secondary_links] = secondarylinks($vars[secondary_links]);
  $vars[iebanner]        = iebanner();
  $vars[topmenu]         = whichmenu($vars[primary_links]);
  $vars[search_box]      = searchbox($vars[search_box]);
  $vars[logo]            = buildlogo($vars);
  $vars[site_name]       = sitename($vars[site_name]);
  $vars[site_slogan]     = siteslogan($vars[site_slogan]);
  $vars[csheet]          = columnsheets($vars[left], $vars[right]);
  $vars[columnarea]      = columns($vars);
  $vars[spacergif]       = spacergif();
  $vars[rulebar]         = rulebar();
  $vars[leftfooter]      = theme_get_setting('custom_footer_left');
  $vars[rightfooter]     = theme_get_setting('custom_footer_right');

}

function headertext($header) {
  if ($header) {
    return $header;
  }
}

function mission($mission) {
  if ($mission) {
    $hm = '<div class="headerbar-mission" style="z-index:2;"><div class="missiontext">' . $mission . '</div></div>';
  }
  else {
    $hm = '<div class="headerbar" style="z-index:2;"></div>';
  }
  return $hm;
}

function secondarylinks($secondary_links) {
  if ($secondary_links) {
    return '<div id="sisternav">' . phptemplate_secondary_links($secondary_links) . '</div>';
  }
}

function iebanner() {
  if (theme_get_setting('banner_display')==1) {
    $bannertext = theme_get_setting('banner_text');
    $banner = '<div id="iebanner">' . $bannertext . '</div>';
  }
  if (isset($banner)) {
    return $banner;
  }
}

function whichmenu($primary_links) {
  if (module_exists('nice_menus')) {
    // Nice Menu
    $usemenu = theme('nice_menu_primary_links');
  }    
  else {
    // Standard Menu
    $usemenu = theme('links', $primary_links, array('class' => ''));
  }
  return $usemenu;
}

function searchbox($search_box) {
  if ($search_box) {
    return $search_box;
  }
}

function buildlogo($vars) {
  if ($vars[logo]) {
    $logo = '<h1><a href="'. check_url($vars[front_page]) .'" title="'. $vars[site_title] .'">';
    $logo .= '<img src="'. check_url($vars[logo]) .'" alt="'. $vars[site_title] .'" id="ubuntulogo" /></a></h1>';
  }
  if (isset($logo)) {
    return $logo;
  }
}

function sitename($site_name) {
  if ($site_name) {
    $name = '<div id="logotext"><h1>' . $site_name . '</h1></div>';
  }
  if (isset($name)) {
    return $name;
  }
}

function siteslogan($site_slogan) {
  if ($site_slogan) {
    $slogan = '<div id="slogantext"><p>' . $site_slogan . '</p></div>';
  }
  if (isset($slogan)) {
    return $slogan;
  }
}

function columnsheets($left, $right) {
  $center = 0;
  $lshow = $left ? 1 : 0;
  $rshow = $right ? 1 : 0; 

  if ($lshow && $rshow) { 
     $column = 3;
     $firstcolumn = 20;
     $secondcolumn = 60;
     $center = 60;
     $lastcolumn = 20;
     $padding = 1;
  }
  elseif (!$lshow && $rshow) { 
     $column = 2;
     $firstcolumn = 75;
     $secondcolumn = 25;
     $lastcolumn = 25;
     $padding = 1;
  }
  elseif ($lshow && !$rshow) { 
     $column = 2;
     $firstcolumn = 25;
     $secondcolumn = 75;
     $lastcolumn = 75;
     $padding = 1;
  }

  $colsheet = '<style type="text/css">' . "\n";

  $colsheet .= '#container' . $column . ' {' . "\n";
  $colsheet .= 'float:left; width:100%; position:relative; overflow:hidden; }' . "\n";

  $colsheet .= '#container' . ($column-1) . '{' . "\n";
  $colsheet .= 'float:left; width:100%; position:relative; right:' . $lastcolumn . '%; }' . "\n";

  $colsheet .= '#container' . ($column-2) . '{' . "\n";
  $colsheet .= 'float:left; width:100%; position:relative; right:' . $secondcolumn . '%; }' . "\n";

  $colsheet .= '#col1 {' . "\n";
  $colsheet .= 'float:left; width:' . ($firstcolumn-($padding*2)) . '%; position:relative; left:' . ($lastcolumn+$center+$padding) . '%; overflow:hidden; }' . "\n";

  $colsheet .= '#col2 {' . "\n";
  $colsheet .= 'float:left; width:' . ($secondcolumn-($padding*2)) . '%; position:relative; left:' . ($lastcolumn+$center+($padding*3)) . '%; overflow:hidden; }' . "\n";

  $colsheet .= '#col3 {' . "\n";
  $colsheet .= 'float:left; width:' . ($lastcolumn-($padding*2)) . '%; position:relative; left:' . ($lastcolumn+$center+($padding*5)) . '%; overflow:hidden; }' . "\n";

  $colsheet .= '</style>' . "\n";

  return $colsheet;
}

function columns($vars) {

  $columns = '<div id="col1">';
    if ($vars[left] && $vars[right]) {
      $columns .= $vars[left];
    }
    elseif (!$vars[left] && $vars[right]) {
      $columns .= center($vars);
    }
    elseif ($vars[left] && !$vars[right]) {
      $columns .=  $vars[left];
    }
  $columns .= '</div>';

  $columns .= '<div id="col2">';
    if ($vars[left] && $vars[right]) {
      $columns .= center($vars);
    }
    elseif (!$vars[left] && $vars[right]) {
      $columns .= $vars[right];
    }
    elseif ($vars[left] && !$vars[right]) {
      $columns .= center($vars);
    }
  $columns .= '</div>';


  if ($vars[left] && $vars[right]) {
    $columns .= '<div id="col3">';
      $columns .= $vars[right];
    $columns .= '</div>';
  }

  return $columns;
}

function center($vars) {
  if ($vars[title]) {
    $center .= '<div id="node-title" style="margin-top: 3px;"><div class="inner"><span class="corners-top"><span></span></span>';
  }
  if ($vars[tabs]) { 
    $center .= '<div id="tabs-wrapper" class="clear-block">';
  }
  if (!$vars[tabs] && $vars[node]->nid) {
    $center .= '<div id="tabs-wrapper" class="clear-block">';
  }
  if ($vars[title]) {
    $center .='<h2'. ($vars[tabs] ? ' class="with-tabs"' : '') .'>'. $vars[title] .'</h2>';
  }
  if ($vars[tabs]) {
    $center .= '<ul class="tabs primary">'. $vars[tabs] .'</ul></div>';
  }
  if ($vars[title] && !$vars[tabs] && $vars[node]->nid) {
    $center .= '<ul class="tabs primary"><li class="active"><a href="'. $vars[node_url] .'" class="active">View</a></li></ul></div>';
  }
  if ($vars[tabs2]) {
    $center .= '<ul class="tabs secondary">'. $vars[tabs2] .'</ul>';
  }
  if ($vars[show_messages] && $vars[messages]) {
    $center .= $vars[messages];
  }
  if ($vars[title]) {
    $center .= '<span class="corners-bottom"><span></span></span></div></div>';
  }
  $center .= $vars[help];
  $center .= $vars[content];

  return $center;
}

function spacergif() {
  return '<img src="' . base_path() . path_to_theme() . '/images/spacer.gif" width="1" height="1" alt="" />';
}

function rulebar() {
  return '<img src="' . base_path() . path_to_theme() . '/images/rule.png" width="' . pagewidth(34) . '" height="1" alt="" class="rule" />';
}

function pagewidth($subtract = 0) {
  return theme_get_setting('wrapper_width') - $subtract;
}

/**
 * Returns the rendered local tasks. The default implementation renders
 * them as tabs. Overridden to split the secondary tasks.
 *
 * @ingroup themeable
 */
function phptemplate_menu_local_tasks() {
  return menu_primary_local_tasks();
}

function phptemplate_comment_submitted($comment) {
  return t('by !username on !datetime',
    array(
      '!username' => theme('username', $comment),
      '!datetime' => format_date($comment->timestamp)
    ));
}

function phptemplate_node_submitted($node) {
  return t('!datetime — !username',
    array(
      '!username' => theme('username', $node),
      '!datetime' => format_date($node->created),
    ));
}

/**
 * Generates IE CSS links.
 */
function ie_styles() {
  $iecss = '<link type="text/css" rel="stylesheet" media="all" href="' . base_path() . path_to_theme() . '/iepatches/fix-ie.css" />';
  $iecss .= '<script src="' . base_path() . path_to_theme() . '/menu.js" type="text/javascript"></script>';
  return $iecss;
}

function ie6_styles() {
  $iecss = '<link type="text/css" rel="stylesheet" media="all" href="' . base_path() . path_to_theme() . '/iepatches/fix-ie6.css" />';
  return $iecss;
}

/**
 * Adds even and odd classes to <li> tags in ul.menu lists
 */ 
function phptemplate_menu_item($link, $has_children, $menu = '', $in_active_trail = FALSE, $extra_class = NULL) {
  static $zebra = FALSE;
  $zebra = !$zebra;
  $class = ($menu ? 'expanded' : ($has_children ? 'collapsed' : 'leaf'));
  if (!empty($extra_class)) {
    $class .= ' '. $extra_class;
  }
  if ($in_active_trail) {
    $class .= ' active-trail';
  }
  if ($zebra) {
    $class .= ' even';
  }
  else {
    $class .= ' odd';
  }
  return '<li class="'. $class .'">'. $link . $menu ."</li>\n";
}

function phptemplate_secondary_links($links, $attributes = '') {
  $output = '';

  if (count($links) > 0) {
    $output = '<ul'. drupal_attributes($attributes) .'>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = ""; //was = $key;

      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $class .= ''; //was ' first';
      }
      if ($i == $num_links) {
        $class .= '';  //was ' last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))) {
        $class .= 'current'; //was ' active';
      }
      if ($class == "") {
        $class = 'plain';
      }
      $output .= '<li'. drupal_attributes(array('class' => $class)) .'>';

      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        $output .= l($link['title'], $link['href'], $link);
      }
      else if (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span'. $span_attributes .'>'. $link['title'] .'</span>';
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}

function phptemplate_links($links, $attributes = array('class' => 'links')) {
  $output = '';

  if (count($links) > 0) {
    $output = '<ul'. drupal_attributes($attributes) .'>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = ""; //was = $key;

      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $class .= ''; //was ' first';
      }
      if ($i == $num_links) {
        $class .= '';  //was ' last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))) {
        $class .= ''; //was ' active';
      }

      $output .= '<li'. drupal_attributes(array('class' => $class)) .'>';

      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        $output .= l($link['title'], $link['href'], $link);
      }
      else if (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span'. $span_attributes .'>'. $link['title'] .'</span>';
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}

function phptemplate_nice_menu_build($menu) {
  $output = '';  

  foreach ($menu as $menu_item) {
    $mlid = $menu_item['link']['mlid'];
    // Check to see if it is a visible menu item.
    if ($menu_item['link']['hidden'] == 0) {
      // Build class name based on menu path 
      // e.g. to give each menu item individual style.
      // Strip funny symbols.
      $clean_path = str_replace(array('http://', '<', '>', '&', '=', '?', ':'), '', $menu_item['link']['href']);
      // Convert slashes to dashes.
      $clean_path = str_replace('/', '-', $clean_path);
      $path_class = 'menu-path-'. $clean_path;
      // If it has children build a nice little tree under it.
      if ((!empty($menu_item['link']['has_children'])) && (!empty($menu_item['below']))) {
        // Keep passing children into the function 'til we get them all.
        $children = theme('nice_menu_build', $menu_item['below']);
        // Set the class to parent only of children are displayed.
        $parent_class = $children ? 'menuparent ' : '';
        $output .= '<li>'. theme('menu_item_link', $menu_item['link']);       
        // Build the child UL only if children are displayed for the user.
        if ($children) {
          $output .= '<ul>';
          $output .= $children;                     
          $output .= "</ul>\n";
        }
        $output .= "</li>\n";
      }
      else {
        $output .= '<li>'. theme('menu_item_link', $menu_item['link']) .'</li>'."\n";
      }
    }
  }
  return $output;
}

function phptemplate_nice_menu($id, $menu_name, $mlid, $direction = 'right', $menu = NULL) {
  $output = array();

  if ($menu_tree = theme('nice_menu_tree', $menu_name, $mlid, $menu)) {
    if ($menu_tree['content']) {
      $output['content'] = '<ul>'. $menu_tree['content'] .'</ul>'."\n";
      $output['subject'] = $menu_tree['subject'];
    }
  }
  return $output;
}
