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
      parent::matriksErrorElementBukanNumeric($matriks1);
      parent::matriksErrorElementBukanNumeric($matriks2);
      parent::matriksErrorJumlahBarisDuaMatriks($matriks1, $matriks2);
      parent::matriksErrorJumlahElementBarisDuaMatriks($matriks1, $matriks2);

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
      parent::matriksErrorElementBukanNumeric($matriks1);
      parent::matriksErrorElementBukanNumeric($matriks2);
      parent::matriksErrorJumlahBarisDuaMatriks($matriks1, $matriks2);
      parent::matriksErrorJumlahElementBarisDuaMatriks($matriks1, $matriks2);

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

   //fungsi untuk mendapatkan matriks berdasarkan column
   function matriksGetColumn(array $matriks1, int $columnKe)
   {
      $matriksHasil = [];
      // $this->matriksIsiData($matriks1);

      foreach ($matriks1 as $key => $value) {
         if(array_key_exists($columnKe, $matriks1[$key]))
         {
            $matriksHasil[] = $matriks1[$key][$columnKe];
         }else
         {
            break;
         }
      }

      if(count($matriksHasil) < 1)
      {
         return false;
      }else
      {
         return $matriksHasil;
      }
   }

   //fungsi untuk mendapatkan matriks berdasarkan baris
   function matriksGetBaris(array $matriks1, int $barisKe)
   {
      $matriksHasil = [];
      $matriks1Keys = array_keys($matriks1);

      if(array_key_exists($barisKe, $matriks1Keys))
      {
         return $matriksHasil = $matriks1[$matriks1Keys[$barisKe]];
      }else
      {
         return false;
      }
   }

   //fungsi untuk menyimpan perkalian antar baris dan column
   function matriksOperasiKaliBarisDanColumn(array $matriksBaris, array $matriksColumn) : int
   {
      $penjumlahan = 0;

      foreach ($matriksBaris as $key => $value) {
         $penjumlahan += $matriksBaris[$key] * $matriksColumn[$key];
      }

      return $penjumlahan;
   }

   function matriksOperasiKali(array $matriks1, array $matriks2) : array
   {
      $matriksHasil = [];
      $this->matriksIsiData($matriks1);
      $this->matriksIsiData($matriks2);
      parent::matriksErrorElementBukanNumeric($matriks1);
      parent::matriksErrorElementBukanNumeric($matriks2);
      parent::matriksErrorCekBarisDanColumnDuaMatriks($matriks1, $matriks2);

      //list keys dari kedua matriks (ambil yang $matriks1 saja)
      $matriksKeys          = array_keys($matriks1);

      //jumlah baris matriks1 untuk membuaat perulangan sebanyak jumlah barisnya
      $jumlahBarisMatriks1  = count($matriks1);

      //jumlah column matriks2 untuk menjumlahkan tiap baris ke tiap column sesuai keys yang telah di list di atas
      $jumlahColumnMatriks2 = count($matriks2[$matriksKeys[0]]);

      for ($i=0; $i < $jumlahColumnMatriks2; $i++) {

         for ($j=0; $j < $jumlahBarisMatriks1; $j++) {
            $matriksBaris  = $this->matriksGetBaris($matriks1, $j);
            $matriksColumn = $this->matriksGetColumn($matriks2, $i);
            $penjumlahan   = $this->matriksOperasiKaliBarisDanColumn($matriksBaris, $matriksColumn);

            //simpan hasil penjumlahannya ke dalam setiap baris dan column
            $matriksHasil[$matriksKeys[$j]][] = $penjumlahan;

            //reset ke 0 untuk menghitung jumlah perkalian dengan column lainnya lagi
            $penjumlahan = 0;
         }
      }

      return $matriksHasil;
   }

   //khusus untuk operasi matriks kali all, semua jumlah baris dan column matriks 1 harus sama dengan semua jumlah baris dan matriks 2
   function matriksOperasiKaliAll(array $matriks) : array
   {
      $matriksHasil = [];

      for ($i=0; $i < count($matriks) - 1; $i++) {
         $matriks1 = $matriks[$i];
         $matriks2 = $matriks[$i + 1];
         $matriks[$i + 1] = $this->matriksOperasiKali($matriks1, $matriks2);
         $matriksHasil = $matriks[$i + 1];
      }

      return $matriksHasil;
   }

   function matriksTranspose(array $matriks1) : array
   {
      $this->matriksIsiData($matriks1);
      parent::matriksErrorCekBarisDanColumn($matriks1);
      $matriksHasil = [];

      $i = 0;
      foreach ($matriks1 as $key => $value) {

         foreach ($matriks1 as $key2 => $value2) {
            //lakukan pertukaran setiap element pada baris dengan setiap element pada column
            //tergantung $i

            $matriksHasil[$key][] = $matriks1[$key2][$i];
         }

         //ubah setiap column
         $i++;
      }

      return $matriksHasil;
   }

   function matriksTransposeAll(array $matriks1) : array
   {
      $matriksHasil = [];

      foreach ($matriks1 as $key => $value) {
         $matriksHasil[] = $this->matriksTranspose($value);
      }

      return $matriksHasil;
   }

   //fungsi untuk merubah tiap baris matriks
   function matriksUbahBaris(array $baris1, array $baris2, int $columnKe) : array
   {
      $matriksHasil = [];
      $elementAtas = $baris2[$columnKe];
      $elementBawah = $baris1[$columnKe];

      foreach ($baris1 as $key => $value) {
         $matriksHasil[] = $baris2[$key] - ($baris1[$key] * $elementAtas / $elementBawah);
      }

      return $matriksHasil;
   }

   //fungsi untuk merubah tiap baris matriks (khusus untuk spl)
   function matriksUbahBarisSpl(array $baris1, array $baris2, int $columnKe) : array
   {
      $matriksHasil = [];

      foreach ($baris1 as $key => $value) {
         $matriksHasil[] = ($baris2[$key] * $baris1[$columnKe]) - ($baris1[$key] * $baris2[$columnKe]);
      }

      return $matriksHasil;
   }

   function matriksDeterminan(array $matriks1)
   {
      $matriksHasil = 0;
      $matriksKeys = array_keys($matriks1);
      $this->matriksIsiData($matriks1);
      parent::matriksErrorCekBarisDanColumn($matriks1);
      parent::matriksErrorElementBukanNumeric($matriks1);

      $matriks1 = $this->matriksSegitigaBawahDeterminan($matriks1);

      //simpan dulu angka pada column pertama
      $matriksHasil = $matriks1[$matriksKeys[0]][0];

      //for untuk menhitung perkalian antara diagonal
      for ($i=0; $i < count($matriks1) - 1; $i++) {
         $matriksHasil *= $matriks1[$matriksKeys[$i+1]][$i+1];
      }

      return $matriksHasil;
   }

   function matriksDeterminanAll(array $matriks1) : array
   {
      $matriksHasil = [];
      foreach ($matriks1 as $key => $value) {
         $matriksHasil[] = $this->matriksDeterminan($value);
      }

      return $matriksHasil;
   }


   //methode untuk membuat segitiga bawah (khusus untuk mencari determinan)
   function matriksSegitigaBawahDeterminan(array $matriks1) : array
   {
      $matriksKeys = array_keys($matriks1);
      //untuk membuat matriks segitiga bawah
      for ($i=0; $i < count($matriks1) - 1; $i++) {
         //pindah baris
         for ($j=$i+1; $j < count($matriks1); $j++) {

            //ubah setiap column pada setiap baris dari depan
            $matriks1[$matriksKeys[$j]] = $this->matriksUbahBaris($matriks1[$matriksKeys[$i]], $matriks1[$matriksKeys[$j]], $i);
         }
      }

      return $matriks1;
   }

   //methode untuk membuat segitiga atas (khusus untuk mencari determinan)
   function matriksSegitigaAtasDeterminan(array $matriks1) : array
   {
      //$this->matriksIsiData($matriks1);
      $matriksKeys = array_keys($matriks1);
      //untuk membuat matriks segitiga atas
      for ($i=count($matriks1) - 1; $i > 0; $i--) {
         //pindah baris
         for ($j=$i-1; $j >= 0; $j--) {

            //ubah setiap column pada setiap baris dari belakang
            $matriks1[$matriksKeys[$j]] = $this->matriksUbahBaris($matriks1[$matriksKeys[$i]], $matriks1[$matriksKeys[$j]], $i);
         }
      }

      return $matriks1;
   }

   //methode untuk membuat segitiga bawah khusus spl
   function matriksSegitigaBawahSpl(array $matriks1) : array
   {
      $matriksKeys = array_keys($matriks1);
      //untuk membuat matriks segitiga bawah
      for ($i=0; $i < count($matriks1) - 1; $i++) {
         //pindah baris
         for ($j=$i+1; $j < count($matriks1); $j++) {

            //ubah setiap column pada setiap baris dari depan
            $matriks1[$matriksKeys[$j]] = $this->matriksUbahBarisSpl($matriks1[$matriksKeys[$i]], $matriks1[$matriksKeys[$j]], $i);
         }
      }

      return $matriks1;
   }

   //methode untuk membuat segitiga atas khusus spl
   function matriksSegitigaAtasSpl(array $matriks1) : array
   {
      //$this->matriksIsiData($matriks1);
      $matriksKeys = array_keys($matriks1);
      //untuk membuat matriks segitiga atas
      for ($i=count($matriks1) - 1; $i > 0; $i--) {
         //pindah baris
         for ($j=$i-1; $j >= 0; $j--) {

            //ubah setiap column pada setiap baris dari belakang
            $matriks1[$matriksKeys[$j]] = $this->matriksUbahBarisSpl($matriks1[$matriksKeys[$i]], $matriks1[$matriksKeys[$j]], $i);
         }
      }

      return $matriks1;
   }

   //methode untuk membuat segitiga atas khusus inverse
   function matriksSegitigaAtasInverse(array $matriks1) : array
   {
      //$this->matriksIsiData($matriks1);
      $matriksKeys = array_keys($matriks1);
      $columnKe =  (count($matriks1[$matriksKeys[0]]) - 1) / 2;
      $columnKe = (int) $columnKe;

      //untuk membuat matriks segitiga atas
      for ($i=count($matriks1) - 1; $i > 0; $i--) {
         //pindah baris
         for ($j=$i-1; $j >= 0; $j--) {

            //ubah setiap column pada setiap baris dari belakang
            $matriks1[$matriksKeys[$j]] = $this->matriksUbahBaris($matriks1[$matriksKeys[$i]], $matriks1[$matriksKeys[$j]],  $columnKe);
         }

         $columnKe--;
      }

      return $matriks1;
   }

   //method untuk menjadikan matriks yang sudah kena operasi obe menjadi identitas
   function matriksIdentitas(array &$matriks1)
   {

      //variabel untuk menimpan perubahan nilai column yang di ambil tiap baris
      $columnKe = 0;
      foreach ($matriks1 as $key => $value) {

         //lakukan pembagian tiap element pada tiap baris
         foreach ($value as $key2 => $value2) {
            $matriks1[$key][$key2] /= $value[$columnKe];
         }

         $columnKe++;
      }

   }

   //method untuk mencari spl (sistem persamaan linear) dengan methode obe
   function matriksSpl(array $matriks1) : array
   {
      $this->matriksIsiData($matriks1);
      parent::matriksErrorElementBukanNumeric($matriks1);
      $matriksKeys = array_keys($matriks1);

      //ubah menjadi matriks segitiga bawah
      $matriks1 = $this->matriksSegitigaAtasSpl($matriks1);
      $matriks1 = $this->matriksSegitigaBawahSpl($matriks1);

      //jadikan sebagai matriks identitas
      $this->matriksIdentitas($matriks1);

      return $matriks1;
   }

   function matriksSplAll(array $matriks) : array
   {
      $matriksHasil = [];

      foreach ($matriks as $key => $value) {
         $matriksHasil[] = $this->matriksSpl($value);
      }

      return $matriksHasil;
   }

   //methode untuk menambah matriks identitas (khusus untuk matriks inverse)
   function matriksTambahIdentitas(array &$matriks1)
   {
      $i = 0;
      foreach ($matriks1 as $key => $value) {
         for ($j=0; $j < count($value); $j++) {
            if($i == $j)
            {
               array_push($matriks1[$key], 1);
            }else
            {
               array_push($matriks1[$key], 0);
            }
         }

         $i++;
      }
   }

   //methode untuk inverse matriks
   function matriksInverse(array $matriks1) : array
   {
      //conversi matriks dan cek apakah matriks merupakan matriks persegi atau tidak
      $this->matriksIsiData($matriks1);
      parent::matriksErrorCekBarisDanColumn($matriks1);
      parent::matriksErrorElementBukanNumeric($matriks1);

      $matriksHasil = [];

      $this->matriksTambahIdentitas($matriks1);
      $matriks1 = $this->matriksSegitigaAtasInverse($matriks1);
      $matriks1 = $this->matriksSegitigaBawahDeterminan($matriks1);
      $this->matriksIdentitas($matriks1);

      //perulangan untuk membuang matriks identitas yang sudah di sebelah kiri untuk mendapatkan matriks inverse
      foreach ($matriks1 as $key => $value) {
         for ($i=0; $i < count($matriks1); $i++) {

            //inilah fungsi untuk buangnya
            array_shift($matriks1[$key]);
         }
      }

      return $matriks1;
   }

   //methode untuk invers matriks sekaligus banyak
   function matriksInverseAll(array $matriks1) : array
   {
      $matriksHasil = [];
      foreach ($matriks1 as $key => $value) {
         $matriksHasil[] = $this->matriksInverse($value);
      }

      return $matriksHasil;
   }

}

$matriks = new matriks();

$matriks1 = array(
   "b1" => "-2;4;-5;9", //1,2,3,7
   "b2" => "1;3;-7;8", //2,3,4,8
   "b3" => "0;4;-8;7", //2,3,4,8
   "b4" => "6;4;-8;3" //2,3,4,8
);

$matriks2 = array(
   "b1" => "1;2;11", //1,2,3,7
   "b2" => "3;4;25", //2,3,4,8
   "b3" => "3;4;6" //2,3,4,8

);


$matriks3 = array(
   "b1" => "1;2;3;4;7", //1,2,3,7
   "b2" => "2;3;4;5;8", //2,3,4,8
   "b3" => "3;4;5;6;9", //3,4,5,9
   "b4" => "4;5;6;7;10" //4,5,6,10
);

$matriks4 = array(
   "b1" => "1;2;3;4", //1,2,3,7
   "b2" => "2;3;4;5", //2,3,4,8
   "b3" => "3;4;5;6", //3,4,5,9
   "b4" => "7;8;9;10" //4,5,6,10
);

$matriks5 = array(
   "b1" => "2;0;-3;0", //1,2,3,7
   "b2" => "0;5;2;3", //2,3,4,8
   "b3" => "-2;3;-1;4", //3,4,5,9
   "b4" => "3;6;0;5" //4,5,6,10
);

// print_r($matriks->matriksOperasiKaliAll(array($matriks1, $matriks2, $matriks3, $matriks4, $matriks5)));
// print_r($matriks->matriksDeterminanAll(array($matriks1, $matriks2)));

// print_r($matriks->matriksDeterminan($matriks5));
// print_r($matriks->matriksDeterminan($matriks1));
foreach ($matriks->matriksInverseAll(array($matriks1)) as $key => $value) {
   foreach ($value as $key2 => $value2) {
      print_r($value2);
      echo "<br>";
   }
}

?>
