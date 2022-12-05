(function ($) {
    $.fn.easyPaginate = function (options) {

        var defaults = {
            step: 1,
            delay: 100,
            numeric: false,
            nextprev: true,
            controls: 'navigate',
            current: 'current'
        };

        var options = $.extend(defaults, options);
        var step = options.step;
        var lower, upper;
        var children = $(this).children();
        var count = children.length;
        var obj, next, prev;
        var page = 2;

        function show() {
            lower = ((page - 1) * step);
            upper = lower + step;
            $(children).each(function (i) {
                var child = $(this);
                child.hide();
                if (i >= lower && i < upper) {
                    setTimeout(function () {
                        child.fadeIn(1000)
                    }, ( i - ( Math.floor(i / step) * step) ) * options.delay);
                }
                if (options.nextprev) {
                    if (upper >= count) {
                        next.fadeOut('fast');
                    } else {
                        next.fadeIn('fast');
                    }
                    if (lower >= 1) {
                        prev.fadeIn('fast');
                    } else {
                        prev.fadeOut('fast');
                    }
                }
            });
            $('li', '#' + options.controls).removeClass(options.current);
            $('li[data-index="' + page + '"]', '#' + options.controls).addClass(options.current);
        }

        this.each(function () {

            obj = this;

            if (count > step) {
                var pages = Math.floor(count / step);
                if ((count / step) > pages) pages++;

                var ol = $('<ol id="' + options.controls + '"></ol>').insertAfter(obj);

                if (options.nextprev) {
                    prev = $('<li class="prev"></li>')
                        .show()
                        .appendTo(ol)
                        .click(function () {
                            page--;
                            show();
                        })
                }
                if (options.numeric) {
                    for (var i = 1; i <= pages; i++) {
                        $('<li data-index="' + i + '">' + i + '</li>')
                            .appendTo(ol)
                            .click(function () {
                                page = $(this).attr('data-index');
                                show();
                            });
                    }
                }
                if (options.nextprev) {
                    next = $('<li class="next"></li>')
                        .show()
                        .appendTo(ol)
                        .click(function () {
                            page++;
                            show();
                        });
                }
                show();
            }
        });

    };

})(jQuery);
