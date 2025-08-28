<script>
    //Importante
    //app.horizontal.init.js
    var userSettings = {
        Layout: "horizontal", // vertical | horizontal
        SidebarType: "full", // full | mini-sidebar
        BoxedLayout: true, // true | false
        Direction: "ltr", // ltr | rtl
        Theme: "light", // light | dark
        ColorTheme: "Blue_Theme", // Blue_Theme | Aqua_Theme | Purple_Theme | Green_Theme | Cyan_Theme | Orange_Theme
        cardBorder: false, // true | false
    };

    //theme.js
    document.addEventListener("DOMContentLoaded", function() {
        "use strict";

        // =================================
        // Tooltip
        // =================================
        const tooltipTriggerList = Array.from(
            document.querySelectorAll('[data-bs-toggle="tooltip"]')
        );
        tooltipTriggerList.forEach((tooltipTriggerEl) => {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // =================================
        // Popover
        // =================================
        var popoverTriggerList = [].slice.call(
            document.querySelectorAll('[data-bs-toggle="popover"]')
        );
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
        // =================================
        // Hide preloader
        // =================================
        var preloader = document.querySelector(".preloader");
        if (preloader) {
            preloader.style.display = "none";
        }
        // =================================
        // Increment & Decrement
        // =================================
        var quantityButtons = document.querySelectorAll(".minus, .add");
        if (quantityButtons) {
            quantityButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    var qtyInput = this.closest("div").querySelector(".qty");
                    var currentVal = parseInt(qtyInput.value);
                    var isAdd = this.classList.contains("add");

                    if (!isNaN(currentVal)) {
                        qtyInput.value = isAdd ?
                            ++currentVal :
                            currentVal > 0 ?
                            --currentVal :
                            currentVal;
                    }
                });
            });
        }
        // =================================
        // Fixed header
        // =================================
        window.addEventListener("scroll", function() {
            var topbar = document.querySelector(".topbar");
            if (topbar) {
                if (window.scrollY >= 60) {
                    topbar.classList.add("shadow-sm");
                } else {
                    topbar.classList.remove("shadow-sm");
                }
            }
        });
    });

    //app.min.js
    // Merge default and provided settings
    var settings = Object.assign({}, userSettings);
    var isSidebar = document.getElementsByClassName("customizer");
    if (isSidebar.length > 0) {
        var AdminSettings = {
            // Settings INIT
            AdminSettingsInit: function() {
                AdminSettings.ManageThemeLayout();
                AdminSettings.ManageSidebarType();
                AdminSettings.ManageBoxedLayout();
                AdminSettings.ManageDirectionLayout();
                AdminSettings.ManageDarkThemeLayout();
                AdminSettings.ManageColorThemeLayout();
                AdminSettings.ManageCardLayout();
            },

            //****************************
            // Vertical / Horizontal Layout
            //****************************
            ManageThemeLayout: function() {
                switch (settings.Layout) {
                    case "horizontal":
                        document.getElementById("horizontal-layout").checked = true;
                        document.documentElement.setAttribute("data-layout", "horizontal");
                        break;
                    case "vertical":
                        document.getElementById("vertical-layout").checked = true;
                        document.documentElement.setAttribute("data-layout", "vertical");
                        break;
                    default:
                }
            },

            //****************************
            // Full / Minisidebar type
            //****************************
            ManageSidebarType: function() {
                switch (settings.SidebarType) {
                    //****************************
                    // If the sidebar type has full
                    //****************************
                    case "full":
                        document.querySelector("#full-sidebar").checked = true;
                        document.body.setAttribute("data-sidebartype", "full");
                        //****************************
                        /* This is for the mini-sidebar if width is less then 1170*/
                        //****************************
                        var setsidebartype = function() {
                            var width =
                                window.innerWidth > 0 ? window.innerWidth : this.screen.width;
                            if (width < 1300) {
                                document.body.setAttribute("data-sidebartype", "mini-sidebar");
                            } else {
                                document.body.setAttribute("data-sidebartype", "full");
                            }
                        };
                        window.addEventListener("DOMContentLoaded", setsidebartype);
                        window.addEventListener("resize", setsidebartype);
                        break;

                        //****************************
                        // If the sidebar type has mini-sidebar
                        //****************************
                    case "mini-sidebar":
                        document.querySelector("#mini-sidebar").checked = true;
                        document.body.setAttribute("data-sidebartype", "mini-sidebar");
                        break;

                    default:
                }
            },

            //****************************
            // Layout Boxed or Full
            //****************************
            ManageBoxedLayout: function() {
                document.getElementById("boxed-layout").checked = true;
                switch (settings.BoxedLayout) {
                    case true:
                        document.documentElement.setAttribute("data-boxed-layout", "boxed");
                        document.getElementById("boxed-layout").checked = true;
                        break;
                    case false:
                        document.documentElement.setAttribute("data-boxed-layout", "full");
                        document.getElementById("full-layout").checked = true;
                        break;
                    default:
                }
            },
            //****************************
            // Direction Type
            //****************************
            ManageDirectionLayout: function() {
                switch (settings.Direction) {
                    case "ltr":
                        document.getElementById("ltr-layout").checked = true;
                        document.documentElement.setAttribute("dir", "ltr");
                        var offcanvasStart = document.querySelector(".offcanvas-start");
                        if (offcanvasStart) {
                            offcanvasStart.classList.toggle("offcanvas-end");
                            offcanvasStart.classList.remove("offcanvas-start");
                        }
                        break;
                    case "rtl":
                        document.documentElement.setAttribute("dir", "rtl");
                        var offcanvasEnd = document.querySelector(".offcanvas-end");
                        if (offcanvasEnd) {
                            offcanvasEnd.classList.toggle("offcanvas-start");
                            offcanvasEnd.classList.remove("offcanvas-end");
                        }
                        document.getElementById("rtl-layout").checked = true;
                        break;
                    default:
                }
            },
            //****************************
            // Card Type
            //****************************
            ManageCardLayout: function() {
                document.getElementById("card-without-border").checked = true;
                switch (settings.cardBorder) {
                    case true:
                        document.documentElement.setAttribute("data-card", "border");
                        document.getElementById("card-with-border").checked = true;
                        break;
                    case false:
                        document.documentElement.setAttribute("data-card", "shadow");
                        document.getElementById("card-without-border").checked = true;
                        break;
                    default:
                }
            },
            //****************************
            // Theme Dark or light
            //****************************
            ManageDarkThemeLayout: function() {
                switch (settings.Theme) {
                    case "light":
                        setTheme("light", ["light-logo"], ["moon"], ["sun"]);
                        break;
                    case "dark":
                        setTheme("dark", ["dark-logo"], ["sun"], ["moon"]);
                        break;
                    default:
                }

                function setTheme(theme, hideElements, showElements, hideElements2) {
                    document.documentElement.setAttribute("data-bs-theme", theme);
                    document.getElementById(`${theme}-layout`).checked = true;
                    hideElements.forEach((el) =>
                        document
                        .querySelectorAll(`.${el}`)
                        .forEach((e) => (e.style.display = "none"))
                    );
                    showElements.forEach((el) =>
                        document
                        .querySelectorAll(`.${el}`)
                        .forEach((e) => (e.style.display = "flex"))
                    );
                    hideElements2.forEach((el) =>
                        document
                        .querySelectorAll(`.${el}`)
                        .forEach((e) => (e.style.display = "none"))
                    );
                }
            },

            //****************************
            // Theme color
            //****************************
            ManageColorThemeLayout: function() {
                const {
                    ColorTheme
                } = settings;
                const colorThemeElement = document.getElementById(ColorTheme);

                if (colorThemeElement) {
                    document.documentElement.setAttribute("data-color-theme", ColorTheme);
                    colorThemeElement.checked = true;
                }
            },
        };

        // Initialize settings
        AdminSettings.AdminSettingsInit();

        //****************************
        // Handle Click
        //****************************

        document.addEventListener("DOMContentLoaded", function() {
            //****************************
            // Theme Direction RTL LTR click
            //****************************
            function handleDirection() {
                document
                    .getElementById("rtl-layout")
                    .addEventListener("click", function() {
                        document.documentElement.setAttribute("dir", "rtl");
                        var offcanvasEnd = document.querySelector(
                            ".customizer.offcanvas-end"
                        );
                        if (offcanvasEnd) {
                            offcanvasEnd.classList.toggle("offcanvas-start");
                            offcanvasEnd.classList.remove("offcanvas-end");
                        }
                    });

                document
                    .getElementById("ltr-layout")
                    .addEventListener("click", function() {
                        document.documentElement.setAttribute("dir", "ltr");
                        var offcanvasStart = document.querySelector(
                            ".customizer.offcanvas-start"
                        );
                        if (offcanvasStart) {
                            offcanvasStart.classList.toggle("offcanvas-end");
                            offcanvasStart.classList.remove("offcanvas-start");
                        }
                    });
            }

            handleDirection();

            //****************************
            // Theme Layout Box or Full
            //****************************
            function handleBoxedLayout() {
                const boxedLayout = document.getElementById("boxed-layout");
                const fullLayout = document.getElementById("full-layout");
                const containerFluid = document.querySelectorAll(".container-fluid");

                boxedLayout.addEventListener("click", function() {
                    containerFluid.forEach(function(element) {
                        element.classList.remove("mw-100");
                    });
                    this.checked;
                    document.documentElement.setAttribute("data-boxed-layout", "boxed");
                });

                fullLayout.addEventListener("click", function() {
                    containerFluid.forEach(function(element) {
                        element.classList.add("mw-100");
                    });
                    document.documentElement.setAttribute("data-boxed-layout", "full");
                    this.checked;
                });
            }
            handleBoxedLayout();

            //****************************
            // Theme Layout Vertical or horizontal
            //****************************
            function handleLayout() {
                const verticalLayout = document.getElementById("vertical-layout");
                const horizontalLayout = document.getElementById("horizontal-layout");

                verticalLayout.addEventListener("click", function() {
                    document.documentElement.setAttribute("data-layout", "vertical");
                    this.checked;
                });

                horizontalLayout.addEventListener("click", function() {
                    document.documentElement.setAttribute("data-layout", "horizontal");
                    this.checked;
                });
            }
            handleLayout();

            //****************************
            // Theme mode dark or light
            //****************************

            function handleTheme() {
                function setThemeAttributes(
                    theme,
                    darkDisplay,
                    lightDisplay,
                    sunDisplay,
                    moonDisplay
                ) {
                    document.documentElement.setAttribute("data-bs-theme", theme);
                    document.getElementById(`${theme}-layout`).checked = true;

                    document
                        .querySelectorAll(`.${darkDisplay}`)
                        .forEach((el) => (el.style.display = "none"));
                    document
                        .querySelectorAll(`.${lightDisplay}`)
                        .forEach((el) => (el.style.display = "flex"));
                    document
                        .querySelectorAll(`.${sunDisplay}`)
                        .forEach((el) => (el.style.display = "none"));
                    document
                        .querySelectorAll(`.${moonDisplay}`)
                        .forEach((el) => (el.style.display = "flex"));
                }

                document.querySelectorAll(".dark-layout").forEach((element) => {
                    element.addEventListener("click", () =>
                        setThemeAttributes("dark", "dark-logo", "light-logo", "moon", "sun")
                    );
                });

                document.querySelectorAll(".light-layout").forEach((element) => {
                    element.addEventListener("click", () =>
                        setThemeAttributes("light", "light-logo", "dark-logo", "sun", "moon")
                    );
                });
            }
            handleTheme();
            //****************************
            // Theme card with border or shadow
            //****************************
            function handleCardLayout() {
                function setCardAttribute(cardType) {
                    document.documentElement.setAttribute("data-card", cardType);
                }

                document
                    .getElementById("card-with-border")
                    .addEventListener("click", () => setCardAttribute("border"));
                document
                    .getElementById("card-without-border")
                    .addEventListener("click", () => setCardAttribute("shadow"));
            }
            handleCardLayout();

            //****************************
            // Theme sidebar
            //****************************
            function handleSidebarToggle() {
                function setSidebarType(sidebarType) {
                    document.body.setAttribute("data-sidebartype", sidebarType);
                }

                document
                    .getElementById("full-sidebar")
                    .addEventListener("click", () => setSidebarType("full"));
                document
                    .getElementById("mini-sidebar")
                    .addEventListener("click", () => setSidebarType("mini-sidebar"));
            }
            handleSidebarToggle();
            //****************************
            // Toggle sidebar
            //****************************
            function handleSidebar() {
                document.querySelectorAll(".sidebartoggler").forEach(function(element) {
                    element.addEventListener("click", function() {
                        document.querySelectorAll(".sidebartoggler").forEach(function(el) {
                            el.checked = true;
                        });
                        document
                            .getElementById("main-wrapper")
                            .classList.toggle("show-sidebar");
                        document.querySelectorAll(".sidebarmenu").forEach(function(el) {
                            el.classList.toggle("close");
                        });
                        var dataTheme = document.body.getAttribute("data-sidebartype");
                        if (dataTheme === "full") {
                            document.body.setAttribute("data-sidebartype", "mini-sidebar");
                        } else {
                            document.body.setAttribute("data-sidebartype", "full");
                        }
                    });
                });
            }

            handleSidebar();
        });
    }

    //sidebarmenu.js
    var at = document.documentElement.getAttribute("data-layout");
    if ((at = "vertical")) {

        // ----------------------------------------
        // Active 2 file at same time
        // ----------------------------------------

        var currentNewURL =
            window.location != window.parent.location ?
            document.referrer :
            document.location.href;

        var current_link = document.getElementById("get-url");
        if (currentNewURL.includes("/main/index.html")) {
            current_link.setAttribute("href", "../main/index.html");
        } else if (currentNewURL.includes("/index.html")) {
            current_link.setAttribute("href", "./index.html");
        } else {
            current_link.setAttribute("href", "./");
        }
        // end


        function findMatchingElement() {
            var currentUrl = window.location.href;
            var anchors = document.querySelectorAll("#sidebarnav a");
            for (var i = 0; i < anchors.length; i++) {
                if (anchors[i].href === currentUrl) {
                    return anchors[i];
                }
            }

            return null; // Return null if no matching element is found
        }
        var elements = findMatchingElement();

        // Do something with the matching element
        if (elements) {
            elements.classList.add("active");
        }

        document
            .querySelectorAll("ul#sidebarnav ul li a.active")
            .forEach(function(link) {
                link.closest("ul").classList.add("in");
                link.closest("ul").parentElement.classList.add("selected");
            });

        document.querySelectorAll("#sidebarnav li").forEach(function(li) {
            const isActive = li.classList.contains("selected");
            if (isActive) {
                const anchor = li.querySelector("a");
                if (anchor) {
                    anchor.classList.add("active");
                }
            }
        });
        document.querySelectorAll("#sidebarnav a").forEach(function(link) {
            link.addEventListener("click", function(e) {
                const isActive = this.classList.contains("active");
                const parentUl = this.closest("ul");
                if (!isActive) {
                    // hide any open menus and remove all other classes
                    parentUl.querySelectorAll("ul").forEach(function(submenu) {
                        submenu.classList.remove("in");
                    });
                    parentUl.querySelectorAll("a").forEach(function(navLink) {
                        navLink.classList.remove("active");
                    });

                    // open our new menu and add the open class
                    const submenu = this.nextElementSibling;
                    if (submenu) {
                        submenu.classList.add("in");
                    }

                    this.classList.add("active");
                } else {
                    this.classList.remove("active");
                    parentUl.classList.remove("active");
                    const submenu = this.nextElementSibling;
                    if (submenu) {
                        submenu.classList.remove("in");
                    }
                }
            });
        });
    }
    if ((at = "horizontal")) {
        function findMatchingElement() {
            var currentUrl = window.location.href;
            var anchors = document.querySelectorAll("#sidebarnavh ul#sidebarnav a");
            for (var i = 0; i < anchors.length; i++) {
                if (anchors[i].href === currentUrl) {
                    return anchors[i];
                }
            }

            return null; // Return null if no matching element is found
        }
        var elements = findMatchingElement();

        if (elements) {
            elements.classList.add("active");
        }
        document
            .querySelectorAll("#sidebarnavh ul#sidebarnav a.active")
            .forEach(function(link) {
                link.closest("a").parentElement.classList.add("selected");
                link.closest("ul").parentElement.classList.add("selected");
            });
    }
</script>
<!-- Import Js Files -->
<script src="{{ asset('assets-prod/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets-prod/libs/simplebar/dist/simplebar.min.js') }}"></script>

<!-- solar icons -->
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
