<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class KaroraController extends Controller
{
    public function index() {
        $nev = request('nev', '');
        $gyartok = request('gyartok') ? explode(',', request('gyartok')) : [];
        $szamlapTipusok = request('szamlapTipusok') ? explode(',', request('szamlapTipusok')) : [];
        $szerkezetTipusok = request('szerkezetTipusok') ? explode(',', request('szerkezetTipusok')) : [];
        $szijAnyagok = request('szijAnyagok') ? explode(',', request('szijAnyagok')) : [];
        $tokAnyagok = request('tokAnyagok') ? explode(',', request('tokAnyagok')) : [];
        $uveglapAnyagok = request('uveglapAnyagok') ? explode(',', request('uveglapAnyagok')) : [];
        $vizallosagok = request('vizallosagok') ? explode(',', request('vizallosagok')) : [];
        $termekcsaladok = request('termekcsaladok') ? explode(',', request('termekcsaladok')) : [];
        $minSzelessegMm = request('minSzelessegMm', '');
        $maxSzelessegMm = request('maxSzelessegMm', '');
        $minMagassagMm = request('minMagassagMm', '');
        $maxMagassagMm = request('maxMagassagMm', '');
        $minVastagsagMm = request('minVastagsagMm', '');
        $maxVastagsagMm = request('maxVastagsagMm', '');

        $lekerdezes = DB::table('karora')
        ->join('szamlap_tipus', 'karora.szamlap_tipus_id', '=', 'szamlap_tipus.id')
        ->join('szerkezet_tipus', 'karora.szerkezet_tipus_id', '=', 'szerkezet_tipus.id')
        ->join('vizallosag', 'karora.vizallosag_id', '=', 'vizallosag.id')
        ->join('tok_anyag', 'karora.tok_anyag_id', '=', 'tok_anyag.id')
        ->join('szij_anyag', 'karora.szij_anyag_id', '=', 'szij_anyag.id')
        ->join('uveglap_anyag', 'karora.uveglap_anyag_id', '=', 'uveglap_anyag.id')
        ->join('termekcsalad', 'karora.termekcsalad_id', '=', 'termekcsalad.id')
        ->join('gyarto', 'termekcsalad.gyarto_id', '=', 'gyarto.id')
        ->select(
            'karora.id as karora_id',
            'karora.nev as karora_nev',
            'karora.szelesseg_mm as karora_szelesseg_mm',
            'karora.magassag_mm as karora_magassag_mm',
            'karora.vastagsag_mm as karora_vastagsag_mm',
            'karora.pontossag_mp_per_nap as karora_pontossag_mp_per_nap',
            'karora.suly_g as karora_suly_g',

            'szamlap_tipus.id as szamlap_tipus_id',
            'szamlap_tipus.nev as szamlap_tipus_nev',

            'szerkezet_tipus.id as szerkezet_tipus_id',
            'szerkezet_tipus.nev as szerkezet_tipus_nev',

            'vizallosag.id as vizallosag_id',
            'vizallosag.nev as vizallosag_nev',

            'tok_anyag.id as tok_anyag_id',
            'tok_anyag.nev as tok_anyag_nev',

            'szij_anyag.id as szij_anyag_id',
            'szij_anyag.nev as szij_anyag_nev',

            'uveglap_anyag.id as uveglap_anyag_id',
            'uveglap_anyag.nev as uveglap_anyag_nev',
            
            'termekcsalad.id as termekcsalad_id',
            'termekcsalad.nev as termekcsalad_nev',

            'gyarto.id as gyarto_id',
            'gyarto.nev as gyarto_nev'
        )
        ->orderBy('karora.nev', 'asc');

        if (!empty($nev))
            $lekerdezes->whereRaw('CONCAT(gyarto.nev, \' \', karora.nev) LIKE ?', ['%' . $nev . '%']);

        if (!empty($gyartok))
            $lekerdezes->whereIn('termekcsalad.gyarto_id', $gyartok);

        if (!empty($szamlapTipusok))
            $lekerdezes->whereIn('karora.szamlap_tipus_id', $szamlapTipusok);

        if (!empty($szerkezetTipusok))
            $lekerdezes->whereIn('karora.szerkezet_tipus_id', $szerkezetTipusok);

        if (!empty($szijAnyagok))
            $lekerdezes->whereIn('karora.szij_anyag_id', $szijAnyagok);

        if (!empty($tokAnyagok))
            $lekerdezes->whereIn('karora.tok_anyag_id', $tokAnyagok);

        if (!empty($uveglapAnyagok))
            $lekerdezes->whereIn('karora.uveglap_anyag_id', $uveglapAnyagok);

        if (!empty($vizallosagok))
            $lekerdezes->whereIn('karora.vizallosag_id', $vizallosagok);

        if (!empty($termekcsaladok))
            $lekerdezes->whereIn('termekcsalad.id', $termekcsaladok);

        if (!empty($minSzelessegMm))
            $lekerdezes->where('karora.szelesseg_mm', '>=', $minSzelessegMm);

        if (!empty($maxSzelessegMm))
            $lekerdezes->where('karora.szelesseg_mm', '<=', $maxSzelessegMm);

        if (!empty($minMagassagMm))
            $lekerdezes->where('karora.magassag_mm', '>=', $minMagassagMm);

        if (!empty($maxMagassagMm))
            $lekerdezes->where('karora.magassag_mm', '<=', $maxMagassagMm);

        if (!empty($minVastagsagMm))
            $lekerdezes->where('karora.vastagsag_mm', '>=', $minVastagsagMm);

        if (!empty($maxVastagsagMm))
            $lekerdezes->where('karora.vastagsag_mm', '<=', $maxVastagsagMm);

        $megjelenitendoKarorak = $lekerdezes->get();

        $szamlapTipusok = DB::table('szamlap_tipus')->select('id as szamlap_tipus_id_szuretlen', 'nev as szamlap_tipus_nev_szuretlen')->get();

        $szerkezetTipusok = DB::table('szerkezet_tipus')->select('id as szerkezet_tipus_id_szuretlen', 'nev as szerkezet_tipus_nev_szuretlen')->get();

        $szijAnyagok = DB::table('szij_anyag')->select('id as szij_anyag_id_szuretlen', 'nev as szij_anyag_nev_szuretlen')->get();

        $tokAnyagok = DB::table('tok_anyag')->select('id as tok_anyag_id_szuretlen', 'nev as tok_anyag_nev_szuretlen')->get();

        $uveglapAnyagok = DB::table('uveglap_anyag')->select('id as uveglap_anyag_id_szuretlen', 'nev as uveglap_anyag_nev_szuretlen')->get();

        $vizallosagok = DB::table('vizallosag')->select('id as vizallosag_id_szuretlen', 'nev as vizallosag_nev_szuretlen')->get();

        $foKepek = DB::table('kepek')
                ->where('fo_kep', 1)
                ->get()
                ->keyBy('karora_id');

        return view('katalogus', compact('megjelenitendoKarorak', 'szamlapTipusok', 'szerkezetTipusok', 'szijAnyagok', 'tokAnyagok', 'uveglapAnyagok', 'vizallosagok', 'foKepek'));
    }

    public function show($id) {
        $foInformaciok = DB::table('karora')
        ->join('szamlap_tipus', 'karora.szamlap_tipus_id', '=', 'szamlap_tipus.id')
        ->join('szerkezet_tipus', 'karora.szerkezet_tipus_id', '=', 'szerkezet_tipus.id')
        ->join('vizallosag', 'karora.vizallosag_id', '=', 'vizallosag.id')
        ->join('tok_anyag', 'karora.tok_anyag_id', '=', 'tok_anyag.id')
        ->join('szij_anyag', 'karora.szij_anyag_id', '=', 'szij_anyag.id')
        ->join('uveglap_anyag', 'karora.uveglap_anyag_id', '=', 'uveglap_anyag.id')
        ->join('termekcsalad', 'karora.termekcsalad_id', '=', 'termekcsalad.id')
        ->join('gyarto', 'termekcsalad.gyarto_id', '=', 'gyarto.id')
        ->select(
            'karora.id as karora_id',
            'karora.nev as karora_nev',
            'karora.szelesseg_mm as karora_szelesseg_mm',
            'karora.magassag_mm as karora_magassag_mm',
            'karora.vastagsag_mm as karora_vastagsag_mm',
            'karora.pontossag_mp_per_nap as karora_pontossag_mp_per_nap',
            'karora.suly_g as karora_suly_g',

            'szamlap_tipus.id as szamlap_tipus_id',
            'szamlap_tipus.nev as szamlap_tipus_nev',

            'szerkezet_tipus.id as szerkezet_tipus_id',
            'szerkezet_tipus.nev as szerkezet_tipus_nev',

            'vizallosag.id as vizallosag_id',
            'vizallosag.nev as vizallosag_nev',

            'tok_anyag.id as tok_anyag_id',
            'tok_anyag.nev as tok_anyag_nev',

            'szij_anyag.id as szij_anyag_id',
            'szij_anyag.nev as szij_anyag_nev',

            'uveglap_anyag.id as uveglap_anyag_id',
            'uveglap_anyag.nev as uveglap_anyag_nev',
            
            'termekcsalad.id as termekcsalad_id',
            'termekcsalad.nev as termekcsalad_nev',

            'gyarto.id as gyarto_id',
            'gyarto.nev as gyarto_nev'
        )
        ->where('karora.id', $id)
        ->first();

        if (!$foInformaciok)
            abort(404);

        $egyebJellemzok = DB::table('egyeb_jellemzok')
        ->join('karorak_egyeb_jellemzok', 'egyeb_jellemzok.id', '=', 'karorak_egyeb_jellemzok.egyeb_jellemzo_id')
        ->select(
            'egyeb_jellemzok.nev as egyeb_jellemzok_nev'
        )
        ->where('karorak_egyeb_jellemzok.karora_id', $id)
        ->distinct()
        ->orderBy('egyeb_jellemzok.nev')
        ->get();

        if (!$egyebJellemzok)
            abort(404);

        $kepek = DB::table('kepek')
        ->select('kep_nev')
        ->where('karora_id', $id)
        ->get();

        $termekcsaladLeirasStr = DB::table('termekcsalad_leiras')
        ->where('termekcsalad_id', $foInformaciok->termekcsalad_id)
        ->value('leiras') ?: 'Nincs leírás ehhez a termékcsaládhoz.';

        return view('karora_reszletes_info', compact('foInformaciok', 'egyebJellemzok', 'kepek', 'termekcsaladLeirasStr'));
    }
}