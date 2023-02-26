<?php


// Query all unit posts, and run a while loop over it. Each output will be a <li> with the various datapoints of the unit post in it. It should be ordered by area, so the return can be split into two categories (>1, ==1).

function units_split_list() {
	$args = array(
		'post_type' => 'unit',
		'posts_per_page' => -1,
		// 'orderby' => 'meta_value_num',
		// 'meta_key' => 'area',
		// 'order' => 'DESC',

	);

	// query using new WP_Query($args =>array)
	$query = new WP_Query( $args );
	//if $query has posts, start a <ul>, then loop over the posts, outputting a <li> for each one. Start with just the title, I guess?
	if ( $query->have_posts() ) {

		$large_area_units = array();
		$one_area_units = array();

		while ( $query->have_posts() ) {
			$query->the_post();
			$area = get_post_meta( get_the_ID(), 'area', true );
			if ( $area > 1 ) {
				$large_area_units[] = get_post();
			} else {

				$one_area_units[] = get_post();
			}
		}

		$output = '<strong style="text-align: center">Units with area larger than 1</strong>';
		$output .= '<table>';
		$output .= '<tr>';
		$output .= '<th>Unit Number</th>';
		$output .= '<th>Asset ID</th>';
		$output .= '<th>Building ID</th>';
		$output .= '<th>Floor ID</th>';
		$output .= '<th>Floor Plan ID</th>';
		$output .= '<th>Area</th>';
		$output .= '</tr>';
		foreach ( $large_area_units as $unit ) {
			$unit_number = $unit->post_title;
			$asset_id = get_post_meta( $unit->ID, 'asset_id', true );
			$building_id = get_post_meta( $unit->ID, 'building_id', true );
			$floor_id = get_post_meta( $unit->ID, 'floor_id', true );
			$floor_plan_id = get_post_meta( $unit->ID, 'floor_plan_id', true );
			$area = get_post_meta( $unit->ID, 'area', true );


			$output .= '<tr>';
			$output .= '<td>' . $unit_number . '</td>';
			$output .= '<td>' . $asset_id . '</td>';
			$output .= '<td>' . $building_id . '</td>';
			$output .= '<td>' . $floor_id . '</td>';
			$output .= '<td>' . $floor_plan_id . '</td>';
			$output .= '<td>' . $area . '</td>';
			$output .= '</tr>';

		}


		$output .= '<strong>Units with area equal to 1</strong>';
		$output .= '<table>';
		$output .= '<tr>';
		$output .= '<th>Unit Number</th>';
		$output .= '<th>Asset ID</th>';
		$output .= '<th>Building ID</th>';
		$output .= '<th>Floor ID</th>';
		$output .= '<th>Floor Plan ID</th>';
		$output .= '<th>Area</th>';
		$output .= '</tr>';
		foreach ( $one_area_units as $unit ) {
			$unit_number = $unit->post_title;
			$asset_id = get_post_meta( $unit->ID, 'asset_id', true );
			$building_id = get_post_meta( $unit->ID, 'building_id', true );
			$floor_id = get_post_meta( $unit->ID, 'floor_id', true );
			$floor_plan_id = get_post_meta( $unit->ID, 'floor_plan_id', true );
			$area = get_post_meta( $unit->ID, 'area', true );


			$output .= '<tr>';
			$output .= '<td>' . $unit_number . '</td>';
			$output .= '<td>' . $asset_id . '</td>';
			$output .= '<td>' . $building_id . '</td>';
			$output .= '<td>' . $floor_id . '</td>';
			$output .= '<td>' . $floor_plan_id . '</td>';
			$output .= '<td>' . $area . '</td>';
			$output .= '</tr>';
		}
		// When there aren't any more posts, close with </ul>
		$output .= '</table>';
		// The whole output should be a variable that can be returned
		return $output;
	}

}

// If it's anything like the rest of wordpress, I'll bet there's an action I need to add.
