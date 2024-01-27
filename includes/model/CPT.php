<?php

class lmscx_CPTHelper
{

	function __construct()
	{
	}

	public function getAllCPTByIdNoFilter($id, $page)
	{

		$args = array(
			'post_type' => $id,
			'post_status' => 'publish',
			'posts_per_page' => $page
		);
		return get_posts($args);
	}

	public function getAllCPTById($id, $page)
	{

		$args = array(
			'post_type' => $id,
			'post_status' => 'publish',
			'posts_per_page' => $page
		);
		$cpt = get_posts($args);

		$cptArr = array();
		foreach ($cpt as $theCPT) {
			$cptArr[$theCPT->ID] = $theCPT->post_title;
		}

		return $cptArr;
	}

	public function getRelatedCPT($cpt, $id)
	{

		$args = array(
			'post_type' => $cpt,
			'post__not_in' => array($id),
			'post_status' => 'publish',
			'posts_per_page' => -1
		);
		return get_posts($args);
	}

	public function getCPTByMeta($post_type, $key, $value)
	{
		$args = array(
			'post_type' => $post_type,  // Replace 'your_custom_post_type' with your actual custom post type name
			'meta_key' => $key,
			'meta_value' => $value,
			'post_status' => 'publish',  // Filter for published posts
			'posts_per_page' => -1,  // Retrieve all matching posts
			'orderby' => 'date',      // Order by date created
			'order' => 'DESC',        // Descending order
			// You can add more arguments here for optimal performance or other filtering
		);

		return get_posts($args);
	}

	public function getCPTPostMeta($id, $meta, $default)
	{

		$meta = get_post_meta($id, $meta, true);
		return $meta != null ? $meta : $default;
	}

	public function getCPTPostField($id, $field)
	{

		$field = get_post_field($field, $id);
		return $field != null ? $field : '';
	}

	public function getCurrentUserAvatar()
	{
		$user = get_current_user_id() != null ? get_current_user_id() : 1;
		$avatar = get_user_meta($user, 'user-avatar', true);
		if ($avatar == null) {
			$srcAvatar = $this->getAllCPTById('avatar', 1);
			foreach ($srcAvatar as $key => $theCPT) {
				$avatar = $key;
			}
		}
		return $avatar;
	}

	public static function instance()
	{
		return new lmscx_CPTHelper;
	}
}
