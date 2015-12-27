<?php

function getPost($topicid, $postid) {
  $data = executeResult("SELECT * FROM `nf_posts` WHERE `topicid`=? AND `postid`=?", array($topicid, $postid));
  $pd = new Parsedown();
  return array("title" => $data['title'], "content" => $pd->text($data['content']), "date" => $data['date'], "ownerid" => $data['ownerid'], "locked" => $data['locked'], "rating" => json_decode($data['rating'], true));
}

function newPost($topicid, $content) {

}
