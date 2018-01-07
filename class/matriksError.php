<?php

class matriksError
{
   function matriksErrorJumlahBarisDuaMatriks(array $matriks1, array $matriks2)
   {
      //foreach untuk mengecek apakah jumlah baris setiap element array sama atau tidak
      foreach($matriks1 as $key => $value)
      {
         if(count($matriks1) != count($matriks2))
         {
            echo "Jumlah baris tidak sama!";
            die();
         }
      }
   }

   function matriksErrorJumlahElementBarisDuaMatriks(array $matriks1, array $matriks2)
   {
      //foreach untuk mengecek jumlah element setiap element array sama atau tidak
      foreach ($matriks1 as $key => $value) {
         foreach($value as $key2 => $value2)
         {
            if(count($matriks1[$key]) != count($matriks2[$key])) //jika jumlah element tiap baris tidak sama
            {
               echo "Jumlah element setiap baris tidak sama!";
               die();
            }
         }
      }
   }

   function matriksErrorElementBukanNumeric(array $matriks1)
   {
      foreach ($matriks1 as $key => $value) {
         foreach($value as $key2 => $value2)
         {
            if(!is_numeric($matriks1[$key][$key2]))
            {
               echo "Beberapa element baris yang di inputkan bukan numeric!";
               die();
            }
         }
      }
   }

   function matriksErrorCekBarisDanColumn(array $matriks1)
   {
      $jumlahBaris = count($matriks1);

      foreach ($matriks1 as $key => $value) {
         $jumlahColumn = count($matriks1[$key]);

         if($jumlahBaris != $jumlahColumn)
         {
            echo "Jumlah baris dan column di suatu matriks tidak sama!";
            die();
         }
      }
   }

   function matriksErrorCekBarisDanColumnDuaMatriks($matriks1, $matriks2)
   {
      $jumlahBarisMatriks2 = count($matriks2);

      foreach ($matriks1 as $key => $value) {
         $jumlahColumnMatriks1 = count($matriks1[$key]);

         if($jumlahColumnMatriks1 != $jumlahBarisMatriks2)
         {
            echo "Antara jumlah baris dengan jumlah column dari 2 matrik tidak sama";
            die();
         }
      }
   }
}

 ?>
