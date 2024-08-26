document.addEventListener('DOMContentLoaded', function() {
    const reservationDateInput = document.getElementById('reservationDate');
    const reservationContent = document.getElementById('reservationContent');
    const selectedTableElement = document.getElementById('selectedTable');
    const reserveBtn = document.getElementById('reserveBtn');
    const totalP = document.getElementById('total');
    let selectedTableId = null;
    let selectedDishes = [];
    let total = 0;

    const userId = document.querySelector('script[data-user-id]').getAttribute('data-user-id');

    reservationDateInput.addEventListener('change', function() {
        const selectedDate = this.value;
        if (selectedDate) {
            fetch(`check_tables.php?date=${selectedDate}`)
            .then(response => response.json())
            .then(data => {
                const tableLayout = document.getElementById('tableLayout');
                tableLayout.innerHTML = '';
                reservationContent.style.display = 'block';
                
                const tableChairs = {
                    't1': 4,
                    't2': 6,
                    't3': 2,
                    't4': 8,
                    't5': 3,
                    't6': 5
                };
                
                for (let tableId in tableChairs) {
                    const tableDiv = document.createElement('div');
                    tableDiv.className = 'table';
                    tableDiv.id = tableId;
                    tableDiv.innerHTML = `<p>${tableId}<br>(${tableChairs[tableId]} chairs)</p>`;
                    
                    if (data.bookedTables.includes(tableId)) {
                        tableDiv.classList.add('booked');
                        tableDiv.style.pointerEvents = 'none';
                        tableDiv.style.opacity = '0.5';
                    } else {
                        tableDiv.addEventListener('click', function() {
                            document.querySelectorAll('.table').forEach(t => t.classList.remove('selected'));
                            this.classList.add('selected');
                            selectedTableId = this.id;
                            selectedTableElement.textContent = `Selected Table: ${this.id} (Chairs: ${tableChairs[this.id]})`;
                        });
                    }
                    
                    tableLayout.appendChild(tableDiv);
                }
            });
        }
    });

    window.selectDish = function(dishName, dishPrice) {
        selectedDishes.push({ name: dishName, price: dishPrice });
        displaySelectedDishes();
    };

    function displaySelectedDishes() {
        const selectedDishesContainer = document.getElementById('selectedDishes');
        selectedDishesContainer.innerHTML = '';
        total = 0;
        selectedDishes.forEach((dish, index) => {
            const dishElement = document.createElement('div');
            dishElement.className = 'selected-dish';
            dishElement.innerHTML = `
                <p>${dish.name} - Rs. ${dish.price}</p>
                <button type="button" onclick="removeDish(${index})">Remove</button>
            `;
            selectedDishesContainer.appendChild(dishElement);
            total += dish.price;
        });
        totalP.textContent = `Total = Rs. ${total}`;
    }

    window.removeDish = function(index) {
        selectedDishes.splice(index, 1);
        displaySelectedDishes();
    };

    reserveBtn.addEventListener('click', function() {
        if (!selectedTableId) {
            alert('Please select a table.');
            return;
        }
        if (selectedDishes.length === 0) {
            alert('Please select at least one dish.');
            return;
        }

        const reservationData = {
            tableId: selectedTableId,
            dishes: selectedDishes.map(dish => dish.name).join(', '),
            total: total,
            userId: userId,
            time: new Date().toLocaleTimeString('en-GB'),
            date: reservationDateInput.value
        };

        fetch('make_reservation.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams(reservationData)
        })
        .then(response => response.text())
        .then(result => {
            if (result.trim() === 'Reservation successful!') {
                alert('Reservation successful!');
                window.location.reload();
            } else {
                alert('Reservation failed. Please try again.');
            }
        });
    });
});
