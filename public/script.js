
    function toggleMenu() {
        const mobileMenu = document.querySelector('.mobile-menu');
        mobileMenu.classList.toggle('active');
    }

    document.addEventListener('click', function (event) {
        const mobileMenu = document.querySelector('.mobile-menu');
        const hamburger = document.querySelector('.hamburger');

        if (!mobileMenu.contains(event.target) && !hamburger.contains(event.target)) {
            mobileMenu.classList.remove('active');
        }
    });

    document.querySelector('#addEducBtn').addEventListener('click', function () {
        var container = document.getElementById('education_section');
        var newEducationField = document.createElement('div');
        newEducationField.classList.add('col-12', 'col-md-12', 'ksForm');
        newEducationField.innerHTML = `<input type='text' name='education[]' placeholder="${schoolPlaceholder}" class="form-control mb-2" required>`;
        container.appendChild(newEducationField);

        var newDateField = document.createElement('div');
        newDateField.classList.add('col-12', 'col-md-12', 'ksForm', 'ksDates');
        newDateField.innerHTML = `
                <input type='date' name='educ_from_date[]' placeholder="From Date" class="form-control mb-2" required>
                <span class="toLabel">${to}</span>
                <input type='date' name='educ_to_date[]' placeholder="To Date" class="form-control mb-2" required>
            `;
        container.appendChild(newDateField);
        var hr = document.createElement('hr');
        container.appendChild(hr);
    });

    document.querySelector('#addExperienceBtn').addEventListener('click', function () {
        var container = document.getElementById('experience_section');
        var newEducationField = document.createElement('div');
        newEducationField.classList.add('col-12', 'col-md-12', 'ksForm');
        newEducationField.innerHTML = `<input type='text' name='experiences[]' placeholder="${experiencePlaceholder}" class="form-control mb-2" required>`;
        container.appendChild(newEducationField);

        var newDateField = document.createElement('div');
        newDateField.classList.add('col-12', 'col-md-12', 'ksForm', 'ksDates');
        newDateField.innerHTML = `
                    <input type='date' name='experience_from_date[]' placeholder="From Date" class="form-control mb-2" required>
                    <span class="toLabel">${to}</span>
                    <input type='date' name='experience_to_date[]' placeholder="To Date" class="form-control mb-2" required>
                `;
        container.appendChild(newDateField);
        var hr = document.createElement('hr');
        container.appendChild(hr);
    });

    document.querySelector('#addSkillBtn').addEventListener('click', function () {
        var container = document.getElementById('skills_section');
        var newEducationField = document.createElement('div');
        newEducationField.classList.add('col-12', 'col-md-12', 'ksForm');
        newEducationField.innerHTML = `<input type='text' name='skills[]' placeholder="${skillsPlaceholder}" class="form-control mb-2" required>`;
        container.appendChild(newEducationField);
        var hr = document.createElement('hr');
        container.appendChild(hr);
    });

    document.getElementById('addLanguageBtn').addEventListener('click', function () {
        var container = document.getElementById('language_section');
        var newLanguageField = document.createElement('div');
        newLanguageField.classList.add('language_flex_section');
        newLanguageField.innerHTML = `
                <div class="col-12 col-md-12 ksForm">
                    <input type='text' name='languages[]' placeholder="${langPlaceholder}" class="form-control mb-2"/>
                </div>
            `;
        container.appendChild(newLanguageField);
        var hr = document.createElement('hr');
        container.appendChild(hr);
    });

    function generateOptions() {
        let options = '';
        for (let x = 1; x <= 10; x++) {
            options += `<option value="${x}">${x}</option>`;
        }
        return options;
    }
