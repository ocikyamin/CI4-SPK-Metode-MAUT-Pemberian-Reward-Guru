<?php
function AppDB()
{
    return $db = \Config\Database::connect();
}

// Periode Akademik aktif 
function PeriodeAktif()
{
    return $builder = AppDB()
        ->table('periode')
        ->where('is_active', 1)
        ->get()
        ->getRow();
}
// List Periode Akademik 
function Periode()
{
    return $builder = AppDB()
        ->table('periode')
        ->get()
        ->getResultArray();
}
// List Sekolah 
function Sekolah()
{
    return $builder = AppDB()
        ->table('sekolah')
        ->get()
        ->getResultArray();
}

// Untuk menghitung jumlah data 
function CountData($table_name)
{
    return $builder = AppDB()
        ->table($table_name)
        ->countAllResults();
}

function Tabel($table_name)
{
    return $builder = AppDB()
        ->table($table_name)
        ->get()
        ->getResultArray();
}