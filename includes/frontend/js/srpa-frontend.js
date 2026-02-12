jQuery(function ($) {

    function debounce(fn, delay) {
        let timer;
        return function () {
            const context = this, args = arguments;
            clearTimeout(timer);
            timer = setTimeout(() => fn.apply(context, args), delay);
        };
    }

    function loadProjects(wrap, page = 1, appendHtml = false) {

        var template   = wrap.data('template');
        var pagination = wrap.data('pagination');
        var ppp        = wrap.data('ppp');
        var keyword    = wrap.find('.srpa-keyword').val();
        var filter    = wrap.find('.srpa-filter').val();
        

        $.post(srpa_ajax.ajax_url, {
            action: 'srpa_load_projects',
            nonce: srpa_ajax.nonce,
            page: page,
            template_type: template,
            pagination_type: pagination,
            ppp: ppp,
            keyword: keyword,
            filter: filter
        }, function (res) {

            if (!res.success) return;

            if (pagination === 'load_more' ) {
                if( appendHtml === true ) {
                    wrap.find('.srpa-projects-listing').append(res.data.html);
                } else {
                    wrap.find('.srpa-projects-listing').html(res.data.html);
                }
                
                console.log( res.data.page , res.data.max_pages );
                if( res.data.page === res.data.max_pages || res.data.max_pages === 0 ) {
                    wrap.find('.srpa-load-btn').hide();
                } else {
                    wrap.find('.srpa-load-btn').show();
                    wrap.find('.srpa-load-btn').attr('data-page', page);
                }
            } else {
                wrap.find('.srpa-projects-listing').html(res.data.html);
                wrap.find('.srpa-pagination').html(res.data.pagination_html);
            }
            
        });
    }

    jQuery(document).on('change', '.srpa-projects-wrap .srpa-filter', function () {
        var wrap = jQuery(this).closest('.srpa-projects-wrap');
        loadProjects(wrap, 1, false);
    });

    // While typing in search text box
    jQuery(document).on('keyup', '.srpa-projects-wrap .srpa-keyword', debounce(function () {
        var wrap = jQuery(this).closest('.srpa-projects-wrap');
        loadProjects(wrap, 1, false);
    }, 400));

    // Load More button clicked
    jQuery(document).on('click', '.srpa-projects-wrap .srpa-load-btn', function () {
        var btn = jQuery(this);
        var wrap = btn.closest('.srpa-projects-wrap');
        var page = parseInt(btn.attr('data-page')) + 1;
        loadProjects(wrap, page, true);
    });

    // Pagination button clicked
    jQuery(document).on('click', '.srpa-projects-wrap .srpa-pagination a', function (e) {
        e.preventDefault();

        var wrap = jQuery(this).closest('.srpa-projects-wrap');
        var page = jQuery(this).attr('href').match(/page\/(\d+)/);
        page = page ? page[1] : 1;
        loadProjects(wrap, page);
        loadProjects(wrap, page, false);
    });

});
