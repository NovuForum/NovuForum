<?php

function getPost($topicid, $postid) {
  $data = executeResult("SELECT * FROM `nf_posts` WHERE `topicid`=? AND `postid`=?", array($topicid, $postid));
  $pd = new Parsedown();
  return array("title" => $data['title'], "content" => $pd->text($data['content']), "date" => $data['date'], "ownerid" => $data['ownerid'], "locked" => $data['locked'], "rating" => json_decode($data['rating'], true));
}

function newPost($topicid, $content) {

}

// TODO: REUSE THIS CODE
function getPostsByPage($page) {
  if (is_numeric($page)) {
    if ($page == 1) {
      $sql = "SELECT * FROM `nf_posts` ORDER BY id DESC LIMIT 0,10 ";
      $args = array();
      return executeResults($sql, $args);
    } else {
      $page = $page * 10 - 10;
      $sql = "SELECT * FROM `nf_posts` ORDER BY `id` DESC LIMIT $page,10";
      $args = array();
      return executeResults($sql, $args);
    }
  } else {
    return array("title" => "Failed getting posts", "linkid" => "failed", "description" => "Failed getting posts, page variable isnt number. Please notify developers!");
  }
}

function countTopicsByForumId($id) {
  $i = 0;
  $previd = -1;
  foreach (executeResults("SELECT * FROM `nf_posts` WHERE `forumid`=?", array($id)) as $value) {
    if ($value['topicid'] == $previd): continue; else: $previd = $value['topicid']; endif;
    $i++;
  }
  return $i;
}

function countPostsByForumId($id) {
  $i = 0;
  foreach (executeResults("SELECT * FROM `nf_posts` WHERE `forumid`=?", array($id)) as $value) {
    $i++;
  }
  return $i;
}

function getLatestPostByForumId($id) {
  return executeResult("SELECT `title` FROM `nf_posts` WHERE `forumid`=? ORDER BY DESC LIMIT 1", array($id))[0];
}
