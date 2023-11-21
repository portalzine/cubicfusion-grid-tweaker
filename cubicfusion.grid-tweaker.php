<?php

/*
Plugin Name:cubicFUSION Grid Tweaker
Plugin URI: https://portalzine.de
Description: Adds additional options for the grid container or its items.
Version: 0.5
Requires at least: 5.2
Requires PHP:      8.0
Author: portalZINE NMN - Alexander Gräf
Author URI: https://portalzine.de
*/

defined( 'ABSPATH' ) || die(); // Exit if accessed directly.

final class cubcFUSION_Grid_Tweaker {
	
	private static $_instance = null;
	
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}
	
	public function __construct() {	
				
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}
	
	public function init() {
	
		add_action( 'elementor/element/after_section_end', function( $element, $section_id, $args ) {

          if ( in_array($element->get_name(),['container']) && in_array($section_id,['section_layout'])  ) {

              $element->start_controls_section(
                  'cf_grid_tweaker__section',
                  [
                      'tab' => 'cubicfusion-grid-tweaker',
                      'label' =>  'Grid Item Definition', 'cubicfusion-grid-tweaker',
                  ]
              );


              $element->add_responsive_control(
                  'cf_grid_tweaker_column' ,
                  [
                      'label'        => 'grid-column',
                      'type'         => Elementor\Controls_Manager::TEXT,
                      'default'      => '',
                      'description' => "This CSS shorthand property specifies a grid item's size and location within a grid column by contributing a line, a span, or nothing (automatic) to its grid placement, thereby specifying the inline-start and inline-end edge of its grid area. Examples: '1', '1 / 3', '2 / -1', '1 / span 2'",
                      'label_block'  => false,

                      'selectors' => [
                  '{{WRAPPER}}' => 'grid-column: {{VALUE}}',
              ],
                  ]
              );

              $element->add_responsive_control(
                  'cf_grid_tweaker_column_start' ,
                  [
                      'label'        => 'grid-column-start',
                      'type'         => Elementor\Controls_Manager::TEXT,
                      'default'      => '',
                      'description' => "The grid-column-start CSS property specifies a grid item's start position within the grid column by contributing a line, a span, or nothing (automatic) to its grid placement. This start position defines the block-start edge of the grid area.",
                      'label_block'  => false,
                      'selectors' => [
                  '{{WRAPPER}}' => 'grid-column: {{VALUE}}',
              ],
                  ]
              );

              $element->add_responsive_control(
                  'cf_grid_tweaker_column_end' ,
                  [
                      'label'        => 'grid-column-end',
                      'type'         => Elementor\Controls_Manager::TEXT,
                      'default'      => '',
                      'description' => "The grid-column-end CSS property specifies a grid item's end position within the grid column by contributing a line, a span, or nothing (automatic) to its grid placement, thereby specifying the block-end edge of its grid area.",
                      'label_block'  => false,
                      'separator' => 'after',
                      'selectors' => [
                  '{{WRAPPER}}' => 'grid-column: {{VALUE}}',
              ],
                  ]
              );

              $element->add_responsive_control(
                  'cf_grid_tweaker_grid_row' ,
                  [
                      'label'        => 'grid-row',
                      'type'         => Elementor\Controls_Manager::TEXT,
                      'description' => "This CSS shorthand property specifies a grid item's size and location within a grid row by contributing a line, a span, or nothing (automatic) to its grid placement, thereby specifying the inline-start and inline-end edge of its grid area. Examples: '1', '1 / 3', '2 / -1', '1 / span 2' ",
                      'default'      => '',
                      'label_block'  => false,
                      'selectors' => [
                  '{{WRAPPER}}' => 'grid-row: {{VALUE}}',
              ],
                  ]
              );	

              $element->add_responsive_control(
                  'cf_grid_tweaker_grid_row_start' ,
                  [
                      'label'        => 'grid-row-start',
                      'type'         => Elementor\Controls_Manager::TEXT,
                      'description' => "The grid-row-start CSS property specifies a grid item's start position within the grid row by contributing a line, a span, or nothing (automatic) to its grid placement, thereby specifying the inline-start edge of its grid area. ",
                      'default'      => '',
                      'label_block'  => false,
                      'selectors' => [
                  '{{WRAPPER}}' => 'grid-row: {{VALUE}}',
              ],
                  ]
              );	

                  $element->add_responsive_control(
                  'cf_grid_tweaker_grid_row_end' ,
                  [
                      'label'        => 'grid-row-end',
                      'type'         => Elementor\Controls_Manager::TEXT,
                      'description' => "The grid-row-end CSS property specifies a grid item's end position within the grid row by contributing a line, a span, or nothing (automatic) to its grid placement, thereby specifying the inline-end edge of its grid area. ",
                      'default'      => '',
                      'label_block'  => false,
                      'selectors' => [
                  '{{WRAPPER}}' => 'grid-row: {{VALUE}}',
              ],
                  ]
              );	

              $element->end_controls_section();


          }

      }, 99, 3 );

      
      add_action( 'elementor/init', function() {
          \Elementor\Controls_Manager::add_tab(
              'cubicfusion-grid-tweaker',
              esc_html__( 'Grid Tweaker', 'cubicfusion-grid-tweaker' )
          );
      } );


      add_action( 'elementor/editor/wp_head', function() {
          if (\Elementor\Plugin::$instance->editor->is_edit_mode()) {
      ?><style>
      .elementor-panel .elementor-tab-control-cubicfusion-grid-tweaker a:before,
      .elementor-panel .elementor-tab-control-cubicfusion-grid-tweaker span:before {
          font-family: eicons;
          content: '\e95e';
      }
      </style><?php
          }
      });

		
	}

}


cubcFUSION_Grid_Tweaker::instance();