<?php

namespace App\Traits;

trait ConvertToCurrency
{    
    /**
     * function for convert Rupiah with 2 angka di belakang koma
     *
     * @param  mixed $angka
     * @return void
     */
    public function rupiah1($angka) {
        $hasil_rupiah = number_format($angka,2,',','.');
        return $hasil_rupiah;
    }    
    /**
     * rupiah_with_rp convert Rupiah with string Rp.
     *
     * @param  mixed $angka
     * @return void
     */
    public function rupiah_with_rp($angka) {
        $hasil_rupiah = "Rp. " . number_format($angka,2,',','.');
        return $hasil_rupiah;
    }    
    /**
     * rupiah convert Rupiah with without string Rp.
     *
     * @param  mixed $angka
     * @return void
     */
    public function rupiah($angka) {
        $hasil_rupiah = number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
}