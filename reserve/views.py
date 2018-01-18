from pprint import pprint

from django.http import HttpResponse
from django.shortcuts import render, redirect, get_object_or_404
from django.forms import ModelForm

from reserve.models import Reserve


class ReserveForm(ModelForm):
    class Meta:
        model = Reserve
        fields = ['cpf', 'price', 'show', 'chair']


def reserve_create(request, template_name='reserve/reserve_form.html'):
    form = ReserveForm(request.POST or None, initial={'price': 23.76, 'show': request.GET['show'], 'chair': request.GET['chair']})
    if form.is_valid():
        form.save()
        return redirect('show:show_edit', pk=request.GET['show'])
    return render(request, template_name, {'form': form})


def reserve_delete(request, template_name='reserve/reserve_confirm_delete.html'):
    reserve = Reserve.objects.filter(chair=request.GET['chair'], show=request.GET['show']).first()
    if request.method == 'POST':
        reserve.delete()
        return redirect('show:show_edit', pk=request.GET['show'])
    return render(request, template_name, {'object': reserve})
