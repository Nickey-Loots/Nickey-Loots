
const infobox = document.querySelector('#info_box')
const div = document.querySelector('#ingredients');
const image_folder = "./media/dd-fotos/";



async function fetchIngredients() {
    const res = await fetch('./db/ingredients.json');
    const data = await res.json();

    return data.ingredients;
}

async function createIngredients() {

    const ingredients = await fetchIngredients();

    ingredients.forEach((ingredient, key) => {
        const ingredientDiv = document.createElement('div');
        ingredientDiv.classList.add('ingredient', 'grayscale', 'w-1/4', 'lg:w-1/5', 'p-1', 'lg:p-4' , 'transition-all', 'duration-300');
        ingredientDiv.innerHTML = `<img src=\"${image_folder + ingredient.image_url}\" class=\"w-full object-cover rounded-full border-primary border-2 aspect-square max-w-48 hover:cursor-pointer lg:hover:scale-110 transition-all duration-300 \"><img/>`;

        if(key == 0) {
            fillInfobox(ingredientDiv, ingredient.title, ingredient.text, ingredient.image_url);
        }


        ingredientDiv.addEventListener('click', () => {
            fillInfobox(ingredientDiv, ingredient.title, ingredient.text, ingredient.image_url);
            div.scrollIntoView();
        });
        div.append(ingredientDiv);
    });


    
}

function fillInfobox(div, title, text, img_url) {
    infobox.querySelector('h2').innerHTML = title;
    infobox.querySelector('p').innerHTML = text;
    infobox.querySelector('img').src = "./media/dd-fotos/"+img_url;

    clearStyle();
    div.classList.add('scale-125', 'grayscale-0', 'z-40', 'border-primary');
}

function clearStyle() {
    const ingredientDivs = document.querySelectorAll('.ingredient');
    ingredientDivs.forEach(div => {
        div.classList.remove('scale-125', 'grayscale-0', 'z-40');
    });
}

createIngredients();

