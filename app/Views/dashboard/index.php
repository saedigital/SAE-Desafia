<?php
    require_once (__DIR__ .'/../../Models/Show.php');
    require_once (__DIR__ .'/../../Models/Armchair.php');
    $show = new Show();
    $results = $show->consulta($show->getTable());

    $reservadas = new Armchair();
    $reservadas = $reservadas->consulta($reservadas->getTable());

    $qtdshow   = 0;
    $totalpoltronasShow = 0;
    $reservada = 0;
    foreach($results as $valor)
    {
        $totalpoltronasShow += $valor['qtd_poltronas'];
        for ($p = 0; $p <= $valor['qtd_poltronas']; ) {
            foreach ($reservadas as $reserva)
            {
                if (($reserva['idfk_espetaculo'] == $valor['id']) and ($reserva['numero_poltrona'] == $p))
                {
                    $reservada++;
                    $p++;
                }
            }
            $p++;
        }
        $qtdshow++;
    }
?>
<!DOCTYPE html>
<html lang="br">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Dashboard Desafio SAE
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="css/dashboard.css" rel="stylesheet" />
</head>
<body class="dark-edition">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
      <div class="logo">
        <a href="/" class="simple-text logo-normal">
         Financeiro de Espetáculo
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="#">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="/">
              <i class="material-icons">person</i>
              <p>Painel de Controle</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:void(0)">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-4 col-lg-12">
              <div class="card card-chart">
                <div class="card-header card-header-success">
                  <div class="ct-chart" id="dailySalesChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Espetáculos Cadastrados</h4>
                  <p class="card-category">
                    <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> Ativos.</p>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">Ultima</i> <?php echo date("Y-m-d H:i:s"); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-12">
              <div class="card card-chart">
                <div class="card-header card-header-warning">
                  <div class="ct-chart" id="websiteViewsChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Poltronas Reservadas</h4>

                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">Ultima</i> <?php echo date("Y-m-d H:i:s"); ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-12">
              <div class="card card-chart">
                <div class="card-header card-header-danger">
                  <div class="ct-chart" id="completedTasksChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Poltronas Livres</h4>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">Ultima</i> <?php echo date("Y-m-d H:i:s"); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">store</i>
                  </div>
                  <p class="card-category">Espetáculos</p>
                  <h3 class="card-title">
                      <?php  echo '<b>'.$qtdshow.'</b>'; ?> Qtd.<br>
                    <?php  echo '<b>'.$totalpoltronasShow.'</b>'; ?> total de poltronas.</h3>

                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">date_range</i> Cadastrados
                  </div>
                </div>
              </div>
            </div>

              <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
                  <div class="card card-stats">
                      <div class="card-header card-header-warning card-header-icon">
                          <div class="card-icon">
                              <i class="material-icons">content_copy</i>
                          </div>
                          <p class="card-category">Poltronas Reservadas</p>
                          <h3 class="card-title">
                              <?php  echo $reservada; ?> <small>Qtd.</small>
                              <br>
                              <?php  echo 'R$ '.number_format(($reservada * 23.76), 2, ',', '.');  ?> <small>Ganho.</small>
                          </h3>
                      </div>
                      <div class="card-footer">
                          <div class="stats">
                              <i class="material-icons text-warning">warning</i>
                              <a href="#pablo" class="warning-link">Reservadas</a>
                          </div>
                      </div>
                  </div>
              </div>

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">info_outline</i>
                  </div>
                  <p class="card-category">Poltronas Livres</p>
                  <h3 class="card-title">
                      <?php
                            echo $totalpoltronasShow - $reservada;
                       ?>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">local_offer</i> Poltronas Livres
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>

      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="/">
                  Espetáculos
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right" id="date">
            , Paulo A. Vital
          </div>
        </div>
      </footer>
      <script>
        const x = new Date().getFullYear();
        let date = document.getElementById('date');
        date.innerHTML = '&copy; ' + x + date.innerHTML;
      </script>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="js/core/jquery.min.js"></script>
  <script src="js/core/popper.min.js"></script>
  <script src="js/core/bootstrap-material-design.min.js"></script>
  <script src="https://unpkg.com/default-passive-events"></script>
  <script src="js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <script src="js/plugins/chartist.min.js"></script>
  <script src="js/plugins/bootstrap-notify.js"></script>
  <script src="js/dashboard.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');
        $sidebar_img_container = $sidebar.find('.sidebar-background');
        $full_page = $('.full-page');
        $sidebar_responsive = $('body > .navbar-collapse');
        window_width = $(window).width();
        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');
          $(this).siblings().removeClass('active');
          $(this).addClass('active');
          var new_color = $(this).data('color');
          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }
          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }
          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });
        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');
          var new_color = $(this).data('background-color');
          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');
          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');
          var new_image = $(this).find("img").attr('src');
          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }
          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');
            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }
          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');
            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }
          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');
          $input = $(this);
          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }
            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }
            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }
            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
            $body = $('body');
          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;
            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();
          } else {
            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');
            setTimeout(function() {
              $('body').addClass('sidebar-mini');
              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);
        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {

      md.initDashboardPageCharts();
    });
  </script>
  <script>

(function() {
  isWindows = navigator.platform.indexOf('Win') > -1 ? true : false;
  if (isWindows) {
    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();
    $('html').addClass('perfect-scrollbar-on');
  } else {
    $('html').addClass('perfect-scrollbar-off');
  }
})();

var breakCards = true;
var searchVisible = 0;
var transparent = true;
var transparentDemo = true;
var fixedTop = false;

var mobile_menu_visible = 0,
  mobile_menu_initialized = false,
  toggle_initialized = false,
  bootstrap_nav_initialized = false;


var seq = 0,
  delays = 80,
  durations = 500;
var seq2 = 0,
  delays2 = 80,
  durations2 = 500;

$(document).ready(function() {
  $('body').bootstrapMaterialDesign();
  $sidebar = $('.sidebar');
  md.initSidebarsCheck();
  window_width = $(window).width();
  md.checkSidebarImage();

  if ($(".selectpicker").length != 0) {
    $(".selectpicker").selectpicker();
  }


  //  Activate the tooltips

  $('[rel="tooltip"]').tooltip();



  $('.form-control').on("focus", function() {

    $(this).parent('.input-group').addClass("input-group-focus");

  }).on("blur", function() {

    $(this).parent(".input-group").removeClass("input-group-focus");

  });



  // remove class has-error for checkbox validation

  $('input[type="checkbox"][required="true"], input[type="radio"][required="true"]').on('click', function() {

    if ($(this).hasClass('error')) {

      $(this).closest('div').removeClass('has-error');

    }

  });



});



$(document).on('click', '.navbar-toggler', function() {

  $toggle = $(this);



  if (mobile_menu_visible == 1) {

    $('html').removeClass('nav-open');



    $('.close-layer').remove();

    setTimeout(function() {

      $toggle.removeClass('toggled');

    }, 400);



    mobile_menu_visible = 0;

  } else {

    setTimeout(function() {

      $toggle.addClass('toggled');

    }, 430);



    var $layer = $('<div class="close-layer"></div>');



    if ($('body').find('.main-panel').length != 0) {

      $layer.appendTo(".main-panel");



    } else if (($('body').hasClass('off-canvas-sidebar'))) {

      $layer.appendTo(".wrapper-full-page");

    }



    setTimeout(function() {

      $layer.addClass('visible');

    }, 100);



    $layer.click(function() {

      $('html').removeClass('nav-open');

      mobile_menu_visible = 0;



      $layer.removeClass('visible');



      setTimeout(function() {

        $layer.remove();

        $toggle.removeClass('toggled');



      }, 400);

    });



    $('html').addClass('nav-open');

    mobile_menu_visible = 1;



  }



});

$(window).resize(function() {

  md.initSidebarsCheck();

  seq = seq2 = 0;
  setTimeout(function() {

    md.initDashboardPageCharts();

  }, 500);

});

md = {

  misc: {

    navbar_menu_visible: 0,

    active_collapse: true,

    disabled_collapse_init: 0

  },



  checkSidebarImage: function() {

    $sidebar = $('.sidebar');

    image_src = $sidebar.data('image');



    if (image_src !== undefined) {

      sidebar_container = '<div class="sidebar-background" style="background-image: url(' + image_src + ') "/>';

      $sidebar.append(sidebar_container);

    }

  },



  initSidebarsCheck: function() {

    if ($(window).width() <= 991) {

      if ($sidebar.length != 0) {

        md.initRightMenu();

      }

    }

  },



  initDashboardPageCharts: function() {



    if ($('#dailySalesChart').length != 0 || $('#completedTasksChart').length != 0 || $('#websiteViewsChart').length != 0) {

        dataDailySalesChart = {

        labels: ['0', '1', '2', '3', '4', '5', '6'],

        series: [

          <?php
            echo '['.$qtdshow.',0, 0, 0, 0,0, 0]';
          ?>

        ]

      };



      optionsDailySalesChart = {

        lineSmooth: Chartist.Interpolation.cardinal({

          tension: 0

        }),

        low: 0,

        high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look

        chartPadding: {

          top: 0,

          right: 0,

          bottom: 0,

          left: 0

        },

      }



      var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

      md.startAnimationForLineChart(dailySalesChart);

      dataCompletedTasksChart = {

        labels: ['50', '100', '150', '200', '250', '300', '350'],

        series: [

          <?php
            $poltronasLivres = $totalpoltronasShow - $reservada;
            echo '['.$poltronasLivres.',0, 0, 0, 0,0, 0]';
            ?>

        ]

      };



      optionsCompletedTasksChart = {

        lineSmooth: Chartist.Interpolation.cardinal({

          tension: 0

        }),

        low: 0,

        high: 350,

        chartPadding: {

          top: 0,

          right: 0,

          bottom: 0,

          left: 0

        }

      }



      var completedTasksChart = new Chartist.Line('#completedTasksChart', dataCompletedTasksChart, optionsCompletedTasksChart);

      md.startAnimationForLineChart(completedTasksChart);


      var dataWebsiteViewsChart = {

        labels: ['10', '20', '30', '40', '50', '60', '70'],

        series: [

          <?php 

            echo '['.$reservada.',0, 0, 0, 0,0, 0]';
            ?>
        ]

      };

      var optionsWebsiteViewsChart = {

        axisX: {

          showGrid: false

        },

        low: 0,

        high: 50,

        chartPadding: {

          top: 0,

          right: 5,

          bottom: 0,

          left: 0

        }

      };

      var responsiveOptions = [

        ['screen and (max-width: 640px)', {

          seriesBarDistance: 5,

          axisX: {

            labelInterpolationFnc: function(value) {

              return value[0];

            }

          }

        }]

      ];

      var websiteViewsChart = Chartist.Bar('#websiteViewsChart', dataWebsiteViewsChart, optionsWebsiteViewsChart, responsiveOptions);


      md.startAnimationForBarChart(websiteViewsChart);

    }

  },



  showNotification: function(from, align) {

    type = ['', 'info', 'danger', 'success', 'warning', 'primary'];



    color = Math.floor((Math.random() * 5) + 1);



    $.notify({

      icon: "add_alert",

      message: "Welcome to <b>Material Dashboard</b> - a beautiful freebie for every web developer."



    }, {

      type: type[color],

      timer: 3000,

      placement: {

        from: from,

        align: align

      }

    });

  },



  checkScrollForTransparentNavbar: debounce(function() {

    if ($(document).scrollTop() > 260) {

      if (transparent) {

        transparent = false;

        $('.navbar-color-on-scroll').removeClass('navbar-transparent');

      }

    } else {

      if (!transparent) {

        transparent = true;

        $('.navbar-color-on-scroll').addClass('navbar-transparent');

      }

    }

  }, 17),



  initRightMenu: debounce(function() {



    $sidebar_wrapper = $('.sidebar-wrapper');



    if (!mobile_menu_initialized) {

      console.log('intra');

      $navbar = $('nav').find('.navbar-collapse').children('.navbar-nav');



      mobile_menu_content = '';



      nav_content = $navbar.html();



      nav_content = '<ul class="nav navbar-nav nav-mobile-menu">' + nav_content + '</ul>';



      navbar_form = $('nav').find('.navbar-form').length != 0 ? $('nav').find('.navbar-form')[0].outerHTML : null;
      $sidebar_nav = $sidebar_wrapper.find(' > .nav');

      $nav_content = $(nav_content);

      $navbar_form = $(navbar_form);

      $nav_content.insertBefore($sidebar_nav);

      $navbar_form.insertBefore($nav_content);



      $(".sidebar-wrapper .dropdown .dropdown-menu > li > a").click(function(event) {

        event.stopPropagation();



      });

      window.dispatchEvent(new Event('resize'));



      mobile_menu_initialized = true;

    } else {

      if ($(window).width() > 991) {

        $sidebar_wrapper.find('.navbar-form').remove();

        $sidebar_wrapper.find('.nav-mobile-menu').remove();

        mobile_menu_initialized = false;

      }

    }

  }, 200),

  startAnimationForLineChart: function(chart) {

    chart.on('draw', function(data) {

      if ((data.type === 'line' || data.type === 'area') && window.matchMedia("(min-width: 900px)").matches) {

        data.element.animate({

          d: {

            begin: 600,

            dur: 700,

            from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),

            to: data.path.clone().stringify(),

            easing: Chartist.Svg.Easing.easeOutQuint

          }

        });

      } else if (data.type === 'point') {

        seq++;

        data.element.animate({

          opacity: {

            begin: seq * delays,

            dur: durations,

            from: 0,

            to: 1,

            easing: 'ease'

          }

        });

      }



    });

    seq = 0;



  },

  startAnimationForBarChart: function(chart) {

    chart.on('draw', function(data) {

      if (data.type === 'bar' && window.matchMedia("(min-width: 900px)").matches) {

        seq2++;

        data.element.animate({

          opacity: {

            begin: seq2 * delays2,

            dur: durations2,

            from: 0,

            to: 1,

            easing: 'ease'

          }

        });

      }



    });



    seq2 = 0;



  }

}

function debounce(func, wait, immediate) {

  var timeout;

  return function() {

    var context = this,

      args = arguments;

    clearTimeout(timeout);

    timeout = setTimeout(function() {

      timeout = null;

      if (!immediate) func.apply(context, args);

    }, wait);

    if (immediate && !timeout) func.apply(context, args);

  };

};

  </script>

</body>



</html>