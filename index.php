<?php
/*
Plugin Name: JL ACF Shortcode Files
Plugin URI: http://jasonlawton.com
Description: Display the ACF file fields as a shortcode, Requires Advanced Custom Fields
Version: 0.1
Author: Jason Lawton
Author URI: http://jasonlawton.com
License: GPL2
*/

function download_links($isMember) {
    // set isMember to 1 for testing
    $isMember = 1;

    // these are the ACF field names
    $fileTypes = array('jpeg','png','illustrator','tif','zip');
    $download_text = array();
    foreach($fileTypes as $fileType) {
        // if they're an acutal member, let them download the file
        $fieldObject = get_field_object($fileType);
        $fileName = get_field($fileType);
        if ($isMember) {
            // echo 'free member';
            $aTag = "href='$fileName'";
        // else pop-up window about becoming a member
        } else {
            // echo 'not a member';
            $aTag = "href='#' class='popup-membership'";
        }
        if (!empty($fileName)) {
            $download_text[] = "<a $aTag>&#9658; " . $fieldObject['label'] . "</a>";
        }
    }
    if ($download_text) {
        $download_text = implode('&nbsp;&nbsp;&nbsp;&nbsp;', $download_text);
        return "Download &#9655;&nbsp;&nbsp;&nbsp;&nbsp;$download_text";
    }
}

add_shortcode('download-links', 'download_links');