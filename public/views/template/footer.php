
<noscript id="deferred-styles">
    <?php

    if (file_exists('public/criticalcss/'.$informacoes['pagina'].'.css') && $_ENV['ENVIRONMENT'] != 'development') print '<style>'.file_get_contents('public/critical/'.$informacoes['pagina'].'.css').'</style>';
    
    if($_ENV['ENVIRONMENT'] == 'development'){
        echo '<link rel="stylesheet" href="src/css/geral.css?v='.$_ENV['ASSETS_VERSION'].'">';
        if (isset($informacoes['css'])) {
            foreach ($informacoes['css'] as $file) {
                echo '<link rel="stylesheet" href="src/css/'.$file.'?v='.$_ENV['ASSETS_VERSION'].'">';
            }
        }
    }else{
        echo '<link href="'.base_url().'public/css/geral.min.css?v='.$_ENV['ASSETS_VERSION'].'" rel="stylesheet" type="text/css" async />';
        echo '<link href="'.base_url().'public/css/'.$informacoes['pagina'].'.min.css?v='.$_ENV['ASSETS_VERSION'].'" rel="stylesheet" type="text/css" async />';
    }

    if($_ENV['ENVIRONMENT'] == 'development'){
        echo '<script src="src/js/geral.js?v='.$_ENV['ASSETS_VERSION'].'"></script>';
        if (isset($informacoes['scripts'])) {
            foreach ($informacoes['scripts'] as $script) {
                echo '<script src="src/'.$script.'?v='.$_ENV['ASSETS_VERSION'].'"></script>';
            }
        }
    }else{
        print '<script async type="text/javascript" src="public/js/geral.min.js?v='.$_ENV['ASSETS_VERSION'].'"></script>';
        print '<script async type="text/javascript" src="public/js/'.$informacoes['pagina'].'.min.js?v='.$_ENV['ASSETS_VERSION'].'"></script>';
    }

    ?>
</noscript>
<script>
    WebFontConfig = {
		google: {
			families: ['Quicksand:400,700']
		}
	};

	(function(d) {
		var wf = d.createElement('script'), s = d.scripts[0];
		wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
		wf.async = true;
		s.parentNode.insertBefore(wf, s);
	})(document);

    var loadDeferredStyles = function() {
	var addStylesNode = document.getElementById("deferred-styles");
	var replacement = document.createElement("div");
	replacement.innerHTML = addStylesNode.textContent;
	document.body.appendChild(replacement)
	addStylesNode.parentElement.removeChild(addStylesNode);
	};
	var raf = requestAnimationFrame || mozRequestAnimationFrame ||
		webkitRequestAnimationFrame || msRequestAnimationFrame;
	if (raf) raf(function() { window.setTimeout(loadDeferredStyles, 0); });
	else window.addEventListener('load', loadDeferredStyles);
</script>
</body>
</html>