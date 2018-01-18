from django.conf.urls import patterns, url

from show import views

urlpatterns = patterns('',
  url(r'^$', views.show_list, name='show_list'),
  url(r'^new$', views.show_create, name='show_new'),
  url(r'^edit/(?P<pk>\d+)$', views.show_update, name='show_edit'),
  url(r'^delete/(?P<pk>\d+)$', views.show_delete, name='show_delete'),
)