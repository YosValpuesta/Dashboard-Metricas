const draggables = document.querySelectorAll(".task");
const droppables = document.querySelectorAll(".swim-lane");

draggables.forEach((task) => {
    task.addEventListener("dragend", () => {
        task.classList.remove("is-dragging");

        const cardId = task.querySelector(".idHU").textContent;
        const columnId = task.closest('.swim-lane').id;
        localStorage.setItem(cardId, columnId);
    });
});


droppables.forEach((zone) => {
    zone.addEventListener("dragover", (e) => {
        e.preventDefault();

        const bottomTask = insertAboveTask(zone, e.clientY);
        const curTask = document.querySelector(".is-dragging");

        if (!bottomTask) {
            zone.appendChild(curTask);
        } else {
            zone.insertBefore(curTask, bottomTask);
        }
    });
});

const insertAboveTask = (zone, mouseY) => {
    const els = zone.querySelectorAll(".task:not(.is-dragging)");

    let closestTask = null;
    let closestOffset = Number.NEGATIVE_INFINITY;

    els.forEach((task) => {
        const { top } = task.getBoundingClientRect();

        const offset = mouseY - top;

        if (offset < 0 && offset > closestOffset) {
            closestOffset = offset;
            closestTask = task;
        }
    });

    return closestTask;
};

// Función para restaurar la posición de las tarjetas
const restoreCardPositions = () => {
    draggables.forEach((task) => {
        const cardId = task.querySelector(".idHU").textContent;
        const storedColumnId = localStorage.getItem(cardId);

        if (storedColumnId) {
            const targetColumn = document.getElementById(storedColumnId);
            if (targetColumn) {
                targetColumn.appendChild(task);
            }
        }
    });
};

window.addEventListener("load", restoreCardPositions);

