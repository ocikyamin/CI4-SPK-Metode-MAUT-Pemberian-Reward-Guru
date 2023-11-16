<?php
function PenilaianDB()
{
return $db= \Config\Database::connect(); 
}

// Status Penilaian by guru,periode
function StatusNilai($periode_id = null, $guru_mapel_id = null)
{
    if ($periode_id === null || $guru_mapel_id === null) {
    return 0; // Kembalikan nilai 0 jika salah satu parameter kosong
    }
    return $builder = PenilaianDB()
    ->table('nilai_alternatif')
    ->select('skor')
    ->where('periode_id',$periode_id)
    ->where('guru_mapel_id',$guru_mapel_id)
    ->countAllResults();
}

// Staus Nilai Kompetensi 
function StatusNilaiK($periode_id = null, $guru_mapel_id = null, $kriteria_id = null)
{
    if ($periode_id === null || $guru_mapel_id === null || $kriteria_id === null) {
        return 0; // Kembalikan nilai 0 jika salah satu parameter kosong
    }

    return PenilaianDB()
        ->table('nilai_alternatif')
        ->selectSum('skor') // Menggunakan selectSum untuk menghitung total nilai skor
        ->where('periode_id', $periode_id)
        ->where('guru_mapel_id', $guru_mapel_id)
        ->where('kriteria_id', $kriteria_id)
        ->get()
        ->getRow();
}


function StatusNilaiIndikator($periode_id = null, $guru_mapel_id = null,$kriteria_id = null, $sub_kriteria_id = null)
{
    if ($periode_id === null || $guru_mapel_id === null || $kriteria_id === null || $sub_kriteria_id === null) {
    return 0; // Kembalikan nilai 0 jika salah satu parameter kosong
    }
    return $builder = PenilaianDB()
    ->table('nilai_alternatif_indikator')
    ->select('id,nilai')
    ->where('periode_id',$periode_id)
    ->where('guru_mapel_id',$guru_mapel_id)
    ->where('kriteria_id',$kriteria_id)
    ->where('sub_kriteria_id',$sub_kriteria_id)
    ->get()
    ->getRow();
}






