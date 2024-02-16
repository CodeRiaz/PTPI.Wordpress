<?php

/**
 * Custom template tags and layout/styling helpers
 *
 * @since 1.0
 */

/**
 * Get logo URL
 *
 * @param string $location Location of the logo
 * @return mixed
 */
function am_get_logo($location = 'header', $echo = false)
{

	$logo = get_field($location . '_logo', 'option');

	if (!$logo && $location == 'header') {
		$logo = get_template_directory_uri() . '/assets/images/logo-header.svg';
	} elseif (!$logo && $location == 'footer') {
		$logo = get_template_directory_uri() . '/assets/images/logo-footer.svg';
	}

	if (!$echo) {
		return $logo;
	}

	$title = get_bloginfo('name');
	echo "<img class=\"logo\" src=\"{$logo}\" alt=\"{$title}\" title=\"{$title}\">";
}

/**
 * Get and prepare copyright message
 *
 * @return mixed Copyright message
 */
function am_get_copyright($echo = false)
{

	$copyright = get_field('copyright_message', 'option', false, false);

	if (empty($copyright)) {
		return false;
	}

	$copyright = str_replace(array('{{year}}'), date('Y'), $copyright);

	if (!$echo) {
		return $copyright;
	}

	echo $copyright;
}

/**
 * Renders ACF Flexible Content
 *
 * @param  string $template The ACF Flexible template
 */
function am_render_flexible_rows($template = 'composer')
{

	if (have_rows($template)) {

		while (have_rows($template)) {
			the_row();

			$layout = str_replace('_', '-', get_row_layout());
			get_template_part('template-parts/layouts/layout', $layout);
		}
	}
}

function am_the_field($name = false, $before = '', $after = '', $sub_field = false, $option = false)
{

	if (!$name) {
		return;
	}

	$output = '';
	// echo get_sub_field( $name );
	if (!$option) {
		if (!$sub_field && get_field($name)) {
			$output = get_field($name, false, false);
		} else if ($sub_field && get_sub_field($name)) {
			$output = get_sub_field($name);
		}
	} else {
		if (!$sub_field && get_field($name, 'option')) {
			$output = get_field($name, 'option');
		} else if ($sub_field && get_sub_field($name)) {
			$output = get_sub_field($name, 'option');
		}
	}

	if (!empty($output)) {
		echo $before . $output . $after;
	}

}

/**
 * Return or echo attachment
 *
 * @param  integer $attachment_id Attachment ID
 * @param  string  $size         Thumbnail size
 * @param  boolean $echo         Whether to print the image or return URL, default = false
 * @param  string $classes      CSS classes
 * @return Mixed                 Print <img> if $echo = true or return URL
 */
function am_get_attachment($attachment_id = 0, $size = 'thumbnail', $echo = false, $classes = '')
{

	if (!$attachment_id) {
		return false;
	}

	if (!$echo) {
		return wp_get_attachment_image_url($attachment_id, $size);
	}

	if (!empty($classes)) {
		$classes = " class=\"{$classes}\"";
	}

	// echo wp_get_attachment_image($attachment_id, $size);
	echo '<img src="' . wp_get_attachment_image_url($attachment_id, $size) . '"' . $classes . '>';
}

/**
 * Prints an anchor tag from an array of ACF Link object
 */
function am_the_link($link = array(), $before = '', $after = '', $classes = '', $target = '')
{

	if (!is_array($link) || !count($link)) {
		return;
	}

	$output = '';

	if (!empty($target)) {
		$link['target'] = $target;
	}

	$output .= '<a href="' . $link['url'] . '" class="' . $classes . '" target="' . $link['target'] . '">' . $link['title'] . '</a>';

	if (!empty($output)) {
		echo $before . $output . $after;
	}
}

function am_the_video($video_url = '', $atts = 'controls')
{
	if (empty($video_url)) return;
	$video_host = parse_url($video_url)['host'];

	echo '<div class="object-container">';

	if ($video_host == 'youtube.com' || $video_host == 'www.youtube.com') :
		parse_str(parse_url($video_url, PHP_URL_QUERY), $youtube_vars);
		$youtube_atts = '?rel=0&amp;showinfo=0&amp;modestbranding=1';

		if ( strpos($atts, 'autoplay') ) {
			$youtube_atts .= '&autoplay=1&controls=0&loop=1';
		}
	?>
		<iframe width="1000px" src="https://www.youtube.com/embed/<?php echo $youtube_vars['v'] . $youtube_atts; ?>" frameborder="0" allow="autoplay; encrypted-media; loop;" allowfullscreen></iframe>
	<?php
		elseif ($video_host == 'vimeo.com' || $video_host == 'www.vimeo.com') :
			$vimeo_vars = explode("/", parse_url($video_url, PHP_URL_PATH));
			$vimeo_id = (int)$vimeo_vars[count($vimeo_vars) - 1];
			$vimeo_atts = '?title=0&byline=0&portrait=0';

			if ( strpos($atts, 'autoplay') ) {
				$vimeo_atts .= '&autoplay=1&controls=0&loop=1';
			}
	?>
		<iframe allow="autoplay; fullscreen;" width="1000px" src="https://player.vimeo.com/video/<?php echo $vimeo_id . $vimeo_atts; ?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
	<?php else : ?>
		<video width="1000px" playsinline <?php echo $atts; ?>>
			<source src="<?php echo $video_url; ?>" type="video/mp4">
			Your browser does not support HTML5 video.
		</video>
	<?php
	endif;

	echo '</div>';
}