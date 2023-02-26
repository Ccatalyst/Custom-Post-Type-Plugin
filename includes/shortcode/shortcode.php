<?php


// Query all unit posts, and run a while loop over it. Each output will be a <li> with the various datapoints of the unit post in it. It should be ordered by area, so the return can be split into two categories (>1, ==1).

function units_split_list() {


	// query using new WP_Query($args =>array)

	//if $query has posts, start a <ul>, then loop over the posts, outputting a <li> for each one. Start with just the title, I guess?

	// When there aren't any more posts, close with </ul>

	// The whole output should be a variable that can be returned
}

// If it's anything like the rest of wordpress, I'll be there's an action I need to add.
