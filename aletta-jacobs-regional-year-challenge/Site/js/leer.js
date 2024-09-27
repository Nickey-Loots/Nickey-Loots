let depressie = document.getElementById("depressie");

async function getData(data) {
    const response = await fetch('./data/Participants_Aggregated_Zipcode.json');
    data = await response.json();
    console.log(data.data[0]);


    let som = 0;

    for (let i = 0; i < data.data.length; i++) {
        DEPRESSION_T1 = data.data[i].DEPRESSION_T1;
        som += DEPRESSION_T1;
        console.log(data.data[i].DEPRESSION_T1);
    }

    let gemiddelde = som / data.data.length;

    let gemiddeldeAfgerond = gemiddelde.toFixed(2);

    let storeGemiddelde = localStorage.setItem("depressie", gemiddeldeAfgerond);


    console.log("Gemiddelde:", gemiddeldeAfgerond);


    depressie.innerHTML = storeGemiddelde + "%";


}



getData();

