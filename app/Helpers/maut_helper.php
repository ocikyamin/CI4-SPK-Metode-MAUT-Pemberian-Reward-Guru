<?php
function MautDB()
{
return $db= \Config\Database::connect(); 
}


// Dapatkan Nilai setiap alternatif 
function NilaiAlternatif($sekolah_id =null, $periode_id =null,$guru_mapel_id=null, $kriteria_id=null)
{
    if ($sekolah_id ===null || $periode_id ===null || $guru_mapel_id===null || $kriteria_id===null) {
        return 0;
    }
    if ($sekolah_id=="all") {
        return MautDB()->table('nilai_alternatif')
       ->select('nilai_alternatif.skor')
       ->where('nilai_alternatif.periode_id',$periode_id)
       ->where('nilai_alternatif.guru_mapel_id',$guru_mapel_id)
       ->where('nilai_alternatif.kriteria_id',$kriteria_id)
       ->get()
       ->getRow();
    }else{
        return MautDB()->table('nilai_alternatif')
       ->select('nilai_alternatif.skor')
       ->where('nilai_alternatif.sekolah_id',$sekolah_id)
       ->where('nilai_alternatif.periode_id',$periode_id)
       ->where('nilai_alternatif.guru_mapel_id',$guru_mapel_id)
       ->where('nilai_alternatif.kriteria_id',$kriteria_id)
       ->get()
       ->getRow();
    }
       
     
}

// Dapatkan Nilai Minumum dan Maksimum
function NilaiMinMax($sekolah_id =null,$periode_id =null, $kriteria_id=null, $type)
{
    if ($sekolah_id ===null || $periode_id ===null || $kriteria_id===null) {
        return 0;
    }

    if ($sekolah_id=="all") {
        if ($type=="min") {
            return MautDB()->table('nilai_alternatif')
            ->selectMin('nilai_alternatif.skor')
            ->where('nilai_alternatif.periode_id',$periode_id)
            ->where('nilai_alternatif.kriteria_id',$kriteria_id)
            ->groupBy('nilai_alternatif.kriteria_id')
            ->get()
            ->getRow();
        }else{
            return MautDB()->table('nilai_alternatif')
            ->selectMax('nilai_alternatif.skor')
            ->where('nilai_alternatif.periode_id',$periode_id)
            ->where('nilai_alternatif.kriteria_id',$kriteria_id)
            ->groupBy('nilai_alternatif.kriteria_id')
            ->get()
            ->getRow();
        }
    }else{
        if ($type=="min") {
            return MautDB()->table('nilai_alternatif')
            ->selectMin('nilai_alternatif.skor')
            ->where('nilai_alternatif.sekolah_id',$sekolah_id)
            ->where('nilai_alternatif.periode_id',$periode_id)
            ->where('nilai_alternatif.kriteria_id',$kriteria_id)
            ->groupBy('nilai_alternatif.kriteria_id')
            ->get()
            ->getRow();
        }else{
            return MautDB()->table('nilai_alternatif')
            ->selectMax('nilai_alternatif.skor')
            ->where('nilai_alternatif.sekolah_id',$sekolah_id)
            ->where('nilai_alternatif.periode_id',$periode_id)
            ->where('nilai_alternatif.kriteria_id',$kriteria_id)
            ->groupBy('nilai_alternatif.kriteria_id')
            ->get()
            ->getRow();
        }
    }
}



function TotalBobot()
{

return MautDB()->table('kriteria')
->selectSum('bobot')
->get()
->getRow();

}