const hari = document.querySelector("#hari");
(bulan = document.querySelector("#bulan")),
    (prevBtn = document.querySelector("#prev")),
    (nextBtn = document.querySelector("#next")),
    (todayBtn = document.querySelector("#today"));

const bulans = [
    "Januari",
    "Februari",
    "Maret",
    "April",
    "Mei",
    "Juni",
    "Juli",
    "Agustus",
    "September",
    "Oktober",
    "November",
    "Desember ",
];

const days = ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"];

const date = new Date();
let bulanSekarang = date.getMonth();
let tahunSekarang = date.getFullYear();

function tampilKalender() {
    date.setDate(1);
    const firstDay = new Date(tahunSekarang, bulanSekarang, 1);
    const lastDay = new Date(tahunSekarang, bulanSekarang + 1, 0);

    const lastDayIndex = lastDay.getDay();
    const lastDayDate = lastDay.getDate();
    const prevLastDay = new Date(tahunSekarang, bulanSekarang, 0);
    const prevLastDayDate = prevLastDay.getDate();

    const nextDays = 7 - lastDayIndex - 1;

    bulan.innerHTML = `${bulans[bulanSekarang]} ${tahunSekarang}`;

    let days = "";

    for (let i = firstDay.getDay(); i > 0; i--) {
        days += `<div class="text-slate-500 flex items-center justify-center">${
            prevLastDayDate - i + 1
        }</div>`;
    }

    for (let j = 1; j <= lastDayDate; j++) {
        if (
            j === new Date().getDate() &&
            bulanSekarang === new Date().getMonth() &&
            tahunSekarang === new Date().getFullYear()
        ) {
            days += `<div class="text-blue-500 p-1">${j}</div>`;
        } else {
            if (new Date(tahunSekarang, bulanSekarang, j).getDay() === 0) {
                days += `<div class="text-red-500 flex items-center justify-center p-1">${j}</div>`;
            } else {
                days += `<div class="p-1 flex items-center justify-center">${j}</div>`;
            }
        }
    }

    for (let k = 1; k <= nextDays; k++) {
        days += `<div class="text-slate-500 flex items-center justify-center">${k}</div>`;
    }

    hari.innerHTML = days;
}

tampilKalender();

nextBtn.addEventListener("click", () => {
    bulanSekarang++;
    if (bulanSekarang > 11) {
        bulanSekarang = 0;
        tahunSekarang++;
    }
    tampilKalender();
});

prevBtn.addEventListener("click", () => {
    bulanSekarang--;
    if (bulanSekarang < 0) {
        bulanSekarang = 11;
        tahunSekarang--;
    }
    tampilKalender();
});

todayBtn.addEventListener("click", () => {
    bulanSekarang = date.getMonth();
    tahunSekarang = date.getFullYear();

    tampilKalender();
});
