document.addEventListener('DOMContentLoaded', function() {
    loadMenu();
    const addDishForm = document.getElementById('addDishForm');
    addDishForm.addEventListener('submit', function(e) {
        e.preventDefault();
        addDish();
    });
});

function loadMenu() {
    fetch('menu.json')
        .then(response => response.json())
        .then(menu => {
            const menuTableBody = document.querySelector('#menuTable tbody');
            menuTableBody.innerHTML = '';
            Object.keys(menu).forEach(country => {
                menu[country].forEach(dish => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${country}</td>
                        <td>${dish.name}</td>
                        <td>${dish.category}</td>
                        <td>${dish.price}</td>
                        <td>${dish.description}</td>
                        <td>
                            <button onclick="deleteDish('${country}', '${dish.name}')">Delete</button>
                        </td>
                    `;
                    menuTableBody.appendChild(row);
                });
            });
        });
}

function addDish() {
    const country = document.getElementById('country').value;
    const name = document.getElementById('name').value;
    const category = document.getElementById('category').value;
    const price = document.getElementById('price').value;
    const description = document.getElementById('description').value;

    fetch('menu.json')
        .then(response => response.json())
        .then(menu => {
            if (!menu[country]) {
                menu[country] = [];
            }
            menu[country].push({ name, category, price, description, imgsrc: '' });
            
            return fetch('update_menu.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(menu)
            });
        })
        .then(() => {
            loadMenu();
        });
}

function deleteDish(country, name) {
    fetch('update_menu.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ delete: true, country, name })
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);  // Debug log for confirmation
        loadMenu();  // Refresh the menu list
    })
    .catch(error => console.error('Error:', error));
}

document.addEventListener('DOMContentLoaded', function() {
    loadUsers();

    const addUserForm = document.getElementById('addUserForm');
    addUserForm.addEventListener('submit', function(e) {
        e.preventDefault();
        addUser();
    });
});

function loadUsers() {
    fetch('get_users.php')
        .then(response => response.json())
        .then(users => {
            const usersTableBody = document.querySelector('#usersTable tbody');
            usersTableBody.innerHTML = '';
            users.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.username}</td>
                    <td>${user.email}</td>
                    <td>
                        <button onclick="deleteUser(${user.id})">Delete</button>
                        <button onclick="modifyUser(${user.id})">Modify</button>
                    </td>
                `;
                usersTableBody.appendChild(row);
            });
        });
}

function addUser() {
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    fetch('add_user.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, email, password })
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        loadUsers();
    });
}

function deleteUser(id) {
    fetch(`delete_user.php?id=${id}`, {
        method: 'GET'
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        loadUsers();
    });
}