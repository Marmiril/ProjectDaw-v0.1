document.addEventListener('DOMContentLoaded', function() {
    // Obtener el ID de la URL y asignarlo al campo oculto
    const urlParams = new URLSearchParams(window.location.search);
    const userId = urlParams.get('id');
    document.getElementById('user_id').value = userId;

    const commonColors = [
        'Rojo', 'Azul', 'Verde', 'Amarillo', 'Negro', 'Blanco', 'Gris', 'Marrón',
        'Naranja', 'Rosa', 'Morado', 'Violeta', 'Turquesa', 'Beige', 'Dorado',
        'Plateado', 'Coral', 'Cian', 'Magenta', 'Lavanda', 'Índigo', 'Carmesí',
        'Esmeralda', 'Aguamarina', 'Salmón', 'Oliva', 'Granate', 'Fucsia',
        'Ocre', 'Púrpura', 'Celeste', 'Borgoña', 'Malva', 'Crema', 'Escarlata',
        'Jade', 'Lila', 'Marfil', 'Cobre', 'Ámbar', 'Melocotón', 'Menta',
        'Cereza', 'Ciruela', 'Castaño', 'Añil', 'Terracota', 'Chocolate',
        'Vainilla', 'Zafiro'
    ];

    const colorInput = document.getElementById('favorite_color');
    const datalist = document.createElement('datalist'); // Corregido: createElemene -> createElement
    datalist.id = 'color-list';

    // Añadir las opciones de color al datalist
    commonColors.forEach(color => {
        const option = document.createElement('option');
        option.value = color;
        datalist.appendChild(option);
    });

    document.body.appendChild(datalist);
    colorInput.setAttribute('list', 'color-list');

    //Validación del formulario.
    const form = document.getElementById('userPreferencesForm');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        let isValid = true;
        clearErrors();

        //Validación de color.
        const favoriteColor = document.getElementById('favorite_color').value.trim();
        console.log('Color introducido:', favoriteColor); // Para depuración
        console.log('¿Color válido?', commonColors.includes(favoriteColor)); // Para depuración
        
        if(!favoriteColor || !commonColors.includes(favoriteColor)) {
            showError('favorite_color', 'El color introducido no es válido');
            isValid = false;
        }

        //Validación de altura.
        const height = document.getElementById('height').value;
        if(!height) {
            showError('height', 'Por favor, indica una altura');
            isValid = false;
        }

        //Validación de peso.
        const weight = document.getElementById('weight').value;
        if(!weight) {
            showError('weight', 'Por favor, indica un peso');
            isValid = false;
        }

        //Validación de edad.
        const age = document.getElementById('age').value;
        if(!age) {
            showError('age', 'Por favor, indica una edad');
            isValid = false;
        }

        //Validación de género.
        const gender = document.getElementById('gender').value;
        if(!gender) {
            showError('gender', 'Por favor, selecciona un género');
            isValid = false;
        }

        if(!isValid) {
            return false;
        } else {
            // Agregamos logs para depuración
            console.log('Formulario válido, enviando datos...');
            console.log('user_id:', document.getElementById('user_id').value);
            console.log('favorite_number:', document.getElementById('favorite_number').value);
            console.log('favorite_color:', document.getElementById('favorite_color').value);
            console.log('height:', document.getElementById('height').value);
            console.log('weight:', document.getElementById('weight').value);
            console.log('age:', document.getElementById('age').value);
            console.log('gender:', document.getElementById('gender').value);
            
            form.submit();
        }
    });

    function showError(inputId, message) {
        const input = document.getElementById(inputId);
        const errorSpan = document.createElement('span');
        errorSpan.className = 'error-message';
        errorSpan.textContent = message;
        input.parentElement.appendChild(errorSpan);       
    }

    function clearErrors() {
        const errors = document.querySelectorAll('.error-message');
        errors.forEach(error=>error.remove());
    }
});