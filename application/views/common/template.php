<?php
/**
 * Common/Template
 * 
 * Utility view to load in the header, footer and any views required in-between
 */
$this->load->view('common/header');

if ( isset($_views) ) {
    if ( ! is_array($_views) ) $_views = array ( $_views );
    foreach ( $_views as $v ) $this->load->view($v);
}

$this->load->view('common/footer');

?>