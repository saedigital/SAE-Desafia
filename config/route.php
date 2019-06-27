<?php

use App\Config\RouteCollection;

RouteCollection::set('configurar$', 'Dashboard', 'menu');

RouteCollection::set('local\/novo', 'Local', 'novo');
RouteCollection::set('local\/editar\/([0-9]+)', 'Local', 'editar');
RouteCollection::set('local\/save(\/[0-9]+|.*)', 'Local', 'save');
RouteCollection::set('local\/excluir\/([0-9]+)', 'Local', 'excluir');
RouteCollection::set('local\/([0-9]+)\/poltronas$', 'LocalPoltrona', 'index');
RouteCollection::set('local\/([0-9]+)\/poltrona\/novo', 'LocalPoltrona', 'novo');
RouteCollection::set('local\/([0-9]+)\/poltrona\/editar\/([0-9]+)', 'LocalPoltrona', 'editar');
RouteCollection::set('local\/([0-9]+)\/poltrona\/save(\/[0-9]+|.*)', 'LocalPoltrona', 'save');
RouteCollection::set('local\/([0-9]+)\/poltrona\/excluir\/([0-9]+)', 'LocalPoltrona', 'excluir');
RouteCollection::set('local$', 'Local', 'index');



RouteCollection::set('espetaculo\/novo', 'Espetaculo', 'novo');
RouteCollection::set('espetaculo\/editar\/([0-9]+)', 'Espetaculo', 'editar');
RouteCollection::set('espetaculo\/remover\/([0-9]+)', 'Espetaculo', 'remover');
RouteCollection::set('espetaculo\/save(\/[0-9]+|.*)', 'Espetaculo', 'save');
RouteCollection::set('espetaculo\/([0-9]+)\/reservas', 'Espetaculo', 'reservas');
RouteCollection::set('espetaculo\/([0-9]+)\/reserva\/([0-9]+)', 'Espetaculo', 'reserva');
RouteCollection::set('', 'Espetaculo', 'index');