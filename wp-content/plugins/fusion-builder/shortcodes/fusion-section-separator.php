<?php
/**
 * Add an element to fusion-builder.
 *
 * @package fusion-builder
 * @since 1.0
 */

if ( fusion_is_element_enabled( 'fusion_section_separator' ) ) {

	if ( ! class_exists( 'FusionSC_SectionSeparator' ) ) {
		/**
		 * Shortcode class.
		 *
		 * @since 1.0
		 */
		class FusionSC_SectionSeparator extends Fusion_Element {

			/**
			 * The section separator counter.
			 *
			 * @access private
			 * @since 1.0
			 * @var int
			 */
			private $element_counter = 1;

			/**
			 * An array of the shortcode arguments.
			 *
			 * @access protected
			 * @since 1.0.0
			 * @var array
			 */
			protected $args;

			/**
			 * Constructor.
			 *
			 * @access public
			 * @since 1.0
			 */
			public function __construct() {
				parent::__construct();
				add_filter( 'fusion_attr_section-separator-shortcode', [ $this, 'attr' ] );
				add_filter( 'fusion_attr_section-separator-shortcode-svg-wrapper', [ $this, 'svg_wrapper_attr' ] );
				add_filter( 'fusion_attr_section-separator-shortcode-spacer', [ $this, 'spacer_attr' ] );
				add_filter( 'fusion_attr_section-separator-shortcode-spacer-height', [ $this, 'spacer_height_attr' ] );
				add_filter( 'fusion_attr_section-separator-shortcode-icon', [ $this, 'icon_attr' ] );
				add_filter( 'fusion_attr_section-separator-shortcode-divider-candy', [ $this, 'divider_candy_attr' ] );
				add_filter( 'fusion_attr_section-separator-shortcode-divider-candy-arrow', [ $this, 'divider_candy_arrow_attr' ] );
				add_filter( 'fusion_attr_section-separator-shortcode-divider-rounded-split', [ $this, 'divider_rounded_split_attr' ] );
				add_filter( 'fusion_attr_section-separator-shortcode-divider-svg', [ $this, 'divider_svg_attr' ] );

				add_shortcode( 'fusion_section_separator', [ $this, 'render' ] );

			}

			/**
			 * Gets the default values.
			 *
			 * @static
			 * @access public
			 * @since 2.0.0
			 * @return array
			 */
			public static function get_element_defaults() {

				global $fusion_settings;

				return [
					'divider_type'     => 'triangle',
					'divider_position' => 'center',
					'hide_on_mobile'   => fusion_builder_default_visibility( 'string' ),
					'class'            => '',
					'id'               => '',
					'backgroundcolor'  => $fusion_settings->get( 'section_sep_bg' ),
					'bordersize'       => $fusion_settings->get( 'section_sep_border_size' ),
					'bordercolor'      => $fusion_settings->get( 'section_sep_border_color' ),
					'divider_candy'    => 'top',
					'icon'             => '',
					'icon_color'       => $fusion_settings->get( 'icon_color' ),
				];
			}

			/**
			 * Maps settings to param variables.
			 *
			 * @static
			 * @access public
			 * @since 2.0.0
			 * @return array
			 */
			public static function settings_to_params() {
				return [
					'section_sep_bg'           => 'backgroundcolor',
					'section_sep_border_size'  => 'bordersize',
					'section_sep_border_color' => 'bordercolor',
					'icon_color'               => 'icon_color',
				];
			}

			/**
			 * Used to set any other variables for use on front-end editor template.
			 *
			 * @static
			 * @access public
			 * @since 2.0.0
			 * @return array
			 */
			public static function get_element_extras() {
				$fusion_settings = fusion_get_fusion_settings();
				return [
					'container_padding_100' => $fusion_settings->get( 'container_padding_100' ),
					'layout'                => esc_attr( $fusion_settings->get( 'layout' ) ),
					'site_width'            => esc_attr( $fusion_settings->get( 'site_width' ) ),
					'header_position'       => esc_attr( fusion_get_option( 'header_position' ) ),
					'side_header_width'     => $fusion_settings->get( 'side_header_width' ),
					'hundredp_padding'      => esc_attr( $fusion_settings->get( 'hundredp_padding' ) ),
					'visibility_large'      => $fusion_settings->get( 'visibility_large' ),
					'visibility_medium'     => $fusion_settings->get( 'visibility_medium' ),
					'visibility_small'      => $fusion_settings->get( 'visibility_small' ),
				];
			}

			/**
			 * Maps settings to extra variables.
			 *
			 * @static
			 * @access public
			 * @since 2.0.0
			 * @return array
			 */
			public static function settings_to_extras() {

				return [
					'container_padding_100' => 'container_padding_100',
					'layout'                => 'layout',
					'site_width'            => 'site_width',
					'header_position'       => 'header_position',
					'side_header_width'     => 'side_header_width',
					'hundredp_padding'      => 'hundredp_padding',
				];
			}

			/**
			 * Render the shortcode
			 *
			 * @access public
			 * @since 1.0
			 * @param  array  $args    Shortcode parameters.
			 * @param  string $content Content between shortcode.
			 * @return string          HTML output.
			 */
			public function render( $args, $content = '' ) {

				global $fusion_settings, $fusion_fwc_type, $fusion_col_type;

				$defaults = FusionBuilder::set_shortcode_defaults( self::get_element_defaults(), $args, 'fusion_section_separator' );

				$defaults['bordersize'] = FusionBuilder::validate_shortcode_attr_value( $defaults['bordersize'], 'px' );

				extract( $defaults );

				$this->args = $defaults;

				if ( 'triangle' === $divider_type ) {
					if ( $icon ) {
						if ( ! $icon_color ) {
							$this->args['icon_color'] = $bordercolor;
						}

						$icon = '<div ' . FusionBuilder::attributes( 'section-separator-shortcode-icon' ) . '></div>';
					}

					$candy = '<div ' . FusionBuilder::attributes( 'section-separator-shortcode-divider-candy-arrow' ) . '></div><div ' . FusionBuilder::attributes( 'section-separator-shortcode-divider-candy' ) . '></div>';

					if ( false !== strpos( $this->args['divider_candy'], 'top' ) && false !== strpos( $this->args['divider_candy'], 'bottom' ) ) {
						$candy = '<div ' . FusionBuilder::attributes( 'section-separator-shortcode-divider-candy' ) . '></div>';
					}

					$candy = $icon . $candy;
				} elseif ( 'bigtriangle' === $divider_type ) {
					$candy = '<svg class="fusion-big-triangle-candy" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" ' . FusionBuilder::attributes( 'section-separator-shortcode-divider-svg' ) . '>';

					if ( 'top' === $divider_candy ) {
						if ( 'right' === $divider_position ) {
							$candy .= '<path d="M0 100 L75 0 L100 100 Z"></path>';
						} elseif ( 'left' === $divider_position ) {
							$candy .= '<path d="M0 100 L25 2 L100 100 Z"></path>';
						} else {
							$candy .= '<path d="M0 100 L50 2 L100 100 Z"></path>';
						}
					} else {
						if ( 'right' === $divider_position ) {
							$candy .= '<path d="M-1 -1 L75 99 L101 -1 Z"></path>';
						} elseif ( 'left' === $divider_position ) {
							$candy .= '<path d="M0 -1 L25 100 L101 -1 Z"></path>';
						} else {
							$candy .= '<path d="M-1 -1 L50 99 L101 -1 Z"></path>';
						}
					}

					$candy .= '</svg>';
				} elseif ( 'slant' === $divider_type ) {
					$candy = '<svg class="fusion-slant-candy" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" ' . FusionBuilder::attributes( 'section-separator-shortcode-divider-svg' ) . '>';

					if ( 'left' === $divider_position && 'top' === $divider_candy ) {
						$candy .= '<path d="M100 0 L100 100 L0 0 Z"></path>';
					} elseif ( 'right' === $divider_position && 'top' === $divider_candy ) {
						$candy .= '<path d="M0 100 L0 0 L100 0 Z"></path>';
					} elseif ( 'right' === $divider_position && 'bottom' === $divider_candy ) {
						$candy .= '<path d="M100 0 L0 100 L101 100 Z"></path>';
					} else {
						$candy .= '<path d="M0 0 L0 100 L100 100 Z"></path>';
					}
					$candy .= '</svg>';
				} elseif ( 'rounded-split' === $divider_type ) {
					$candy = sprintf( '<div %s></div>', FusionBuilder::attributes( 'section-separator-shortcode-divider-rounded-split' ) );
				} elseif ( 'big-half-circle' === $divider_type ) {
					$candy = '<svg class="fusion-big-half-circle-candy" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" ' . FusionBuilder::attributes( 'section-separator-shortcode-divider-svg' ) . '>';

					if ( 'top' === $divider_candy ) {
						$candy .= '<path d="M0 100 C40 0 60 0 100 100 Z"></path>';
					} else {
						$candy .= '<path d="M0 0 C55 180 100 0 100 0 Z"></path>';
					}

					$candy .= '</svg>';
				} elseif ( 'curved' === $divider_type ) {
					$candy = '<svg class="fusion-curved-candy" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" ' . FusionBuilder::attributes( 'section-separator-shortcode-divider-svg' ) . '>';

					if ( 'left' === $divider_position ) {
						if ( 'top' === $divider_candy ) {
							$candy .= '<path d="M0 100 C 20 0 50 0 100 100 Z"></path>';
						} else {
							$candy .= '<path d="M0 0 C 20 100 50 100 100 0 Z"></path>';
						}
					} else {
						if ( 'top' === $divider_candy ) {
							$candy .= '<path d="M0 100 C 60 0 75 0 100 100 Z"></path>';
						} else {
							$candy .= '<path d="M0 0 C 50 100 80 100 100 0 Z"></path>';
						}
					}
					$candy .= '</svg>';
				} elseif ( 'clouds' === $divider_type ) {
					$candy  = '<svg class="fusion-clouds-candy" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none" ' . FusionBuilder::attributes( 'section-separator-shortcode-divider-svg' ) . '>';
					$candy .= '<path d="M-5 100 Q 0 20 5 100 Z"></path>
								<path d="M0 100 Q 5 0 10 100"></path>
								<path d="M5 100 Q 10 30 15 100"></path>
								<path d="M10 100 Q 15 10 20 100"></path>
								<path d="M15 100 Q 20 30 25 100"></path>
								<path d="M20 100 Q 25 -10 30 100"></path>
								<path d="M25 100 Q 30 10 35 100"></path>
								<path d="M30 100 Q 35 30 40 100"></path>
								<path d="M35 100 Q 40 10 45 100"></path>
								<path d="M40 100 Q 45 50 50 100"></path>
								<path d="M45 100 Q 50 20 55 100"></path>
								<path d="M50 100 Q 55 40 60 100"></path>
								<path d="M55 100 Q 60 60 65 100"></path>
								<path d="M60 100 Q 65 50 70 100"></path>
								<path d="M65 100 Q 70 20 75 100"></path>
								<path d="M70 100 Q 75 45 80 100"></path>
								<path d="M75 100 Q 80 30 85 100"></path>
								<path d="M80 100 Q 85 20 90 100"></path>
								<path d="M85 100 Q 90 50 95 100"></path>
								<path d="M90 100 Q 95 25 100 100"></path>
								<path d="M95 100 Q 100 15 105 100 Z"></path>';
					$candy .= '</svg>';
				} elseif ( 'horizon' === $divider_type ) {
					$y_min = ( 'top' === $divider_candy ) ? '-0.5' : '0';
					$candy = '<svg class="fusion-horizon-candy" fill="' . esc_attr( $this->args['backgroundcolor'] ) . '" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" viewBox="0 ' . $y_min . ' 1024 178" preserveAspectRatio="none" ' . FusionBuilder::attributes( 'section-separator-shortcode-divider-svg' ) . '>';
					if ( 'top' === $divider_candy ) {
						$candy .= '<path class="st0" d="M1024 177.371H0V.219l507.699 133.939L1024 .219v177.152z"/>
									<path class="st1" d="M1024 177.781H0V39.438l507.699 94.925L1024 39.438v138.343z"/>
									<path class="st2" d="M1024 177.781H0v-67.892l507.699 24.474L1024 109.889v67.892z"/>
									<path class="st3" d="M1024 177.781H0v-3.891l507.699-39.526L1024 173.889v3.892z"/>
								';
					} else {
						$candy .= '<path class="st0" d="M1024 177.193L507.699 43.254 0 177.193V.041h1024v177.152z"/>
									<path class="st1" d="M1024 138.076L507.699 43.152 0 138.076V-.266h1024v138.342z"/>
									<path class="st2" d="M1024 67.728L507.699 43.152 0 67.728V-.266h1024v67.994z"/>
									<path class="st3" d="M1024 3.625L507.699 43.152 0 3.625V-.266h1024v3.891z"/>
								';
					}
					$candy .= '</svg>';
				} elseif ( 'hills' === $divider_type ) {
					if ( 'top' === $divider_candy ) {
						$candy  = '<svg class="fusion-hills-candy" fill="' . esc_attr( $this->args['backgroundcolor'] ) . '" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" viewBox="0 74 1024 107" preserveAspectRatio="none" ' . FusionBuilder::attributes( 'section-separator-shortcode-divider-svg' ) . '>';
						$candy .= '<path class="st4" d="M0 182.086h1024v-77.312c-49.05 20.07-120.525 42.394-193.229 42.086-128.922-.512-159.846-72.294-255.795-72.294-89.088 0-134.656 80.179-245.043 82.022S169.063 99.346 49.971 97.401C32.768 97.094 16.077 99.244 0 103.135v78.951z"/>';
					} else {
						$candy  = '<svg class="fusion-hills-candy" fill="' . esc_attr( $this->args['backgroundcolor'] ) . '" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" viewBox="0 1 1024 107" preserveAspectRatio="none" ' . FusionBuilder::attributes( 'section-separator-shortcode-divider-svg' ) . '>';
						$candy .= '<path class="st4" d="M0 0h1024v77.3c-49-20.1-120.5-42.4-193.2-42.1-128.9.5-159.8 72.3-255.8 72.3-89.1 0-134.7-80.2-245-82-110.4-1.8-160.9 57.2-280 59.2-17.2.3-33.9-1.8-50-5.7V0z"/>';
					}
					$candy .= '</svg>';
				} elseif ( 'hills_opacity' === $divider_type ) {
					$y_min = ( 'top' === $divider_candy ) ? '-0.5' : '0';
					$candy = '<svg class="fusion-hills-opacity-candy" fill="' . esc_attr( $this->args['backgroundcolor'] ) . '" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" viewBox="0 ' . $y_min . ' 1024 182" preserveAspectRatio="none" ' . FusionBuilder::attributes( 'section-separator-shortcode-divider-svg' ) . '>';
					if ( 'top' === $divider_candy ) {
						$candy .= '<path class="st0" d="M0 182.086h1024V41.593c-28.058-21.504-60.109-37.581-97.075-37.581-112.845 0-198.144 93.798-289.792 93.798S437.658 6.777 351.846 6.777s-142.234 82.125-238.49 82.125c-63.078 0-75.776-31.744-113.357-53.658L0 182.086z"/>
									<path class="st1" d="M1024 181.062v-75.878c-39.731 15.872-80.794 27.341-117.658 25.805-110.387-4.506-191.795-109.773-325.53-116.224-109.158-5.12-344.166 120.115-429.466 166.298H1024v-.001z"/>
									<path class="st2" d="M0 182.086h1024V90.028C966.451 59.103 907.059 16.3 824.115 15.071 690.278 13.023 665.19 102.93 482.099 102.93S202.138-1.62 74.24.019C46.49.326 21.811 4.217 0 9.849v172.237z"/>
									<path class="st3" d="M0 182.086h1024V80.505c-37.171 19.558-80.691 35.328-139.571 36.25-151.142 2.355-141.619-28.57-298.496-29.184s-138.854 47.002-305.459 43.725C132.813 128.428 91.238 44.563 0 28.179v153.907z"/>
									<path class="st4" d="M0 182.086h1024v-77.312c-49.05 20.07-120.525 42.394-193.229 42.086-128.922-.512-159.846-72.294-255.795-72.294-89.088 0-134.656 80.179-245.043 82.022S169.063 99.346 49.971 97.401C32.768 97.094 16.077 99.244 0 103.135v78.951z"/>
								';
					} else {
						$candy .= '<path class="st0" d="M0 0h1024v140.5C995.9 162 963.9 178 926.9 178c-112.8 0-198.1-93.8-289.8-93.8s-199.5 91-285.3 91-142.2-82.1-238.5-82.1c-63.1 0-75.7 31.6-113.3 53.6V0z"/>
									<path class="st1" d="M1024 0v75.9C984.3 60 942.2 48.6 905.3 50.1c-110.4 4.5-191.8 109.8-325.5 116.2C470.6 171.5 235.6 46.1 150.3 0H1024z"/>
									<path class="st2" d="M0 0h1024v92c-57.5 30.9-116.9 73.7-199.9 75-133.8 2-158.9-87.9-342-87.9S202.1 183.7 74.2 182c-27.8-.3-52.4-4.2-74.2-9.7V0z"/>
									<path class="st3" d="M0 0h1024v101.6C986.8 82 943.3 66.3 884.4 65.4 733.3 63 742.8 94 585.9 94.6S447 47.6 280.4 50.9C132.8 53.6 91.2 137.5 0 154V0z"/>
									<path class="st4" d="M0 0h1024v77.3c-49-20.1-120.5-42.4-193.2-42.1-128.9.5-159.8 72.3-255.8 72.3-89.1 0-134.7-80.2-245-82-110.4-1.8-160.9 57.2-280 59.2-17.2.3-33.9-1.8-50-5.7V0z"/>
								';
					}
					$candy .= '</svg>';
				} elseif ( 'waves' === $divider_type ) {
					$y_min = ( 'top' === $divider_candy ) ? '54' : '1';
					$candy = '<svg class="fusion-waves-candy" fill="' . esc_attr( $this->args['backgroundcolor'] ) . '" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" viewBox="0 ' . $y_min . ' 1024 162" preserveAspectRatio="none" ' . FusionBuilder::attributes( 'section-separator-shortcode-divider-svg' ) . '>';

					if ( 'left' === $divider_position ) {
						if ( 'top' === $divider_candy ) {
							$candy .= '<path class="st3" d="M0 216.312h1024v-3.044c-50.8-17.1-108.7-30.7-172.7-37.9-178.6-19.8-220 36.8-404.9 21.3-206.6-17.2-228-126.5-434.5-141.6-3.9-.3-7.9-.5-11.9-.7v161.944z"/>';
						} else {
							$candy .= '<path class="st3" d="M0 162.1c4-.2 8-.4 11.9-.7C218.4 146.3 239.8 37 446.4 19.8 631.3 4.3 672.7 60.9 851.3 41.1c64-7.2 121.9-20.8 172.7-37.9V.156H0V162.1z"/>';
						}
					} else {
						if ( 'top' === $divider_candy ) {
							$candy .= '<path class="st3" d="M1024.1 54.368c-4 .2-8 .4-11.9.7-206.5 15.1-227.9 124.4-434.5 141.6-184.9 15.5-226.3-41.1-404.9-21.3-64 7.2-121.9 20.8-172.7 37.9v3.044h1024V54.368z"/>';
						} else {
							$candy .= '<path class="st3" d="M1024.1.156H.1V3.2c50.8 17.1 108.7 30.7 172.7 37.9 178.6 19.8 220-36.8 404.9-21.3 206.6 17.2 228 126.5 434.5 141.6 3.9.3 7.9.5 11.9.7V.156z"/>';
						}
					}

					$candy .= '</svg>';
				} elseif ( 'waves_opacity' === $divider_type ) {
					$y_min = ( 'top' === $divider_candy ) ? '0' : '1';
					$candy = '<svg class="fusion-waves-opacity-candy" fill="' . esc_attr( $this->args['backgroundcolor'] ) . '" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" viewBox="0 ' . $y_min . ' 1024 216" preserveAspectRatio="none" ' . FusionBuilder::attributes( 'section-separator-shortcode-divider-svg' ) . '>';

					if ( 'left' === $divider_position ) {
						if ( 'top' === $divider_candy ) {
							$candy .= '<path class="st0" d="M0 216.068h1024l.1-105.2c-14.6-3.2-30.2-5.8-47.1-7.6-178.6-19.6-279.5 56.8-464.3 41.3-206.5-17.2-248.4-128.8-455-143.8-19-1.3-38.3-.2-57.7.3v215z"/>
										<path class="st1" d="M0 20.068v196.144h1024v-79.744c-22.7-6.4-47.9-11.4-76.2-14.6-178.6-19.8-272.2 53.9-457.1 38.4-206.6-17.2-197.3-124.7-403.9-139.8-27.2-2-56.6-2-86.8-.4z"/>
										<path class="st2" d="M0 216.212h1024v-35.744c-45.1-15.4-95.2-27.7-150-33.7-178.6-19.8-220.6 46.8-405.4 31.3-206.6-17.2-197.8-114.7-404.4-129.7-20.4-1.5-42-2-64.2-1.7v169.544z"/>
										<path class="st3" d="M0 216.312h1024v-3.044c-50.8-17.1-108.7-30.7-172.7-37.9-178.6-19.8-220 36.8-404.9 21.3-206.6-17.2-228-126.5-434.5-141.6-3.9-.3-7.9-.5-11.9-.7v161.944z"/>
									';
						} else {
							$candy .= '<path class="st0" d="M0 215.4c19.4.5 38.7 1.6 57.7.3 206.6-15 248.5-126.6 455-143.8 184.8-15.5 285.7 60.9 464.3 41.3 16.9-1.8 32.5-4.4 47.1-7.6L1024 .4H0v215z"/>
										<path class="st1" d="M0 196.4c30.2 1.6 59.6 1.6 86.8-.4C293.4 180.9 284.1 73.4 490.7 56.2c184.9-15.5 278.5 58.2 457.1 38.4 28.3-3.2 53.5-8.2 76.2-14.6V.256H0V196.4z"/>
										<path class="st2" d="M0 169.8c22.2.3 43.8-.2 64.2-1.7C270.8 153.1 262 55.6 468.6 38.4 653.4 22.9 695.4 89.5 874 69.7c54.8-6 104.9-18.3 150-33.7V.256H0V169.8z"/>
										<path class="st3" d="M0 162.1c4-.2 8-.4 11.9-.7C218.4 146.3 239.8 37 446.4 19.8 631.3 4.3 672.7 60.9 851.3 41.1c64-7.2 121.9-20.8 172.7-37.9V.156H0V162.1z"/>
									';
						}
					} else {
						if ( 'top' === $divider_candy ) {
							$candy .= '<path class="st0" d="M1024.1 1.068c-19.4-.5-38.7-1.6-57.7-.3-206.6 15-248.5 126.6-455 143.8-184.8 15.5-285.7-60.9-464.3-41.3-16.9 1.8-32.5 4.4-47.1 7.6l.1 105.2h1024v-215z"/>
										<path class="st1" d="M1024.1 20.068c-30.2-1.6-59.6-1.6-86.8.4-206.6 15.1-197.3 122.6-403.9 139.8-184.9 15.5-278.5-58.2-457.1-38.4-28.3 3.2-53.5 8.2-76.2 14.6v79.744h1024V20.068z"/>
										<path class="st2" d="M1024.1 46.668c-22.2-.3-43.8.2-64.2 1.7-206.6 15-197.8 112.5-404.4 129.7-184.8 15.5-226.8-51.1-405.4-31.3-54.8 6-104.9 18.3-150 33.7v35.744h1024V46.668z"/>
										<path class="st3" d="M1024.1 54.368c-4 .2-8 .4-11.9.7-206.5 15.1-227.9 124.4-434.5 141.6-184.9 15.5-226.3-41.1-404.9-21.3-64 7.2-121.9 20.8-172.7 37.9v3.044h1024V54.368z"/>
									';
						} else {
							$candy .= '<path class="st0" d="M1024.1.4H.1L0 105.6c14.6 3.2 30.2 5.8 47.1 7.6 178.6 19.6 279.5-56.8 464.3-41.3 206.5 17.2 248.4 128.8 455 143.8 19 1.3 38.3.2 57.7-.3V.4z"/>
										<path class="st1" d="M1024.1 196.4V.256H.1V80C22.8 86.4 48 91.4 76.3 94.6c178.6 19.8 272.2-53.9 457.1-38.4C740 73.4 730.7 180.9 937.3 196c27.2 2 56.6 2 86.8.4z"/>
										<path class="st2" d="M1024.1.256H.1V36c45.1 15.4 95.2 27.7 150 33.7 178.6 19.8 220.6-46.8 405.4-31.3 206.6 17.2 197.8 114.7 404.4 129.7 20.4 1.5 42 2 64.2 1.7V.256z"/>
										<path class="st3" d="M1024.1.156H.1V3.2c50.8 17.1 108.7 30.7 172.7 37.9 178.6 19.8 220-36.8 404.9-21.3 206.6 17.2 228 126.5 434.5 141.6 3.9.3 7.9.5 11.9.7V.156z"/>
									';
						}
					}

					$candy .= '</svg>';
				}

				$html          = '<div ' . FusionBuilder::attributes( 'section-separator-shortcode' ) . '>';
					$html     .= '<div ' . FusionBuilder::attributes( 'section-separator-shortcode-svg-wrapper' ) . '>' . $candy . '</div>';
					$html     .= '<div ' . FusionBuilder::attributes( 'section-separator-shortcode-spacer' ) . '>';
						$html .= '<div ' . FusionBuilder::attributes( 'section-separator-shortcode-spacer-height' ) . '></div>';
					$html     .= '</div>';
				if ( $this->args['additional_styles'] ) {
					$html .= '<style type="text/css">' . $this->args['additional_styles'] . '</style>';
				}
				$html .= '</div>';

				$this->element_counter++;

				return apply_filters( 'fusion_element_section_separator_content', $html, $args );

			}

			/**
			 * Builds the attributes array.
			 *
			 * @access public
			 * @since 1.0
			 * @return array
			 */
			public function attr() {

				$attr = fusion_builder_visibility_atts(
					$this->args['hide_on_mobile'],
					[
						'class' => 'fusion-section-separator section-separator ' . esc_attr( str_replace( '_', '-', $this->args['divider_type'] ) ) . ' fusion-section-separator-' . $this->element_counter,
					]
				);

				if ( 'rounded-split' === $this->args['divider_type'] ) {
					$attr['class'] .= ' rounded-split-separator';
				}

				if ( $this->args['class'] ) {
					$attr['class'] .= ' ' . $this->args['class'];
				}

				if ( $this->args['id'] ) {
					$attr['id'] = $this->args['id'];
				}

				return $attr;

			}

			/**
			 * Builds the attributes array for the svg wrapper.
			 *
			 * @access public
			 * @since 3.0
			 * @return array
			 */
			public function svg_wrapper_attr() {
				global $fusion_settings, $fusion_fwc_type, $fusion_col_type;

				$attr = [
					'class' => 'fusion-section-separator-svg',
					'style' => '',
				];

				if ( 'triangle' === $this->args['divider_type'] ) {
					if ( $this->args['bordercolor'] ) {
						if ( 'bottom' === $this->args['divider_candy'] ) {
							$attr['style'] = 'border-bottom:' . $this->args['bordersize'] . ' solid ' . $this->args['bordercolor'] . ';';

						} elseif ( 'top' === $this->args['divider_candy'] ) {
							$attr['style'] = 'border-top:' . $this->args['bordersize'] . ' solid ' . $this->args['bordercolor'] . ';';

						} elseif ( false !== strpos( $this->args['divider_candy'], 'top' ) && false !== strpos( $this->args['divider_candy'], 'bottom' ) ) {
							$attr['style'] = 'border:' . $this->args['bordersize'] . ' solid ' . $this->args['bordercolor'] . ';';
						}
					}
				} elseif ( 'bigtriangle' === $this->args['divider_type'] || 'slant' === $this->args['divider_type'] || 'big-half-circle' === $this->args['divider_type'] || 'clouds' === $this->args['divider_type'] || 'curved' === $this->args['divider_type'] ) {
					$attr['style'] = 'padding:0;';
				} elseif ( 'horizon' === $this->args['divider_type'] || 'waves' === $this->args['divider_type'] || 'waves_opacity' === $this->args['divider_type'] || 'hills' === $this->args['divider_type'] || 'hills_opacity' === $this->args['divider_type'] ) {
					$attr['style'] = 'font-size:0;line-height:0;';
				}

				$this->args['additional_styles'] = '';
				if ( ! empty( $fusion_fwc_type ) && isset( $fusion_col_type['type'] ) ) {

					// 100% width template && 1/1 column.
					if ( $fusion_fwc_type['width_100_percent'] && '1_1' === $fusion_col_type['type'] ) {
						$attr['class'] .= ' fusion-section-separator-fullwidth';
					} else {

						$margin_left  = 0;
						$margin_right = 0;

						// Flex container.
						if ( isset( $fusion_col_type['margin'] ) ) {
							foreach ( $fusion_col_type['margin'] as $size => $margins ) {

								if ( 'large' === $size ) {
									if ( ! empty( $fusion_col_type['margin'][ $size ]['left'] ) ) {
										$this->args['additional_styles'] .= '.fusion-section-separator-' . $this->element_counter . ' .fusion-section-separator-svg {';
										$this->args['additional_styles'] .= 'margin-left:' . $fusion_col_type['margin'][ $size ]['left'] . ';';
										$this->args['additional_styles'] .= 'margin-right:' . $fusion_col_type['margin'][ $size ]['right'] . ';';
										$this->args['additional_styles'] .= '}';
									}
								} elseif ( ! empty( $fusion_col_type['margin'][ $size ]['left'] ) ) {
									// Medium and Small size screen styles.
									$this->args['additional_styles'] .= '@media only screen and (max-width:' . $fusion_settings->get( 'visibility_' . $size ) . 'px) {';
									$this->args['additional_styles'] .= '.fusion-section-separator-' . $this->element_counter . ' .fusion-section-separator-svg {';
									$this->args['additional_styles'] .= 'margin-left:' . $fusion_col_type['margin'][ $size ]['left'] . ' !important;';
									$this->args['additional_styles'] .= 'margin-right:' . $fusion_col_type['margin'][ $size ]['right'] . '!important;';
									$this->args['additional_styles'] .= '}';
									$this->args['additional_styles'] .= '}';
								}
							}
						} else {
							$attr['style'] .= 'margin-left: 0px;';
							$attr['style'] .= 'margin-right: 0px;';
						}
					}
				}

				return $attr;

			}

			/**
			 * Builds the attributes array for the spacer.
			 *
			 * @access public
			 * @since 3.0
			 * @return array
			 */
			public function spacer_attr() {
				global $fusion_fwc_type, $fusion_col_type;

				$attr['class'] = 'fusion-section-separator-spacer';

				// 100% width template && 1/1 column.
				if ( ! empty( $fusion_fwc_type ) && isset( $fusion_col_type['type'] ) && $fusion_fwc_type['width_100_percent'] && '1_1' === $fusion_col_type['type'] ) {
					$attr['class'] .= ' fusion-section-separator-fullwidth';
				}

				return $attr;

			}

			/**
			 * Builds the attributes array for the spacer height container.
			 *
			 * @access public
			 * @since 3.0
			 * @return array
			 */
			public function spacer_height_attr() {
				$attr['class'] = 'fusion-section-separator-spacer-height';

				$hundred_px_separators = [ 'slant', 'bigtriangle', 'curved', 'big-half-circle', 'clouds' ];

				if ( in_array( $this->args['divider_type'], $hundred_px_separators, true ) ) {
					$attr['style'] = 'height:99px;';
				} elseif ( 'triangle' === $this->args['divider_type'] ) {
					if ( $this->args['bordercolor'] ) {
						if ( 'bottom' === $this->args['divider_candy'] || 'top' === $this->args['divider_candy'] ) {
							$attr['style'] = 'height:' . $this->args['bordersize'] . ';';
						} elseif ( false !== strpos( $this->args['divider_candy'], 'top' ) && false !== strpos( $this->args['divider_candy'], 'bottom' ) ) {
							$attr['style'] = 'height:calc( ' . $this->args['bordersize'] . ' * 2 );';
						}
					}
				} elseif ( 'rounded-split' === $this->args['divider_type'] ) {
					$attr['style'] = 'height:71px;';
				} elseif ( 'hills_opacity' === $this->args['divider_type'] ) {
					$attr['style'] = 'padding-top:' . ( 182 / 1024 * 100 ) . '%;';
				} elseif ( 'hills' === $this->args['divider_type'] ) {
					$attr['style'] = 'padding-top:' . ( 107 / 1024 * 100 ) . '%;';
				} elseif ( 'horizon' === $this->args['divider_type'] ) {
					$attr['style'] = 'padding-top:' . ( 178 / 1024 * 100 ) . '%;';
				} elseif ( 'waves_opacity' === $this->args['divider_type'] ) {
					$attr['style'] = 'padding-top:' . ( 216 / 1024 * 100 ) . '%;';
				} elseif ( 'waves' === $this->args['divider_type'] ) {
					$attr['style'] = 'padding-top:' . ( 162 / 1024 * 100 ) . '%;';
				}
				return $attr;
			}


			/**
			 * Builds the rounded split attributes array.
			 *
			 * @access public
			 * @since 1.0
			 * @return array
			 */
			public function divider_svg_attr() {
				$attr = [];

				if ( 'bigtriangle' === $this->args['divider_type'] || 'slant' === $this->args['divider_type'] || 'big-half-circle' === $this->args['divider_type'] || 'clouds' === $this->args['divider_type'] || 'curved' === $this->args['divider_type'] ) {
					$attr['style'] = sprintf( 'fill:%s;padding:0;', $this->args['backgroundcolor'] );
				}
				if ( 'slant' === $this->args['divider_type'] && 'bottom' === $this->args['divider_candy'] ) {
					$attr['style'] = sprintf( 'fill:%s;padding:0;margin-bottom:-3px;display:block', $this->args['backgroundcolor'] );
				}

				return $attr;
			}

			/**
			 * Builds the rounded split attributes array.
			 *
			 * @access public
			 * @since 1.0
			 * @return array
			 */
			public function divider_rounded_split_attr() {
				return [
					'class' => 'rounded-split ' . $this->args['divider_candy'],
					'style' => 'background-color:' . $this->args['backgroundcolor'] . ';',
				];
			}

			/**
			 * Builds the icon attributes array.
			 *
			 * @access public
			 * @since 1.0
			 * @return array
			 */
			public function icon_attr() {

				$attr = [
					'class'       => 'section-separator-icon icon ' . fusion_font_awesome_name_handler( $this->args['icon'] ),
					'style'       => 'color:' . $this->args['icon_color'] . ';',
					'aria-hidden' => 'true',
				];

				if ( FusionBuilder::strip_unit( $this->args['bordersize'] ) > 1 ) {
					$divider_candy = $this->args['divider_candy'];
					if ( 'bottom' === $divider_candy ) {
						$attr['style'] .= 'bottom:-' . ( FusionBuilder::strip_unit( $this->args['bordersize'] ) + 10 ) . 'px;top:auto;';
					} elseif ( 'top' === $divider_candy ) {
						$attr['style'] .= 'top:-' . ( FusionBuilder::strip_unit( $this->args['bordersize'] ) + 10 ) . 'px;';
					}
				}
				return $attr;

			}

			/**
			 * Builds the divider attributes array.
			 *
			 * @access public
			 * @since 1.0
			 * @param array $args The arguments array.
			 * @return array
			 */
			public function divider_candy_attr( $args ) {

				$attr = [
					'class' => 'divider-candy',
				];

				$divider_candy = ( $args ) ? $args['divider_candy'] : $this->args['divider_candy'];

				if ( 'bottom' === $divider_candy ) {
					$attr['class'] .= ' bottom';
					$attr['style']  = 'bottom:-' . ( FusionBuilder::strip_unit( $this->args['bordersize'] ) + 20 ) . 'px;border-bottom:1px solid ' . $this->args['bordercolor'] . ';border-left:1px solid ' . $this->args['bordercolor'] . ';';
				} elseif ( 'top' === $divider_candy ) {
					$attr['class'] .= ' top';
					$attr['style']  = 'top:-' . ( FusionBuilder::strip_unit( $this->args['bordersize'] ) + 20 ) . 'px;border-bottom:1px solid ' . $this->args['bordercolor'] . ';border-left:1px solid ' . $this->args['bordercolor'] . ';';
					// Modern setup, that won't work in IE8.
				} elseif ( false !== strpos( $this->args['divider_candy'], 'top' ) && false !== strpos( $this->args['divider_candy'], 'bottom' ) ) {
					$attr['class'] .= ' both';
					$attr['style']  = 'background-color:' . $this->args['backgroundcolor'] . ';border:1px solid ' . $this->args['bordercolor'] . ';';
				}

				return $attr;

			}

			/**
			 * Builds the divider-arrow attributes array.
			 *
			 * @access public
			 * @since 1.0
			 * @param array $args The arguments array.
			 * @return array
			 */
			public function divider_candy_arrow_attr( $args ) {

				$attr = [
					'class' => 'divider-candy-arrow',
				];

				$divider_candy = ( $args ) ? $args['divider_candy'] : $this->args['divider_candy'];

				// For borders of size 1, we need to hide the border line on the arrow, thus we set it to 0.
				$arrow_position = FusionBuilder::strip_unit( $this->args['bordersize'] );
				if ( '1' == $arrow_position ) { // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
					$arrow_position = 0;
				}

				if ( 'bottom' === $divider_candy ) {
					$attr['class'] .= ' bottom';
					$attr['style']  = 'top:' . $arrow_position . 'px;border-top-color: ' . $this->args['backgroundcolor'] . ';';
				} elseif ( 'top' === $divider_candy ) {
					$attr['class'] .= ' top';
					$attr['style']  = 'bottom:' . $arrow_position . 'px;border-bottom-color: ' . $this->args['backgroundcolor'] . ';';
				}

				return $attr;

			}

			/**
			 * Load base CSS.
			 *
			 * @access public
			 * @since 3.0
			 * @return void
			 */
			public function add_css_files() {
				FusionBuilder()->add_element_css( FUSION_BUILDER_PLUGIN_DIR . 'assets/css/shortcodes/section-separator.min.css' );
			}

			/**
			 * Adds settings to element options panel.
			 *
			 * @access public
			 * @since 1.1
			 * @return array $sections Section Separator settings.
			 */
			public function add_options() {

				return [
					'section_separator_shortcode_section' => [
						'label'       => esc_html__( 'Section Separator', 'fusion-builder' ),
						'description' => '',
						'id'          => 'section_separator_shortcode_section',
						'type'        => 'accordion',
						'icon'        => 'fusiona-ellipsis',
						'fields'      => [
							'section_sep_border_size'  => [
								'label'       => esc_html__( 'Section Separator Border Size', 'fusion-builder' ),
								'description' => esc_html__( 'Controls the border size of the section separator.', 'fusion-builder' ),
								'id'          => 'section_sep_border_size',
								'default'     => '1',
								'type'        => 'slider',
								'transport'   => 'postMessage',
								'choices'     => [
									'min'  => '0',
									'max'  => '50',
									'step' => '1',
								],
							],
							'section_sep_bg'           => [
								'label'       => esc_html__( 'Section Separator Background Color', 'fusion-builder' ),
								'description' => esc_html__( 'Controls the background color of the section separator style.', 'fusion-builder' ),
								'id'          => 'section_sep_bg',
								'default'     => '#f9f9fb',
								'type'        => 'color-alpha',
								'transport'   => 'postMessage',
							],
							'section_sep_border_color' => [
								'label'       => esc_html__( 'Section Separator Border Color', 'fusion-builder' ),
								'description' => esc_html__( 'Controls the border color of the separator.', 'fusion-builder' ),
								'id'          => 'section_sep_border_color',
								'default'     => '#e2e2e2',
								'type'        => 'color-alpha',
								'transport'   => 'postMessage',
							],
						],
					],
				];
			}
		}
	}

	new FusionSC_SectionSeparator();

}

/**
 * Map shortcode to Avada Builder.
 *
 * @since 1.0
 */
function fusion_element_section_separator() {

	global $fusion_settings;

	fusion_builder_map(
		fusion_builder_frontend_data(
			'FusionSC_SectionSeparator',
			[
				'name'       => esc_attr__( 'Section Separator', 'fusion-builder' ),
				'shortcode'  => 'fusion_section_separator',
				'icon'       => 'fusiona-ellipsis',
				'preview'    => FUSION_BUILDER_PLUGIN_DIR . 'inc/templates/previews/fusion-section-separator-preview.php',
				'preview_id' => 'fusion-builder-block-module-section-separator-preview-template',
				'help_url'   => 'https://theme-fusion.com/documentation/fusion-builder/elements/section-separator-element/',
				'params'     => [
					[
						'type'        => 'select',
						'heading'     => esc_attr__( 'Section Separator Style', 'fusion-builder' ),
						'description' => esc_attr__( 'Select the type of the section separator', 'fusion-builder' ),
						'param_name'  => 'divider_type',
						'value'       => [
							'triangle'        => esc_attr__( 'Triangle', 'fusion-builder' ),
							'slant'           => esc_attr__( 'Slant', 'fusion-builder' ),
							'bigtriangle'     => esc_attr__( 'Big Triangle', 'fusion-builder' ),
							'rounded-split'   => esc_attr__( 'Rounded Split', 'fusion-builder' ),
							'curved'          => esc_attr__( 'Curved', 'fusion-builder' ),
							'big-half-circle' => esc_attr__( 'Big Half Circle', 'fusion-builder' ),
							'clouds'          => esc_attr__( 'Clouds', 'fusion-builder' ),
							'horizon'         => esc_attr__( 'Horizon', 'fusion-builder' ),
							'waves'           => esc_attr__( 'Waves', 'fusion-builder' ),
							'waves_opacity'   => esc_attr__( 'Waves Opacity', 'fusion-builder' ),
							'hills'           => esc_attr__( 'Hills', 'fusion-builder' ),
							'hills_opacity'   => esc_attr__( 'Hills Opacity', 'fusion-builder' ),
						],
						'default'     => 'triangle',
					],
					[
						'type'        => 'radio_button_set',
						'heading'     => esc_attr__( 'Horizontal Position of the Section Separator', 'fusion-builder' ),
						'description' => esc_attr__( 'Select the horizontal position of the section separator.', 'fusion-builder' ),
						'param_name'  => 'divider_position',
						'value'       => [
							'left'   => esc_attr__( 'Left', 'fusion-builder' ),
							'center' => esc_attr__( 'Center', 'fusion-builder' ),
							'right'  => esc_attr__( 'Right', 'fusion-builder' ),
						],
						'default'     => 'center',
						'dependency'  => [
							[
								'element'  => 'divider_type',
								'value'    => 'triangle',
								'operator' => '!=',
							],
							[
								'element'  => 'divider_type',
								'value'    => 'rounded-split',
								'operator' => '!=',
							],
							[
								'element'  => 'divider_type',
								'value'    => 'big-half-circle',
								'operator' => '!=',
							],
							[
								'element'  => 'divider_type',
								'value'    => 'clouds',
								'operator' => '!=',
							],
							[
								'element'  => 'divider_type',
								'value'    => 'horizon',
								'operator' => '!=',
							],
							[
								'element'  => 'divider_type',
								'value'    => 'hills',
								'operator' => '!=',
							],
							[
								'element'  => 'divider_type',
								'value'    => 'hills_opacity',
								'operator' => '!=',
							],
						],
					],
					[
						'type'        => 'radio_button_set',
						'heading'     => esc_attr__( 'Vertical Position of the Section Separator', 'fusion-builder' ),
						'description' => esc_attr__( 'Select the vertical position of the section separator.', 'fusion-builder' ),
						'param_name'  => 'divider_candy',
						'value'       => [
							'top'        => esc_attr__( 'Top', 'fusion-builder' ),
							'bottom'     => esc_attr__( 'Bottom', 'fusion-builder' ),
							'bottom,top' => esc_attr__( 'Top and Bottom', 'fusion-builder' ),
						],
						'default'     => 'top',
						'dependency'  => [
							[
								'element'  => 'divider_type',
								'value'    => 'clouds',
								'operator' => '!=',
							],
						],
					],
					[
						'type'        => 'iconpicker',
						'heading'     => esc_attr__( 'Icon', 'fusion-builder' ),
						'param_name'  => 'icon',
						'value'       => '',
						'description' => esc_attr__( 'Click an icon to select, click again to deselect.', 'fusion-builder' ),
						'dependency'  => [
							[
								'element'  => 'divider_type',
								'value'    => 'triangle',
								'operator' => '==',
							],
						],
					],
					[
						'type'        => 'colorpickeralpha',
						'heading'     => esc_attr__( 'Icon Color', 'fusion-builder' ),
						'description' => '',
						'param_name'  => 'icon_color',
						'value'       => '',
						'default'     => $fusion_settings->get( 'icon_color' ),
						'dependency'  => [
							[
								'element'  => 'divider_type',
								'value'    => 'triangle',
								'operator' => '==',
							],
							[
								'element'  => 'icon',
								'value'    => '',
								'operator' => '!=',
							],
						],
					],
					[
						'type'        => 'range',
						'heading'     => __( 'Border', 'fusion-builder' ),
						'heading'     => esc_attr__( 'Border', 'fusion-builder' ),
						'description' => esc_attr__( 'In pixels.', 'fusion-builder' ),
						'param_name'  => 'bordersize',
						'value'       => '',
						'min'         => '0',
						'max'         => '50',
						'step'        => '1',
						'default'     => $fusion_settings->get( 'section_sep_border_size' ),
						'dependency'  => [
							[
								'element'  => 'divider_type',
								'value'    => 'triangle',
								'operator' => '==',
							],
						],
					],
					[
						'type'        => 'colorpickeralpha',
						'heading'     => __( 'Border Color', 'fusion-builder' ),
						'heading'     => esc_attr__( 'Border Color', 'fusion-builder' ),
						'description' => esc_attr__( 'Controls the border color. ', 'fusion-builder' ),
						'param_name'  => 'bordercolor',
						'value'       => '',
						'default'     => $fusion_settings->get( 'section_sep_border_color' ),
						'dependency'  => [
							[
								'element'  => 'divider_type',
								'value'    => 'triangle',
								'operator' => '==',
							],
							[
								'element'  => 'bordersize',
								'value'    => '0',
								'operator' => '!=',
							],
						],
					],
					[
						'type'        => 'colorpickeralpha',
						'heading'     => esc_attr__( 'Background Color of the Section Separator', 'fusion-builder' ),
						'description' => esc_attr__( 'Controls the background color of the section separator style.', 'fusion-builder' ),
						'param_name'  => 'backgroundcolor',
						'value'       => '',
						'default'     => $fusion_settings->get( 'section_sep_bg' ),
					],
					[
						'type'        => 'checkbox_button_set',
						'heading'     => esc_attr__( 'Element Visibility', 'fusion-builder' ),
						'param_name'  => 'hide_on_mobile',
						'value'       => fusion_builder_visibility_options( 'full' ),
						'default'     => fusion_builder_default_visibility( 'array' ),
						'description' => esc_attr__( 'Choose to show or hide the element on small, medium or large screens. You can choose more than one at a time.', 'fusion-builder' ),
					],
					[
						'type'        => 'textfield',
						'heading'     => esc_attr__( 'CSS Class', 'fusion-builder' ),
						'description' => esc_attr__( 'Add a class to the wrapping HTML element.', 'fusion-builder' ),
						'param_name'  => 'class',
						'value'       => '',
					],
					[
						'type'        => 'textfield',
						'heading'     => esc_attr__( 'CSS ID', 'fusion-builder' ),
						'description' => esc_attr__( 'Add an ID to the wrapping HTML element.', 'fusion-builder' ),
						'param_name'  => 'id',
						'value'       => '',
					],
				],
			]
		)
	);
}
add_action( 'fusion_builder_before_init', 'fusion_element_section_separator' );
