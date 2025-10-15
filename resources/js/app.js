import './bootstrap';
// import { initFlowbite } from 'flowbite';

// import { Datepicker } from 'flowbite';

// import vi from "../../node_modules/flowbite-datepicker/dist/js/locales/vi.js";

// import {vi} from "../../node_modulesflowbite-datepicker/locales/vi.js"

// document.addEventListener("livewire:navigated", () => {
//     initFlowbite();
// });


document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".number-input").forEach(input => {
        input.addEventListener("input", e => {
            let value = e.target.value.replace(/\D/g, "")
            if (value) {
                e.target.value = new Intl.NumberFormat('vi-VN').format(value);
            } else {
                e.target.value = "";
            }
        });
    });
});


