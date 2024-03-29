<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8" />
      <meta
         name="viewport"
         content="width=device-width, initial-scale=1, shrink-to-fit=no"
      />
      <meta
         name="description"
         content="ISSN (print) 2075—0862 ISSN (online) 2658-350X Индекс Роспечати 37150. ИДЕИ И ИДЕАЛЫ. Н А У Ч Н Ы Й Ж У Р Н А Л. Основан в 2009 году."
      />
      <meta name="author" content="Viktor Prilepin" />
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <title>
         @lang('Идеи и Идеалы') | @isset($subtitle){{$subtitle}}@else @yield('title') @endif
      </title>

      <link href="{{ asset('css/front.css') }}" rel="stylesheet" />
   </head>

   <body>

      @include('front.header') 

      <div class="nav-scroller py-1 mb-2 bg-white shadow">
         <div class="container">
            @yield('navigation')
         </div>
      </div>

      <div class="page-header-section">
         <div class="container">
            <div class="row col-md-12">
               <div class="page-title">@yield('title')</div>
            </div>
         </div>
      </div>

      <main role="main" class="container">
         <div class="row">
            <div class="col-md-9 blog-main mb-3">
               <div class="card shadow">
                  @hasSection('subtitle')
                  <div class="card-header ">
                     @yield('breadcrumbs')
                     <h2 class="my-1 px-2">
                        @yield('subtitle')
                     </h2>
                  </div>
                  @endif
                  <div class="card-body mx-2">
                     @yield('content')
                  </div>
                  @hasSection('contentFooter')
                  <div class="card-footer ">
                     @yield('contentFooter')
                  </div>
                  @endif
               </div>
            </div>
            <!-- /.blog-main -->

            <aside class="col-md-3 blog-sidebar">
               @yield('stol_menu') @yield('review_menu') @yield('sidebar_menu')

               @yield('tag_menu')
            </aside>
            <!-- /.blog-sidebar -->
         </div>
         <!-- /.row -->
      </main>
      <!-- /.container -->

      @include('front.footer')

   </body>
   <script src="{{ asset('js/front.js') }}"></script>
   <script src="{{ asset('js/manifest.js') }}"></script>
   <script src="{{ asset('js/vendor.js') }}"></script>

   @stack('scripts')

   <!-- Yandex.Metrika counter -->
      <script type="text/javascript" >
         (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
         m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
         (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

         ym({{ env('YANDEX_METRIKA_ID') }}, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true
         });
      </script>
      <noscript><div><img src="https://mc.yandex.ru/watch/{{ env('YANDEX_METRIKA_ID') }}" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
      <!-- /Yandex.Metrika counter -->
</html>
