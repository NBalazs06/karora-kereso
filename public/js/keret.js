const oldalnev = document.getElementById("oldal-nev");
const oldalnevKarakterDb = oldalnev.innerHTML.length;
const oldalnevSpanElemek = [];
const simaOldalnevKarakterSzin = oldalnev.style.color;
const kiemeltOldalnevKarakterSzin = "red";

oldalnev.innerHTML = oldalnev.innerHTML.split("").map(c => "<span>" + c + "</span>").join("");

oldalnevSpanElemek.push(...Array.from(oldalnev.children));

let i = 0;

setInterval(() => {
    oldalnevSpanElemek[i].style.color = oldalnevSpanElemek[i].style.color === simaOldalnevKarakterSzin ? kiemeltOldalnevKarakterSzin : simaOldalnevKarakterSzin;

    do {
        i = (i + 1) % oldalnevSpanElemek.length;
    } while (oldalnevSpanElemek[i].innerHTML === " ");
}, 1000);