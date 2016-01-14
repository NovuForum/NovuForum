<?php

function getPost($topicid, $postid) {
  $data = executeResult("SELECT * FROM `nf_posts` WHERE `topicid`=? AND `postid`=?", array($topicid, $postid));
  $pd = new Parsedown();
  return array("title" => $data['title'], "content" => $pd->text($data['content']), "date" => $data['date'], "ownerid" => $data['ownerid'], "locked" => $data['locked'], "rating" => json_decode($data['rating'], true));
}

function newPost($topicid, $content) {

}

// TODO: REUSE THIS CODE
function getPosts($page) {
  if ($page == -1) {
    $sql = "SELECT * FROM `blogg` ORDER BY id DESC";
    $args = array();
    return executeResults($sql, $args);
  }
  $pagelength = 10;
  if (is_numeric($page)) {
    if ($page == 1) {
      $sql = "SELECT * FROM `blogg` ORDER BY id DESC LIMIT 0,10 ";
      $args = array();
      return executeResults($sql, $args);
    } else {
      $page = $page * 10 - 10;
      $sql = "SELECT * FROM `blogg` ORDER BY `id` DESC LIMIT $page,10";
      $args = array();
      return executeResults($sql, $args);
    }
  } else {
    return array("title" => "Failed getting posts", "linkid" => "failed", "description" => "Failed getting posts, please review the code or contact joarc@joarc.se");
  }
}
