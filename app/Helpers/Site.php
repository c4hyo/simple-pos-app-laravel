<?php
use App\Http\Model\Item;
use App\Http\Model\Categories;

    function GetString()
    {
        return "Test tok gan";
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
?>