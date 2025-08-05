const square = document.getElementById('square');
const coordinates = document.getElementById('coordinates');

square.addEventListener('mousemove', (event) => {
  const rect = square.getBoundingClientRect();

  const x = Math.floor(event.clientX - rect.left);
  const y = Math.floor(event.clientY - rect.top);

  coordinates.textContent = `Координаты: x = ${x}, y = ${y}`;
});

square.addEventListener('mouseleave', () => {
  coordinates.textContent = 'Координаты: x = 0, y = 0';
});


const moveRightBtn = document.getElementById('move-right');
const moveLeftBtn = document.getElementById('move-left');
const leftList = document.getElementById('left-list');
const rightList = document.getElementById('right-list');

function moveItems(fromList, toList) {
  const checkboxes = fromList.querySelectorAll('input[type="checkbox"]:checked');

  checkboxes.forEach(checkbox => {
    const parentItem = checkbox.parentElement; 
    checkbox.checked = false; 
    toList.appendChild(parentItem); 
  });

  
  sortList(toList);
}

function sortList(list) {
  const items = Array.from(list.children); 
  items.sort((a, b) => {
    const valueA = a.querySelector('input').value; 
    const valueB = b.querySelector('input').value;
    return valueA.localeCompare(valueB); 
  });

 
  items.forEach(item => list.appendChild(item));
}


moveRightBtn.addEventListener('click', () => {
  moveItems(leftList, rightList);
});


moveLeftBtn.addEventListener('click', () => {
  moveItems(rightList, leftList);
});


// block 3

const binaryInput = document.getElementById('grid-binary-input');
const dynamicGrid = document.getElementById('dynamic-grid');

binaryInput.addEventListener('input', () => {
  const binaryData = binaryInput.value.trim(); 
  generateGrid(binaryData);
});

function generateGrid(binaryData) {
  dynamicGrid.innerHTML = ''; 

  const rows = binaryData.split('\n'); 

  rows.forEach(row => {
    const rowLength = row.length; 
    dynamicGrid.style.gridTemplateColumns = `repeat(${rowLength}, 30px)`; 
    row.split('').forEach(char => {
      if (char === '1' || char === '0') {
        const square = document.createElement('div');
        square.classList.add('grid-square', char === '1' ? 'black' : 'white');
        dynamicGrid.appendChild(square);
      }
    });

    
    if (row !== rows[rows.length - 1]) {
      const spacer = document.createElement('div');
      spacer.style.height = '5px'; 
      spacer.style.gridColumn = `1 / span ${rowLength}`; 
      dynamicGrid.appendChild(spacer);
    }
  });
}

