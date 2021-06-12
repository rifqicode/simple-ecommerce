(function ($) {
    $.fn.loader = function (opt) {
        let $element = this;

        let loader = new Loader($element, opt); //initialize loader
        //initialize custom handler to the elements
        let handler = {
            'destroy.loader': $.proxy(function () {
                let self = this;
                loader.destroy();
            }, this)
        };
        $element.on(handler);

        return $element;
    };

    // default settings
    let settings = {
        loader_img: LOADER_IMG,
        className: 'basic-loader',
        containerName: 'loader-container',
        minHeight: 200,
        fixedLoader: false,
        afterDestroy: function () {
            //after loader destroyed, what you will do, put it here
        }
    };

    let Loader = function (target, opt) {
        if (target.length < 1) {
            return;
        }

        this.$target = target;
        this.$obj = {};
        this.settings = $.extend(settings, opt);

        this._htmlInit();
    };

    Loader.prototype._htmlInit = function () {
        let self = this;
        let $obj = $('<div/>', {
            'class': self.settings.className + (self.settings.fixedLoader ? ' fixed-container' : ''),
            'style': 'background-image:url(' + self.settings.loader_img + ')'
        });
        self.$target.addClass(self.settings.containerName);
        self.$target.get(0).style.minHeight = self.settings.minHeight + 'px';
        self.$target.append($obj);
        self.$obj = self.$target.find('.' + self.settings.className);
    };

    Loader.prototype.destroy = function () {
        let self = this;
        self.$obj.fadeOut(500).promise().done(function () {
            self.$obj.remove();
            if (self.settings.afterDestroy)
                self.settings.afterDestroy();
            //self.$target.removeClass(self.settings.containerName);
            self.$target.get(0).style.minHeight = '';
        });
    };
}(jQuery));
