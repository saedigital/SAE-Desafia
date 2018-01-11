from django.conf.urls import url, include
from django.contrib.auth import views as auth_views
from . import views

urlpatterns = [
    url(r'^$', views.EspetaculoLista.as_view(), name="dashboard"),
    url(r'^reservar/$', views.reservar, name='reserva'),
    url(r'^cancelar/$', views.cancelar, name='cancelar'),
    url(r'^deletar/(?P<pk>[0-9]+)/$', views.EspetaculoDelete.as_view(), name='deletar'),
    url(r'^detalhes/(?P<pk>[0-9]+)$', views.detalhes, name='detalhes'),
    url(r'^update-espetaculo/(?P<pk>[0-9]+)$', views.updateEspetaculo, name='update-espetaculo'),

]