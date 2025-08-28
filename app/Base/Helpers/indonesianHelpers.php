<?php

function format_uang($angka)
{
    return number_format($angka, 0, ',', '.');
}

function terbilang($angka)
{
    $angka = abs($angka);
    $baca  = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas');
    $terbilang = '';

    if ($angka < 12) { // 0 - 11
        $terbilang = ' ' . $baca[$angka];
    } elseif ($angka < 20) { // 12 - 19
        $terbilang = terbilang($angka - 10) . ' belas';
    } elseif ($angka < 100) { // 20 - 99
        $terbilang = terbilang($angka / 10) . ' puluh' . terbilang($angka % 10);
    } elseif ($angka < 200) { // 100 - 199
        $terbilang = ' seratus' . terbilang($angka - 100);
    } elseif ($angka < 1000) { // 200 - 999
        $terbilang = terbilang($angka / 100) . ' ratus' . terbilang($angka % 100);
    } elseif ($angka < 2000) { // 1.000 - 1.999
        $terbilang = ' seribu' . terbilang($angka - 1000);
    } elseif ($angka < 1000000) { // 2.000 - 999.999
        $terbilang = terbilang($angka / 1000) . ' ribu' . terbilang($angka % 1000);
    } elseif ($angka < 1000000000) { // 1000000 - 999.999.990
        $terbilang = terbilang($angka / 1000000) . ' juta' . terbilang($angka % 1000000);
    }

    return $terbilang;
}

function tanggal_indonesia($tgl, $tampil_hari = true, $tampil_waktu = false)
{
    $nama_hari  = array(
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jum\'at',
        'Sabtu'
    );
    $nama_bulan = array(
        1 =>
        'Januari',
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

    $tahun   = substr($tgl, 0, 4);
    $bulan   = $nama_bulan[(int) substr($tgl, 5, 2)];
    $tanggal = substr($tgl, 8, 2);
    $text    = '';

    if ($tampil_waktu && $tampil_hari) {
        $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
        $hari        = $nama_hari[$urutan_hari];
        $jam         = substr($tgl, 11, 2);
        $menit       = substr($tgl, 14, 2);
        $text       .= "$hari, $tanggal $bulan $tahun $jam:$menit";
        return $text;
    }

    if ($tampil_hari) {
        $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
        $hari        = $nama_hari[$urutan_hari];
        $text       .= "$hari, $tanggal $bulan $tahun";
        return $text;
    }

    if ($tampil_waktu) {
        $jam   = substr($tgl, 11, 2);
        $menit = substr($tgl, 14, 2);
        $text  .= "$tanggal $bulan $tahun $jam:$menit";
        return $text;
    }

    $text       .= "$tanggal $bulan $tahun";
    return $text;
}

function tambah_nol_didepan($value, $threshold = null)
{
    return sprintf("%0" . $threshold . "s", $value);
}


function RemoveSpecialChar($str)
{

    // Using str_replace() function
    // to replace the word
    $res = str_replace(array(
        '\'',
        '"',
        ',',
        ';',
        '<',
        '>',
        '[',
        ']'
    ), ' ', $str);

    // Returning the result
    return $res;
}
function RemoveSpecialCharPlus($str)
{

    // Using str_replace() function
    // to replace the word
    $res = str_replace(array(
        '\'',
        '"',
        ';',
        ':',
        '<',
        '>',
        '[',
        ']',
        '{',
        '}',
    ), ' ', $str);

    // Returning the result
    return $res;
}
