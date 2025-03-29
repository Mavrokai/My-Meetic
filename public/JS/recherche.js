document.addEventListener('DOMContentLoaded', function () {



    function dropdownNav() {
        const btnRecherche = document.querySelector("#nav__recherche");
        const dropdownNav = document.querySelector(".dropdownRecherche");
        const btnDescription = document.querySelector("#nav__description");
        const dropdownNavDescritpion = document.querySelector(".dropdownDescription");


        if (btnDescription && dropdownNavDescritpion) {
            btnDescription.addEventListener("click", function (e) {
                e.preventDefault();
                dropdownNavDescritpion.classList.toggle("dropdownDescription--active");
                this.classList.toggle("active", dropdownNavDescritpion.classList.contains("dropdownDescription--active"));
            });
        }

        if (btnRecherche && dropdownNav) {
            btnRecherche.addEventListener("click", function (e) {
                e.preventDefault();
                dropdownNav.classList.toggle("dropdownRecherche--active");
                this.classList.toggle("active", dropdownNav.classList.contains("dropdownRecherche--active"));
            });
        }
    }
    dropdownNav();





    initPhotoCarousels();


    function initPhotoCarousels() {
        document.querySelectorAll('.photos-container').forEach(initCarousel);

        function initCarousel(container) {
            const photos = container.querySelectorAll('.photo');
            if (photos.length <= 1) return;


            const dotsContainer = document.createElement('div');
            dotsContainer.className = 'carousel-dots';
            photos.forEach((_, index) => {
                const dot = document.createElement('div');
                dot.className = `dot${index === 0 ? ' active' : ''}`;
                dotsContainer.appendChild(dot);
            });
            container.appendChild(dotsContainer);


            const prevBtn = document.createElement('button');
            prevBtn.className = 'photo-nav-btn prev';
            prevBtn.innerHTML = '❮';
            const nextBtn = document.createElement('button');
            nextBtn.className = 'photo-nav-btn next';
            nextBtn.innerHTML = '❯';
            container.append(prevBtn, nextBtn);

            let currentIndex = 0;
            let touchStartX = 0;



            container.addEventListener('touchstart', handleTouchStart);
            container.addEventListener('touchend', handleTouchEnd);
            prevBtn.addEventListener('click', () => updatePhoto(-1));
            nextBtn.addEventListener('click', () => updatePhoto(1));
            dotsContainer.childNodes.forEach((dot, index) => {
                dot.addEventListener('click', () => jumpToPhoto(index));
            });

            function handleTouchStart(e) {
                touchStartX = e.touches[0].clientX;
                e.stopPropagation();
            }

            function handleTouchEnd(e) {
                const touchEndX = e.changedTouches[0].clientX;
                const deltaX = touchEndX - touchStartX;

                if (Math.abs(deltaX) > 30) {
                    deltaX > 0 ? updatePhoto(-1) : updatePhoto(1);
                }
                e.stopPropagation();
            }

            function updatePhoto(step) {
                currentIndex = (currentIndex + step + photos.length) % photos.length;
                jumpToPhoto(currentIndex);
            }

            function jumpToPhoto(index) {
                photos.forEach(photo => photo.classList.remove('active'));
                photos[index].classList.add('active');

                dotsContainer.querySelectorAll('.dot').forEach((dot, i) => {
                    dot.classList.toggle('active', i === index);
                });

                currentIndex = index;
            }
        }
    }



    let currentProfileIndex = 0;
    const profileContainer = document.querySelector('.profiles-container');
    const profileCards = Array.from(document.querySelectorAll('.profile-card'));



    profileCards.forEach((card, index) => {
        if (index !== 0) card.style.display = 'none';
    });

    function handleAction(card, direction) {
        card.classList.add(`slide-out-${direction}`);





        setTimeout(() => {
            card.remove();
            currentProfileIndex++;
            const nextCard = profileContainer.querySelector('.profile-card');
            if (nextCard) {
                nextCard.style.display = 'block';
            } else {
                showNoMoreProfiles();
            }
        }, 600);
    }

    function showNoMoreProfiles() {
        profileContainer.innerHTML = `
            <div class="no-more-profiles">
                Plus de profils à afficher 😢<br>
                <button onclick="window.location.reload()">Rafraîchir</button>
            </div>
        `;
    }



    document.addEventListener('click', function (e) {
        const card = e.target.closest('.profile-card');
        if (!card) return;

        if (e.target.closest('.like-btn')) {
            handleAction(card, 'right');
        } else if (e.target.closest('.dislike-btn')) {
            handleAction(card, 'left');
        }
    });


    let profileTouchStartX = 0;
    let isSwipingProfile = false;

    profileContainer.addEventListener('touchstart', e => {
        profileTouchStartX = e.touches[0].clientX;
        isSwipingProfile = true;
    });


    profileContainer.addEventListener('touchmove', e => {
        if (!isSwipingProfile) return;



        const currentCard = profileContainer.querySelector('.profile-card');
        if (!currentCard) return;

        const touchCurrentX = e.touches[0].clientX;
        const deltaX = touchCurrentX - profileTouchStartX;
        const rotation = deltaX * 0.1;

        currentCard.style.transform = `translateX(${deltaX}px) rotate(${rotation}deg)`;
    });



    profileContainer.addEventListener('touchend', e => {
        if (!isSwipingProfile) return;
        isSwipingProfile = false;

        const currentCard = profileContainer.querySelector('.profile-card');
        if (!currentCard) return;

        const touchEndX = e.changedTouches[0].clientX;
        const deltaX = touchEndX - profileTouchStartX;

        if (Math.abs(deltaX) > 100) {
            handleAction(currentCard, deltaX > 0 ? 'right' : 'left');
        } else {
            currentCard.style.transform = 'none';
        }
    });
});