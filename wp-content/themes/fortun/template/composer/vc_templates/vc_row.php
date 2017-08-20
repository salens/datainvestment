<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * //@var $full_width
 * @var $full_height
 * //@var $content_placement
 * //@var $parallax
 * //@var $parallax_image
 * @var $css
 * @var $el_id
 * //@var $video_bg
 * //@var $video_bg_url
 * //@var $video_bg_parallax
 * @var $content - shortcode content
 * @var $fullwidth - added additionally
 * @var $bg_parallax - added additionally
 * @var $data_bottom_top - added additionally
 * @var $data_center - added additionally
 * @var $data_top_bottom - added additionally
 * @var $bg_choice - added additionally
 * @var $bg_image - added additionally
 * @var $bg_color - added additionally
 * @var $fallback_bg_color - added additionally etc.
 * //@var $bg_video_type - added additionally
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$output = $after_output = $fluid = $design_css = $row_bg_css = $row_bg_overlay = $fullheight = $flexrow = $columnsplacement = $equalheight = $row_css_classes = $fallback_bg = $bg_parallax_class = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class );

$wrapper_attributes = array();
// build attributes for wrapper
// NEED TO BE IMPROVED to create custom css
if ( empty( $el_id ) ) {
	$el_id = 'agni-row-'.rand(10000, 99999);
}
$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';

if( !empty( $fullwidth ) ){
	$fluid = '-fluid';
	$row_css_classes = $fullwidth;
}

if ( ! empty( $full_height ) ) {
	$row_css_classes .= ' vc_row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$row_css_classes .= ' vc_row-o-columns-' . $columns_placement;
	}
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$row_css_classes .= ' vc_row-o-equal-height';
}
if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$row_css_classes .= ' vc_row-o-content-' . $content_placement;
}
if (!empty($atts['gap'])) {
	$row_css_classes .= ' vc_column-gap-'.$atts['gap'];
}
if ( ! empty( $flex_row ) ) {
	$row_css_classes .= ' vc_row-flex';
}

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if( !empty($margin_top) ){
	$design_css .= 'margin-top: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_top ) ? $margin_top : $margin_top . 'px' ) . '; ';
}
if( !empty($margin_right) ){
	$design_css .= 'margin-right: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_right ) ? $margin_right : $margin_right . 'px' ) . '; ';
}
if( !empty($margin_bottom) ){
	$design_css .= 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_bottom ) ? $margin_bottom : $margin_bottom . 'px' ) . '; ';
}
if( !empty($margin_left) ){
	$design_css .= 'margin-left: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_left ) ? $margin_left : $margin_left . 'px' ) . '; ';
}
if( !empty($padding_top) ){
	$design_css .= 'padding-top: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding_top ) ? $padding_top : $padding_top . 'px' ) . '; ';
}
if( !empty($padding_right) ){
	$design_css .= 'padding-right: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding_right ) ? $padding_right : $padding_right . 'px' ) . '; ';
}
if( !empty($padding_bottom) ){
	$design_css .= 'padding-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding_bottom ) ? $padding_bottom : $padding_bottom . 'px' ) . '; ';
}
if( !empty($padding_left) ){
	$design_css .= 'padding-left: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding_left ) ? $padding_left : $padding_left . 'px' ) . '; ';
}
if( !empty($border_top) ){
	$design_css .= 'border-top-width: ' . $border_top . 'px; ';
	if( !empty($border_style) ){
		$design_css .= 'border-top-style: ' . $border_style . '; ';
	}
}
if( !empty($border_right) ){
	$design_css .= 'border-right-width: ' . $border_right . 'px; ';
	if( !empty($border_style) ){
		$design_css .= 'border-right-style: ' . $border_style . '; ';
	}
}
if( !empty($border_bottom) ){
	$design_css .= 'border-bottom-width: ' . $border_bottom . 'px; ';
	if( !empty($border_style) ){
		$design_css .= 'border-bottom-style: ' . $border_style . '; ';
	}
}
if( !empty($border_left) ){
	$design_css .= 'border-left-width: ' . $border_left . 'px; ';
	if( !empty($border_style) ){
		$design_css .= 'border-left-style: ' . $border_style . '; ';
	}
}
if( !empty($border_color) ){
	$design_css .= 'border-color: ' . $border_color.'; ';
}
if( !empty($border_radius) ){
	$design_css .= 'border-radius: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $border_radius ) ? $border_radius : $border_radius . 'px' ) . '; ';
}

if( !empty($design_css) ){
	$design_css = 'style="'.$design_css.'"';
}

if( $bg_parallax == '1' ){
	$bg_parallax = 'data-top-bottom="'.$data_top_bottom.'" data-center="'.$data_center.'" data-bottom-top="'.$data_bottom_top.'"';
	$bg_parallax_class = ' parallax';
}

if( !empty($bg_color) ){
	$row_bg_css .= 'background-color: ' . $bg_color . '; ';
}
if( !empty($bg_image) ){
	$row_bg_css .= 'background-image: url(\'' . wp_get_attachment_url($bg_image) . '\'); ';

	$row_bg_css .= 'background-repeat:' . $bg_image_repeat . '; ';
	$row_bg_css .= 'background-size:' . $bg_image_size . '; ';
	$row_bg_css .= 'background-position:' . $bg_image_position . '; ';
	$row_bg_css .= 'background-attachment:' . $bg_image_attachment . '; ';

	if( !empty($fallback_bg_color) ){
		$row_bg_css .= 'background-color: ' . $fallback_bg_color . '; ';
		$fallback_bg = 'has-fallback';
	}
}
if( !empty($row_bg_css) ){
	$row_bg_css = 'style="'.$row_bg_css.'"';
}
if( $bg_choice == '1' ){
	$row_bg = '<div class="section-row-bg section-row-bg-color '.$bg_parallax_class.'" '.$row_bg_css.' '.$bg_parallax.'></div>';
}
else if( $bg_choice == '2' ){
	$row_bg = '<div class="section-row-bg section-row-bg-image '.$bg_parallax_class.'" '.$row_bg_css.' '.$bg_parallax.'></div>';
}
else if( $bg_choice == '3' ){

    if( $bg_video_loop == '1'){
        $yt_bg_video_loop = 'true';
        $bg_video_loop = 'loop ';
    }
    else{
        $yt_bg_video_loop = 'false';
    }
    
    if( $bg_video_autoplay == '1'){
        $yt_bg_video_autoplay = 'true';
        $bg_video_autoplay = 'autoplay ';
    }
    else{
        $yt_bg_video_autoplay = 'false';
    }
    
    if( $bg_video_muted == '1'){
        $yt_bg_video_muted = 'true';
        $bg_video_muted = 'muted ';
    }
    else{
        $yt_bg_video_muted = 'false';
    }

    if( $bg_video_src == '1' ){
        $row_bg = '<a id="bgndVideo-'.$el_id.'" class="player" style="background-image:url('.wp_get_attachment_url($bg_video_src_yt_fallback).');" data-property="{videoURL:\''.$bg_video_src_yt.'\',containment:\'.section-row-bg-container-'.$el_id.'\', showControls:false, autoPlay:'.$yt_bg_video_autoplay.', loop:'.$yt_bg_video_loop.', vol:'.$bg_video_volume.', mute:'.$yt_bg_video_muted.', startAt:'.$bg_video_start_at.', stopAt:'.$bg_video_stop_at.', opacity:1, addRaster:false, quality:\''.$bg_video_quality.'\'}"></a>
            <!--<div class="section-video-controls">
                <a class="command command-play" href="#"></a>
                <a class="command command-pause" href="#"></a>
            </div>-->';
    }
    else if( $bg_video_src == '2' ){
        $row_bg = '<div id="section-selfhosted-video-'.$el_id.'" class="section-row-bg section-row-bg-video self-hosted embed-responsive">
                <video '. $bg_video_autoplay . $bg_video_loop . $bg_video_muted . ' class="custom-self-hosted-video" poster="'.wp_get_attachment_url($bg_video_src_sh_poster).'">
                    <source src="'.$bg_video_src_sh.'" type="video/mp4">
                </video>
            </div>';
    }
}

if( $bg_overlay == '1' ){
	$row_bg_overlay = '<div class="section-row-bg-overlay overlay" style="background-color:'.$bg_overlay_color.';"></div>';
	if( $bg_overlay_choice == '3' ){
	    $row_bg_overlay = '<div class="section-row-bg-overlay section-row-gradient-map-overlay gradient-map-overlay overlay '.$bg_parallax_class.'" data-gm="'.$bg_gm_overlay_color1.','.$bg_gm_overlay_color2.','.$bg_gm_overlay_color3.' " '.$row_bg_css.' '.$bg_parallax.'></div>';
	}
	elseif ( $bg_overlay_choice == '2' ) {
	    $row_bg_overlay = '<div class="section-row-bg-overlay overlay" style="'.strip_tags($bg_sg_overlay_css).';"></div>';
	}
}

if( !empty($row_bg) ){
	$row_bg = '<div class="section-row-bg-container section-row-bg-container-'.$el_id.'">'.$row_bg.$row_bg_overlay.'</div>';
}

$css_classes = array(
	'section-row',
	$el_class,
	$fallback_bg,
	//vc_shortcode_custom_css_class( $css ),
);
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
if( !empty($css_class) ){
	$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
}


$output .= '<div ' . implode( ' ', $wrapper_attributes ) . ' '.$design_css.'>';
$output .= $row_bg;
$output .= '<div class="container'.$fluid.'">';
$output .= '<div class="vc_row vc_row_fluid ' . esc_attr( trim( $row_css_classes ) ) . '">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
//$output .= $after_output;

echo  $output;