<?php
use App\Http\Model\Item;
use App\Http\Model\Categories;

    function getIdTransaction()
    {
        $string = "1234567890QWERTYUIOPLKJHGFDSAMNBVCXZ";
        $number = "0987654321";
        $rand1 = substr(str_shuffle($string),0,3);
        $rand2 = substr(str_shuffle($number),0,5);
        $date = substr(date('F'),0,1);
        return $rand1."$date".date('dmy')."".$rand2;
    }
    function rupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
    }
    function randomNumber(){
        $number = "0987654321";
        return substr(str_shuffle($number),0,6);
    }
    function ItemCount()
    {
        return Item::count();
    }
    function categoriesCount()
    {
        return Categories::count();
    }
    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
?>