// Función para agregar HU al tablero
function agregarAlTablero(event) {
    event.preventDefault(); // Evita que el enlace se ejecute por defecto

    const numeroHU = event.target.dataset.numerohu; // Obtiene el número de HU desde el atributo data

    // Crea un nuevo elemento para mostrar la HU en el tablero
    const card = document.createElement('div');
    card.classList.add('card', 'task');
    card.draggable = true;
    card.innerHTML = `
        <div class="card-header">
            <h5>${numeroHU}</h5>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Nombre: ${nombreHU}</li>
            <li class="list-group-item">PH: ${ph}</li>
            <li class="list-group-item">Responsable: ${responsable}</li>
        </ul>
    `;

    // Agrega un evento dragstart para hacer la tarjeta arrastrable
    card.addEventListener("dragstart", () => {
        card.classList.add("is-dragging");
    });

    // Agrega la nueva HU al tablero
    const todoLane = document.getElementById('todo-lane'); // Cambia 'todo-lane' por el ID correcto de tu columna
    todoLane.appendChild(card);
}

