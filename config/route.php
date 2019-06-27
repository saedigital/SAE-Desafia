<?php

use App\Config\RouteCollection;

RouteCollection::set('espetaculo\/novo', 'Espetaculo', 'novo');
RouteCollection::set('espetaculo\/editar\/([0-9]+)', 'Espetaculo', 'editar');
RouteCollection::set('', 'Espetaculo', 'index');