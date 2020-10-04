<?php
/**
 * Messages HTML
 * can be shown with show_message(text), show_error(text) and show_success(); 
 */
?>


<div class="container alert_container d-print-none">
    <div class="alert alert-success" role="alert" style="display: none;">
    <span></span>
        <a href="#" onclick="close_alerts()" class="close">
        <span aria-hidden="true">&times;</span> 
    </a>
    </div>
    <div class="alert alert-danger" role="alert" style="display: none;">
    <span></span>
    <a href="#" onclick="close_alerts()" class="close">
        <span aria-hidden="true">&times;</span> 
    </a>
    </div>
    <div class="alert alert-warning" role="alert" style="display: none;">
    <span></span>
    <a href="#" onclick="close_alerts()" class="close">
        <span aria-hidden="true">&times;</span>
</a>
    </div>
</div>