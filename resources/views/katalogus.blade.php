@extends('keret')

<link rel="stylesheet" href="{{ asset('css/katalogus.css') }}">
@section('katalogus')

<div id="katalogus">
    <div id="szures">
        <form id="szures_form" method="GET" action="{{ url()->current() }}">
            <label id="nev_szuro_label" for="nev">
                Név:&nbsp;
                <input id="nev" class="szures_input nev_text" type="text" name="nev" value="{{ request('nev') }}">
            </label>

            <button id="nev_szuro_torlese_gomb" class="egy_tulajdonsaghoz_tartozo_szurok_torlese_gomb">Törlés</button>

            <br> <br>

            <details class="szuro-csoport">
                <summary>Számlap típus</summary>
                <div class="szuro-opciok">
                    @foreach($szamlapTipusok as $tipus)
                    <label>
                        <input
                            type="checkbox"
                            class="szamlap_tipus_checkbox szures_input"
                            value="{{ $tipus->szamlap_tipus_id_szuretlen }}"
                            {{ in_array($tipus->szamlap_tipus_id_szuretlen, explode(',', request('szamlapTipusok', ''))) ? 'checked' : '' }}
                        >
                        {{ $tipus->szamlap_tipus_nev_szuretlen }}
                    </label>
                    <br>
                    @endforeach
                    <button id="szamlap_tipus_szurok_torlese_gomb" class="egy_tulajdonsaghoz_tartozo_szurok_torlese_gomb">Szűrők törlése</button>
                </div>
            </details>

            <input type="hidden" name="szamlapTipusok" id="szamlap_tipusok_hidden" value="">

            <br>

            <details class="szuro-csoport">
                <summary>Szerkezet típus</summary>
                <div class="szuro-opciok">
                    @foreach($szerkezetTipusok as $tipus)
                    <label>
                        <input 
                            type="checkbox"
                            class="szerkezet_tipus_checkbox szures_input"
                            value="{{ $tipus->szerkezet_tipus_id_szuretlen }}"
                            {{ in_array($tipus->szerkezet_tipus_id_szuretlen, explode(',', request('szerkezetTipusok', ''))) ? 'checked' : '' }}
                        >
                        {{ $tipus->szerkezet_tipus_nev_szuretlen }}
                    </label>
                    <br>
                    @endforeach
                    <button id="szerkezet_tipus_szurok_torlese_gomb" class="egy_tulajdonsaghoz_tartozo_szurok_torlese_gomb">Szűrők törlése</button>
                </div>
            </details>

            <input type="hidden" name="szerkezetTipusok" id="szerkezet_tipusok_hidden" value="">

            <br>

            <details class="szuro-csoport">
                <summary>Tok anyaga</summary>
                <div class="szuro-opciok">
                    @foreach($tokAnyagok as $tipus)
                    <label>
                        <input 
                            type="checkbox"
                            class="tok_anyag_checkbox szures_input"
                            value="{{ $tipus->tok_anyag_id_szuretlen }}"
                            {{ in_array($tipus->tok_anyag_id_szuretlen, explode(',', request('tokAnyagok', ''))) ? 'checked' : '' }}
                        >
                        {{ $tipus->tok_anyag_nev_szuretlen }}
                    </label>
                    <br>
                    @endforeach
                    <button id="tok_anyag_szurok_torlese_gomb" class="egy_tulajdonsaghoz_tartozo_szurok_torlese_gomb">Szűrők törlése</button>
                </div>
            </details>

            <input type="hidden" name="tokAnyagok" id="tok_anyagok_hidden" value="">

            <br>

            <details class="szuro-csoport">
                <summary>Szíj anyaga</summary>
                <div class="szuro-opciok">
                    @foreach($szijAnyagok as $tipus)
                    <label>
                        <input 
                            type="checkbox"
                            class="szij_anyag_checkbox szures_input"
                            value="{{ $tipus->szij_anyag_id_szuretlen }}"
                            {{ in_array($tipus->szij_anyag_id_szuretlen, explode(',', request('szijAnyagok', ''))) ? 'checked' : '' }}
                        >
                        {{ $tipus->szij_anyag_nev_szuretlen }}
                    </label>
                    <br>
                    @endforeach
                    <button id="szij_anyag_szurok_torlese_gomb" class="egy_tulajdonsaghoz_tartozo_szurok_torlese_gomb">Szűrők törlése</button>
                </div>
            </details>

            <input type="hidden" name="szijAnyagok" id="szij_anyagok_hidden" value="">

            <br>

            <details class="szuro-csoport">
                <summary>Üveglap anyaga</summary>
                <div class="szuro-opciok">
                    @foreach($uveglapAnyagok as $tipus)
                    <label>
                        <input 
                            type="checkbox"
                            class="uveglap_anyag_checkbox szures_input"
                            value="{{ $tipus->uveglap_anyag_id_szuretlen }}"
                            {{ in_array($tipus->uveglap_anyag_id_szuretlen, explode(',', request('uveglapAnyagok', ''))) ? 'checked' : '' }}
                        >
                        {{ $tipus->uveglap_anyag_nev_szuretlen }}
                    </label>
                    <br>
                    @endforeach
                    <button id="uveglap_anyag_szurok_torlese_gomb" class="egy_tulajdonsaghoz_tartozo_szurok_torlese_gomb">Szűrők törlése</button>
                </div>
            </details>

            <input type="hidden" name="uveglapAnyagok" id="uveglap_anyagok_hidden" value="">

            <br>

            <details class="szuro-csoport">
                <summary>Vízállóság</summary>
                <div class="szuro-opciok">
                    @foreach($vizallosagok as $tipus)
                    <label>
                        <input 
                            type="checkbox"
                            class="vizallosag_checkbox szures_input"
                            value="{{ $tipus->vizallosag_id_szuretlen }}"
                            {{ in_array($tipus->vizallosag_id_szuretlen, explode(',', request('vizallosagok', ''))) ? 'checked' : '' }}
                        >
                        {{ $tipus->vizallosag_nev_szuretlen }}
                    </label>
                    <br>
                    @endforeach
                    <button id="vizallosag_szurok_torlese_gomb" class="egy_tulajdonsaghoz_tartozo_szurok_torlese_gomb">Szűrők törlése</button>
                </div>
            </details>

            <input type="hidden" name="vizallosagok" id="vizallosagok_hidden" value="">

            <br>

            <details class="szuro-csoport">
                <summary>Méretek</summary>
                <div class="szuro-opciok">
                    <label>
                        Szélesség:

                        <br>

                        <input 
                            type="number"
                            name="minSzelessegMm"
                            id="minSzelessegMm"
                            value="{{ request('minSzelessegMm') }}"
                            min="0"
                            placeholder="Min."
                            class="meret_number szures_input"
                        >
                        -
                        <input 
                            type="number"
                            name="maxSzelessegMm"
                            id="maxSzelessegMm"
                            value="{{ request('maxSzelessegMm') }}"
                            min="0"
                            placeholder="Max."
                            class="meret_number szures_input"
                        >
                        mm
                    </label>

                    <br> <br>

                    <label>
                        Magasság:

                        <br>

                        <input 
                            type="number"
                            name="minMagassagMm"
                            id="minMagassagMm"
                            value="{{ request('minMagassagMm') }}"
                            min="0"
                            placeholder="Min."
                            class="meret_number szures_input"
                        >
                        -
                        <input 
                            type="number"
                            name="maxMagassagMm"
                            id="maxMagassagMm"
                            value="{{ request('maxMagassagMm') }}"
                            min="0"
                            placeholder="Max."
                            class="meret_number szures_input"
                        >
                        mm
                    </label>

                    <br> <br>

                    <label>
                        Vastagság:

                        <br>

                        <input 
                            type="number"
                            name="minVastagsagMm"
                            id="minVastagsagMm"
                            value="{{ request('minVastagsagMm') }}"
                            min="0"
                            placeholder="Min."
                            class="meret_number szures_input"
                        >
                        -
                        <input 
                            type="number"
                            name="maxVastagsagMm"
                            id="maxVastagsagMm"
                            value="{{ request('maxVastagsagMm') }}"
                            min="0"
                            placeholder="Max."
                            class="meret_number szures_input"
                        >
                        mm
                    </label>

                    <br>

                    <button id="meret_szurok_torlese_gomb" class="egy_tulajdonsaghoz_tartozo_szurok_torlese_gomb">Szűrők törlése</button>
                </div>
            </details>

            <input type="hidden" name="meretek" id="meretek_hidden" value="">

            <br> <br>

            <button id="kereses_a_megadott_szurokkel_gomb" type="submit" class="largeSzoveg">Keresés a megadott szűrőkkel</button>
        </form>

        <button id="osszes_szuro_torlese_gomb" class="largeSzoveg">Összes szűrő törlése</button>
    </div>

    <div>

    <p>{{ $megjelenitendoKarorak->count() }} találat</p>

    @foreach($megjelenitendoKarorak as $megjelenitendoKarora)

    @php
    $foKep = $foKepek[$megjelenitendoKarora->karora_id] ?? null;
    @endphp

    <div id="karoraListaelem">
        <div>
            <a href="{{ '/karora/' . $megjelenitendoKarora->karora_id }}">
                <img class="katalogusElonezetKep" src="{{ asset('img/' . ($foKep->kep_nev ?? 'placeholder.png')) }}" alt="{{ $megjelenitendoKarora->karora_nev}}">
            </a>
        </div>
        <div>
            <a href="{{ '/karora/' . $megjelenitendoKarora->karora_id }}"><p class="xLargeSzoveg">{{ $megjelenitendoKarora->karora_nev }}</p></a>
            <table class="katalogusAdatokTable">
                <tr>
                    <td>Gyártó: {{ $megjelenitendoKarora->gyarto_nev }}</td>
                    <td>Szíj anyaga: {{ $megjelenitendoKarora->szij_anyag_nev }}</td>
                </tr>

                <tr>
                    <td>Számlap típusa: {{ $megjelenitendoKarora->szamlap_tipus_nev }}</td>
                    <td>Üveglap anyaga: {{ $megjelenitendoKarora->uveglap_anyag_nev }}</td>
                </tr>

                <tr>
                    <td>Szerkezet típusa: {{ $megjelenitendoKarora->szerkezet_tipus_nev }}</td>
                    <td>Vízállóság: {{ $megjelenitendoKarora->vizallosag_nev }}</td>
                </tr>

                <tr>
                    <td>Tok anyaga: {{ $megjelenitendoKarora->tok_anyag_nev }}</td>
                </tr>
            </table>
        </div>
    </div>
    @endforeach
    </div>
</div>

<script src="{{ asset('js/katalogus.js') }}"></script>

@endsection