/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (function () { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/main.js":
/*!************************!*\
  !*** ./src/js/main.js ***!
  \************************/
/***/ (function () {

        eval("// const sum = require(\"./module/sum.js\");\n\nconst generateRandomString = () => Array.from({ length: 10 }, () => 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'[Math.floor(Math.random() * 62)]).join('');\n\ndocument.addEventListener(\"DOMContentLoaded\", () => {\n    let selects = document.querySelectorAll('.select .select__item');\n    if (selects) {\n        selects.forEach(wrapItem => {\n            const randomString = generateRandomString();\n            wrapItem.querySelectorAll('input[type=\"radio\"]').forEach(radioButton => radioButton.name = randomString);\n        });\n    }\n\n    let radios = document.querySelectorAll('.radios');\n    if (radios) {\n        radios.forEach(wrapItem => {\n            const randomString = generateRandomString();\n            wrapItem.querySelectorAll('input[type=\"radio\"]').forEach(radioButton => radioButton.name = randomString);\n        });\n    }\n\n    let fileFields = document.querySelectorAll('.file-btn');\n    if (fileFields) {\n        fileFields.forEach(element => {\n            element.addEventListener('click', function (e) {\n                e.target.parentNode.querySelector('.file-upload').click();\n            });\n        });\n    }\n\n    let fileUploads = document.querySelectorAll('.file-upload');\n    if (fileUploads) {\n        fileUploads.forEach(element => {\n            element.addEventListener('change', function (e) {\n                e.target.parentNode.querySelector('.file-name').innerText = e.target.files[0].name;\n            });\n        });\n    }\n\n    let areaSelectItems = document.querySelectorAll('.select .select__item');\n    if (areaSelectItems) {\n        areaSelectItems.forEach(element => {\n            let itemHead = element.querySelector(\".item__head\");\n            let hiddenInput = element.querySelector('input[type=\"hidden\"]');\n            let multiContainer = element.querySelector('.multi');\n\n            itemHead.addEventListener('click', () => {\n                element.querySelector(\".item\").classList.toggle('item-opened')\n                // let wraps = element.querySelectorAll('.option-wrap');\n                // let finalHeight = [...wraps].slice(0, 3).reduce((a, b) => a + b.offsetHeight, 0) - 1;\n                // element.querySelector(\".item__options\").style.maxHeight = finalHeight + 'px';\n            });\n\n            element.querySelector(\".item__options\").querySelectorAll('.option-wrap').forEach((option) => {\n                option.addEventListener('click', (e) => {\n                    element.querySelector(\".item__options\").querySelectorAll('.item__option').forEach((opt) => opt.classList.remove('item__option-selected'));\n                    let selectedOption = option.querySelector(\".item__option\");\n                    selectedOption.classList.add('item__option-selected');\n                    element.querySelector(\"span\").textContent = selectedOption.dataset.text;\n\n                    if (element.parentNode.classList.contains('select-multi')) {\n                        let selectedValue = selectedOption.dataset.selectedValue;\n                        let values = hiddenInput.value ? hiddenInput.value.split(',') : [];\n                        if (!values.includes(selectedValue)) {\n                            hiddenInput.value = [...values, selectedValue].join(',');\n                            updateMultiItems(element, hiddenInput, multiContainer);\n                        }\n                        element.querySelector(\"span\").textContent = \"Выберите значение\";\n                    }\n                });\n            });\n\n            document.addEventListener('click', (e) => {\n                if (!itemHead.contains(e.target)) {\n                    element.querySelector(\".item\").classList.remove('item-opened');\n                }\n            });\n        });\n    }\n\n    [\"popup\", \"dropdown\"].forEach((c) => {\n        document.querySelectorAll(`.${c}`).forEach((e) => {\n            e.querySelectorAll(`.${c}__btn`).forEach((i) => {\n                i.addEventListener(\"click\", () => {\n                    document.querySelectorAll(\".popup__wrap, .dropdown__wrap, .popup-wrap, .dropdown-wrap\").forEach((w) => {\n                        if (w !== e.querySelector(`.${c}__wrap`) && w !== e.querySelector(`.${c}-wrap`)) {\n                            w.classList.remove(\"show\");\n                        }\n                    });\n\n                    e.querySelector(`.${c}__wrap`).classList.toggle(\"show\");\n                    e.querySelector(`.${c}-wrap`) ? e.querySelector(`.${c}-wrap`).classList.toggle(\"show\") : \"\";\n                    document.querySelector(\"body\").classList.contains(\"stop-scroll\") ? document.querySelector(\"body\").classList.remove(\"stop-scroll\") : document.querySelector(\"body\").classList.add(\"stop-scroll\");\n                });\n            });\n        });\n    });\n\n    document.addEventListener(\"click\", (e) => {\n        if (e.target.classList.contains(\"popup__wrap\")) {\n            document.querySelectorAll(\".popup__wrap, .dropdown__wrap, .popup-wrap, .dropdown-wrap\").forEach((w) => {\n                w.classList.remove(\"show\");\n\n                document.querySelector(\"body\").classList.remove(\"stop-scroll\");\n            });\n        }\n        if (![\"popup\", \"dropdown\", \"cta\"].some((c) => e.target.closest(`.${c}`))) {\n            document.querySelectorAll(\".popup__wrap, .dropdown__wrap, .popup-wrap, .dropdown-wrap\").forEach((w) => {\n                w.classList.remove(\"show\");\n\n                document.querySelector(\"body\").classList.remove(\"stop-scroll\");\n            });\n        }\n    });\n\n    let popupTabs = document.querySelectorAll(\".popup .inner__tabs\");\n    if (popupTabs) {\n        popupTabs.forEach(element => {\n            let tabs = element.querySelectorAll(\".inner__tab\");\n\n            tabs.forEach(tab => {\n                tab.addEventListener(\"click\", () => {\n                    tabs.forEach(tabToRemove => {\n                        tabToRemove.classList.remove(\"inner__tab-selected\");\n                    });\n\n                    let details = element.parentNode.querySelectorAll(\".inner__detail\");\n                    details.forEach(detailToRemove => {\n                        detailToRemove.classList.remove(\"inner__detail-selected\");\n                    });\n\n                    let dataElement = tab.getAttribute(\"data-element\");\n                    let detail = element.parentNode.querySelector('.inner__detail[data-element=\"' + dataElement + '\"]');\n                    detail.classList.add(\"inner__detail-selected\");\n                    tab.classList.add(\"inner__tab-selected\");\n                });\n            });\n        });\n    }\n});\n\nconst updateMultiItems = (element, hiddenInput, multiContainer) => {\n    let values = hiddenInput.value.split(',');\n    multiContainer.innerHTML = '';\n    values.forEach(value => {\n        let multiItem = document.createElement('div');\n        multiItem.classList.add('multi-item');\n        element.querySelector(`input[data-selected-value='${value}']`).classList.add(\"item__option-marked\");\n        multiItem.innerHTML = `<img src=\"img/multi-remove.svg\" alt=\"\"><p>${element.querySelector(`input[data-selected-value='${value}']`).dataset.text}</p>`;\n        multiItem.querySelector('img').addEventListener('click', (e) => {\n            e.stopPropagation();\n            multiItem.remove();\n            element.querySelector(`input[data-selected-value='${value}']`).classList.remove(\"item__option-marked\");\n            hiddenInput.value = hiddenInput.value.split(',').filter(v => v !== value).join(',');\n            element.classList.toggle('select__item-multi', hiddenInput.value.length > 0);\n        });\n        multiContainer.appendChild(multiItem);\n    });\n    element.classList.toggle('select__item-multi', values.length > 0);\n};\n\n//# sourceURL=webpack://gulp-starter/./src/js/main.js?");

        /***/
})

    /******/
});
/************************************************************************/
/******/
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./src/js/main.js"]();
  /******/
  /******/
})()
  ;