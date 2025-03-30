document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('userRegistrationForm');
    const username = document.getElementById('username');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        let isValid = true;
        clearErrors();

        //Validación del nombre del usuario con al menos 4 caracteres alfanuméricos.
        if (!username.value.match(/^[a-zA-Z0-9]{3,}$/)) {
            showError(username, "El nombre del usuario ha de contener al menos 3 caracteres.");
            isValid = false;
        }

        //Validación de correo electrónico.
        if (!email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
            showError(email, "Por favor, indique un email válido.");
            isValid = false;
        } else {
            if (await checkDuplicateEmail(email.value)) {
                showError(email, "El email ya está registrado");
                isValid = false;
            }
        }

        //Validación de contraseña
        if (!password.value.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/)) {
            showError(password, "La contraseña ha de tener al menos 8 caracteres, 1 mayúscula, 1 minúscula y 1 número.");
            isValid = false;
        }

        //Confirmación de la contraseña.
        if (password.value !== confirmPassword.value) {
            showError(confirmPassword, "Las contraseñas no coinciden.");
            isValid = false;
        }
        if (isValid) {
            const formData = new FormData(form);
            try {
                const response = await fetch('../php/register_user.php', 
                    {
                        method: 'POST',
                        body: formData
                    });
                    if (response.redirected) {
                        window.location.href = response.url;
                    }
                
            }catch (error) {
                console.error('Error', error);
            }
        }
    });

    async function checkDuplicateEmail(email) {
        try {
            const response = await fetch('../php/register_user.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `email=${email}&check_email=true`
            });
            const data = await response.json();
            return data.exists;
        } catch (error) {
            console.error('Error', error);
            return false;
        }
    }


    function showError(input, message) {
        const formGroup = input.parentElement;
        const error = document.createElement('span');
        error.className = 'error-message';
        error.textContent = message;
        formGroup.appendChild(error);
        formGroup.classList.add('error');
    }

    function clearErrors() {
        const errors = document.querySelectorAll('.error-message');
        errors.forEach(error => error.remove());
        document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
    }

});