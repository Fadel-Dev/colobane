<!-- Google Analytics -->
@if(config('seo.google.analytics_id'))
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ config('seo.google.analytics_id') }}"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<script async src="https://www.googletagmanager.com/gtag/js?id={{ config('seo.google.analytics_id') }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '{{ config('seo.google.analytics_id') }}', {
    'page_path': window.location.pathname,
    'page_title': document.title
  });
</script>
@endif

<!-- Claridad Analytics (Alternative à Google Analytics) -->
<script>
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "{{ config('seo.google.analytics_id', 'clarity_id') }}");
</script>

<!-- Event tracking pour NoflayHub -->
<script>
    // Track custom events
    window.noflayhubEvents = {
        // Track quand un utilisateur visite une annonce
        trackListingView: function(listingId, type) {
            if (typeof gtag !== 'undefined') {
                gtag('event', 'view_item', {
                    'items': [{
                        'id': listingId,
                        'name': 'Annonce ' + type,
                        'category': type
                    }]
                });
            }
        },
        
        // Track quand un utilisateur contacte un vendeur
        trackContact: function(listingId, method) {
            if (typeof gtag !== 'undefined') {
                gtag('event', 'contact', {
                    'listing_id': listingId,
                    'method': method
                });
            }
        },
        
        // Track les recherches
        trackSearch: function(query, results) {
            if (typeof gtag !== 'undefined') {
                gtag('event', 'search', {
                    'search_term': query,
                    'number_of_results': results
                });
            }
        }
    };
</script>

<!-- Hotjar pour l'analyse comportementale -->
@if(env('HOTJAR_ID'))
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:{{ env('HOTJAR_ID') }},hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
@endif

