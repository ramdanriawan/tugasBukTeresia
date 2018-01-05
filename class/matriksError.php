<?php

class matriksError
{
   function matriksErrorJumlahBaris(array $matriks1, array $matriks2)
   {
      //foreach untuk mengecek apakah jumlah baris setiap element array sama atau tidak
      foreach($matriks1 as $key => $value)
      {
         if(count($matriks1) != count($matriks2))
         {
            print_r(array("error" => "Jumlah baris tidak sama!"));
            die();
         }
      }
   }

   function matriksErrorJumlahElementBaris(array $matriks1, array $matriks2)
   {
      //foreach untuk mengecek jumlah element setiap element array sama atau tidak
      foreach ($matriks1 as $key => $value) {
         foreach($value as $key2 => $value2)
         {
            if((!is_numeric($matriks1[$key][$key2]) || !is_numeric($matriks2[$key][$key2])) || (count($matriks1[$key]) != count($matriks2[$key]))) // pastikan juga tidak ada element yang kosong
            {
               print_r(array("error" => "Jumlah element setiap baris tidak sama!"));
               die();
            }
         }
      }
   }

   function matriksErrorElementBukanNumeric(array $matriks1, array $matriks2)
   {
      foreach ($matriks1 as $key => $value) {
         foreach($value as $key2 => $value2)
         {
            if(!is_numeric($matriks1[$key][$key2]) || !is_numeric($matriks2[$key][$key2]))
            {
               print_r(array("error" => "Beberapa element baris yang di inputkan bukan numeric!"));
               die();
            }
         }
      }
   }
}

 ?>
