<?php

namespace GridElementTrash;


class ElementsFilter {
	
	
	/**
	 * ElementsFilter constructor.
	 *
	 * @param Plugin $plugin
	 */
	function __construct( $plugin ) {
		$this->plugin = $plugin;
		
		// grid hook
		add_filter( 'grid_boxes_search', array( $this, 'boxes_filter' ) );
		add_filter( 'grid_metaboxes', array( $this, 'boxes_filter' ) );
		add_filter( 'grid_containers', array( $this, 'containers_filter' ) );
		
	}
	
	/**
	 * filter for boxes
	 */
	public function boxes_filter( $boxes ) {
		
		$trash = new Store();
		for ( $i = 0; $i < count( $boxes ); $i ++ ) {
			$trashid = $boxes[ $i ]["type"];
			if ( $boxes[ $i ]["type"] == "reference" && ! empty( $boxes[ $i ]["content"] ) ) {
				$trashid = "reference-" . $boxes[ $i ]["content"]->boxid;
			}
			if ( $trash->is_box_trashed( $trashid ) ) {
				array_splice( $boxes, $i, 1 );
				$i --;
			}
		}
		
		return $boxes;
	}
	
	/**
	 * filter for containers
	 */
	public function containers_filter( $containers ) {
		$trash = new Store();
		for ( $i = 0; $i < count( $containers ); $i ++ ) {
			if ( $trash->is_container_trashed( $containers[ $i ]["type"] ) ) {
				array_splice( $containers, $i, 1 );
				$i --;
			}
		}
		
		return $containers;
	}
	
}