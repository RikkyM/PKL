$(document).ready(function () {
    $("#btn").on("click", function () {
        $("nav").toggleClass("w-[70px] w-56");
        $(".sideText").toggleClass("opacity-0 opacity-100");
        $(".hamburger").toggleClass("bx-menu bx-menu-alt-right");
        $(".tooltip").toggleClass(
            "group-hover/dashboard:opacity-100 group-hover/barang:opacity-100 group-hover/faktur:opacity-100 group-hover/barang-retur:opacity-100 group-hover/sopir:opacity-100 group-hover/toko:opacity-100 group-hover/mobil:opacity-100"
        );
    });

    $("#profil").on("click", function () {
        $(".boxProfil").toggleClass("bottom-[-100px] bottom-[-115px] ");

        if ($(".boxProfil").hasClass("opacity-0")) {
            $(".boxProfil")
                .removeClass("opacity-0 pointer-events-none")
                .addClass("opacity-100 pointer-events-auto");
        } else {
            $(".boxProfil")
                .removeClass("opacity-100 pointer-events-auto")
                .addClass("opacity-0 pointer-events-none");
        }
    });

    $("#printBtnFaktur").on("click", function () {
        window.print();
    });

    $("#printBtnRetur").on("click", function () {
        // $('#retur').printThis();
        window.print();
    });
});
