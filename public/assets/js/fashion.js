const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

var clipboard = new ClipboardJS(".icon-copy");
// $(document).ready(function () {
//   toggles();
//   $(".toggles a").click(toggles);
// });

// function toggles() {
//   // fetch the class of the clicked item
//   var ourClass = "women";

//   if (this !== window) {
//     ourClass = $(this).attr("class");
//     // reset the active class on all the buttons
//     $(".toggles a").removeClass("active");
//     // update the active state on our clicked button
//     $(this).addClass("active");
//   }
//   if (ourClass == "") {
//     // show all our items
//     $(".toggles a").removeClass("active");
//   } else {
//     // hide all elements that don't share ourClass
//     $(".products-cards .container .row")
//       .children("div:not(." + ourClass + ")")
//       .fadeOut(500)
//       .siblings("div." + ourClass)
//       .fadeIn(1000);
//     // show all elements that do share ourClass
//     // $(".products-cards .container .row")
//     //   .children("div." + ourClass)
//     //   .fadeIn(1000);
//   }
//   // return false;
// }
var $grid = $(".cards-toggle .container .row").isotope({
    itemSelector: ".col-12",
    // layoutMode: "fitRows",
    transitionDuration: "1s",
});
$(document).ready(function () {
    firstfilter = $(".toggles .text-center a.first")
        .addClass("active")
        .attr("data-filter");
    $grid.isotope({ filter: firstfilter });
});

$(".toggles .text-center a").on("click", function () {
    $(".toggles .text-center a").removeClass("active");
    $(this).addClass("active");
    var filterValue = $(this).attr("data-filter");
    if (filterValue) {
        // $grid.isotope({ filter: "*" });
        $grid.isotope({ filter: filterValue });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    Livewire.hook("message.processed", (message, component) => {
        console.log("hi");
        $grid.isotope("destroy");
        $grid = $(".cards-toggle .container .row")
            .isotope({
                itemSelector: ".col-12",
                // layoutMode: "fitRows",
                transitionDuration: "1s",
            })
            .delay(150);
        console.log("here");
        firstfilter = $(".toggles .text-center a.active").attr("data-filter");
        console.log(firstfilter);
        $grid.isotope({ filter: firstfilter });
        console.log("bye");
    });
});
