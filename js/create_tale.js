document.addEventListener('DOMContentLoaded', function() {
    const storyContent = document.getElementById('story-content');
    if (!storyContent) {
        console.error('No se pudo encontrar un textarea con id "story-content"');
        return;
    }

    const wordCount = document.getElementById('word-count');
    if (!wordCount) {
        console.error("No se ha encontrado ningún elemento con id 'word-count'");
        return;
    }

    const form = document.getElementById('createStoryForm');
    const MIN_WORDS = 200;
    const MAX_WORDS = 600;

    function countWords(text) {
        return text.trim().split(/\s+/).filter(word => word.length > 0).length;
    }

    function updateWordCount() {
        const currentWords = countWords(storyContent.value);
        wordCount.textContent = `Palabras: ${currentWords}`;

        //Cambio de color en base al conteo.
        if (currentWords < MIN_WORDS || currentWords > 550) {
            wordCount.style.color = "#ff0000";
        } else {
            wordCount.style.color = '#666';
        }

        //Aquí se previene de que el usuario escriba más palabras en el texto.
        if (currentWords > MAX_WORDS) {
            const words = storyContent.value.trim().split(/\s+/);
            storyContent.value = words.slice(0, MAX_WORDS).join(' ');
            alert(`Has alcanzado el límite máximo de ${MAX_WORDS} palabras.`);
        }
    }

   storyContent.addEventListener('input', updateWordCount);

   form.addEventListener('submit', function(e) {
        e.preventDefault();
        const currentWords = countWords(storyContent.value);

        if(currentWords < MIN_WORDS || currentWords > MAX_WORDS) {
            alert(`El texto debe tener entre ${MIN_WORDS} y ${MAX_WORDS}. Ahora: ${currentWords}`);
            return;
        }

        const formData = new FormData(form);
        fetch('../php/save_story.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) 
        .then(data => {
            if(data.success) {
                alert('Guardado con éxito');
                window.location.href = 'profile.php';
            } else {
                alert('Error al guardar el cuento: ' + data.message);
            }
        })
        .catch(error=> {
            console.error('Error', error);
            alert("Error al guardar el cuento");
        });
    });
});