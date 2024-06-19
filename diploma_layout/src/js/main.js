// const sum = require("./module/sum.js");

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

    let fileFields = document.querySelectorAll(".file-btn");
    if (fileFields) {
        fileFields.forEach((element) => {
            element.addEventListener("click", function (e) {
                e.target.parentNode.querySelector(".file-upload").click();
            });
        });
    }

    let fileUploads = document.querySelectorAll(".file-upload");
    if (fileUploads) {
        fileUploads.forEach((element) => {
            element.addEventListener("change", function (e) {
                e.target.parentNode.querySelector(".file-name").innerText = e.target.files[0].name;
            });
        });
    }

    let areaSelectItems = document.querySelectorAll(".select .select__item");
    if (areaSelectItems) {
        areaSelectItems.forEach((element) => {
            let itemHead = element.querySelector(".item__head");
            let hiddenInput = element.querySelector('input[type="hidden"]');
            let multiContainer = element.querySelector(".multi");

            itemHead.addEventListener("click", () => {
                element.querySelector(".item").classList.toggle("item-opened");
                // let wraps = element.querySelectorAll('.option-wrap');
                // let finalHeight = [...wraps].slice(0, 3).reduce((a, b) => a + b.offsetHeight, 0) - 1;
                // element.querySelector(".item__options").style.maxHeight = finalHeight + 'px';
            });

            element
                .querySelector(".item__options")
                .querySelectorAll(".option-wrap")
                .forEach((option) => {
                    option.addEventListener("click", (e) => {
                        element
                            .querySelector(".item__options")
                            .querySelectorAll(".item__option")
                            .forEach((opt) => opt.classList.remove("item__option-selected"));
                        let selectedOption = option.querySelector(".item__option");
                        selectedOption.classList.add("item__option-selected");
                        element.querySelector("span").textContent = selectedOption.dataset.text;

                        if (element.parentNode.classList.contains("select-multi")) {
                            let selectedValue = selectedOption.dataset.selectedValue;
                            let values = hiddenInput.value ? hiddenInput.value.split(",") : [];
                            if (!values.includes(selectedValue)) {
                                hiddenInput.value = [...values, selectedValue].join(",");
                                updateMultiItems(element, hiddenInput, multiContainer);
                            }
                            element.querySelector("span").textContent = "Выберите значение";
                        }
                    });
                });

            document.addEventListener("click", (e) => {
                if (!itemHead.contains(e.target)) {
                    element.querySelector(".item").classList.remove("item-opened");
                }
            });
        });
    }

    ["popup", "dropdown"].forEach((c) => {
        document.querySelectorAll(`.${c}`).forEach((e) => {
            e.querySelectorAll(`.${c}__btn`).forEach((i) => {
                i.addEventListener("click", () => {
                    document
                        .querySelectorAll(".popup__wrap, .dropdown__wrap, .popup-wrap, .dropdown-wrap")
                        .forEach((w) => {
                            if (w !== e.querySelector(`.${c}__wrap`) && w !== e.querySelector(`.${c}-wrap`)) {
                                w.classList.remove("show");
                            }
                        });

                    e.querySelector(`.${c}__wrap`).classList.toggle("show");
                    e.querySelector(`.${c}-wrap`) ? e.querySelector(`.${c}-wrap`).classList.toggle("show") : "";
                    document.querySelector("body").classList.contains("stop-scroll")
                        ? document.querySelector("body").classList.remove("stop-scroll")
                        : document.querySelector("body").classList.add("stop-scroll");
                });
            });
        });
    });

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
    });

    // @2
    let tableItems = document.querySelectorAll(".table__item");
    if (tableItems) {
        tableItems.forEach(function (tableItem) {
            let button = tableItem.querySelector(".btn-sm.btn-red");
            let items = tableItem.querySelectorAll("tbody tr");

            for (let i = 4; i < items.length; i++) {
                items[i].style.display = "none";
            }

            button.addEventListener("click", function () {
                if (button.textContent === "Показать еще") {
                    for (let item of items) {
                        item.style.display = "";
                    }
                    button.textContent = "Скрыть";
                } else {
                    for (let i = 4; i < items.length; i++) {
                        items[i].style.display = "none";
                    }
                    button.textContent = "Показать еще";
                }
            });
        });
    }

    let popupTabs = document.querySelectorAll(".popup .inner__tabs");
    if (popupTabs) {
        popupTabs.forEach((element) => {
            let tabs = element.querySelectorAll(".inner__tab");

            tabs.forEach((tab) => {
                tab.addEventListener("click", () => {
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
                });
            });
        });
    }

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
});

const updateMultiItems = (element, hiddenInput, multiContainer) => {
    let values = hiddenInput.value.split(",");
    multiContainer.innerHTML = "";
    values.forEach((value) => {
        let multiItem = document.createElement("div");
        multiItem.classList.add("multi-item");
        element.querySelector(`input[data-selected-value='${value}']`).classList.add("item__option-marked");
        multiItem.innerHTML = `<img src="img/multi-remove.svg" alt=""><p>${
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
