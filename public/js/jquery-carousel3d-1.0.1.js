(function($) {

    /**
     * @member jQuery
     * @method carousel3d 3D carousel constructor
     * @param {Object} options carousel3d options
     * @param {Number} options.perspective carousel's perspective value
     * @param {Number} options.duration carousel's duration value
     * @param {Number} options.width carousel's width
     * @param {Boolean} options.progress whether show inidicator or not
     * @param {Boolean} options.controller wherher show controller or not
     * jQuery plugin for 3D carousel
     */
    $.widget('R.carousel3d', {
        /**
         * @member jQuery.carousel3d
         * carousel3d options
         * @type {Object}
         * @property {Object} options carousel3d options
         * @property {Number} options.perspective carousel's perspective value
         * @property {Number} options.duration carousel's duration value
         * @property {Number} options.width carousel's width
         * @property {Boolean} options.progress whether show inidicator or not
         * @property {Boolean} options.controller wherher show controller or not
         * @property {String} options.prevText Text for prev controller
         * @property {String} options.nextText Text for next controller
         */
        options: {
            perspective: 500,
            duration: 1000,
            width: null,
            progress: true,
            controller: true,
            prevText: 'prev',
            nextText: 'next'
        },

        /**
         * @member jQuery.carousel3d
         * carousel's list count
         * @type {Number}
         **/
        _listCnt: 0,

        /**
         * @member jQuery.carousel3d
         * current selected list index
         * @type {Number}
         **/
        _counter: 0,

        /**
         * @member jQuery.carousel3d
         * deg difference with next list
         * @type {Number}
         **/
        _deg: 0,

        /**
         * @member jQuery.carousel3d
         * @method _create
         * 3D carousel constructor
         * @private
         **/
        _create: function() {
            this.$element = $(this.element);
            this.options.width = this.options.width || this.$element.outerWidth();
        },

        /**
         * @member jQuery.carousel3d
         * @method _init
         * initialize 3D carousel
         * @private
         **/
        _init: function() {
            var self = this,
                $element = this.$element,
                $ancestor = this.$ancestor = $('<div class="carousel3d-ancestor"></div>'),
                $parent = this.$parent = $('<div class="carousel3d-parent"></div>'),
                $wrapper = this.$wrapper = $('<div class="carousel3d-wrapper"></div>'),
                $list = $element.children();

            $element.after($ancestor.append($parent.append($wrapper)));
            $wrapper.append($element);

            $element.addClass('carousel3d');
            $list.addClass('carousel3d-list');

            this._layout();
        },

        /**
         * @member jQuery.carousel3d
         * @method _layout
         * arrange list layout to 3D
         * @private
         **/
        _layout: function() {
            var $element = this.$element,
                $ancestor = this.$ancestor,
                $parent = this.$parent,
                $wrapper = this.$wrapper,
                $list = $element.children(),
                deg,
                radian,
                cosTheta,
                sinTheta,
                radius,
                translateZ;

            $ancestor.height($list.outerHeight());
            $ancestor.width(this.options.width);

            $parent.width(this.options.width);
            $wrapper.width(this.options.width);
            $element.width(this.options.width);
            $list.width(this.options.width);

            $parent.css({
                perspective: this.options.perspective + 'px'
            });

            $element.css({
                'transition-duration': this.options.duration + 'ms'
            });

            this._listCnt = $list.size(),
            deg = this._deg = 360 / this._listCnt;
            radian = (180 - deg) / 2 * Math.PI / 180;
            cosTheta = Math.cos(radian);
            sinTheta = Math.sin(radian);
            radius = this.options.width / 2 / cosTheta;
            translateZ = radius * sinTheta;

            $wrapper.css({
                transform: 'translateZ('+ -1 * translateZ +'px)'
            });

            $list.each(function(i) {
                $(this).css({
                    transform: 'rotateY('+ (deg * (i)) +'deg) translateZ('+ translateZ +'px)'
                });
            });
            if ($list.length === 1) {
                $wrapper.css({
                    transform: 'translateZ(0)'
                });
                $list.css({
                    transform: 'translateZ(0)'
                });
            }else if ($list.length === 2) {
                $list.eq(1).css({
                    transform: 'translateZ(-1px)'
                });
            }


            this._setIndicator();

            this._setController();
        },

        /**
         * @member jQuery.carousel3d
         * @method _setIndicator
         * set indicator
         * @private
         **/
        _setIndicator: function() {
            var $ancestor = this.$ancestor,
                $indicator = this.$indicator = $('<ol class="carousel3d-indicator"></ol>'),
                indicatorWidth = 0,
                i;

            $ancestor.find('.carousel3d-indicator').remove();

            if(this.options.progress) {
                $ancestor.append($indicator);

                for(i = 0; i < this._listCnt; i++) {
                    $indicator.append('<li></li>');
                }

                indicatorWidth = $indicator.find('li').outerWidth(true) * this._listCnt;

                if(this.options.width < indicatorWidth) {
                    $indicator.css( {
                        'margin-left': -1 * (indicatorWidth - this.options.width) / 2
                    });
                }

                $indicator.find('li').eq(this._counter).addClass('active');
            }
        },

        /**
         * @member jQuery.carousel3d
         * @method _setController
         * set prev and next controller and their event
         * @private
         **/
        _setController: function() {
            var self = this,
                $ancestor = this.$ancestor,
                $jsPrev = $('<div class="js-carousel3d-prev">'+ self.options.prevText +'</div>'),
                $jsNext = $('<div class="js-carousel3d-next">'+ self.options.nextText +'</div>'),
                fireFlag = false;

            // Remove controller when refresh
            $ancestor.find('.js-carousel3d-prev, .js-carousel3d-next').remove();

            // Controller flag true case
            if(this.options.controller) {
                $ancestor.append($jsPrev);
                $ancestor.append($jsNext);

                // Set controllers position center of curent list
                $jsPrev.css({
                    top: $ancestor.outerHeight() / 2 - $jsPrev.outerHeight() / 2
                });
                $jsNext.css({
                    top: $ancestor.outerHeight() / 2 - $jsNext.outerHeight() / 2
                });

                if('touchstart' in window) {
                    // Set prev event
                    $jsPrev.on('touchstart', function() {
                        fireFlag = true;
                    });
                    $jsPrev.on('touchmove', function() {
                        fireFlag = false;
                    });
                    $jsPrev.on('touchend', function() {
                        if(fireFlag) self.prev();
                    });
                    // Set next event
                    $jsNext.on('touchstart', function() {
                        fireFlag = true;
                    });
                    $jsNext.on('touchmove', function() {
                        fireFlag = false;
                    });
                    $jsNext.on('touchend', function() {
                        if(fireFlag) self.next();
                    });
                } else {
                    // Set prev event
                    $jsPrev.on('mousedown', function() {
                        fireFlag = true;
                    });
                    $jsPrev.on('mouseover', function() {
                        fireFlag = false;
                    });
                    $jsPrev.on('mouseup', function() {
                        if(fireFlag) self.prev();
                    });
                    // Set next event
                    $jsNext.on('mousedown', function() {
                        fireFlag = true;
                    });
                    $jsNext.on('mouseover', function() {
                        fireFlag = false;
                    });
                    $jsNext.on('mouseup', function() {
                        if(fireFlag) self.next();
                    });
                }
            }
        },

        /**
         * @member jQuery.carousel3d
         * @method _go
         * move carousel actually
         * @private
         **/
        _go: function() {
            var $element = this.$element,
                currentDeg = this._deg * this._counter,
                index;

            if(this._counter % this._listCnt === 0) {
                currentDeg = 360 * (this._counter / this._listCnt);
            }

            $element.css( {
                transform: 'rotateY('+ -1 * currentDeg +'deg)'
            });

            if(this.options.progress) {
                index = this._counter % this._listCnt;
                this.$indicator.find('li').removeClass('active').eq(index).addClass('active');
            }
        },

        /**
         * @member jQuery.carousel3d
         * @method next
         * move to next list
         **/
        next: function() {
            this._counter++;
            this._go();
        },

        /**
         * @member jQuery.carousel3d
         * @method prev
         * move to prev list
         **/
        prev: function() {
            this._counter--;
            this._go();
        },

        /**
         * @member jQuery.carousel3d
         * @method move
         * move to specified list
         * @param {Number} index list index
         **/
        move: function(index) {
            var point = this._counter % this._listCnt;

            this._counter += index - point;
            this._go();
        },

        /**
         * @member jQuery.carousel3d
         * @method refresh
         * recreate 3D carousel with new options
         * @param {Object} options 3D carousel options
         **/
        refresh: function(options) {
            $.extend(this.options, options);

            this._layout();
        },

        /**
         * @member jQuery.carousel3d
         * @method _destroy
         * Destroy 3D carousel
         * @private
         **/
        _destroy: function() {
            this.$ancestor.before(this.$element);
            this.$ancestor.remove();
            this.$element.css({
                'transition': 'none',
                'transform': 'none'
            });
            this.$element.children().css('transform', 'none');
        }
    });

    if ( typeof define === "function" && define.amd ) {
        define( "carousel3d", [], function () { return jQuery; } );
    }

}(jQuery));