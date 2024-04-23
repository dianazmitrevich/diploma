const generateRandomString = () => Array.from({ length: 10 }, () => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'[Math.floor(Math.random() * 62)]).join('');

document.addEventListener("DOMContentLoaded", () => {
    let selects = document.querySelectorAll('.select .select__item');
    if (selects) {
        selects.forEach(wrapItem => {
            const randomString = generateRandomString();
            wrapItem.querySelectorAll('input[type="radio"]').forEach(radioButton => radioButton.name = randomString);
        });
    }

    let radios = document.querySelectorAll('.radios');
    if (radios) {
        radios.forEach(wrapItem => {
            const randomString = generateRandomString();
            wrapItem.querySelectorAll('input[type="radio"]').forEach(radioButton => radioButton.name = randomString);
        });
    }

    document.addEventListener("click", (e) => {
        if (e.target.classList.contains("popup__wrap")) {
            document.querySelectorAll(".popup__wrap, .dropdown__wrap, .popup-wrap, .dropdown-wrap").forEach((w) => {
                w.classList.remove("show");

                document.querySelector("body").classList.remove("stop-scroll");
            });
        }
        if (!["popup", "dropdown", "cta"].some((c) => e.target.closest(`.${c}`))) {
            document.querySelectorAll(".popup__wrap, .dropdown__wrap, .popup-wrap, .dropdown-wrap").forEach((w) => {
                w.classList.remove("show");

                document.querySelector("body").classList.remove("stop-scroll");
            });
        }

        ["popup", "dropdown"].forEach((c) => {
            if (event.target.matches(`.${c}__btn`)) {
                let e = event.target.closest(`.${c}`);
                document.querySelectorAll(".popup__wrap, .dropdown__wrap, .popup-wrap, .dropdown-wrap").forEach((w) => {
                    if (w !== e.querySelector(`.${c}__wrap`) && w !== e.querySelector(`.${c}-wrap`)) {
                        w.classList.remove("show");
                    }
                });

                e.querySelector(`.${c}__wrap`).classList.toggle("show");
                e.querySelector(`.${c}-wrap`) ? e.querySelector(`.${c}-wrap`).classList.toggle("show") : "";
                document.querySelector("body").classList.contains("stop-scroll") ? document.querySelector("body").classList.remove("stop-scroll") : document.querySelector("body").classList.add("stop-scroll");
            }
        });

        if (e.target.classList.contains("btn-ajax")) {
            let element = e.target;
            let api;
            let user;

            api = element.getAttribute('data-api') ? element.getAttribute('data-api') : '';
            user = element.getAttribute('data-user') ? element.getAttribute('data-user') : '';

            fetch(element.getAttribute("data-url"), {
                method: 'POST',
                body: new URLSearchParams({ 'element_id': element.getAttribute("data-id"), 'api': api, 'user': user }),
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).then(res => {
                return res.json();
            }).then(data => {
                if (data) {
                    document.querySelector("body").classList.add("stop-scroll");
                    document.querySelector("." + data['selector']).innerHTML = data['html'];
                }
            }).catch((error) => console.log(error));
        }

        if (e.target.classList.contains("inner__tab")) {
            let element = e.target.parentNode;
            let tabs = element.querySelectorAll(".inner__tab");
            let tab = e.target;

            tabs.forEach(tabToRemove => {
                tabToRemove.classList.remove("inner__tab-selected");
            });

            let details = element.parentNode.querySelectorAll(".inner__detail");
            details.forEach(detailToRemove => {
                detailToRemove.classList.remove("inner__detail-selected");
            });

            let dataElement = tab.getAttribute("data-element");
            let detail = element.parentNode.querySelector('.inner__detail[data-element="' + dataElement + '"]');
            detail.classList.add("inner__detail-selected");
            tab.classList.add("inner__tab-selected");
        }

        let areaSelectItems = document.querySelectorAll('.select .select__item');
        if (areaSelectItems) {
            areaSelectItems.forEach(element => {
                let itemHead = element.querySelector(".item__head");
                let hiddenInput = element.querySelector('input[type="hidden"]');
                let multiContainer = element.querySelector('.multi');

                if (itemHead && itemHead.contains(e.target)) {
                    element.querySelector(".item").classList.toggle('item-opened');
                }

                let optionWraps = element.querySelector(".item__options") ? element.querySelector(".item__options").querySelectorAll('.option-wrap') : null;
                if (optionWraps) {
                    optionWraps.forEach((option) => {
                        if (option.contains(e.target)) {
                            element.querySelector(".item__options").querySelectorAll('.item__option').forEach((opt) => opt.classList.remove('item__option-selected'));
                            let selectedOption = option.querySelector(".item__option");
                            selectedOption.classList.add('item__option-selected');
                            element.querySelector("span").textContent = selectedOption.dataset.text;
                            // element.querySelector("input[type='hidden']").value = selectedOption.dataset.selectedValue;

                            if (element.parentNode.classList.contains('select-multi')) {
                                let selectedValue = selectedOption.dataset.selectedValue;
                                let values = hiddenInput.value ? hiddenInput.value.split(',') : [];
                                console.log(selectedValue);
                                console.log(values);
                                if (!values.includes(selectedValue)) {
                                    hiddenInput.value = [...values, selectedValue].join(',');
                                    updateMultiItems(element, hiddenInput, multiContainer);
                                }
                                element.querySelector("span").textContent = "Выберите значение";
                            } else {
                                element.querySelector("input[type='hidden']").value = selectedOption.dataset.selectedValue;
                            }
                        }
                    });
                }

                if (!itemHead.contains(e.target)) {
                    element.querySelector(".item").classList.remove('item-opened');
                }
            });
        }


        if (e.target.classList.contains("file-btn")) {
            e.target.parentNode.querySelector('.file-upload').click();
        }

        let fileUploads = document.querySelectorAll('.file-upload');
        if (fileUploads) {
            fileUploads.forEach(element => {
                element.addEventListener('change', function (e) {
                    e.target.parentNode.querySelector('.file-name').innerText = e.target.files[0].name;
                });
            });
        }

        if (e.target.classList.contains("item__edit") && !e.target.getAttribute("type")) {
            let element = document.createElement("button");
            element.type = "submit";
            element.classList.add("item__edit", "btn", "btn-green");
            let img = document.createElement("img");
            img.src = '/resources/img/save-icon.svg';
            element.appendChild(img);

            let container = e.target.parentNode;
            e.target.remove();
            container.appendChild(element);

            document.querySelector(".detail__col-info").classList.remove("info-blured");
        }
    });

    document.addEventListener("submit", (e) => {
        e.preventDefault();
        let formData = new FormData(e.target);
        let url = e.target.getAttribute("data-url");
        fetch(url, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).then(res => {
            return res.json();
        }).then(data => {
            if (data && !data['ok']) {
                Object.keys(data).forEach(element => {
                    let invalid = e.target.querySelector("." + element);
                    invalid.classList.add("show");
                    invalid.querySelector("p").innerHTML = data[element];
                });
            } else { location.reload(); }
        }).catch((error) => console.log(error));
    });

    document.querySelectorAll('.checkboxes-ajax').forEach((checkboxAjax) => {
        let checkboxes = checkboxAjax.querySelectorAll('input[type=checkbox]');

        let hiddenInputs = checkboxAjax.querySelectorAll('input[type="hidden"]');
        let result = {};
        hiddenInputs.forEach((input) => {
            result[input.name] = input.value;
        });

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
                let dataId = checkbox.getAttribute('data-id');
                let hiddenInput = checkbox.parentNode.parentNode.querySelector('input[type="hidden"]');
                let hiddenValue = hiddenInput.value.split(',');

                if (checkbox.checked) {
                    if (!hiddenValue.includes(dataId)) {
                        hiddenValue.push(dataId);
                    }
                } else {
                    let index = hiddenValue.indexOf(dataId);
                    if (index > -1) {
                        hiddenValue.splice(index, 1);
                    }
                }

                hiddenInput.value = hiddenValue.join(',');

                let hiddenInputs = checkboxAjax.querySelectorAll('input[type="hidden"]');
                let result = {};
                hiddenInputs.forEach((input) => {
                    result[input.name] = input.value;
                });

                let url = checkboxAjax.getAttribute('data-url');
                fetch(url, {
                    method: 'POST',
                    body: new URLSearchParams({ 'id': checkboxAjax.getAttribute("data-id"), 'checked_inputs': JSON.stringify(result), 'checked': hiddenInput.value, 'element_id': checkboxAjax.getAttribute('data-element'), 'api': checkboxAjax.getAttribute('data-api') }),
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                }).then(res => {
                    return res.json();
                }).then(data => {
                    document.getElementById(data['selector']).innerHTML = data['html'];
                }).catch((error) => console.log(error));
            });
        });
    });

    document.querySelectorAll(".checkbox-ajax").forEach(element => {
        let checkbox = element.querySelector("input[type='checkbox']");
        if (!checkbox) checkbox = element.querySelector("input[type='radio']");
        let hidden = element.querySelector("input[type='hidden']");
        let url = element.getAttribute('data-url');

        checkbox.addEventListener("change", () => {
            fetch(url, {
                method: 'POST',
                body: new URLSearchParams({ 'question_id': checkbox.getAttribute("data-id"), 'user_id': hidden.value, 'completed': checkbox.checked ? 'Y' : 'N' }),
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).then(res => {
                return res.json();
            }).then(data => {
                console.log(data);
                if (checkbox.type == "radio") {
                    element.parentNode.parentNode.querySelector(".rate__num").innerHTML = data['new_rating'];
                }
            }).catch((error) => console.log(error));
        });
    });

});

const updateMultiItems = (element, hiddenInput, multiContainer) => {
    let values = hiddenInput.value.split(',');
    multiContainer.innerHTML = '';
    values.forEach(value => {
        let multiItem = document.createElement('div');
        multiItem.classList.add('multi-item');
        element.querySelector(`input[data-selected-value='${value}']`).classList.add("item__option-marked");
        multiItem.innerHTML = `<img src="/resources/img/multi-remove.svg" alt=""><p>${element.querySelector(`input[data-selected-value='${value}']`).dataset.text}</p>`;
        multiItem.querySelector('img').addEventListener('click', (e) => {
            e.stopPropagation();
            multiItem.remove();
            element.querySelector(`input[data-selected-value='${value}']`).classList.remove("item__option-marked");
            hiddenInput.value = hiddenInput.value.split(',').filter(v => v !== value).join(',');
            element.classList.toggle('select__item-multi', hiddenInput.value.length > 0);
        });
        multiContainer.appendChild(multiItem);
    });
    element.classList.toggle('select__item-multi', values.length > 0);
};