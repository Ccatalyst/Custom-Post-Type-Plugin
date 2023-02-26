<?php


// Query all unit posts, and run a while loop over it to sort it into an array based on area size. Create a table for each array, and loop over them. Each output will be a table row with the various datapoints of the unit post in it. 

function units_split_list() {
	// initially the thought would be to order the posts by the area, but if you wanted the most recent posts, that wouldn't work. It also meant that if you limited the number of posts per page, it would only return one of the area sizes, larger than 1 by default. So for now it's the default.
	$args = array(
		'post_type' => 'unit',
		'posts_per_page' => -1,
	);

	// query using new WP_Query($args =>array)
	$query = new WP_Query( $args );
	// if the post type has posts, create two arrays and sort the posts into an array if they have an area of 1, or larger than 1.
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

		$output = '<style >
        table, th, td {
            border: 1px solid black;
            border-collapse:collapse;
        }
        tr:nth-child(odd) { 
            background-color: #DEE3E1;
        }
        th,td {
        padding: 5px;
        }
        td {
        text-align: right;
        }
        </style>';

		$output .= '<table>';
		$output .= '<caption><strong>Units with area larger than 1</strong></caption>';
		$output .= '<tr>';
		$output .= '<th><strong>Unit Number</strong></th>';
		$output .= '<th><strong> Asset ID </strong></th>';
		$output .= '<th><strong> Building ID </strong></th>';
		$output .= '<th><strong> Floor ID </strong></th>';
		$output .= '<th><strong> Floor Plan ID </strong></th>';
		$output .= '<th><strong> Area </strong></th>';
		$output .= '</tr>';
		// rows for the unit posts that have an area larger than 1.
		foreach ( $large_area_units as $unit ) {
			$unit_number = $unit->post_title;
			$asset_id = get_post_meta( $unit->ID, 'asset_id', true );
			$building_id = get_post_meta( $unit->ID, 'building_id', true );
			$floor_id = get_post_meta( $unit->ID, 'floor_id', true );
			$floor_plan_id = get_post_meta( $unit->ID, 'floor_plan_id', true );
			$area = get_post_meta( $unit->ID, 'area', true );


			$output .= '<tr>';
			$output .= '<td >' . $unit_number . '</td>';
			$output .= '<td>' . $asset_id . '</td>';
			$output .= '<td>' . $building_id . '</td>';
			$output .= '<td>' . $floor_id . '</td>';
			$output .= '<td>' . $floor_plan_id . '</td>';
			$output .= '<td>' . $area . '</td>';
			$output .= '</tr>';

		}


		$output .= '<table>';
		$output .= '<caption><strong>Units with area equal to 1</strong></caption>';
		$output .= '<tr>';
		$output .= '<th><strong>Unit Number</strong></th>';
		$output .= '<th><strong>Asset ID</strong></th>';
		$output .= '<th><strong>Building ID</strong></th>';
		$output .= '<th><strong>Floor ID</strong></th>';
		$output .= '<th><strong>Floor Plan ID</strong></th>';
		$output .= '<th><strong>Area</strong></th>';
		$output .= '</tr>';
		// rows for the unit posts that have an area of 1
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
		// When there aren't any more posts, close table
		$output .= '</table>';
		// The whole output should be a variable that can be returned
		return $output;
	}

}