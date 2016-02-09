<?php
// TMP Notes
/*

$forumslist = data from table

$key = something
$object = data from row
$object["type"] = object type
0 = nada (save data but dont delete)
1 = forum
2 = divider
3 = divider with text
4 = link
5 = ?

*/

$forumslist = executeResults("SELECT * FROM `nf_forums`", array());
$parser['forumlist'] = "";
$parser['forumlist'] .= '<table class="forumlist">';
$parser['forumlist'] .= '  <tr>';
$parser['forumlist'] .= '    <td colspan="11">ForumList</td>';
$parser['forumlist'] .= '  </tr>';
foreach($forumslist as $key => $object) {
  if ($object["type"] == 1) {
$parser['forumlist'] .= '      <tr>';
$parser['forumlist'] .= '        <td colspan="6" class="forum-name"><a href="/forum/'.$object["id"].'">'.$object["title"].'<br><small>'.$object["content"].'</small></a></td>';
$parser['forumlist'] .= '        <td colspan="1" class="forum-topics">'.countTopicsByForumId($object["id"]).'</td>';
$parser['forumlist'] .= '        <td colspan="1" class="forum-posts">'.countPostsByForumId($object["id"]).'</td>';
$parser['forumlist'] .= '        <td colspan="3" class="forum-latest">'.getLatestPostByForumId($object["id"]).'</td>';
$parser['forumlist'] .= '      </tr>';
  } else if ($object["type"] == 2) {
$parser['forumlist'] .= '      <tr>';
$parser['forumlist'] .= '        <td colspan="11" class="forum-divider"></td>';
$parser['forumlist'] .= '      </tr>';
  } else if ($object["type"] == 3) {
$parser['forumlist'] .= '      <tr>';
$parser['forumlist'] .= '        <td colspan="11" class="forum-divider">'.$object["title"];
    if ($object["content"] != "") {
$parser['forumlist'] .= '<br><small>'.$object["content"].'</small>';
    }
$parser['forumlist'] .= '</td>';
$parser['forumlist'] .= '      </tr>';
  } else if ($object["type"] == 4) {
$parser['forumlist'] .= '      <tr>';
$parser['forumlist'] .= '        <td colspan="11" class="forum-link"><a href="'.$object["url"].'">'.$object["title"];
    if ($object["content"] != "") {
$parser['forumlist'] .= '<br><small>'.$object["content"].'</small>';
    }
$parser['forumlist'] .= '</a></td>';
$parser['forumlist'] .= '      </tr>';
  }
}
$parser['forumlist'] .= '</table>';
