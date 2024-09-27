let score = localStorage.getItem("score");

let resultaat = document.getElementById("resultaat");
let info = document.getElementById("info");

async function getData(data) {
    const response = await fetch('./data/Participants_Aggregated_Zipcode.json');
    data = await response.json();
    console.log(data.data[0]);
    let dataSet = data.data[0];

    let somSleep = 0;
    let somMental = 0;

    for (let i = 0; i < data.data.length; i++) {
        SLEEP_QUALITY = data.data[i].SLEEP_QUALITY;
        MENTAL_DISORDER_T1 = data.data[i].MENTAL_DISORDER_T1;
        somSleep += SLEEP_QUALITY;
        somMental += MENTAL_DISORDER_T1;
    }

    let gemiddeldeSlaap = somSleep / data.data.length;
    let gemiddeldeMental = somMental / data.data.length;

    let gemiddeldeSlaapAfgerond = gemiddeldeSlaap.toFixed(2);
    let gemiddeldeMentalAfgerond = gemiddeldeMental.toFixed(2);

    localStorage.setItem("slaap", gemiddeldeSlaapAfgerond);
    localStorage.setItem("mental", gemiddeldeMentalAfgerond);


}
getData();

let sleepData = localStorage.getItem("slaap");
let mentalData = localStorage.getItem("mental");

let sleep = document.createElement("p");
sleep.innerHTML = "Slaap is erg belangrijk voor je mentale gezondheid, probeer elke dag 8 uur te slapen.";

let sleepdata = document.createElement("p");
sleepdata.innerHTML = "Gemiddeld slaap kwaliteit van mensen die hebben meegedaan met een lifelines onderzoek is: " + sleepData + "%";
sleepdata.classList.add("text-center", "bg-cyan-400", "text-white", "p-2", "rounded", "my-2");

let mental = document.createElement("p");
mental.innerHTML = "Mensen met een mentale stoornis hebben een grotere kans op een depressie.";
let mentalDataTekst = document.createElement("p");
mentalDataTekst.innerHTML = "Gemiddelde procent mentale stoornis onder de mensen die hebben meegedaan met een lifelines onderzoek is: " + mentalData + "%";
mentalDataTekst.classList.add("text-center", "bg-cyan-400", "text-white", "p-2", "rounded", "my-2");

info.appendChild(sleep);
info.appendChild(sleepdata);
info.appendChild(mental);
info.appendChild(mentalDataTekst);

if (score == 0) {
    resultaat.innerHTML = "Volgens jou antwoorden ben je gelukkig ga zo door!";

} else if (score > 17) {
    resultaat.innerHTML = "Volgens jou antwoorden ben je ongelukkig, misschien is het een goed idee om met iemand te praten.";
} else if (score > 10 && score < 17) {
    resultaat.innerHTML = "Volgens jou antwoorden ben je een beetje ongelukkig, misschien is het een goed idee om met iemand te praten.";
} else if (score > 5 && score < 10) {
    resultaat.innerHTML = "Volgens jou antwoorden ben je een beetje gelukkig, ga zo door!";
} else if (score > 0 && score < 5) {
    resultaat.innerHTML = "Volgens jou antwoorden ben je gelukkig, ga zo door!";
} else {
    resultaat.innerHTML = "Er is iets mis gegaan, probeer het opnieuw.";
}
