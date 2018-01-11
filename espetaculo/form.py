from django import  forms
from .models import Estepaculo

class EspetaculoForm(forms.ModelForm):
    class Meta:
        model = Estepaculo
        fields = ['titulo', 'data']
