from django.conf.urls import patterns, url

from reserve import views

urlpatterns = patterns('',
  url(r'^new$', views.reserve_create, name='reserve_new'),
  url(r'^delete$', views.reserve_delete, name='reserve_delete'),
)