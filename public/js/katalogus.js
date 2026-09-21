const szures_form = document.getElementById('szures_form');
const szamlap_tipusok_hidden = document.getElementById('szamlap_tipusok_hidden');
const szerkezet_tipusok_hidden = document.getElementById('szerkezet_tipusok_hidden');
const tok_anyagok_hidden = document.getElementById('tok_anyagok_hidden');
const szij_anyagok_hidden = document.getElementById('szij_anyagok_hidden');
const uveglap_anyagok_hidden = document.getElementById('uveglap_anyagok_hidden');
const vizallosagok_hidden = document.getElementById('vizallosagok_hidden');
const meretek_hidden = document.getElementById('meretek_hidden');
const min_szelesseg_mm = document.getElementById('min_szelesseg_mm');
const max_szelesseg_mm = document.getElementById('max_szelesseg_mm');
const min_magassag_mm = document.getElementById('min_magassag_mm');
const max_magassag_mm = document.getElementById('max_magassag_mm');
const min_vastagsag_mm = document.getElementById('min_vastagsag_mm');
const max_vastagsag_mm = document.getElementById('max_vastagsag_mm');
const nev_text = document.getElementById('nev');
const nev_szuro_torlese_gomb = document.getElementById('nev_szuro_torlese_gomb');
const szamlap_tipus_szurok_torlese_gomb = document.getElementById('szamlap_tipus_szurok_torlese_gomb');
const szerkezet_tipus_szurok_torlese_gomb = document.getElementById('szerkezet_tipus_szurok_torlese_gomb');
const tok_anyag_szurok_torlese_gomb = document.getElementById('tok_anyag_szurok_torlese_gomb');
const szij_anyag_szurok_torlese_gomb = document.getElementById('szij_anyag_szurok_torlese_gomb');
const uveglap_anyag_szurok_torlese_gomb = document.getElementById('uveglap_anyag_szurok_torlese_gomb');
const vizallosag_szurok_torlese_gomb = document.getElementById('vizallosag_szurok_torlese_gomb');
const meret_szurok_torlese_gomb = document.getElementById('meret_szurok_torlese_gomb');
const kereses_a_megadott_szurokkel_gomb = document.getElementById('kereses_a_megadott_szurokkel_gomb');
const osszes_szuro_torlese_gomb = document.getElementById('osszes_szuro_torlese_gomb');

const szuro_torles_gomb_erintett_checkbox_osztaly_map = new Map([
    [nev_szuro_torlese_gomb, 'nev_text'],
    [osszes_szuro_torlese_gomb, 'szures_input'],
    [szamlap_tipus_szurok_torlese_gomb, 'szamlap_tipus_checkbox'],
    [szerkezet_tipus_szurok_torlese_gomb, 'szerkezet_tipus_checkbox'],
    [tok_anyag_szurok_torlese_gomb, 'tok_anyag_checkbox'],
    [szij_anyag_szurok_torlese_gomb, 'szij_anyag_checkbox'],
    [uveglap_anyag_szurok_torlese_gomb, 'uveglap_anyag_checkbox'],
    [vizallosag_szurok_torlese_gomb, 'vizallosag_checkbox'],
    [meret_szurok_torlese_gomb, 'meret_number']
]);

nev_text.addEventListener('keydown', (event) => {
    if (event.key !== 'Enter')
        return;

    event.preventDefault();

    szures_form.dispatchEvent(new Event('submit'));
});

szures_form.querySelectorAll('button').forEach((button) => {
    if (button === kereses_a_megadott_szurokkel_gomb)
        return;

    button.addEventListener('click', (event) => {
        event.preventDefault();
    });
});

szures_form.addEventListener('submit', (event) => {
    event.preventDefault();

    szamlap_tipusok_hidden.value = Array.from(document.querySelectorAll('.szamlap_tipus_checkbox')).filter(cb => cb.checked).map(cb => cb.value).join(',');
    szerkezet_tipusok_hidden.value = Array.from(document.querySelectorAll('.szerkezet_tipus_checkbox')).filter(cb => cb.checked).map(cb => cb.value).join(',');
    tok_anyagok_hidden.value = Array.from(document.querySelectorAll('.tok_anyag_checkbox')).filter(cb => cb.checked).map(cb => cb.value).join(',');
    szij_anyagok_hidden.value = Array.from(document.querySelectorAll('.szij_anyag_checkbox')).filter(cb => cb.checked).map(cb => cb.value).join(',');
    uveglap_anyagok_hidden.value = Array.from(document.querySelectorAll('.uveglap_anyag_checkbox')).filter(cb => cb.checked).map(cb => cb.value).join(',');
    vizallosagok_hidden.value = Array.from(document.querySelectorAll('.vizallosag_checkbox')).filter(cb => cb.checked).map(cb => cb.value).join(',');

    szures_form.submit();
});

document.querySelectorAll('.egy_tulajdonsaghoz_tartozo_szurok_torlese_gomb').forEach(szuro_torles_gomb => {
    szuro_torles_gomb.addEventListener('click', () => {
        document.querySelectorAll('.' + szuro_torles_gomb_erintett_checkbox_osztaly_map.get(szuro_torles_gomb)).forEach(tulajdonsag_opcio_input => {
            if (tulajdonsag_opcio_input.type === 'checkbox')
                tulajdonsag_opcio_input.checked = false;
            else if (tulajdonsag_opcio_input.type === 'text' || tulajdonsag_opcio_input.type === 'number')
                tulajdonsag_opcio_input.value = '';
        });

        szuro_torles_gomb.style.display = 'none';
        osszes_szuro_torlese_gomb.style.display = legalabb_egy_input_nem_ures_adott_osztalybol('szures_input') ? 'inline' : 'none';
    });
});

osszes_szuro_torlese_gomb.addEventListener('click', () => {
    document.querySelectorAll('.szures_input').forEach((szuresInput => {
        if (szuresInput.type === 'checkbox') {
            szuresInput.checked = false;
        } else if (szuresInput.type === 'text' || szuresInput.type === 'number') {
            szuresInput.value = '';
        }
    }));

    szuro_torles_gomb_erintett_checkbox_osztaly_map.keys().forEach(szuro_torles_gomb => {
        szuro_torles_gomb.style.display = 'none';
    });
});

for (const [szuro_torles_gomb, szuro_input_elem_osztaly] of szuro_torles_gomb_erintett_checkbox_osztaly_map) {
    document.querySelectorAll('input.' + szuro_input_elem_osztaly).forEach(input_elem => {
        input_elem.addEventListener('change', () => {
            szuro_torles_gomb.style.display = legalabb_egy_input_nem_ures_adott_osztalybol(szuro_input_elem_osztaly) ? 'inline-block' : 'none';
        });
    });
}

document.querySelectorAll('input.szures_input').forEach(input_elem => { //alapból a megfelelő display értékkel rendelkezzenek a szűrőket törlő gombok
    input_elem.dispatchEvent(new Event('change'));
});

function legalabb_egy_input_nem_ures_adott_osztalybol(szuro_osztaly) {
    return Array.from(document.querySelectorAll('input.' + szuro_osztaly)).some(input_elem => {
        return input_elem.type === 'checkbox' && input_elem.checked ||
        input_elem.type === 'text' && input_elem.value !== '' ||
        input_elem.type === 'number' && input_elem.value !== '';
    })
}

function get_checkboxhoz_tartozo_szurendo_tulajdonsag_osztalynev(szures_checkbox) {
    const szures_checkbox_class_list = szures_checkbox.classList;

    for (const osztaly of szures_checkbox_class_list)
        if (nem_alap_allapotban_levo_egy_tulajdonsag_szurok_db_map.has(osztaly))
            return osztaly;
}