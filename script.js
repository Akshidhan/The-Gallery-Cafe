const promotions = document.getElementById('promotions');
const events = document.getElementById('events');
const sriLankan = document.getElementById('srilankan');
const chinese = document.getElementById('chinese');
const italian = document.getElementById('italian');
const searchBox = document.getElementById('search-bar');
const searchButton = document.getElementById('search-button');
const resultDiv = document.getElementById('searchResult');
const breakfastBtn = document.getElementById('breakfast');
const lunchBtn = document.getElementById('lunch');
const dinnerBtn = document.getElementById('dinner');
const beveragesBtn = document.getElementById('beverages');
const selection = document.getElementById('selection');
const menu = document.getElementById('menu-items');

let toggleStates = {
    togglebf: false,
    togglel: false,
    toggled: false,
    toggleb: false
};

fetch('promotions.json')
    .then(response => response.json())
    .then(data => {
        if(data.length === 0) {
            promotions.innerHTML += `<p class="message">There are no promotions at the moment</p>`;
        } else {
            data.forEach((item) => {
                const imgSrc = item.image;
                const heading = item.heading;
                const content = item.content;

                promotions.innerHTML += `<div class="promo">
                                            <div class="promoImage">
                                                <img src="${imgSrc}">
                                            </div>
                                            <div class="left">
                                                <h3>${heading}</h3>
                                                <p>${content}</p>
                                            </div>
                                        </div>`;
            });
        }
    })
    .catch(error => console.error('Error fetching data:', error));

function displayResult(){
    resultDiv.innerHTML = "";
    selection.innerHTML = "";
    resultDiv.style.display = 'grid';
    menu.style.display = 'none';
}

function displayReset(){
    resultDiv.style.display = 'none';
    resultDiv.innerHTML = "";
    menu.style.display = 'block';
}

function searchCard(item) {
    displayResult();
    resultDiv.innerHTML += `<div class="menuItem">
        <img src="${item.imgsrc}">
        <p class="title">${item.name}</p>
        <p class="price">${item.price}</p>
        <p class="description">${item.description}</p>
      </div>`;
}

function search() {
    const query = searchBox.value.toLowerCase();
    fetch('menu.json')
        .then(response => response.json())
        .then(data => {
            let found = false;

            if (query != ""){
                data.SriLanka.forEach(item => {
                    if (item.name.toLowerCase().includes(query)) {
                        searchCard(item);
                        found = true;
                    }
                });
    
                data.China.forEach(item => {
                    if (item.name.toLowerCase().includes(query)) {
                        searchCard(item);
                        found = true;
                    }
                });
    
                data.Italy.forEach(item => {
                    if (item.name.toLowerCase().includes(query)) {
                        searchCard(item);
                        found = true;
                    }
                });
    
                if (!found) {
                    displayResult();
                    resultDiv.innerHTML += `<p class="message">No result found!</p>`;
                }
            }
            else{
                displayReset();
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

function select(selectionType){
    fetch('menu.json')
        .then(response => response.json())
        .then(data => {
            ['SriLanka', 'China', 'Italy'].forEach(cuisine => {
                data[cuisine].forEach(item => {
                    if (item.category === selectionType) {
                        var name = item.name;
                        var price = item.price;
                        var description = item.description;
                        var image = item.imgsrc;


                        selection.innerHTML += `<div class="menuItem">
                            <img src="${image}">
                            <p class="title">${name}</p>
                            <p class="price">${price}</p>
                            <p class="description">${description}</p>
                        </div>`;
                    }
                });
            });
        })
        .catch(error => console.error('Error fetching data:', error));
}

function toggleCategory(toggle, button, selectionType){
    debugger;
    if (toggleStates[toggle]){
        selection.innerHTML = '';
        selection.style.display = 'none';
        menu.style.display = 'block';
        button.style.backgroundColor = '#FFE0B5';
        button.style.color = 'black';
        toggleStates[toggle] = false;
    }
    else{
        selection.innerHTML = '';
        menu.style.display = 'none';
        selection.style.display = 'grid';
        button.style.backgroundColor = '#5e4634';
        button.style.color = 'white';
        select(selectionType);
        toggleStates[toggle] = true;
    }
}

searchButton.addEventListener('click', search);
breakfastBtn.addEventListener('click', function(){toggleCategory('togglebf', breakfastBtn, 'Breakfast')});
lunchBtn.addEventListener('click', function(){toggleCategory('togglel', lunchBtn, 'Main Course')});
dinnerBtn.addEventListener('click', function(){toggleCategory('toggled', dinnerBtn, 'Dinner')});
beveragesBtn.addEventListener('click', function(){toggleCategory('toggleb', beveragesBtn, 'Beverage')});