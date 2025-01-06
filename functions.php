<?php
/**
 * Fungsi untuk memvalidasi dan membersihkan input
 *
 * @param string $data
 * @return string
 */
function validateInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>