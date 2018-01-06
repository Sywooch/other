<?php



/* GET FIRST WORDS */



function first_words($string, $num, $tail='...')

{

		/** strip the excerpt off tags **/

		

		$str = strip_tags($string);

	

        /** words into an array **/

        $words = str_word_count($str, 2);



        /*** get the first $num words ***/

        $firstwords = array_slice( $words, 0, $num);



        /** return words in a string **/

        return  implode(' ', $firstwords).$tail;

}



/* POPULAR POSTS */



function popularPosts($num) {

    global $wpdb, $wordpressbling_widgetLimit;

 

    $posts = $wpdb->get_results("SELECT comment_count, post_date, post_content, ID, post_title FROM $wpdb->posts ORDER BY comment_count DESC LIMIT 0 , $num");

 

    foreach ($posts as $post) {

        setup_postdata($post);

        $id = $post->ID;

        $title = $post->post_title;

        $count = $post->comment_count;

        $string = $post->post_content;

 

        if ($count != 0) {

        	$thumb = get_the_post_thumbnail($id, array(42,42));
	
			$limit = $wordpressbling_widgetLimit;
			
			if ($post->post_excerpt) {
			
				$text = get_the_excerpt();
				if (is_single()) echo '<p class="excerpt">'.$text.'</p>'; else echo '<p>'.$text.'</p>';
				
			} else {
			
				if (strpos($post->post_content, '<!--more-->')) $limit = strpos($post->post_content, '<!--more-->');
				$text = get_the_content();		
				$text = strip_shortcodes($text);
				$text = strip_tags($text);
				$text = substr($text, 0, $limit);
				$text = $text . '...';
				
			}

            $popular .= '<li>';

            $popular .= '<h4><a href="' . get_permalink($id) . '" title="' . $title . '">' . $title . '</a></h4>';

            if (!empty($thumb)) { $popular .= '<a href="' . get_permalink($id) . '">' . $thumb . '</a>'; }

            $popular .= '<p>' . $text . '</p>';

            $popular .= '</li>';

        }

    }

    return $popular;

}



/* RECENT COMMENTS */



function recent_com($numb) {

 	global $wpdb;

	

	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date, comment_approved, comment_type,comment_author_url, SUBSTRING(comment_content,1,100) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date DESC LIMIT 0, $numb";



	$comments = $wpdb->get_results($sql);

	

	foreach ($comments as $comment) {

	

	$title = $comment->post_title;

	$postid = $comment->comment_post_ID;

	$exc = $comment->com_excerpt;

	$comID = $comment->comment_ID;

	$email = $comment->comment_author_email;

	

	    $thumb2 = get_avatar($email,'42');

	

	

		$output .= '<li>';

		$output .= '<h4><a href="' . get_permalink($postid) . '" title="' . $title . '">' . $title . '</a></h4>';

		if(!empty($thumb2)) { $output .= '<a href="' . get_permalink($postid) . '#comment-'.$comID.'">' . $thumb2 . '</a>'; }

		$output .= '<p><a href="' . get_permalink($postid) . '#comment-'.$comID.'">'.first_words($exc, 11).'</a></p>';

		$output .= '</li>';

	}

	

 	echo $output;

}



?>