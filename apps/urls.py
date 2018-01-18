from django.conf.urls import include, url
from django.contrib import admin

urlpatterns = [
    # Examples:
    # url(r'^$', 'apps.views.home', name='home'),
    # url(r'^blog/', include('blog.urls')),

    url(r'^admin/', include(admin.site.urls)),
    url(r'^shows/', include('show.urls', namespace='show')),
    url(r'^reserves/', include('reserve.urls', namespace='reserve')),
    url(r'^$', 'apps.views.home'),
]
