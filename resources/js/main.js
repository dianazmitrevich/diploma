const generateRandomString = () =>
    Array.from(
        { length: 10 },
        () => "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"[Math.floor(Math.random() * 62)]
    ).join("");

document.addEventListener("DOMContentLoaded", () => {
    let selects = document.querySelectorAll(".select .select__item");
    if (selects) {
        selects.forEach((wrapItem) => {
            const randomString = generateRandomString();
            wrapItem
                .querySelectorAll('input[type="radio"]')
                .forEach((radioButton) => (radioButton.name = randomString));
        });
    }

    let radios = document.querySelectorAll(".radios");
    if (radios) {
        radios.forEach((wrapItem) => {
            const randomString = generateRandomString();
            wrapItem
                .querySelectorAll('input[type="radio"]')
                .forEach((radioButton) => (radioButton.name = randomString));
        });
    }

    // let table = document.querySelector(".profile-table .table__item table");
    // for (let item of table.querySelectorAll("tbody tr:nth-child(n+5)")) {
    //     item.style.display = "none";
    // }

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
                document.querySelector("body").classList.contains("stop-scroll")
                    ? document.querySelector("body").classList.remove("stop-scroll")
                    : document.querySelector("body").classList.add("stop-scroll");
            }
        });

        if (e.target.classList.contains("btn-ajax")) {
            let element = e.target;
            let api;
            let user;

            api = element.getAttribute("data-api") ? element.getAttribute("data-api") : "";
            user = element.getAttribute("data-user") ? element.getAttribute("data-user") : "";
            item = element.getAttribute("data-item") ? element.getAttribute("data-item") : "";

            fetch(element.getAttribute("data-url"), {
                method: "POST",
                body: new URLSearchParams({
                    element_id: element.getAttribute("data-id"),
                    api: api,
                    user: user,
                    item: item,
                }),
                headers: { "X-Requested-With": "XMLHttpRequest" },
            })
                .then((res) => {
                    return res.json();
                })
                .then((data) => {
                    if (data) {
                        document.querySelector("body").classList.add("stop-scroll");
                        document.querySelector("." + data["selector"]).innerHTML = data["html"];
                    }
                })
                .catch((error) => console.log(error));
        }

        if (e.target.classList.contains("inner__tab")) {
            let element = e.target.parentNode;
            let tabs = element.querySelectorAll(".inner__tab");
            let tab = e.target;

            tabs.forEach((tabToRemove) => {
                tabToRemove.classList.remove("inner__tab-selected");
            });

            let details = element.parentNode.querySelectorAll(".inner__detail");
            details.forEach((detailToRemove) => {
                detailToRemove.classList.remove("inner__detail-selected");
            });

            let dataElement = tab.getAttribute("data-element");
            let detail = element.parentNode.querySelector('.inner__detail[data-element="' + dataElement + '"]');
            detail.classList.add("inner__detail-selected");
            tab.classList.add("inner__tab-selected");
        }

        let areaSelectItems = document.querySelectorAll(".select .select__item");
        if (areaSelectItems) {
            areaSelectItems.forEach((element) => {
                let itemHead = element.querySelector(".item__head");
                let hiddenInput = element.querySelector('input[type="hidden"]');
                let multiContainer = element.querySelector(".multi");

                if (itemHead && itemHead.contains(e.target)) {
                    element.querySelector(".item").classList.toggle("item-opened");
                }

                let optionWraps = element.querySelector(".item__options")
                    ? element.querySelector(".item__options").querySelectorAll(".option-wrap")
                    : null;
                if (optionWraps) {
                    optionWraps.forEach((option) => {
                        if (option.contains(e.target)) {
                            element
                                .querySelector(".item__options")
                                .querySelectorAll(".item__option")
                                .forEach((opt) => opt.classList.remove("item__option-selected"));
                            let selectedOption = option.querySelector(".item__option");
                            selectedOption.classList.add("item__option-selected");
                            element.querySelector("span").textContent = selectedOption.dataset.text;
                            // element.querySelector("input[type='hidden']").value = selectedOption.dataset.selectedValue;

                            if (element.parentNode.classList.contains("select-multi")) {
                                let selectedValue = selectedOption.dataset.selectedValue;
                                let values = hiddenInput.value ? hiddenInput.value.split(",") : [];
                                console.log(selectedValue);
                                console.log(values);
                                if (!values.includes(selectedValue)) {
                                    hiddenInput.value = [...values, selectedValue].join(",");
                                    updateMultiItems(element, hiddenInput, multiContainer);
                                }
                                element.querySelector("span").textContent = "Выберите значение";
                            } else {
                                element.querySelector("input[type='hidden']").value =
                                    selectedOption.dataset.selectedValue;
                            }
                        }
                    });
                }

                if (!itemHead.contains(e.target)) {
                    element.querySelector(".item").classList.remove("item-opened");
                }
            });
        }

        if (e.target.classList.contains("file-btn")) {
            e.target.parentNode.querySelector(".file-upload").click();
        }

        let fileUploads = document.querySelectorAll(".file-upload");
        if (fileUploads) {
            fileUploads.forEach((element) => {
                element.addEventListener("change", function (e) {
                    e.target.parentNode.querySelector(".file-name").innerText = e.target.files[0].name;
                });
            });
        }

        if (e.target.classList.contains("item__edit") && !e.target.getAttribute("type")) {
            let element = document.createElement("button");
            element.type = "submit";
            element.classList.add("item__edit", "btn", "btn-green");
            let img = document.createElement("img");
            img.src = "/resources/img/save-icon.svg";
            element.appendChild(img);

            let container = e.target.parentNode;
            e.target.remove();
            container.appendChild(element);

            document.querySelector(".detail__col-info").classList.remove("info-blured");
        }

        if (e.target.classList.contains("btn-red")) {
            let table = e.target.closest(".table__item");
            let items = table.querySelectorAll("tbody tr");

            if (e.target.textContent === "Показать еще") {
                for (let item of items) {
                    item.style.display = "";
                }
                e.target.textContent = "Скрыть";
            } else {
                for (let i = 4; i < items.length; i++) {
                    items[i].style.display = "none";
                }
                e.target.textContent = "Показать еще";
            }
        }

        document.querySelectorAll(".form__field-hinted.hinted-company").forEach(function (field) {
            let inputField = field.querySelector('input[name="company"]');
            let hiddenField = field.querySelector('input[name="company_id"]');
            let hintList = field.querySelector(".field-hints");

            if (!hintList) {
                hintList = document.createElement("ul");
                hintList.className = "field-hints";
                hintList.style.display = "none";
                field.appendChild(hintList);
            }

            inputField.addEventListener("input", function (e) {
                let inputValue = e.target.value;
                if (inputValue === "") {
                    hiddenField.value = "";
                    hintList.innerHTML = "";
                    hintList.style.display = "none";
                    return;
                }
                fetch("/api/companies")
                    .then((response) => response.json())
                    .then((data) => {
                        let matches = data.filter((item) =>
                            item.name.toLowerCase().startsWith(inputValue.toLowerCase())
                        );
                        hintList.innerHTML = "";
                        if (matches.length > 0) {
                            matches.forEach((item) => {
                                let listItem = document.createElement("li");
                                listItem.textContent = item.name;
                                listItem.addEventListener("click", function (event) {
                                    event.stopPropagation();
                                    inputField.value = item.name;
                                    hiddenField.value = item.id_company;
                                    hintList.innerHTML = "";
                                    hintList.style.display = "none";
                                });
                                hintList.appendChild(listItem);
                            });
                            hintList.style.display = "block";
                        } else {
                            hintList.style.display = "none";
                        }
                    });
            });

            inputField.addEventListener("change", function (e) {
                if (e.target.value === "") {
                    hiddenField.value = "";
                    hintList.innerHTML = "";
                    hintList.style.display = "none";
                }
            });
        });

        document.querySelectorAll(".form__field-hinted.hinted-techs").forEach(function (field) {
            let inputField = field.querySelector('input[name="tech"]');
            let hiddenField = field.querySelector('input[name="techs_list"]');
            let hintList = field.querySelector(".field-hints");
            let techsDiv = field.querySelector(".techs");

            if (!hintList) {
                hintList = document.createElement("ul");
                hintList.className = "field-hints";
                hintList.style.display = "none";
                field.appendChild(hintList);
            }

            inputField.addEventListener("input", function (e) {
                let inputValue = e.target.value;
                if (inputValue === "") {
                    hintList.innerHTML = "";
                    hintList.style.display = "none";
                    return;
                }
                fetch("/api/techs")
                    .then((response) => response.json())
                    .then((data) => {
                        let matches = data.filter((item) =>
                            item.name.toLowerCase().startsWith(inputValue.toLowerCase())
                        );
                        hintList.innerHTML = "";
                        if (matches.length > 0) {
                            matches.forEach((item) => {
                                let listItem = document.createElement("li");
                                listItem.textContent = item.name;
                                listItem.addEventListener("click", function (event) {
                                    event.stopPropagation();
                                    hiddenField.value = hiddenField.value
                                        ? hiddenField.value + "," + item.id_tech
                                        : item.id_tech;
                                    hintList.innerHTML = "";
                                    hintList.style.display = "none";
                                    let techItem = document.createElement("div");
                                    techItem.className = "techs-item";
                                    techItem.innerHTML =
                                        '<img src="/resources/img/multi-remove.svg" alt=""><p>' + item.name + "</p>";
                                    techItem.querySelector("img").addEventListener("click", function (event) {
                                        event.stopPropagation();
                                        techItem.remove();
                                        let techs = hiddenField.value.split(",");
                                        let index = techs.indexOf(item.id_tech);
                                        if (index > -1) {
                                            techs.splice(index, 1);
                                        }
                                        hiddenField.value = techs.join(",");
                                    });
                                    techsDiv.appendChild(techItem);
                                    inputField.value = ""; // Очистка поля inputField после клика на элемент из списка
                                });
                                hintList.appendChild(listItem);
                            });
                        } else {
                            let listItem = document.createElement("li");
                            listItem.textContent = inputValue;
                            listItem.addEventListener("click", function (event) {
                                event.stopPropagation();
                                hiddenField.value = hiddenField.value
                                    ? hiddenField.value + "," + inputValue
                                    : inputValue;
                                hintList.innerHTML = "";
                                hintList.style.display = "none";
                                let techItem = document.createElement("div");
                                techItem.className = "techs-item";
                                techItem.innerHTML =
                                    '<img src="/resources/img/multi-remove.svg" alt=""><p>' + inputValue + "</p>";
                                techItem.querySelector("img").addEventListener("click", function (event) {
                                    event.stopPropagation();
                                    techItem.remove();
                                    let techs = hiddenField.value.split(",");
                                    let index = techs.indexOf(inputValue);
                                    if (index > -1) {
                                        techs.splice(index, 1);
                                    }
                                    hiddenField.value = techs.join(",");
                                });
                                techsDiv.appendChild(techItem);
                                inputField.value = ""; // Очистка поля inputField после клика на элемент из списка
                            });
                            hintList.appendChild(listItem);
                        }
                        hintList.style.display = "block";
                    });
            });

            inputField.addEventListener("change", function (e) {
                if (e.target.value === "") {
                    hintList.innerHTML = "";
                    hintList.style.display = "none";
                }
            });
        });

        if (e.target.classList.contains("item__option") && e.target.closest(".select-main-topic")) {
            let dataTopic = e.target.parentNode.dataset.topic;
            e.target.closest(".select-main-topic").querySelector(".field-invalid").classList.remove("inc_topic");
            e.target.closest(".select-main-topic").querySelector("input[type='hidden']").name = "";

            let selectedTab = e.target
                .closest(".select-main-topic")
                .parentNode.querySelector(`.form__field[data-topic="${dataTopic}"]`);

            e.target
                .closest(".select-main-topic")
                .parentNode.querySelectorAll(`.select-subtopic`)
                .forEach((element) => {
                    element.style.display = "none";

                    element.querySelector("input[type='hidden']").removeAttribute("value");
                    element.querySelector("input[type='hidden']").name = "";
                    element.querySelector(".field-invalid").classList.remove("inc_topic");
                    element.querySelector(".item__head span").innerHTML = "Выберите подтему";
                });

            selectedTab.style.display = "block";
            selectedTab.querySelector("input[type='hidden']").name = "topic";
            selectedTab.querySelector(".field-invalid").classList.add("inc_topic");
        }
    });

    // document.addEventListener("submit", (e) => {
    //     e.preventDefault();
    //     let formData = new FormData(e.target);
    //     let url = e.target.getAttribute("data-url");
    //     fetch(url, {
    //         method: "POST",
    //         body: formData,
    //         headers: { "X-Requested-With": "XMLHttpRequest" },
    //     })
    //         .then((res) => {
    //             return res.json();
    //         })
    //         .then((data) => {
    //             console.log(data);
    //             if (data && !data["ok"]) {
    //                 Object.keys(data).forEach((element) => {
    //                     let invalid = e.target.querySelector("." + element);
    //                     invalid.classList.add("show");
    //                     invalid.querySelector("p").innerHTML = data[element];
    //                 });
    //             } else {
    //                 location.reload();
    //             }
    //         })
    //         .catch((error) => console.log(error));
    // });

    document.addEventListener("submit", (e) => {
        e.preventDefault();

        if (e.target.classList.contains("confirm-remove")) {
            document.querySelector(".confirm__wrap").classList.add("show");
            document.querySelector(".confirm-wrap").classList.add("show");
            document.querySelector(".confirm__wrap .wrap__text").innerHTML = e.target.getAttribute("data-confirm");
            document.querySelector(".confirm__wrap .btn-yellow").innerHTML = e.target.getAttribute("data-positive");
            document.body.classList.add("stop-scroll");

            function resetConfirmModal() {
                document.querySelector(".confirm__wrap").classList.remove("show");
                document.querySelector(".confirm-wrap").classList.remove("show");
                document.body.classList.remove("stop-scroll");
            }
            console.log(e.target);

            document.querySelector(".confirm .btn-yellow").addEventListener("click", () => {
                sendForm(e.target);
                resetConfirmModal();
            });

            document.querySelector(".confirm .btn-grey").addEventListener("click", () => {
                resetConfirmModal();
            });
        } else {
            sendForm(e.target);
        }
    });

    function sendForm(form) {
        let formData = new FormData(form);
        let url = form.getAttribute("data-url");
        fetch(url, {
            method: "POST",
            body: formData,
            headers: { "X-Requested-With": "XMLHttpRequest" },
        })
            .then((res) => res.json())
            .then((data) => {
                console.log(data);
                if (data && !data["ok"]) {
                    Object.keys(data).forEach((element) => {
                        let invalid = form.querySelector("." + element);
                        invalid.classList.add("show");
                        invalid.querySelector("p").innerHTML = data[element];
                    });
                } else {
                    if (data.redirect_url) {
                        window.location.href = data.redirect_url;
                    } else {
                        location.reload();
                    }
                }
            })
            .catch((error) => console.log(error));
    }

    document.querySelectorAll(".checkboxes-ajax").forEach((checkboxAjax) => {
        let checkboxes = checkboxAjax.querySelectorAll("input[type=checkbox]");

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", () => {
                let dataId = checkbox.getAttribute("data-id");
                let hiddenInput = checkbox.parentNode.parentNode.querySelector('input[type="hidden"]');
                let hiddenValue = hiddenInput.value.split(",");

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

                if (checkboxAjax.classList.contains("checkboxes-collect")) {
                    let infoElement = document.querySelector(".checkboxes-info");
                    let infoDataElement = infoElement.querySelector(
                        `[data-info="${hiddenInput.getAttribute("data-info")}"]`
                    );

                    let labels = hiddenValue.map((id) => {
                        if (id) {
                            return hiddenInput.parentNode
                                .querySelector(`input[data-id="${id}"]`)
                                .parentNode.querySelector("label").textContent;
                        }
                    });

                    if (hiddenInput.getAttribute("data-info") == 1) {
                        infoDataElement.innerHTML = "Выбранные технологии: ";
                    } else if (hiddenInput.getAttribute("data-info") == 2) {
                        infoDataElement.innerHTML = "Выбранные уровни: ";
                    }

                    if (labels.length === 1) {
                        labels = "-";
                    } else labels = labels.join(", ").replace(/^,|,$/g, "");
                    infoDataElement.innerHTML += labels;
                }

                hiddenInput.value = hiddenValue.join(",");

                let hiddenInputs = checkboxAjax.querySelectorAll('input[type="hidden"]');
                let result = {};
                hiddenInputs.forEach((input) => {
                    result[input.name] = input.value;
                });

                let url = checkboxAjax.getAttribute("data-url");
                fetch(url, {
                    method: "POST",
                    body: new URLSearchParams({
                        id: checkboxAjax.getAttribute("data-id"),
                        checked_inputs: JSON.stringify(result),
                        checked: hiddenInput.value,
                        element_id: checkboxAjax.getAttribute("data-element"),
                        api: checkboxAjax.getAttribute("data-api"),
                        user_id: checkboxAjax.getAttribute("data-user"),
                        user_role: checkboxAjax.getAttribute("data-role"),
                        topic_id: checkboxAjax.getAttribute("data-topic"),
                    }),
                    headers: { "X-Requested-With": "XMLHttpRequest" },
                })
                    .then((res) => {
                        return res.json();
                    })
                    .then((data) => {
                        console.log(data);
                        if (data["selector"]) {
                            document.getElementById(data["selector"]).innerHTML = data["html"];
                        }

                        if (data["percent"] || data["percent"] === 0) {
                            document.querySelector(
                                ".progress-circle .circle__item"
                            ).style = `--percent: ${data["percent"]}`;
                            document.querySelector(".progress-circle .circle__item p").innerHTML =
                                data["percent"] + "%";
                            document.querySelector(
                                ".progress-circle .circle__text .done span"
                            ).innerHTML = `${data["completed_count"]}/${data["topic_count"]}`;
                        }
                    })
                    .catch((error) => console.log(error));
            });
        });
    });

    document.querySelectorAll(".checkbox-ajax").forEach((element) => {
        let checkbox = element.querySelector("input[type='checkbox']");
        if (!checkbox) checkbox = element.querySelector("input[type='radio']");
        let hidden = element.querySelector("input[type='hidden']");
        let url = element.getAttribute("data-url");

        checkbox.addEventListener("change", () => {
            fetch(url, {
                method: "POST",
                body: new URLSearchParams({
                    question_id: checkbox.getAttribute("data-id"),
                    user_id: hidden.value,
                    completed: checkbox.checked ? "Y" : "N",
                }),
                headers: { "X-Requested-With": "XMLHttpRequest" },
            })
                .then((res) => {
                    return res.json();
                })
                .then((data) => {
                    if (element.classList.contains("rate-block")) {
                        element.parentNode.querySelector(".rating-like").innerHTML = data["new_rating_l"];
                        element.parentNode.querySelector(".rating-dislike").innerHTML = data["new_rating_d"];
                    }
                })
                .catch((error) => console.log(error));
        });
    });

    let tabs = document.querySelectorAll(".tabs");
    if (tabs) {
        tabs.forEach((element) => {
            let items = element.querySelectorAll(".tabs__item");
            let details = element.querySelectorAll(".tabs__detail");

            items.forEach((item) => {
                item.addEventListener("click", () => {
                    items.forEach((itemInner) => {
                        itemInner.classList.remove("selected");
                    });

                    item.classList.add("selected");

                    details.forEach((detailInner) => {
                        detailInner.classList.remove("selected");
                    });

                    element
                        .querySelector(".tabs__detail[data-detail='" + item.getAttribute("data-detail") + "']")
                        .classList.add("selected");
                });
            });
        });
    }

    document.querySelectorAll('.item__rate .checkbox-ajax input[type="checkbox"]').forEach(function (checkbox) {
        checkbox.addEventListener("change", function () {
            if (this.checked) {
                let otherCheckbox = Array.from(
                    this.closest(".item__rate").querySelectorAll('.checkbox-ajax input[type="checkbox"]')
                ).find((cb) => cb !== this);
                otherCheckbox.checked = false;
            }
        });
    });

    var rateReplyElements = document.querySelectorAll(".rate-reply");
    rateReplyElements.forEach(function (rateReplyElement) {
        rateReplyElement.addEventListener("click", function () {
            var itemRow = this.closest(".item__row") || this.closest(".item__row-sm");
            var itemRate = itemRow.querySelector(".item__rate");
            var replyForm = itemRow.querySelector(".item__reply");
            if (replyForm) {
                replyForm.remove();
            } else {
                var replyId = itemRow.querySelector('input[name="reply_id"]').value;
                var questionId = itemRow.querySelector('input[name="question_id"]').value;
                var authorName = itemRow.querySelector(".item__author-name").textContent;
                let textValue = "";
                if (itemRow.classList.contains("item__row-sm")) {
                    textValue = authorName;
                }
                var formHTML = `
                        <form class="item__reply reply" data-url="/add-reply">
                            <p>Ответ ${authorName}:</p>
                            <div class="wrap">
                                <input type="hidden" name="reply_id" value="${replyId}" required="">
                                <input type="hidden" name="question_id" value="${questionId}" required="">
                                <input type="text" name="text" placeholder="Текст ответа" value="${textValue} "><input type="submit" value="">
                            </div>
                        </form>
                    `;
                itemRate.insertAdjacentHTML("afterend", formHTML);
            }
        });
    });
});

const updateMultiItems = (element, hiddenInput, multiContainer) => {
    let values = hiddenInput.value.split(",");
    multiContainer.innerHTML = "";
    values.forEach((value) => {
        let multiItem = document.createElement("div");
        multiItem.classList.add("multi-item");
        element.querySelector(`input[data-selected-value='${value}']`).classList.add("item__option-marked");
        multiItem.innerHTML = `<img src="/resources/img/multi-remove.svg" alt=""><p>${
            element.querySelector(`input[data-selected-value='${value}']`).dataset.text
        }</p>`;
        multiItem.querySelector("img").addEventListener("click", (e) => {
            e.stopPropagation();
            multiItem.remove();
            element.querySelector(`input[data-selected-value='${value}']`).classList.remove("item__option-marked");
            hiddenInput.value = hiddenInput.value
                .split(",")
                .filter((v) => v !== value)
                .join(",");
            element.classList.toggle("select__item-multi", hiddenInput.value.length > 0);
        });
        multiContainer.appendChild(multiItem);
    });
    element.classList.toggle("select__item-multi", values.length > 0);
};
