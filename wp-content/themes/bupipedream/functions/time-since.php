<?php

/**
 * Return a "human-readable" time such as 8 hours ago.
 *
 * @param string $time such as: 2013-03-18 21:13:59
*/

function get_time_since($time) {	
	$date = new \DateTime();
	$date->setTimestamp(strtotime($time));
	
	$interval = $date->diff(new \DateTime('now'));
	
	if(!$interval->i && !$interval->h && !$interval->d && !$interval->m && !$interval->y) {
		if($interval->s != "1") {
			$plural = "s";
			return $interval->format('%s second'.$plural.' ago');
		} else {
			return $interval->format('%s second ago');
		}
	} else if(!$interval->h && !$interval->d && !$interval->m && !$interval->y) {
		if($interval->i != "1") {
			$plural = "s";
			return $interval->format('%i minute'.$plural.' ago');
		} else {
			return $interval->format('%i minute ago');
		}
	} else if(!$interval->d && !$interval->m && !$interval->y) {
		if($interval->h != "1") {
			$plural = "s";
			return $interval->format('%h hour'.$plural.' ago');
		} else {
			return $interval->format('%h hour ago');
		}
	} else if(!$interval->m && !$interval->y) {
		if($interval->d != "1") {
			$plural = "s";
			return $interval->format('%d day'.$plural.' ago');
		} else {
			return $interval->format('%d day ago'); 
		}
	} else if(!$interval->y) {
		if($interval->m != "1") {
			$plural = "s";	
			return $interval->format('%m month'.$plural.' ago');
		} else {
			return $interval->format('%m month ago');
		}
	}
	
	return false;
}