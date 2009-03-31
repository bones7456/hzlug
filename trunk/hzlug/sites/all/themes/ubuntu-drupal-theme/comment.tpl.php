<?php
// $Id: comment.tpl.php,v 1.1.2.22 2008/07/27 18:05:04 andregriffin Exp $
?>
<div class="comment<?php print ($comment->new) ? ' comment-new' : ''; print ' '. $status; print ' '. $zebra; ?>" >
<div class="inner" style="border-right:5px solid #EBE0CA;border-left:5px solid #EBE0CA;"><span class="corners-top" style="margin-left:-5px;margin-right:-5px;"><span></span></span>
<?php print $picture ?>
  <div class="comment-bar">
    <?php if ($submitted): ?>
      <span class="submitted"><?php print $submitted; ?></span>
    <?php endif; ?>

    <?php if ($comment->new) : ?>
      <span class="new"><?php print drupal_ucfirst($new) ?></span>
    <?php endif; ?>
  </div>

  <h3><?php print $title ?></h3>
<span class="corners-bottom" style="margin-left:-5px;margin-right:-5px;"><span></span></span></div>

  <div class="content">
    <?php print $content ?>
    <?php if ($signature): ?>
      <div>—</div>
      <?php print $signature ?>
    <?php endif; ?>
  </div>

  <?php if ($links): ?>
    <div class="links">
      <?php print $links ?>
    </div>
  <?php endif; ?>

</div>
