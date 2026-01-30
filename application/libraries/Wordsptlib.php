<?php

// use PhpOffice\PhpWord\PhpWord;
// use PhpOffice\PhpWord\Writer\Word2007;


class Wordsptlib
{
        
    function spt($data) {
        require_once 'vendor/autoload.php';
        //$phpWord = new PhpWord();
		$phpWord = new \PhpOffice\PhpWord\PhpWord();
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('public/report/'.$data['source']);

        #detail nama petugas
        $detail_array = [];
        $no= 1;
        foreach ($data['detail'] as $key) {
            $detail_array[] = [
                'petugas' => $key->nama,
                'petugas_nip' => ($key->nip == "") ? '-':$key->nip,
                'petugas_pangkat' => ($key->pangkat == "") ? 'PPNPN':$key->pangkat,
                'petugas_jabatan' => htmlspecialchars($key->jabatan),
                'no' => $no,
            ];
            $no++;
        }
        $templateProcessor->cloneBlock('loop_petugas', 0, true, false, $detail_array);
        
        #jika terdapat beberapa tahap spt diklat
        if($data['tahap'] != "") {
            $detail_tahap = [];
            $no_tahap = 1;
            foreach ($data['tahap'] as $key) {
                $detail_tahap[] = [
                    'waktu' => $key->waktu,
                    'tempat' => $key->tempat,
                    'no' => $no_tahap,
                ];
                $no_tahap++;
            }
            $templateProcessor->cloneBlock('loop_tahap', 0, true, false, $detail_tahap);
        }

        $templateProcessor->setValues($data['data']);
        header("Content-Disposition: attachment; filename=".$data['filename']);
        $templateProcessor->saveAs('php://output');
    }


    public function izin($data) {
        require_once 'vendor/autoload.php';
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('public/report/'.$data['source']);

        $templateProcessor->setValues($data['data']);
        header("Content-Disposition: attachment; filename=".$data['filename']);
        $templateProcessor->saveAs('php://output');
    }
   
}


