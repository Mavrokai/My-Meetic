document.addEventListener('DOMContentLoaded', function () {


    document.getElementById('emailInput').addEventListener('input', function () {
        document.getElementById('emailError').textContent = '';
    });

    document.querySelectorAll('[name="current_password"], [name="new_password"], [name="confirm_password"]').forEach(input => {
        input.addEventListener('input', function () {
            const errorDiv = this.parentElement.querySelector('.error-message');
            if (errorDiv) errorDiv.textContent = '';
        });
    });

    const hobbySelector = document.getElementById('hobbySelector');
    const hiddenHobbies = document.getElementById('hiddenHobbies');
    const selectedHobbiesDiv = document.getElementById('selectedHobbies');

    if (hobbySelector) {
        hobbySelector.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                addHobby(selectedOption.value, selectedOption.textContent);
                this.value = '';
            }
        });
    }

    function addHobby(id, name) {
        if (!Array.from(hiddenHobbies.options).find(opt => opt.value === id)) {
            const option = document.createElement('option');
            option.value = id;
            option.textContent = name;
            option.selected = true;
            hiddenHobbies.appendChild(option);

            const hobbySpan = document.createElement('span');
            hobbySpan.className = 'hobby';
            hobbySpan.innerHTML = `
                ${name}
                <button type="button" class="delete-hobby" data-hobby-id="${id}">&times;</button>
            `;

            hobbySpan.querySelector('.delete-hobby').addEventListener('click', function () {
                hiddenHobbies.removeChild(option);
                selectedHobbiesDiv.removeChild(hobbySpan);
            });

            selectedHobbiesDiv.appendChild(hobbySpan);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const hobbySelector = document.getElementById('hobbySelector');
        const hiddenHobbies = document.getElementById('hiddenHobbies');
        const selectedHobbiesDiv = document.getElementById('selectedHobbies');
        const existingHobbies = new Set(existingHobbyIds);

        hobbySelector.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const hobbyId = parseInt(selectedOption.value);

            if (!selectedOption.value) return;


            if (existingHobbies.has(hobbyId) || isAlreadySelected(hobbyId)) {
                showHobbyError(`"${selectedOption.textContent}" est déjà dans vos hobbies`);
                this.value = '';
                return;
            }

            addHobbyToSelection(hobbyId, selectedOption.textContent);
            this.value = '';
        });

        function isAlreadySelected(hobbyId) {
            return Array.from(hiddenHobbies.options).some(opt => parseInt(opt.value) === hobbyId);
        }

        function showHobbyError(message) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'hobby-error';
            errorDiv.textContent = message;

            selectedHobbiesDiv.prepend(errorDiv);


            setTimeout(() => {
                errorDiv.remove();
            }, 3000);
        }

    });
    setTimeout(() => {
        document.querySelector('.error-message').remove();
    }, 3000);




    const fileInput = document.querySelector('input[type="file"]');
    const photoPreview = document.getElementById('photoPreview');

    fileInput.addEventListener('change', function (e) {
        Array.from(e.target.files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    const div = document.createElement('div');
                    div.className = 'photo-thumbnail';
                    div.innerHTML = `
                    <img src="${event.target.result}" alt="Prévisualisation">
                    <button class="delete-photo" onclick="this.parentElement.remove()">&times;</button>
                `;
                    photoPreview.prepend(div);
                };
                reader.readAsDataURL(file);
            }
        });
    });


    document.querySelectorAll('.photo-thumbnail img').forEach(img => {
        img.src = img.src.replace('/public/uploads/profile_photos/', '/profile_photos/');
    });


    document.addEventListener('click', async (e) => {
        if (e.target.classList.contains('delete-photo')) {
            const photoElement = e.target.closest('.photo-thumbnail');
            const photoName = photoElement.querySelector('img').src.split('/').pop();

            if (confirm('Supprimer cette photo définitivement ?')) {
                try {
                    const response = await fetch(
                        `../Controller/ProfilController.php?action=delete_photo&photo=${encodeURIComponent(photoName)}`,
                        { method: 'DELETE' }
                    );

                    if (response.ok) {
                        photoElement.remove();
                    }
                    else {
                        const error = await response.text();
                        alert(error);
                    }
                } catch (error) {
                    console.error('Erreur:', error);
                    alert('Une erreur est survenue');
                }
            }
        }
    });

    function dropdownNav() {
        const btnRecherche = document.querySelector("#nav__recherche");
        const dropdownNav = document.querySelector(".dropdownRecherche");

        if (btnRecherche && dropdownNav) {
            btnRecherche.addEventListener("click", function (e) {
                e.preventDefault();
                dropdownNav.classList.toggle("dropdownRecherche--active");
                this.classList.toggle("active", dropdownNav.classList.contains("dropdownRecherche--active"));
            });
        }
    }
    dropdownNav();
});