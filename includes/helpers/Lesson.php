<?php

class lmscx_Lesson_Helper
{
  public function getLessonContent($lesson)
  {
    $content_post = get_post($lesson);
    $content = $content_post->post_content;
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);

    return $content;
  }

  public static function instance()
  {
    return new lmscx_Lesson_Helper;
  }
}
