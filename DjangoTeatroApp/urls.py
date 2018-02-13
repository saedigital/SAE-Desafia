"""
Definition of urls for DjangoTeatroApp.
"""

from datetime import datetime
from django.conf.urls import include
from django.conf.urls import url
import django.contrib.auth.views
from rest_framework import routers
from app import views 

# Uncomment the next lines to enable the admin:
# from django.conf.urls import include
# from django.contrib import admin
# admin.autodiscover()

router = routers.DefaultRouter()
router.register(r'espetaculos',views.EspetaculoView)
router.register(r'poltronas', views.PoltronaView)
router.register(r'reservas',views.ReservaView)

urlpatterns = [
    url(r'^', include(router.urls)),
    # Uncomment the admin/doc line below to enable admin documentation:
    # url(r'^admin/doc/', include('django.contrib.admindocs.urls')),

    # Uncomment the next line to enable the admin:
    # url(r'^admin/', include(admin.site.urls)),
]
