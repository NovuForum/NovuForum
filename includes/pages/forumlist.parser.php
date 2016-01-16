<?php
// TMP Notes
/*

$forumslist = data from table

$key = something
$object = data from row
$object['type'] = object type
0 = nada (save data but dont delete)
1 = forum
2 = divider
3 = divider with text
4 = link
5 = ?

*/

$forumslist = executeResults("SELECT * FROM `nf_forums`", array());
?>
<table class="forumlist">
  <tr>
    <td colspan="11">ForumList</td>
  </tr>
  <?php foreach($forumslist as $key => $object) { ?>
    <?php if ($object['type'] == 1) { ?>
      <tr>
        <td colspan="6" class="forum-name"><a href="/forum/<?= $object['id'] ?>"><?= $object['title'] ?><br><small><?= $object['content'] ?></small></a></td>
        <td colspan="1" class="forum-topics"><?= countTopics($object['id']) ?></td>
        <td colspan="1" class="forum-posts"><?= countPosts($object['id']) ?></td>
        <td colspan="3" class="forum-latest"><?= getLatestPostByForumId($object['id']) ?></td>
      </tr>
    <?php } else if ($object['type'] == 2) { ?>
      <tr>
        <td colspan="11" class="forum-divider"></td>
      </tr>
    <?php } else if ($object['type'] == 3) { ?>
      <tr>
        <td colspan="11" class="forum-divider"><?= $object['title'] ?><?php if ($object['content'] != ""): ?><br><small><?= $object['content']?></small><?php endif; ?></td>
      </tr>
    <?php } else if ($object['type'] == 4) { ?>
      <tr>
        <td colspan="11" class="forum-link"><a href="<?= $object['url'] ?>"><?= $object['title'] ?><?php if ($object['content'] != ""): ?><br><small><?= $object['content']?></small><?php endif; ?></a></td>
      </tr>
    <?php } ?>
  <?php } ?>
</table>
