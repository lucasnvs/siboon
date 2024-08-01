// import {InputQuantity} from "../../shared/components/InputQuantity/InputQuantity.js";
//
// const divAvailableSizes =document.getElementById("available-sizes");
// const divQuantityBySize = document.getElementById("product-quantity-by-size");
//
// var staticCheckedsList = [];
//
// function clearQuantityBySize() {
//     staticCheckedsList = [];
//     updateQuantityBySize();
// }
//
// function updateQuantityBySize() {
//     let checkboxes = FORM_ELEMENTS.divAvailableSizes.querySelectorAll("input[type=checkbox]");
//     let checkeds = Array.prototype.filter.call(checkboxes, item => item.checked === true)
//
//     FORM_ELEMENTS.divQuantityBySize.innerHTML = "";
//     checkeds.forEach(check => {
//         FORM_ELEMENTS.divQuantityBySize.insertAdjacentHTML("beforeend", `
//                 <div id="${check.value}" class="row-quantity-size">
//                     <label>${check.value}</label>
//                 </div>
//            `)
//
//         let exist = staticCheckedsList.find(value => value.id === `quantity-${check.value}`)
//         if (exist === undefined) {
//             let newInputQuantity = new InputQuantity(check.value, `quantity-${check.value}`)
//             staticCheckedsList.push(newInputQuantity)
//             newInputQuantity.inflate();
//             return
//         }
//         exist.inflate()
//     })
// }
//
//
// ///// estava dentro do selectSize change event
//
// FORM_ELEMENTS.divAvailableSizes.innerHTML = "";
// clearQuantityBySize()
//
// type.forEach(type => { // escreve as checkboxes
//     FORM_ELEMENTS.divAvailableSizes.innerHTML += `
//                 <div>
//                     <input id="size-${type}" name="size" value="${type}" type="checkbox">
//                     <label for="size-${type}">${type}</label>
//                 </div>
//         `
// })
// FORM_ELEMENTS.divAvailableSizes.querySelectorAll("input[type=checkbox]").forEach(checkbox => {
//     checkbox.addEventListener("change", (checkbox) => { // add evento de change em todas checkboxes
//         let finded = staticCheckedsList.find(value => value.parentId === checkbox.target.value)
//         staticCheckedsList.splice(staticCheckedsList.indexOf(finded), 1);
//         updateQuantityBySize();
//     })
// })
