<?php include "matriksError.php";


class matriks extends matriksError
{

   //methode untuk isis data
   function matriksIsiData(array &$matriks1)
   {
      //foreach untuk mengisi setiap baris element
      foreach ($matriks1 as $key => $value) {

         //jika bukan array maka explode menjadi array
         //berpengaruh pada matriksOperasiTambah, dan matriksOperasiTambahAll
         if(!is_array($matriks1[$key]))
         {
            $matriks1[$key] = explode(";", $value);
         }
      }
   }

   //method untuk menambahkan element array
   function matriksOperasiTambah(array $matriks1, array $matriks2) : array
   {
      //inisialisasi matriks baru yang merupakan hasil penambahan
      $matriksHasil = [];

      $this->matriksIsiData($matriks1);
      $this->matriksIsiData($matriks2);
      parent::matriksErrorJumlahBaris($matriks1, $matriks2);
      parent::matriksErrorJumlahElementBaris($matriks1, $matriks2);
      parent::matriksErrorElementBukanNumeric($matriks1, $matriks2);

      //foreach untuk menambah setiap baris element array menjadi array baru
      foreach ($matriks1 as $key => $value) {
         foreach ($value as $key2 => $value2) {
            $matriksHasil[$key][] = $matriks1[$key][$key2] + $matriks2[$key][$key2];
         }
      }

      //return hasil
      return $matriksHasil;
   }

   //method untuk megnurangkan element array
   function matriksOperasiKurang(array $matriks1, array $matriks2) : array
   {
      //inisialisasi matriks baru yang merupakan hasil penambahan
      $matriksHasil = [];

      $this->matriksIsiData($matriks1);
      $this->matriksIsiData($matriks2);
      parent::matriksErrorJumlahBaris($matriks1, $matriks2);
      parent::matriksErrorJumlahElementBaris($matriks1, $matriks2);
      parent::matriksErrorElementBukanNumeric($matriks1, $matriks2);

      //foreach untuk menambah setiap baris element array menjadi array baru
      foreach ($matriks1 as $key => $value) {
         foreach ($value as $key2 => $value2) {
            $matriksHasil[$key][] = $matriks1[$key][$key2] - $matriks2[$key][$key2];
         }
      }

      //return hasil
      return $matriksHasil;
   }

   //method untuk menambahkan matriks dalam jumlah yang banyak
   function matriksOperasiTambahAll(array $matriks) : array
   {
      //matriks hasil
      $matriksHasil = [];

      for ($i=0; $i < count($matriks) - 1; $i++) {
         $matriks1 = $matriks[$i];
         $matriks2 = $matriks[$i + 1];
         $matriks[$i + 1] = $this->matriksOperasiTambah($matriks1, $matriks2);

         $matriksHasil = $matriks[$i + 1];
      }

      return $matriksHasil;
   }

   //method untuk mengurangkan matriks dalam jumlah yang sedikit
   function matriksOperasiKurangAll(array $matriks) : array
   {
      //matriks hasil
      $matriksHasil = [];

      for ($i=0; $i < count($matriks) - 1; $i++) {
         $matriks1 = $matriks[$i];
         $matriks2 = $matriks[$i + 1];
         $matriks[$i + 1] = $this->matriksOperasiKurang($matriks1, $matriks2);

         $matriksHasil = $matriks[$i + 1];
      }

      return $matriksHasil;
   }

   function matriksOperasiKali(array $matriks1, array $matriks2) : array
   {
      $arrayHasil = [];


      return $arrayHasil;
   }

   function matriksTranspose(array $matriks1) : array
   {
      $this->matriksIsiData($matriks1);
   }

}

$matriks = new matriks();


$matriks1 = array(
   "b1" => "1;2;4;4",
   "b2" => "2;3;4;5",
   "b3" => "2;3;4;5"
);

$matriks2 = array(
   "b1" => "1;2;3;4",
   "b2" => "2;3;4;5",
   "b3" => "2;3;4;5"
);

$matriks3 = array(
   "b1" => "1;2;3;4",
   "b2" => "2;3;4;5",
   "b3" => "2;3;4;5"
);

$matriks4 = array(
   "b1" => "1;2;3;4",
   "b2" => "2;3;4;5",
   "b3" => "2;3;4;5"
);


?>
