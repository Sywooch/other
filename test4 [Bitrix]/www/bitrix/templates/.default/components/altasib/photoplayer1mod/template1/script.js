var JCALXAdvRoll = function(id, options)
{
        var _this = this;
        this.id = id;

        this.options = options;
        if (this.options.currentid == null)
            this.options.currentid = 0;
        if (this.trigger == null)
            this.trigger = false;
        this.items = $('#container_'+this.id).children();

        this.init = function()
        {
            item_h0 = $(this.items[0]).height();
            item_w0 = $(this.items[0]).width();

            if (item_h0 < this.options.max_height)
            {
                m_t0 = (this.options.max_height - item_h0)/2;
                $(this.items[0]).children('.discribe_block_alx-photoplayer1mod_'+this.id).css('margin-top', m_t0+item_h0+'px');
                $(this.items[0]).css('margin-top', m_t0+'px');
            }
            if (item_w0 < this.options.max_width)
            {
                w_t0 = (this.options.max_width - item_w0)/2;
                $(this.items[0]).children('.discribe_block_alx-photoplayer1mod_'+this.id).css('margin-left', -w_t0+'px');
                $(this.items[0]).css('margin-left', w_t0+'px');
            }

            if (this.options.animationtype == 'slide')
                $(this.items[0]).slideDown(this.options.speed);
            else if (this.options.animationtype == 'fade')
                $(this.items[0]).fadeIn(this.options.speed);
            eval('link_sel_'+this.id+'(0)');
        }

        this.showElement = function(direction)
        {
            clearTimeout(this.autoTimer);

            current = this.options.currentid;
            if (current != this.options.id)
            {
                hideItem = current;
                showItem = this.options.id;
                this.options.currentid = this.options.id;

                firstItem = this.items[showItem];
                secondItem = this.items[hideItem];
                item_h = $(firstItem).height();
                item_w = $(firstItem).width();

                m_t = (this.options.max_height - item_h)/2;
                $(firstItem).children('.discribe_block_alx-photoplayer1mod_'+this.id).css('margin-top', m_t+item_h+'px');
                $(firstItem).css('margin-top', m_t+'px');

                if (item_w <= this.options.max_width+3)
                {
                    w_t = (this.options.max_width - item_w)/2;
                    $(firstItem).css('margin-left', w_t+'px');
                    $(firstItem).children('.discribe_block_alx-photoplayer1mod_'+this.id).css('margin-left', -w_t+'px');
                }
                if(this.options.animationtype == 'slide')
                {
                   $(firstItem).slideDown(this.options.speed);
                   $(secondItem).slideUp(this.options.speed);
                }
                else if(this.options.animationtype == 'fade')
                {
                   $(firstItem).fadeIn(this.options.speed);
                   $(secondItem).fadeOut(this.options.speed);
                }
            }
        };

        this.start_auto = function(s)
        {
            if (s != undefined)
                this.options.auto = s;
            if (this.options.auto == 0)
                return this.stopAuto();
            if (this.timer != null)
                return;
            this.timer = eval("setInterval(function() { _this.options.auto = false; $('#jcar_next1_"+this.id+"').click();}, this.options.auto * 1000)");
        };

        this.stop_auto = function()
        {
            if (this.timer == null)
                return;

            clearInterval(this.timer);
            this.timer = null;
        };
}