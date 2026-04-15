(function () {
    'use strict';

    const overlay   = document.getElementById('modal-calc-overlay');
    const modal     = document.getElementById('modal-calc');
    const step1     = document.getElementById('modal-step-1');
    const step2     = document.getElementById('modal-step-2');
    const success   = document.getElementById('modal-success');
    const closeBtn  = document.getElementById('modal-calc-close');
    const nextBtn   = document.getElementById('mc-next-btn');
    const backBtn   = document.getElementById('mc-back-btn');
    const submitBtn = document.getElementById('mc-submit-btn');
    const closeSuccessBtn = document.getElementById('mc-close-success');

    const externalFields = {
        city:  ['mc-city'],
        name:  ['mc-name'],
        phone: ['mc-phone'],
    };

    function openModal(prefill) {
        if (!modal) return;
        // Сброс шагов
        step1.style.display = 'block';
        step2.style.display = 'none';
        success.style.display = 'none';

        if (prefill) {
            if (prefill.city)  document.getElementById('mc-city').value  = prefill.city  || '';
            if (prefill.name)  document.getElementById('mc-name').value  = prefill.name  || '';
            if (prefill.phone) document.getElementById('mc-phone').value = prefill.phone || '';
        }

        overlay.classList.add('is-active');
        modal.classList.add('is-active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        if (!modal) return;
        overlay.classList.remove('is-active');
        modal.classList.remove('is-active');
        document.body.style.overflow = '';
    }

    document.querySelectorAll('.js-open-modal, .btn-open-modal').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            var prefill = {};
            var pageCity  = document.getElementById('tc-city')  || document.querySelector('[name="city"]:not(#mc-city)');
            var pageName  = document.getElementById('tc-name')  || document.querySelector('[name="name"]:not(#mc-name)');
            var pagePhone = document.getElementById('tc-phone') || document.querySelector('[name="phone"]:not(#mc-phone)');

            if (pageCity  && pageCity.value.trim())  prefill.city  = pageCity.value.trim();
            if (pageName  && pageName.value.trim())  prefill.name  = pageName.value.trim();
            if (pagePhone && pagePhone.value.trim()) prefill.phone = pagePhone.value.trim();

            openModal(prefill);
        });
    });

    if (closeBtn)         closeBtn.addEventListener('click', closeModal);
    if (overlay)          overlay.addEventListener('click', closeModal);
    if (closeSuccessBtn)  closeSuccessBtn.addEventListener('click', closeModal);

    // ESC
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeModal();
    });

    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            step1.style.display = 'none';
            step2.style.display = 'block';
            modal.scrollTop = 0;
        });
    }
    if (backBtn) {
        backBtn.addEventListener('click', function () {
            step2.style.display = 'none';
            step1.style.display = 'block';
            modal.scrollTop = 0;
        });
    }

    if (submitBtn) {
        submitBtn.addEventListener('click', function () {
            var nonce = document.getElementById('mc-nonce');
            if (!nonce) return;

            var furnitureType = document.getElementById('mc-furniture-type')  ? document.getElementById('mc-furniture-type').value : '';
            var furnitureSize = document.getElementById('mc-furniture-size')  ? document.getElementById('mc-furniture-size').value : '';
            var fluffiness    = document.getElementById('mc-fluffiness')       ? document.getElementById('mc-fluffiness').value : '';
            var filler        = document.getElementById('mc-filler')           ? document.getElementById('mc-filler').value : '';

            var fabrics = [];
            document.querySelectorAll('[name="fabric[]"]:checked').forEach(function (cb) {
                fabrics.push(cb.value);
            });

            var city    = document.getElementById('mc-city').value.trim();
            var name    = document.getElementById('mc-name').value.trim();
            var phone   = document.getElementById('mc-phone').value.trim();
            var comment = document.getElementById('mc-comment').value.trim();

            var contactMethods = [];
            document.querySelectorAll('[name="contact_method[]"]:checked').forEach(function (cb) {
                contactMethods.push(cb.value);
            });

            if (!name || !phone) {
                alert('Пожалуйста, укажите имя и телефон.');
                return;
            }

            var data = new FormData();
            data.append('action',           'modal_calc_submit');
            data.append('nonce',            nonce.value);
            data.append('furniture_type',   furnitureType);
            data.append('furniture_size',   furnitureSize);
            data.append('fluffiness',       fluffiness);
            data.append('filler',           filler);
            data.append('fabrics',          fabrics.join(', '));
            data.append('city',             city);
            data.append('name',             name);
            data.append('phone',            phone);
            data.append('comment',          comment);
            data.append('contact_methods',  contactMethods.join(', '));

            submitBtn.disabled = true;
            submitBtn.textContent = 'Отправка...';

            fetch(window.ajaxurl || '/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: data,
            })
            .then(function (r) { return r.json(); })
            .then(function (resp) {
                if (resp.success) {
                    step2.style.display = 'none';
                    success.style.display = 'flex';
                } else {
                    alert('Ошибка отправки. Попробуйте ещё раз.');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Отправить';
                }
            })
            .catch(function () {
                alert('Ошибка соединения. Попробуйте ещё раз.');
                submitBtn.disabled = false;
                submitBtn.textContent = 'Отправить';
            });
        });
    }


    var menuBtn     = document.querySelector('.menu-btn');
    var mobileMenu  = document.querySelector('.mobile-menu');
    var menuClose   = document.querySelector('.mobile-menu .close');
    var pageOverlay = document.querySelector('.overlay');

    function openMobileMenu() {
        if (!mobileMenu) return;
        mobileMenu.classList.add('mobile-menu_active');
        if (pageOverlay) pageOverlay.classList.add('overlay_active');
        document.body.classList.add('locked');
    }

    function closeMobileMenu() {
        if (!mobileMenu) return;
        mobileMenu.classList.remove('mobile-menu_active');
        if (pageOverlay) pageOverlay.classList.remove('overlay_active');
        document.body.classList.remove('locked');
    }

    if (menuBtn)    menuBtn.addEventListener('click', openMobileMenu);
    if (menuClose)  menuClose.addEventListener('click', closeMobileMenu);
    if (pageOverlay) pageOverlay.addEventListener('click', closeMobileMenu);


    var filterBtns = document.querySelectorAll('.portfolio-page__filter-btn');
    var portfolioGrid = document.getElementById('portfolio-grid');

    filterBtns.forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            if (!btn.dataset.cat) return;
            e.preventDefault();

            filterBtns.forEach(function (b) { b.classList.remove('portfolio-page__filter-btn--active'); });
            btn.classList.add('portfolio-page__filter-btn--active');

            if (!portfolioGrid) return;
            portfolioGrid.style.opacity = '0.4';

            var data = new FormData();
            data.append('action', 'portfolio_filter');
            data.append('nonce',  btn.dataset.nonce || '');
            data.append('cat',    btn.dataset.cat);

            fetch(window.ajaxurl || '/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: data,
            })
            .then(function (r) { return r.text(); })
            .then(function (html) {
                portfolioGrid.innerHTML = html;
                portfolioGrid.style.opacity = '1';

                attachPortfolioCardClicks();
            })
            .catch(function () {
                portfolioGrid.style.opacity = '1';
            });
        });
    });

    function attachPortfolioCardClicks() {
    }


    if (!window.__faqInitialized) {
        window.__faqInitialized = true;
        document.querySelectorAll('.faq__question').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var item   = this.closest('.faq__item');
                var answer = item.querySelector('.faq__answer');
                var isOpen = item.classList.contains('faq__item--open');

                document.querySelectorAll('.faq__item').forEach(function (i) {
                    i.classList.remove('faq__item--open');
                    var a = i.querySelector('.faq__answer');
                    if (a) a.hidden = true;
                    i.querySelector('.faq__question').setAttribute('aria-expanded', 'false');
                    var t = i.querySelector('.faq__toggle-plus, .faq__toggle-minus');
                    if (t) { t.textContent = '+'; t.className = 'faq__toggle-plus'; }
                });

                if (!isOpen && answer) {
                    item.classList.add('faq__item--open');
                    answer.hidden = false;
                    this.setAttribute('aria-expanded', 'true');
                    var toggle = this.querySelector('.faq__toggle-plus, .faq__toggle-minus');
                    if (toggle) { toggle.textContent = '−'; toggle.className = 'faq__toggle-minus'; }
                }
            });
        });
    }


    if (typeof Swiper !== 'undefined') {
        var heroSwiper = document.querySelector('.hero-swiper');
        if (heroSwiper) {
            new Swiper('.hero-swiper', {
                loop: true,
                autoplay: { delay: 5000, disableOnInteraction: false },
                pagination: {
                    el: '.hero-pagination',
                    clickable: true,
                },
            });
        }
    }

    var header = document.getElementById('header');
    if (header) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 80) {
                header.classList.add('header--sticky');
            } else {
                header.classList.remove('header--sticky');
            }
        });
    }


    var priceTabs = document.querySelectorAll('.prices__tab');
    priceTabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            priceTabs.forEach(function (t) { t.classList.remove('prices__tab--active'); });
            tab.classList.add('prices__tab--active');

            var tabKey = tab.dataset.tab;
            var tbody  = document.querySelector('.prices__tbody');
            if (!tbody) return;

            tbody.style.opacity = '0.3';

            var data = new FormData();
            data.append('action', 'prices_tab');
            data.append('tab',    tabKey);
            data.append('nonce',  (document.getElementById('mc-nonce') || {value: ''}).value);

            fetch(window.ajaxurl || '/wp-admin/admin-ajax.php', {
                method: 'POST',
                body: data,
            })
            .then(function (r) { return r.text(); })
            .then(function (html) {
                tbody.innerHTML = html;
                tbody.style.opacity = '1';
            })
            .catch(function () {
                tbody.style.opacity = '1';
            });
        });
    });


    var teamCallbackForm = document.querySelector('.team-callback__form');
    var teamSubmitBtn    = teamCallbackForm ? teamCallbackForm.querySelector('[type="submit"]') : null;

    if (teamSubmitBtn) {
        teamSubmitBtn.addEventListener('click', function (e) {
            e.preventDefault();
            var prefill = {
                city:  (teamCallbackForm.querySelector('[name="city"]')  || {}).value || '',
                name:  (teamCallbackForm.querySelector('[name="name"]')  || {}).value || '',
                phone: (teamCallbackForm.querySelector('[name="phone"]') || {}).value || '',
            };
            openModal(prefill);
        });
    }

    var svcForm    = document.querySelector('.svc-advantages__form');
    var svcSubmit  = svcForm ? svcForm.querySelector('.svc-advantages__form-submit') : null;

    if (svcSubmit) {
        svcSubmit.addEventListener('click', function (e) {
            e.preventDefault();
            var prefill = {
                city:  (svcForm.querySelector('[name="city"]')  || {}).value || '',
                name:  (svcForm.querySelector('[name="name"]')  || {}).value || '',
                phone: (svcForm.querySelector('[name="phone"]') || {}).value || '',
            };
            openModal(prefill);
        });
    }

})();