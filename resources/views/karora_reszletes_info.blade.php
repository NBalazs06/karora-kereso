@extends('keret')

<link rel="stylesheet" href="{{ asset('css/karora_reszletes_info.css') }}">
@section('karora_reszletes_info')

<main>
    <div id="caruoselJellemzokTermekcsaladLeiras">
        <div>
            <p id="karoraGyartoNev">{{ $foInformaciok->gyarto_nev }}</p>
            <p id="karoraNev">{{ $foInformaciok->karora_nev }}</p>

            @if(count($kepek) >= 2)
                <div id="karoraCarousel" class="carousel slide">
                    <div class="carousel-indicators">
                        @foreach($kepek as $index => $kep)
                            <button type="button" data-bs-target="#karoraCarousel" data-bs-slide-to="{{ $index }}" 
                                class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" 
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>

                    <div class="carousel-inner">
                        @foreach($kepek as $index => $kep)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('img/' . $kep->kep_nev) }}" class="d-block w-100" alt="{{ $foInformaciok->karora_nev }}" title="{{ $foInformaciok->karora_nev }}">
                            </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#karoraCarousel" data-bs-slide="prev" style="background-color: rgba(0, 0, 0, 0.2); width: 8%;">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Előző</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#karoraCarousel" data-bs-slide="next" style="background-color: rgba(0, 0, 0, 0.2); width: 8%;">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Következő</span>
                    </button>
                </div>

            @elseif(count($kepek) === 1)
                <img src="{{ asset('img/' . $kepek[0]->kep_nev) }}" class="karoraKepNemCarousel d-block w-100"
                alt="{{ $foInformaciok->karora_nev }}" title="{{ $foInformaciok->karora_nev }}">
            @else
                <img src="{{ asset('img/placeholder.png') }}" class="karoraKepNemCarousel d-block w-100"
                alt="{{ $foInformaciok->karora_nev }}" title="{{ $foInformaciok->karora_nev }}">
            @endif
        </div>

        <div>
            <p>Főbb jellemzők:</p>

            <table class="table table-dark table-striped table-bordered w-auto">
                <tr>
                    <th scope="row">Számlap típus</th>
                    <td>{{ $foInformaciok->szamlap_tipus_nev }}</td>
                </tr>
                <tr>
                    <th scope="row">Szerkezet típus</th>
                    <td>{{ $foInformaciok->szerkezet_tipus_nev }}</td>
                </tr>
                <tr>
                    <th scope="row">Vízállóság</th>
                    <td>{{ $foInformaciok->vizallosag_nev }}</td>
                </tr>
                <tr>
                    <th scope="row">Tok anyaga</th>
                    <td>{{ $foInformaciok->tok_anyag_nev }}</td>
                </tr>
                <tr>
                    <th scope="row">Szíj anyaga</th>
                    <td>{{ $foInformaciok->szij_anyag_nev }}</td>
                </tr>
                <tr>
                    <th scope="row">Üveglap anyaga</th>
                    <td>{{ $foInformaciok->uveglap_anyag_nev }}</td>
                </tr>
                <tr>
                    <th scope="row">Szélesség</th>
                    <td>{{ $foInformaciok->karora_szelesseg_mm }} mm</td>
                </tr>
                <tr>
                    <th scope="row">Magasság</th>
                    <td>{{ $foInformaciok->karora_magassag_mm }} mm</td>
                </tr>
                <tr>
                    <th scope="row">Vastagság</th>
                    <td>{{ $foInformaciok->karora_vastagsag_mm }} mm</td>
                </tr>
                <tr>
                    <th scope="row">Pontosság</th>
                    <td>±{{ $foInformaciok->karora_pontossag_mp_per_nap }} mp max. eltérés/nap</td>
                </tr>
                <tr>
                    <th scope="row">Súly</th>
                    <td>{{ $foInformaciok->karora_suly_g }} g</td>
                </tr>
            </table>
        </div>

        <div>
            <p>Egyéb jellemzők:</p>

            @if(count($egyebJellemzok) > 0)
                <ul style="font-size: small;">
                    @foreach($egyebJellemzok as $jellemzo)
                        <li>{{ $jellemzo->egyeb_jellemzok_nev }}</li>
                    @endforeach
                </ul>
            @else
                <p style="font-size: small;">Nem található egyéb jellemző erről a modellről</p>
            @endif
        </div>

        <div id="termekcsaladNevEsInfo">
            <p>Termékcsalád:</p>

            <p style="font-size: small;">
                <a href="/?termekcsaladok={{ $foInformaciok->termekcsalad_id }}">{{ $foInformaciok->termekcsalad_nev }} ({{ $foInformaciok->gyarto_nev }})</a>
            </p>

            <p>Termékcsalád leírása:</p>

            <p style="font-size: small;">{{ $termekcsaladLeirasStr }}</p>
        </div>
    </div>
</main>

@endsection