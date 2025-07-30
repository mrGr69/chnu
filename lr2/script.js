// Получаем элементы
const square = document.getElementById('square');
const coordinates = document.getElementById('coordinates');

// Добавляем обработчик события для движения мыши
square.addEventListener('mousemove', (event) => {
  // Получаем координаты квадрата относительно окна
  const rect = square.getBoundingClientRect();

  // Вычисляем координаты курсора относительно квадрата
  const x = Math.floor(event.clientX - rect.left);
  const y = Math.floor(event.clientY - rect.top);

  // Обновляем текст с координатами
  coordinates.textContent = `Координаты: x = ${x}, y = ${y}`;
});

// Сброс координат, если курсор покидает квадрат
square.addEventListener('mouseleave', () => {
  coordinates.textContent = 'Координаты: x = 0, y = 0';
});


const moveRightBtn = document.getElementById('move-right');
const moveLeftBtn = document.getElementById('move-left');
const leftList = document.getElementById('left-list');
const rightList = document.getElementById('right-list');

// Функция перемещения выделенных элементов
function moveItems(fromList, toList) {
  const checkboxes = fromList.querySelectorAll('input[type="checkbox"]:checked');

  checkboxes.forEach(checkbox => {
    const parentItem = checkbox.parentElement; // Родительский элемент <li>
    checkbox.checked = false; // Снимаем отметку
    toList.appendChild(parentItem); // Перемещаем <li> в другой список
  });

  // Сортируем элементы в списке, чтобы сохранить исходный порядок
  sortList(toList);
}

// Функция сортировки списка
function sortList(list) {
  const items = Array.from(list.children); // Получаем все <li> в списке
  items.sort((a, b) => {
    const valueA = a.querySelector('input').value; // Значение input в <li>
    const valueB = b.querySelector('input').value;
    return valueA.localeCompare(valueB); // Сравниваем строки (алфавитный порядок)
  });

  // Добавляем элементы в список заново в правильном порядке
  items.forEach(item => list.appendChild(item));
}

// Событие для кнопки ">>"
moveRightBtn.addEventListener('click', () => {
  moveItems(leftList, rightList);
});

// Событие для кнопки "<<"
moveLeftBtn.addEventListener('click', () => {
  moveItems(rightList, leftList);
});


// block 3

const binaryInput = document.getElementById('grid-binary-input');
const dynamicGrid = document.getElementById('dynamic-grid');

binaryInput.addEventListener('input', () => {
  const binaryData = binaryInput.value.trim(); // Убираем лишние пробелы
  generateGrid(binaryData);
});

function generateGrid(binaryData) {
  dynamicGrid.innerHTML = ''; // Очищаем старую сетку

  const rows = binaryData.split('\n'); // Делим введённые данные на строки

  rows.forEach(row => {
    const rowLength = row.length; // Длина строки
    dynamicGrid.style.gridTemplateColumns = `repeat(${rowLength}, 30px)`; // Устанавливаем количество колонок для текущей строки

    row.split('').forEach(char => {
      if (char === '1' || char === '0') {
        const square = document.createElement('div');
        square.classList.add('grid-square', char === '1' ? 'black' : 'white');
        dynamicGrid.appendChild(square);
      }
    });

    // Разделяем строки визуально: после каждой строки добавляем "пустую строку"
    if (row !== rows[rows.length - 1]) {
      const spacer = document.createElement('div');
      spacer.style.height = '5px'; // Разделение между строками
      spacer.style.gridColumn = `1 / span ${rowLength}`; // Растягиваем разделитель по всей строке
      dynamicGrid.appendChild(spacer);
    }
  });
}

