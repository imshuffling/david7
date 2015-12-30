<?php
/**
 * @file views-view-list.tpl.php
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
?>
<?php print $wrapper_prefix; ?>
  <?php if (!empty($title)) : ?>
    <h3><?php print $title; ?></h3>
  <?php endif; ?>
  <?php print $list_type_prefix; ?>
    <?php 
      $item = 0;
      foreach ($rows as $id => $row) {
        $classes = '';
        if (($item % 3) == 0) {
          $classes = 'alpha';
        }
        elseif (($item % 3) == 2) {
          $classes = 'omega';
        }
        ?>
        <li class="grid-4 <?php echo $classes;?>"><?php print $row; ?></li>
        <?php 
        $item++;
      }
    ?>
  <?php print $list_type_suffix; ?>
<?php print $wrapper_suffix; ?>