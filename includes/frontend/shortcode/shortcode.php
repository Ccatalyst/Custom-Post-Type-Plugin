<?php
function build_unit_table( $array, $title ) {
	$output = '';
	$output .= '<table>';
	$output .= '<caption><strong>' . $title . '</strong></caption>';
	$output .= '<tr>';
	$output .= '<th><strong>Unit Number</strong></th>';
	$output .= '<th><strong> Asset ID </strong></th>';
	$output .= '<th><strong> Building ID </strong></th>';
	$output .= '<th><strong> Floor ID </strong></th>';
	$output .= '<th><strong> Floor Plan ID </strong></th>';
	$output .= '<th><strong> Area </strong></th>';
	$output .= '<th><strong> Link </strong></th>';
	$output .= '</tr>';

	foreach ( $array as $unit ) {
		$unit_number = $unit->post_title;
		$asset_id = get_post_meta( $unit->ID, 'asset_id', true );
		$building_id = get_post_meta( $unit->ID, 'building_id', true );
		$floor_id = get_post_meta( $unit->ID, 'floor_id', true );
		$floor_plan_id = get_post_meta( $unit->ID, 'floor_plan_id', true );
		$area = get_post_meta( $unit->ID, 'area', true );
		$link = get_post_permalink( $unit->ID );

		$output .= '<tr>';
		$output .= '<td >' . $unit_number . '</td>';
		$output .= '<td>' . $asset_id . '</td>';
		$output .= '<td>' . $building_id . '</td>';
		$output .= '<td>' . $floor_id . '</td>';
		$output .= '<td>' . $floor_plan_id . '</td>';
		$output .= '<td>' . $area . '</td>';
		$output .= '<td><a href="' . $link . '">Link</a></td>';
		$output .= '</tr>';
	}
	$output .= '</table>';
	return $output;
}
function units_split_list() {
	$args = array(
		'post_type' => 'unit',
		// CHANGE THIS NUMBER TO CONTROL NUMBER OF UNIT POSTS SHOWN IN TABLES. -1 GETS ALL POSTS.
		'posts_per_page' => -1,
	);

	$query = new WP_Query( $args );
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
		$output .= build_unit_table( $large_area_units, 'Units with area larger than 1' );
		$output .= build_unit_table( $one_area_units, 'Units with area equal to 1' );
		return $output;
	}
}