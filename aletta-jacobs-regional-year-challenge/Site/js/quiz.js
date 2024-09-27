const vragen = [
    {
        vraag: "Hoe voel je je over het algemeen op dit moment?",
        antwoord: [
            { a: "Heel goed", waarde: 0 },
            { b: "Redelijk goed", waarde: 0 },
            { c: "Niet zo goed", waarde: 1 },
            { d: "Slecht", waarde: 2 },
        ],
    },
    {
        vraag: "Hoe vaak ervaar je gevoelens van stress in je dagelijks leven?",
        antwoord: [
            { a: "Zelden", waarde: 0 },
            { b: "Af en toe", waarde: 1 },
            { c: "Vaak", waarde: 2 },
            { d: "Voortdurend", waarde: 3 },
        ],
    },
    {
        vraag: "Heb je de afgelopen tijd veranderingen in je slaappatroon opgemerkt?",
        antwoord: [
            { a: "Nee", waarde: 0 },
            { b: "Een beetje", waarde: 1 },
            { c: "Ja, behoorlijk wat", waarde: 2 },
            { d: "Ja, heel veel", waarde: 3 },
        ],
    },
    {
        vraag: "Voel je je comfortabel om met vrienden of familie over je emoties te praten?",
        antwoord: [
            { a: "Ja, altijd", waarde: 0 },
            { b: "Ja, meestal", waarde: 1 },
            { c: "Soms", waarde: 2 },
            { d: "Bijna Nooit", waarde: 3 },
        ],
    },
    {
        vraag: "Heb je de afgelopen maanden interesse verloren in activiteiten die je vroeger leuk vond?",
        antwoord: [
            { a: "Nee", waarde: 0 },
            { b: "Een beetje", waarde: 1 },
            { c: "Ja, behoorlijk wat", waarde: 2 },
            { d: "Ja, heel veel", waarde: 3 },
        ]
    },
    {
        vraag: "Merk je dat je moeite hebt om je te concentreren op taken of activiteiten?",
        antwoord: [
            { a: "Bijna Nooit", waarde: 0 },
            { b: "Af en toe", waarde: 1 },
            { c: "Vaak", waarde: 2 },
            { d: "Altijd", waarde: 3 },
        ]
    },
    {
        vraag: "Voel je je vaak overweldigd door de eisen van het dagelijks leven?",
        antwoord: [
            { a: "Bijna nooit", waarde: 0 },
            { b: "Af en toe", waarde: 1 },
            { c: "Vaak", waarde: 2 },
            { d: "Voordurend", waarde: 3 },
        ]
    },
    {
        vraag: "Hoe zou je je algemene geestelijke gezondheid beoordelen op een schaal van 1 tot 10?",
        antwoord: [
            { a: "8-10", waarde: 0 },
            { b: "6-7", waarde: 1 },
            { c: "4-5", waarde: 2 },
            { d: "1-3", waarde: 3 },
        ]
    }
]

let vraagTekst = document.getElementById("vraagTekst");
let antwoord1 = document.getElementById("antwoord1");
let antwoord2 = document.getElementById("antwoord2");
let antwoord3 = document.getElementById("antwoord3");
let antwoord4 = document.getElementById("antwoord4");
let Button1 = document.getElementById("buton1");
let Button2 = document.getElementById("buton2");
let Button3 = document.getElementById("buton3");
let Button4 = document.getElementById("buton4");
// let terugButton = document.getElementById("terug");
let volgendeButton = document.getElementById("volgende");
let vraagAantal = document.getElementById("vraagAantal");

let getalvraag = 0;
let geselecteerdAntwoord = null;

vraagAantal.innerHTML = getalvraag + "/" + vragen.length;

vragen.forEach(vraag => {
    vraag.geselecteerdeWaarde = null;
});


function vraagSwitch() {
    vraagTekst.innerHTML = vragen[getalvraag].vraag;
    antwoord1.innerHTML = vragen[getalvraag].antwoord[0].a;
    antwoord2.innerHTML = vragen[getalvraag].antwoord[1].b;
    antwoord3.innerHTML = vragen[getalvraag].antwoord[2].c;
    antwoord4.innerHTML = vragen[getalvraag].antwoord[3].d;
    resetAntwoordStijl();
}

vraagSwitch();

function resetAntwoordStijl() {
    [Button1, Button2, Button3, Button4].forEach(button => {
        button.classList.remove("bg-blue-500");
    });
}

function selecteerAntwoord(antwoord, button) {
    geselecteerdAntwoord = antwoord;
    vragen[getalvraag].geselecteerdeWaarde = geselecteerdAntwoord.waarde;
    console.log(vragen[getalvraag].geselecteerdeWaarde);
    resetAntwoordStijl();
    button.classList.add("bg-blue-500");
}

volgendeButton.addEventListener("click", function () {
    if (geselecteerdAntwoord !== null) {
        totaleScore += geselecteerdAntwoord.waarde;
    }
    volgende();
});

// terugButton.addEventListener("click", function () {
//     terug();
// });

Button1.addEventListener("click", function () {
    selecteerAntwoord(vragen[getalvraag].antwoord[0], Button1);
});
Button2.addEventListener("click", function () {
    selecteerAntwoord(vragen[getalvraag].antwoord[1], Button2);
});
Button3.addEventListener("click", function () {
    selecteerAntwoord(vragen[getalvraag].antwoord[2], Button3);
});
Button4.addEventListener("click", function () {
    selecteerAntwoord(vragen[getalvraag].antwoord[3], Button4);
});

let totaleScore = 0;


function volgende() {
    if (getalvraag < vragen.length - 1) {
        getalvraag++;
        vraagAantal.innerHTML = getalvraag + 1 + "/" + vragen.length;
        resetAntwoordStijl();
    } else {
        console.log("Totale Score:", totaleScore);
        localStorage.setItem("score", totaleScore);
        window.location.href = "resultaten.html";
    }
    vraagSwitch();
}

// function terug() {
//     if (getalvraag > 0) {
//         getalvraag--;
//         vraagAantal.innerHTML = getalvraag + "/15";
//         resetAntwoordStijl();
//     }
//     vraagSwitch();
// }

