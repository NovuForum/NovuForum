<?php
$topiclist = executeResults("SELECT * FROM `nf_posts` WHERE `forumid`=?", array($forumid));
?>
<table class="topiclist">
<?php if ($topiclist != null) { ?>
<?php foreach($topiclist as $topicdata) { ?>
  <tr class="topicrow">
    <td class="topictitle"><?= $topicdata['title'] ?></td>
  </tr>
<?php } ?>
<?php } else { ?>
<tr>
  <td colspan="8">No topics found in this section.</td>
</tr>
<?php } ?>
</table>
<hr>
<pre>
  <?php print_r($topiclist); ?>
</pre>
