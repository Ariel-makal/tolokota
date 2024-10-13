from django.shortcuts import render

# Create your views here.
def home(request):
    return render(request, "home/index.html")
def blog(request):
    return render(request, "html/blog.html")
def about(request):
    return render(request, "html/about.html")
def maps(request):
    return render(request, "html/maps.html")