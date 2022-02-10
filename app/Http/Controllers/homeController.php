<?php

namespace App\Http\Controllers;

use SheetDB\SheetDB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

use Maatwebsite\Excel\Facades\Excel AS Excel1;


class homeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function toko_besi()
    {
        return view('toko_besi');
    }

    public function getMapBesi()
    {
        $response = Http::get('https://serpapi.com/search.json?engine=google_maps&q=toko+besi+semarang&type=search&api_key=8bc733d63ff314a146adb8dd835121f614aac989fc8a11d9213b8f5dae0e7420');

        $data = $response->json();

        $list_toko_besi = $data['local_results'];

        $sheetdb = new SheetDB('ihvk52x31fdn3');

        $create = array();

        foreach ($list_toko_besi as $key => $value) {

            if(isset($value['website'])) {
                $website = $value['website'];
            } else {
                $website = '-';
            }

            if(isset($value['rating'])) {
                $nilai_review = $value['rating'];
            } else {
                $nilai_review = '0';
            }

            if(isset($value['reviews'])) {
                $jml_review = $value['reviews'];
            } else {
                $jml_review = '0';
            }

            if(isset($value['phone'])) {
                $telepon = $value['phone'];
            } else {
                $telepon = '-';
            }

            $create[$value['position']] = [
                'nama'    => $value['title'],
                'alamat'  => $value['address'],
                'telepon' => "'".$telepon,
                'email'   => '-',
                'website' => $website,
                'nilai_review'=> $nilai_review,
                'jml_review'  => $jml_review,
            ];

        }
        $sheetdb->create($create);

        return redirect()->route('toko_besi');
    }

    public function toko_bangunan()
    {
        return view('toko_bangunan');
    }

    public function getMapBangunan()
    {
        $response = Http::get('https://serpapi.com/search.json?engine=google_maps&q=toko+bangunan+semarang&type=search&api_key=8bc733d63ff314a146adb8dd835121f614aac989fc8a11d9213b8f5dae0e7420');

        $data = $response->json();

        $list_toko_bangunan = $data['local_results'];

        $sheetdb2 = new SheetDB('oj7byzh0e19j3');

        $create1 = array();

        foreach ($list_toko_bangunan as $key => $value) {

            if(isset($value['website'])) {
                $website = $value['website'];
            } else {
                $website = '-';
            }

            if(isset($value['rating'])) {
                $nilai_review = $value['rating'];
            } else {
                $nilai_review = '0';
            }

            if(isset($value['reviews'])) {
                $jml_review = $value['reviews'];
            } else {
                $jml_review = '0';
            }

            if(isset($value['phone'])) {
                $telepon = $value['phone'];
            } else {
                $telepon = '-';
            }

            $create1[$value['position']] = [
                'nama'    => $value['title'],
                'alamat'  => $value['address'],
                'telepon' => "'".$telepon,
                'email'   => '-',
                'website' => $website,
                'nilai_review'=> $nilai_review,
                'jml_review'  => $jml_review,
            ];

        }
        $sheetdb2->create($create1);

        return redirect()->route('toko_bangunan');
    }
}
