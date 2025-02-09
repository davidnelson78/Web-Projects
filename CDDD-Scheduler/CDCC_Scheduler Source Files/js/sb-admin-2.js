(function ($) {
    "use strict"; // Start of use strict

    // Toggle the side navigation
    $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
            $('.sidebar .collapse').collapse('hide');
        };
    });

    $('.datepicker').pickadate({
        weekdaysShort: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
        showMonthsShort: true
    })

    // Strings and translations
    monthsFull: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        weekdaysFull: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        weekdaysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        showMonthsShort: undefined,
        showWeekdaysFull: undefined,

        // Buttons
        today: 'Today',
        clear: 'Clear',
        close: 'Close',

        // Accessibility labels
        labelMonthNext: 'Next month',
        labelMonthPrev: 'Previous month',
        labelMonthSelect: 'Select a month',
        labelYearSelect: 'Select a year',

        // Formats
        format: 'd mmmm, yyyy',
        formatSubmit: undefined,
        hiddenPrefix: undefined,
        hiddenSuffix: '_submit',
        hiddenName: undefined,

        // Editable input
        editable: undefined,

        // Dropdown selectors
        selectYears: undefined,
        selectMonths: undefined,

        // First day of the week
        firstDay: undefined,

        // Date limits
        min: undefined,
        max: undefined,

        // Disable dates
        disable: undefined,

        // Root picker container
        container: undefined,

        // Hidden input container
        containerHidden: undefined,

        // Close on a user action
        closeOnSelect: true,
        closeOnClear: true,

        // Events
        onStart: undefined,
        onRender: undefined,
        onOpen: undefined,
        onClose: undefined,
        onSet: undefined,
        onStop: undefined,

        // Classes
        klass: {

            // The element states
            input: 'picker__input',
            active: 'picker__input--active',

            // The root picker and states *
            picker: 'picker',
            opened: 'picker--opened',
            focused: 'picker--focused',

            // The picker holder
            holder: 'picker__holder',

            // The picker frame, wrapper, and box
            frame: 'picker__frame',
            wrap: 'picker__wrap',
            box: 'picker__box',

            // The picker header
            header: 'picker__header',

            // Month navigation
            navPrev: 'picker__nav--prev',
            navNext: 'picker__nav--next',
            navDisabled: 'picker__nav--disabled',

            // Month & year labels
            month: 'picker__month',
            year: 'picker__year',

            // Month & year dropdowns
            selectMonth: 'picker__select--month',
            selectYear: 'picker__select--year',

            // Table of dates
            table: 'picker__table',

            // Weekday labels
            weekdays: 'picker__weekday',

            // Day states
            day: 'picker__day',
            disabled: 'picker__day--disabled',
            selected: 'picker__day--selected',
            highlighted: 'picker__day--highlighted',
            now: 'picker__day--today',
            infocus: 'picker__day--infocus',
            outfocus: 'picker__day--outfocus',

            // The picker footer
            footer: 'picker__footer',

            // Today, clear, & close buttons
            buttonClear: 'picker__button--clear',
            buttonClose: 'picker__button--close',
            buttonToday: 'picker__button--today'
        }


    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function () {
        if ($(window).width() < 768) {
            $('.sidebar .collapse').collapse('hide');
        };
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
        if ($(window).width() > 768) {
            var e0 = e.originalEvent,
                delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });

    // Scroll to top button appear
    $(document).on('scroll', function () {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function (e) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        e.preventDefault();
    });

})(jQuery); // End of use strict
