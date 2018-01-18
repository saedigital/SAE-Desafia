from django.db.models import Sum
from django.shortcuts import render, redirect, get_object_or_404
from django.forms import ModelForm

from reserve.models import Chair, Reserve
from show.models import Show


class ShowForm(ModelForm):
    class Meta:
        model = Show
        fields = ['name', 'author', 'date']


def show_list(request, template_name='show/show_list.html'):
    show = Show.objects.all()
    data = {
        'object_list': show,
    }
    return render(request, template_name, data)


def show_create(request, template_name='show/show_form.html'):
    form = ShowForm(request.POST or None)
    if form.is_valid():
        form.save()
        return redirect('show:show_list')
    return render(request, template_name, {'form': form})


def show_update(request, pk, template_name='show/show_form.html'):
    show = get_object_or_404(Show, pk=pk)
    chairs = Chair.objects.all()
    reserves = Reserve.objects.filter(show=pk).values_list('chair', flat=True)
    total = Reserve.objects.filter(show=pk).aggregate(Sum('price'))
    form = ShowForm(request.POST or None, instance=show)
    if form.is_valid():
        form.save()
        return redirect('show:show_list')
    return render(request, template_name, {'total':total, 'show': show, 'form': form, 'reserves': reserves, 'chairs': chairs})


def show_delete(request, pk, template_name='show/show_confirm_delete.html'):
    show = get_object_or_404(Show, pk=pk)    
    if request.method=='POST':
        show.delete()
        return redirect('show:show_list')
    return render(request, template_name, {'object':show})
