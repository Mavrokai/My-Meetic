document.addEventListener('DOMContentLoaded', function () {


    const firstnameError = document.getElementById('firstnameError');
    const lastnameError = document.getElementById('lastnameError');
    const birthdayError = document.getElementById('birthdayError');
    const passwordError = document.getElementById('passwordError');
    const confirmPasswordError = document.getElementById('confirmPasswordError');
    const hobbyError = document.getElementById('hobbyError');
    const cityInput = document.getElementById('cityInput');
    const citySuggestions = document.getElementById('citySuggestions');
    const cityError = document.getElementById('cityError');
    const GEOAPIFY_API_KEY = 'd439fed75bdc48b9ae1e3babcf19806e';



    document.querySelector('input[name="firstname"]').addEventListener('input', function () {
        validateName(this, firstnameError, 'Prénom');
    });


    document.querySelector('input[name="lastname"]').addEventListener('input', function () {
        validateName(this, lastnameError, 'Nom');
    });



    cityInput.addEventListener('input', debounce(async (e) => {
        const searchText = e.target.value.trim();

        if (searchText.length < 2) {
            citySuggestions.style.display = 'none';
            return;
        }

        try {
            const cities = await getFrenchCities(searchText);
            showCitySuggestions(cities);
        } catch (error) {
            console.error('Erreur de récupération des villes:', error);
            showError(cityError, 'Erreur de connexion au service de villes');
        }
    }, 300));


    document.getElementById('registerForm').addEventListener('submit', async function (e) {
        e.preventDefault();


        const form = e.target;
        const isValid = await validateAllFields();



        clearError(document.getElementById('emailError'));
        document.querySelector('input[name="email"]').style.borderColor = '#ccc';

        if (!isValid) return;

        const formData = new FormData(form);


        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData
            });
            const result = await response.json();

            if (result.success) {
                window.location.href = result.redirect;
            } else {

                if (result.errors?.email) {

                    const emailError = document.getElementById('emailError');
                    showError(emailError, result.errors.email);

                    document.querySelector('input[name="email"]').style.borderColor = '#ff69b4';
                }
            }
        } catch (error) {
            console.error('Erreur réseau:', error);
        }
    });



    function validateName(input, errorElement, fieldName) {
        const value = input.value.trim();
        const regex = /^[a-zA-ZÀ-ÿ-' ]+$/;


        if (value.length < 2) {
            showError(errorElement, `${fieldName} doit contenir au moins 2 caractères`);
            return false;
        }
        if (!regex.test(value)) {
            showError(errorElement, `${fieldName} ne peut contenir que des lettres, espaces, apostrophes (') et tirets`);
            return false;
        }

        clearError(errorElement);
        return true;
    }



    function validateBirthdate() {

        const birthdayInput = document.querySelector('input[name="birthday"]');
        const birthday = new Date(birthdayInput.value);
        const today = new Date();
        const minAgeDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());


        if (!birthdayInput.value) {
            showError(birthdayError, 'Veuillez saisir votre date de naissance');
            return false;
        }
        if (birthday > minAgeDate) {
            showError(birthdayError, 'Vous devez avoir au moins 18 ans');
            return false;
        }
        clearError(birthdayError);
        return true;
    }



    function showError(element, message) {
        element.textContent = message;
        element.style.display = 'block';
        if (element.previousElementSibling) {
            element.previousElementSibling.style.borderColor = '#ff69b4';
        }
    }


    function clearError(element) {
        element.textContent = '';
        element.style.display = 'none';
        if (element.previousElementSibling) {
            element.previousElementSibling.style.borderColor = '#ccc';
        }
    }



    async function validateAllFields() {

        const isFirstnameValid = validateName(document.querySelector('input[name="firstname"]'), firstnameError, 'Prénom');
        const isLastnameValid = validateName(document.querySelector('input[name="lastname"]'), lastnameError, 'Nom');
        const isBirthdayValid = validateBirthdate();
        const hobbiesValid = document.getElementById('hiddenHobbies').options.length > 0;


        if (!hobbiesValid) {
            showError(hobbyError, 'Veuillez sélectionner au moins un loisir.');
            hobbyError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else {
            clearError(hobbyError);
        }


        const cityValue = cityInput.value.trim();
        let isCityValid = false;
        if (cityValue.length > 0) {
            isCityValid = await validateCity(cityValue);
            if (!isCityValid) showError(cityError, 'Ville française invalide');
        } else {
            showError(cityError, 'Veuillez entrer une ville');
        }


        const password = document.querySelector('input[name="password"]').value;
        const confirmPassword = document.querySelector('input[name="confirm_password"]').value;
        let isPasswordValid = (password === confirmPassword);


        if (!isPasswordValid) {
            showError(confirmPasswordError, 'Les mots de passe ne correspondent pas');
            showError(passwordError, 'Les mots de passe ne correspondent pas');
        } else {
            clearError(confirmPasswordError);
            clearError(passwordError);
        }


        return isFirstnameValid && isLastnameValid && isBirthdayValid && hobbiesValid && isCityValid && isPasswordValid;
    }


    function handleHobbySelection() {
        const hobbySelector = document.getElementById('hobbySelector');
        const hiddenHobbies = document.getElementById('hiddenHobbies');
        const selectedHobbiesContainer = document.getElementById('selectedHobbies');

        hobbySelector.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];

            if (selectedOption.value && !isHobbyAlreadySelected(selectedOption.value)) {
                addHobbyToSelection(selectedOption);
                this.selectedIndex = 0;
            }
        });

        function isHobbyAlreadySelected(value) {
            return Array.from(hiddenHobbies.options)
                .some(option => option.value === value);
        }

        function addHobbyToSelection(option) {
            const newOption = new Option(option.text, option.value, true, true);
            hiddenHobbies.appendChild(newOption);
            clearError(hobbyError);

            const tag = document.createElement('div');
            tag.className = 'hobby-tag';
            tag.dataset.value = option.value;
            tag.innerHTML = `
                ${option.text}
                <span class="remove-tag" onclick="removeHobby('${option.value}')">×</span>
            `;
            selectedHobbiesContainer.appendChild(tag);
        }
    }



    async function validateCity(cityName) {
        try {

            const response = await fetch(
                `https://api.geoapify.com/v1/geocode/search?text=${encodeURIComponent(cityName)}&filter=countrycode:fr&apiKey=${GEOAPIFY_API_KEY}`
            );

            const data = await response.json();

            return data.features.length > 0 &&
                data.features[0].properties.country_code === 'fr' &&
                data.features[0].properties.formatted.toLowerCase() === cityName.toLowerCase();
        } catch (error) {
            console.error('Erreur de validation de la ville:', error);
            return false;
        }
    }


    async function getFrenchCities(searchText) {

        const response = await fetch(
            `https://api.geoapify.com/v1/geocode/autocomplete?text=${encodeURIComponent(searchText)}&filter=countrycode:fr&limit=5&apiKey=${GEOAPIFY_API_KEY}`
        );
        const data = await response.json();
        return data.features;
    }

    function showCitySuggestions(cities) {

        citySuggestions.innerHTML = '';

        if (!cities || cities.length === 0) {
            citySuggestions.style.display = 'none';
            return;
        }



        cities.forEach(city => {
            const div = document.createElement('div');
            div.className = 'city-suggestion-item';
            div.textContent = city.properties.formatted;


            div.onclick = () => {

                cityInput.value = city.properties.formatted;
                citySuggestions.style.display = 'none';
                clearError(cityError);
            };
            citySuggestions.appendChild(div);
        });

        citySuggestions.style.display = 'block';
    }



    function debounce(func, timeout = 300) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => { func.apply(this, args); }, timeout);
        };
    }


    document.addEventListener('click', (e) => {
        if (!cityInput.contains(e.target)) {
            citySuggestions.style.display = 'none';
        }
    });


    window.removeHobby = function (value) {

        const tag = document.querySelector(`.hobby-tag[data-value="${value}"]`);
        const option = document.querySelector(`#hiddenHobbies option[value="${value}"]`);


        if (tag && option) {
            tag.remove();
            option.remove();
        }

        clearError(hobbyError);
    };

    handleHobbySelection();

    document.getElementById('profilePhoto').addEventListener('change', function (e) {
        const preview = document.getElementById('profileImagePreview');
        preview.innerHTML = '';

        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (event) {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.style.maxWidth = '300px';
                preview.appendChild(img);
            };

            reader.onerror = function (error) {
                console.error('Erreur de lecture du fichier:', error);
            };

            reader.readAsDataURL(file);
        }
    });
});