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
?>
<table class="forumlist">
  <tr>
    <td colspan="11">ForumList</td>
  </tr>
  <?php foreach($forumslist as $key => $object) { ?>
    <?php if ($object['type'] == 1) { ?>
    <tr>
      <td colspan="6" class="forum-name"><?= $object['title'] ?><br><small><?= $object['content'] ?></small></td>
      <td colspan="1" class="forum-topics"><?= countTopics($object['id']) ?></td>
      <td colspan="1" class="forum-posts"><?= countPosts($object['id']) ?></td>
      <td colspan="3" class="forum-latest"><?= getLatestPostsFromForums($object['id']) ?></td>
    </tr>
    <?php } ?>
  <?php } ?>
</table>
