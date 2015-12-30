<?php

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal
 * generates through Alpha & Omega this file is a good place to do so.
 * 
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
 */
 
 // remove a tag from the head for Drupal 7
function david_html_head_alter(&$head_elements) {
  unset($head_elements['system_meta_generator']);
}


/**
 * Your themes template.php file
 */
function david_css_alter(&$css) {
	  // Turn off some styles from the system module
	  unset($css[drupal_get_path('module', 'system') . '/system.theme.css']);
	  unset($css[drupal_get_path('module', 'flippy') . '/flippy.css']);
}

/**
 * Implements hook_process_region().
 */
function david_process_region(&$vars) {
  if (in_array($vars['elements']['#region'], array('content', 'menu', 'branding'))) {
    $theme = alpha_get_theme();
    
    switch ($vars['elements']['#region']) {
      case 'content':
        $vars['title_prefix'] = $theme->page['title_prefix'];
        $vars['breadcrumb'] = $theme->page['breadcrumb'];
        $vars['title'] = $theme->page['title'];
        $vars['title_suffix'] = $theme->page['title_suffix'];
        $vars['tabs'] = $theme->page['tabs'];
        $vars['action_links'] = $theme->page['action_links'];      
        $vars['title_hidden'] = $theme->page['title_hidden'];
        $vars['feed_icons'] = $theme->page['feed_icons'];
        break;
      
      case 'menu':
        $vars['main_menu'] = $theme->page['main_menu'];
        $vars['secondary_menu'] = $theme->page['secondary_menu'];
        break;
      
      case 'branding':
        $vars['site_name'] = $theme->page['site_name'];
        $vars['linked_site_name'] = l($vars['site_name'], '<front>', array('attributes' => array('rel' => 'home', 'title' => t('Home')), 'html' => TRUE));
        $vars['site_slogan'] = $theme->page['site_slogan'];      
        $vars['site_name_hidden'] = $theme->page['site_name_hidden'];
        $vars['site_slogan_hidden'] = $theme->page['site_slogan_hidden'];
        $vars['logo'] = $theme->page['logo'];
        $vars['logo_img'] = $vars['logo'] ? '<img src="' . $vars['logo'] . '" alt="' . $vars['site_name'] . '" id="logo" />' : '';
        $vars['linked_logo_img'] = $vars['logo'] ? l($vars['logo_img'], '<front>', array('attributes' => array('rel' => 'home', 'title' => t($vars['site_name'])), 'html' => TRUE)) : '';
        break;      
    }
  }
}

/**
 * Implements hook_process_zone().
 */
function david_process_zone(&$vars) {
  $theme = alpha_get_theme();
  
  if ($vars['elements']['#zone'] == 'content') {
    $vars['messages'] = $theme->page['messages'];
    $vars['breadcrumb'] = $theme->page['breadcrumb'];
  }
}

function david_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];
  if (!empty($breadcrumb)) {
    // Adding the title of the current page to the breadcrumb.
    $breadcrumb[] = drupal_get_title();
   
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';

    $output .= '<div class="breadcrumb">' . implode(' &#187; ', $breadcrumb) . '</div>';
    return $output;
  }
}

function david_preprocess_html(&$variables) {   
    drupal_add_js(drupal_get_path('theme', 'david') .'/js/david.js');
	
	// Fittext shit
	drupal_add_js(drupal_get_path('theme', 'david') .'/js/jquery.fittext.js');
	drupal_add_js('http://use.edgefonts.net/droid-sans.js', 'external');
	//drupal_add_js('http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js', 'external');
	
  drupal_add_css(path_to_theme() . '/css/font-awesome.css', array('group' => CSS_THEME, 'preprocess' => FALSE));
  drupal_add_css(path_to_theme() . '/css/font-awesome-ie7.min.css', array('group' => CSS_THEME, 'preprocess' => FALSE));
}

