!function(){const e=()=>Array.from({length:10},(()=>"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"[Math.floor(62*Math.random())])).join("");document.addEventListener("DOMContentLoaded",(()=>{let l=document.querySelectorAll(".select .select__item");l&&l.forEach((t=>{const l=e();t.querySelectorAll('input[type="radio"]').forEach((e=>e.name=l))}));let o=document.querySelectorAll(".radios");o&&o.forEach((t=>{const l=e();t.querySelectorAll('input[type="radio"]').forEach((e=>e.name=l))}));let r=document.querySelectorAll(".file-btn");r&&r.forEach((e=>{e.addEventListener("click",(function(e){e.target.parentNode.querySelector(".file-upload").click()}))}));let c=document.querySelectorAll(".file-upload");c&&c.forEach((e=>{e.addEventListener("change",(function(e){e.target.parentNode.querySelector(".file-name").innerText=e.target.files[0].name}))}));let a=document.querySelectorAll(".select .select__item");a&&a.forEach((e=>{let l=e.querySelector(".item__head"),o=e.querySelector('input[type="hidden"]'),r=e.querySelector(".multi");l.addEventListener("click",(()=>{e.querySelector(".item").classList.toggle("item-opened")})),e.querySelector(".item__options").querySelectorAll(".option-wrap").forEach((l=>{l.addEventListener("click",(c=>{e.querySelector(".item__options").querySelectorAll(".item__option").forEach((e=>e.classList.remove("item__option-selected")));let a=l.querySelector(".item__option");if(a.classList.add("item__option-selected"),e.querySelector("span").textContent=a.dataset.text,e.parentNode.classList.contains("select-multi")){let l=a.dataset.selectedValue,c=o.value?o.value.split(","):[];c.includes(l)||(o.value=[...c,l].join(","),t(e,o,r)),e.querySelector("span").textContent="Выберите значение"}}))})),document.addEventListener("click",(t=>{l.contains(t.target)||e.querySelector(".item").classList.remove("item-opened")}))})),["popup","dropdown"].forEach((e=>{document.querySelectorAll(`.${e}`).forEach((t=>{t.querySelectorAll(`.${e}__btn`).forEach((l=>{l.addEventListener("click",(()=>{document.querySelectorAll(".popup__wrap, .dropdown__wrap, .popup-wrap, .dropdown-wrap").forEach((l=>{l!==t.querySelector(`.${e}__wrap`)&&l!==t.querySelector(`.${e}-wrap`)&&l.classList.remove("show")})),t.querySelector(`.${e}__wrap`).classList.toggle("show"),t.querySelector(`.${e}-wrap`)&&t.querySelector(`.${e}-wrap`).classList.toggle("show"),document.querySelector("body").classList.contains("stop-scroll")?document.querySelector("body").classList.remove("stop-scroll"):document.querySelector("body").classList.add("stop-scroll")}))}))}))})),document.addEventListener("click",(e=>{e.target.classList.contains("popup__wrap")&&document.querySelectorAll(".popup__wrap, .dropdown__wrap, .popup-wrap, .dropdown-wrap").forEach((e=>{e.classList.remove("show"),document.querySelector("body").classList.remove("stop-scroll")})),["popup","dropdown","cta"].some((t=>e.target.closest(`.${t}`)))||document.querySelectorAll(".popup__wrap, .dropdown__wrap, .popup-wrap, .dropdown-wrap").forEach((e=>{e.classList.remove("show"),document.querySelector("body").classList.remove("stop-scroll")}))}));let s=document.querySelectorAll(".table__item");s&&s.forEach((function(e){let t=e.querySelector(".btn-sm.btn-red"),l=e.querySelectorAll("tbody tr");for(let e=4;e<l.length;e++)l[e].style.display="none";t.addEventListener("click",(function(){if("Показать еще"===t.textContent){for(let e of l)e.style.display="";t.textContent="Скрыть"}else{for(let e=4;e<l.length;e++)l[e].style.display="none";t.textContent="Показать еще"}}))}));let n=document.querySelectorAll(".popup .inner__tabs");n&&n.forEach((e=>{let t=e.querySelectorAll(".inner__tab");t.forEach((l=>{l.addEventListener("click",(()=>{t.forEach((e=>{e.classList.remove("inner__tab-selected")})),e.parentNode.querySelectorAll(".inner__detail").forEach((e=>{e.classList.remove("inner__detail-selected")}));let o=l.getAttribute("data-element");e.parentNode.querySelector('.inner__detail[data-element="'+o+'"]').classList.add("inner__detail-selected"),l.classList.add("inner__tab-selected")}))}))}));let i=document.querySelectorAll(".tabs");i&&i.forEach((e=>{let t=e.querySelectorAll(".tabs__item"),l=e.querySelectorAll(".tabs__detail");t.forEach((o=>{o.addEventListener("click",(()=>{t.forEach((e=>{e.classList.remove("selected")})),o.classList.add("selected"),l.forEach((e=>{e.classList.remove("selected")})),e.querySelector(".tabs__detail[data-detail='"+o.getAttribute("data-detail")+"']").classList.add("selected")}))}))}))}));const t=(e,t,l)=>{let o=t.value.split(",");l.innerHTML="",o.forEach((o=>{let r=document.createElement("div");r.classList.add("multi-item"),e.querySelector(`input[data-selected-value='${o}']`).classList.add("item__option-marked"),r.innerHTML=`<img src="img/multi-remove.svg" alt=""><p>${e.querySelector(`input[data-selected-value='${o}']`).dataset.text}</p>`,r.querySelector("img").addEventListener("click",(l=>{l.stopPropagation(),r.remove(),e.querySelector(`input[data-selected-value='${o}']`).classList.remove("item__option-marked"),t.value=t.value.split(",").filter((e=>e!==o)).join(","),e.classList.toggle("select__item-multi",t.value.length>0)})),l.appendChild(r)})),e.classList.toggle("select__item-multi",o.length>0)}}();