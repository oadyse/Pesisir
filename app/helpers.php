<?php
function hitung($angka) {
    if($angka < 25) {
        return 'Sangat Buruk';
    } else if($angka < 50) {
        return 'Buruk';
    } else if($angka < 70) {
        return 'Sedang';
    } else if($angka < 90) {
        return 'Bagus';
    } else if($angka < 100) {
        return 'Sangat Bagus';
    }
}