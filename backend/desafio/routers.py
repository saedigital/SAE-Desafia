"""
    Modificado em 19/04/2018 11:20:20
"""
from rest_framework import routers
from espetaculos.views import EspetaculoViewSet
from poltronas.views import PoltronaViewSet
from poltronas.views import ReservaViewSet


router = routers.DefaultRouter()

router.register(r'espetaculos', EspetaculoViewSet)
router.register(r'poltronas', PoltronaViewSet)
router.register(r'reservas', ReservaViewSet)