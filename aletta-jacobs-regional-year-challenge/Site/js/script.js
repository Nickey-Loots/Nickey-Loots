let vraagTekst = document.getElementById("vraagTekst");
let antwoord1 = document.getElementById("antwoord1");
let antwoord2 = document.getElementById("antwoord2");
let antwoord3 = document.getElementById("antwoord3");
let antwoord4 = document.getElementById("antwoord4");
let antwoord1Balk = document.getElementById("antwoord1Balk");
let antwoord2Balk = document.getElementById("antwoord2Balk");
let antwoord3Balk = document.getElementById("antwoord3Balk");
let antwoord4Balk = document.getElementById("antwoord4Balk");
let terug = document.getElementById("terug");
let volgende = document.getElementById("volgende");
let vraagAantal = document.getElementById("vraagAantal");
let getalvraag = 1;
vraagAantal.innerHTML = getalvraag + "/15"

async function getData() {
    const response = await fetch('./data/Participants_Aggregated_Zipcode.json');
    const data = await response.json();
    console.log(data.data[0]);
    for (let i = 0; i < data.data.length; i++) {
        console.log(data.data[i]);
    }
}

getData();

function checkActief() {
    if (antwoord1Balk.classList.contains("actief")) {
        antwoord1Balk.style.backgroundColor = "red";
    } else if (antwoord2Balk.classList.contains("actief")) {
        antwoord2Balk.style.backgroundColor = "red";
    } else if (antwoord3Balk.classList.contains("actief")) {
        antwoord3Balk.style.backgroundColor = "red";
    } else if (antwoord4Balk.classList.contains("actief")) {
        antwoord4Balk.style.backgroundColor = "red";
    } else {
        resetAlleBalken();
    }
}

// Functie om alle balken te resetten naar de niet-actieve toestand
function resetAlleBalken() {
    antwoord1Balk.classList.remove("actief");
    antwoord2Balk.classList.remove("actief");
    antwoord3Balk.classList.remove("actief");
    antwoord4Balk.classList.remove("actief");
    antwoord1Balk.style.backgroundColor = "blue";
    antwoord2Balk.style.backgroundColor = "blue";
    antwoord3Balk.style.backgroundColor = "blue";
    antwoord4Balk.style.backgroundColor = "blue";
}

terug.addEventListener("click", function () {
    terugButton();
});

volgende.addEventListener("click", function () {
    volgendeButton();
});



function terugButton() {
    if (getalvraag > 0) {
        getalvraag--;
        vraagAantal.innerHTML = getalvraag + "/15";
    }
    vraagSwitch();
}

function volgendeButton() {
    if (getalvraag < 15) {
        getalvraag++;
        vraagAantal.innerHTML = getalvraag + "/15";
    }
    vraagSwitch();
}

function vraag1() {
    vraagTekst.innerHTML = "Hoe voel je je over het algemeen op dit moment?";

    antwoord1.innerHTML = " Heel goed";
    antwoord2.innerHTML = "Redelijk goed";
    antwoord3.innerHTML = "Neutraal";
    antwoord4.innerHTML = "Niet zo goed";
}
vraag1();

function vraag2() {
    vraagTekst.innerHTML = "Hoe vaak ervaar je gevoelens van stress in je dagelijks leven?";

    antwoord1.innerHTML = "Zelden";
    antwoord2.innerHTML = "Af en toe";
    antwoord3.innerHTML = "Vaak";
    antwoord4.innerHTML = "Voortdurend";
    antwoord3Balk.style.display = "block";
    antwoord3.style.display = "block";
    antwoord4Balk.style.display = "block";
    antwoord4.style.display = "block";
}

function vraag3() {
    vraagTekst.innerHTML = "Heb je de afgelopen tijd veranderingen in je slaappatroon opgemerkt?";
    antwoord1.innerHTML = "Nee";
    antwoord2.innerHTML = "Een beetje";
    antwoord3.innerHTML = " Ja, behoorlijk wat"
    antwoord4.innerHTML = "Ja, heel veel";

}

function vraag4() {
    vraagTekst.innerHTML = "Voel je je comfortabel om met vrienden of familie over je emoties te praten?";
    antwoord1.innerHTML = "Altijd";
    antwoord2.innerHTML = "Meestal";
    antwoord3.innerHTML = "Soms";
    antwoord4.innerHTML = "zelden";
}

function vraag5() {
    vraagTekst.innerHTML = "Heb je de afgelopen maanden interesse verloren in activiteiten die je vroeger leuk vond?";

    antwoord1.innerHTML = "Nee";
    antwoord2.innerHTML = "Een beetje";
    antwoord3.innerHTML = "Ja, behoorlijk wat";
    antwoord4.innerHTML = "Ja, volledig";
}

function vraag6() {
    vraagTekst.innerHTML = "Merk je dat je moeite hebt om je te concentreren op taken of activiteiten?";

    antwoord1.innerHTML = "Zelden";
    antwoord2.innerHTML = "Af en toe";
    antwoord3.innerHTML = "Vaak";
    antwoord4.innerHTML = "Altijd";
}

function vraag7() {
    vraagTekst.innerHTML = "Voel je je vaak overweldigd door de eisen van het dagelijks leven?";

    antwoord1.innerHTML = "zelden";
    antwoord2.innerHTML = "Af en toe";
    antwoord3.innerHTML = "Vaak";
    antwoord4.innerHTML = "Voortdurend";
}

function vraag8() {
    vraagTekst.innerHTML = "Hoe zou je je algemene geestelijke gezondheid beoordelen op een schaal van 1 tot 10?";

    antwoord1.innerHTML = "8-10";
    antwoord2.innerHTML = "6-7";
    antwoord3.innerHTML = "4-5";
    antwoord4.innerHTML = " 1-3";
}

function vraagSwitch() {
    if (getalvraag == 1) {
        vraag1();
    } else if (getalvraag == 2) {
        vraag2();
    } else if (getalvraag == 3) {
        vraag3();
    } else if (getalvraag == 4) {
        vraag4();
    } else if (getalvraag == 5) {
        vraag5();
    } else if (getalvraag == 6) {
        vraag6();
    }
}