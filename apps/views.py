from django.shortcuts import render, redirect, get_object_or_404
from django.http import HttpResponse

def home(request):
    html = """
    <h1>SAE desafia</h1>
    <a href="/shows/">Entrar</a><br>   
    """
    return HttpResponse(html)