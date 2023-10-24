<?php 
/**
 * Add new shortcode with parse Function
 *
 * @param unknown $name
 * @param unknown $func
 */
function add_shortcode($name, $func){
	global $shortcode_tags;
	$shortcode_tags[$name] = $func;
}
/**
 * Parse all shortcode
 *
 * @param 		: string $content
 * @param		: string $shortcode_tags
 * @return		: string
 */
function parse_shortcode($content, $ignore_html = false ) {
	global $shortcode_tags;
	if ( false === strpos( $content, '[' ) ) {
		return $content;
	}
	if (empty($shortcode_tags) || !is_array($shortcode_tags))
		return $content;
	// Find all registered tag names in $content.
	preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
	$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );

	if ( empty( $tagnames ) ) {
		return $content;
	}

	$pattern = get_shortcode_regex( $tagnames);
	$content = preg_replace_callback( "/$pattern/", 'do_shortcode_tag', $content );

	// Always restore square braces so we don't break things like <!--[if IE ]>
	$content = unescape_invalid_shortcodes( $content );

	return $content;
}
/**
 * Regular Expression callable for parse_shortcode() for calling shortcode hook.
 *
 * @param unknown $m
 * @return string
 */
function do_shortcode_tag($m){
	global $shortcode_tags;
	// allow [[foo]] syntax for escaping a tag
	if ( $m[1] == '[' && $m[6] == ']' ) {
		return substr($m[0], 1, -1);
	}

	$tag = $m[2];
	$attr = shortcode_parse_atts( $m[3] );
	if ( ! is_callable( $shortcode_tags[ $tag ] ) ) {
		die("Error shortcode $tag");
	}
	$content = isset( $m[5] ) ? $m[5] : null;

	$output = $m[1] . call_user_func( $shortcode_tags[ $tag ], $attr, $content, $tag ) . $m[6];
	return $output;
}
/**
 * Combine user attributes with known attributes and fill in defaults when needed.
 *
 * @param unknown $pairs
 * @param unknown $atts
 * @param string $shortcode
 * @return multitype:array unknown
 */
function shortcode_atts( $pairs, $atts, $shortcode = '' ) {
	$atts = (array)$atts;
	$out = array();
	foreach ($pairs as $name => $default) {
		if ( array_key_exists($name, $atts) )
			$out[$name] = $atts[$name];
		else
			$out[$name] = $default;
	}
	/**
	 * Filters a shortcode's default attributes.
	 *
	 * If the third parameter of the shortcode_atts() function is present then this filter is available.
	 * The third parameter, $shortcode, is the name of the shortcode.
	 *
	 * @since 3.6.0
	 * @since 4.4.0 Added the `$shortcode` parameter.
	 *
	 * @param array  $out       The output array of shortcode attributes.
	 * @param array  $pairs     The supported attributes and their defaults.
	 * @param array  $atts      The user defined shortcode attributes.
	 * @param string $shortcode The shortcode name.
	 */
	if ( $shortcode ) {
		$out = apply_filters( "shortcode_atts_{$shortcode}", $out, $pairs, $atts, $shortcode );
	}
	return $out;
}
/**
 * Retrieve the shortcode attributes regex.
 *
 * @return string
 */
function get_shortcode_atts_regex() {
	return '/([\w-]+)\s*=\s*"([^"]*)"(?:\s|$)|([\w-]+)\s*=\s*\'([^\']*)\'(?:\s|$)|([\w-]+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|\'([^\']*)\'(?:\s|$)|(\S+)(?:\s|$)/';
}
/**
 * Retrieve all attributes from the shortcodes tag.
 *
 * @param unknown $text
 * @return Ambigous <string, multitype:NULL >
 */
function shortcode_parse_atts($text) {
	$atts = array();
	$pattern = get_shortcode_atts_regex();
	$text = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $text);
	if ( preg_match_all($pattern, $text, $match, PREG_SET_ORDER) ) {
		foreach ($match as $m) {
			if (!empty($m[1]))
				$atts[strtolower($m[1])] = stripcslashes($m[2]);
			elseif (!empty($m[3]))
			$atts[strtolower($m[3])] = stripcslashes($m[4]);
			elseif (!empty($m[5]))
			$atts[strtolower($m[5])] = stripcslashes($m[6]);
			elseif (isset($m[7]) && strlen($m[7]))
			$atts[] = stripcslashes($m[7]);
			elseif (isset($m[8]) && strlen($m[8]))
			$atts[] = stripcslashes($m[8]);
			elseif (isset($m[9]))
			$atts[] = stripcslashes($m[9]);
		}

		// Reject any unclosed HTML elements
		foreach( $atts as &$value ) {
			if ( false !== strpos( $value, '<' ) ) {
				if ( 1 !== preg_match( '/^[^<]*+(?:<[^>]*+>[^<]*+)*+$/', $value ) ) {
					$value = '';
				}
			}
		}
	} else {
		$atts = ltrim($text);
	}
	return $atts;
}
/**
 * Retrieve the shortcode regular expression for searching.
 *
 * @param string $tagnames
 * @return string (The shortcode search regular expression)
 */
function get_shortcode_regex( $tagnames = null ) {
	global $shortcode_tags;
	if ( empty( $tagnames ) ) {
		$tagnames = array_keys( $shortcode_tags );
	}
	$tagregexp = join( '|', array_map('preg_quote', $tagnames) );

	// WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
	// Also, see shortcode_unautop() and shortcode.js.
	return
	'\\['                              // Opening bracket
	. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
	. "($tagregexp)"                     // 2: Shortcode name
	. '(?![\\w-])'                       // Not followed by word character or hyphen
	. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
	.     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
	.     '(?:'
			.         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
			.         '[^\\]\\/]*'               // Not a closing bracket or forward slash
			.     ')*?'
					. ')'
							. '(?:'
									.     '(\\/)'                        // 4: Self closing tag ...
									.     '\\]'                          // ... and closing bracket
									. '|'
											.     '\\]'                          // Closing bracket
											.     '(?:'
													.         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
													.             '[^\\[]*+'             // Not an opening bracket
													.             '(?:'
															.                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
															.                 '[^\\[]*+'         // Not an opening bracket
															.             ')*+'
																	.         ')'
																			.         '\\[\\/\\2\\]'             // Closing shortcode tag
																			.     ')?'
																					. ')'
																							. '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
}
/**
 * Remove placeholders added by do_shortcodes_in_html_tags().
 *
 * @param unknown $content
 * @return string
 */
function unescape_invalid_shortcodes( $content ) {
	// Clean up entire string, avoids re-parsing HTML.
	$trans = array( '&#91;' => '[', '&#93;' => ']' );
	$content = strtr( $content, $trans );

	return $content;
}
?>