from django.shortcuts import render, get_object_or_404
from django.core.urlresolvers import reverse_lazy
from django.http import HttpResponse, Http404, JsonResponse
from django.views.generic import CreateView, ListView, DeleteView
from .models import Estepaculo, Poltrona
from .form import EspetaculoForm
# Create your views here.
def home(request):
    espetaculo = Estepaculo.objects.get(pk=2)
    context = {
        'espetaculo' : espetaculo
    }
    return render(request, 'index.html', context)

def detalhes(request, pk):
    espetaculo = Estepaculo.objects.get(pk=pk)
    context = {
        'espetaculo' : espetaculo
    }
    return render(request, 'detail.html', context)
def reservar(request):
    if request.method == "POST" and request.is_ajax():
        pk = request.POST.get('poltrona')
        poltrona = get_object_or_404(Poltrona, pk=pk)
        poltrona.ocupada = True
        poltrona.save()
        espetaculo = poltrona.espetaculo
        toreturn = {
            'ocupados' : espetaculo.total_ocupada,
            'livre' : espetaculo.total_livre,
            'arrecadado' : espetaculo.arrecadado,
        }
        return JsonResponse(toreturn, safe=False)
    else:
        raise Http404

def cancelar(request):
    if request.method == "POST" and request.is_ajax():
        pk = request.POST.get('poltrona')
        poltrona = get_object_or_404(Poltrona, pk=pk)
        poltrona.ocupada = False
        poltrona.save()
        espetaculo = poltrona.espetaculo
        toreturn = {
            'ocupados' : espetaculo.total_ocupada,
            'livre' : espetaculo.total_livre,
            'arrecadado' : espetaculo.arrecadado,
        }
        return JsonResponse(toreturn, safe=False)
    else:
        raise Http404
    
def updateEspetaculo(request, pk):
    if request.is_ajax():
        espetaculo = get_object_or_404(Estepaculo, pk=pk)
        if request.method == 'POST':
            form = EspetaculoForm(request.POST, instance=espetaculo)
            if form.is_valid():
                
                espetaculo = form.save()
                toreturn = {
                    'nome' : espetaculo.titulo,
                }
                return JsonResponse(toreturn, safe=False)
            else:
                context = {
                    'form' : form
                }
                return render(request, 'formbyajax.html', context, status=500) 
        else:
            form = EspetaculoForm(instance=espetaculo)
            context = {
                'form' : form
            }
            return render(request, 'formbyajax.html', context) 
    else:
        raise Http404   


class EspetaculoLista (ListView):
    model = Estepaculo
    template_name = 'index.html'
    context_object_name = 'espetaculos'

class EspetaculoDelete(DeleteView):
    model = Estepaculo
    success_url = reverse_lazy('dashboard')
    template_name = 'confirmdelete.html'

def addEspetaculo(request):
    if request.is_ajax():
        if request.method == 'POST':
            form = EspetaculoForm(request.POST, )
            if form.is_valid():
                
                espetaculo = form.save()
                context = {
                    'espetaculos' : Estepaculo.objects.all()
                }
                return render(request, 'allespetaculos.html', context) 
            else:
                context = {
                    'form' : form
                }
                return render(request, 'formbyajax.html', context, status=500) 
        else:

            template_name = 'formbyajax.html'
            form = EspetaculoForm()
            context = {
                'form': form
            }
            return render(request, template_name, context)
    else:
        raise Http404